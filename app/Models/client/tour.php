<?php

namespace App\Models\client;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;



class tour extends Model
{
    use HasFactory;

    protected $table = 'tbl_tour';
    protected $primaryKey = 'tourid';
    public $timestamps = false;
    protected $fillable = [
        'title',
        'destination',
        'domain',
        'time',
        'startDate',
        'endDate',
        'quantity',
        'priceAdult',
        'priceChild',
        'description',
        'display_position'
    ];

    //Lay danh sach tour
    // public function getAllTour()
    // {
    //     $AllTour = DB::table($this->table)
    //         ->get();
    //     foreach ($AllTour as $tour) {
    //         $tour->images = DB::table('tbl_images')
    //             ->where('tourid', $tour->tourid)
    //             ->pluck('imageUrl');
    //     }
    //     return  $AllTour;
    // }
    //Lay chi tiet tour
    public function gettourdetail($id)
    {
        $tourdetail = DB::table($this->table)
            ->where('tourid', $id)
            ->first();

        if (!$tourdetail) {
            return null;
        }

        $tourdetail->images = self::orderedImages()
            ->where('tourid', $tourdetail->tourid)
            ->limit(5)
            ->pluck('imageURL');

        $tourdetail->timeline = DB::table('tbl_timeline')
            ->where('tourid', $tourdetail->tourid)
            ->orderBy('timeLineid')
            ->get();


        return $tourdetail;
    }

    public static function orderedImages()
    {
        return DB::table('tbl_images')->orderBy('uploadDate')->orderBy('imageURL');
    }
    //lay khu vuc tour
    public function getDomain(bool $onlyToursPage = false)
    {
        $query = DB::table($this->table);

        if ($onlyToursPage) {
            $query->whereIn('display_position', ['both', 'tours']);
        }

        return $query->select('domain')
            ->selectRaw('COUNT(*) AS total')
            ->groupBy('domain')
            ->pluck('total', 'domain');
    }
    public function getDestinations()
    {
        return DB::table($this->table)
            ->whereIn('display_position', ['both', 'tours'])
            ->where('destination', '<>', '')
            ->distinct()
            ->orderBy('destination')
            ->pluck('destination');
    }
    public function filterTour(array $filters = [])
    {
        // Tính điểm trung bình của từng tour.
        $ratings = DB::table('tbl_reviews')
            ->select('tourid')
            ->selectRaw('AVG(rating) AS average_rating')
            ->groupBy('tourid');

        // Lấy tour kèm điểm trung bình.
        $query = DB::table($this->table . ' as tours')
            ->leftJoinSub($ratings, 'ratings', function ($join) {
                $join->on('tours.tourid', '=', 'ratings.tourid');
            })
            ->select('tours.*', 'ratings.average_rating');
        $query->whereIn('tours.display_position', ['both', 'tours']);

        // Lọc theo miền
        if (!empty($filters['domain'])) {
            $query->where('tours.domain', $filters['domain']);
        }

        // Lọc theo điểm đến
        if (!empty($filters['destination'])) {
            $query->where('tours.destination', $filters['destination']);
        }

        // Thời gian.
        $durations = [
            '1n1d' => '1 ngày 1 đêm',
            '3n2d' => '3 Ngày 2 Đêm',
            '4n3d' => '4 ngày 3 đêm',
            '5n4d' => '5 ngày 4 đêm',
        ];

        if (!empty($filters['duration'])) {
            $query->where(
                'tours.time',
                $durations[$filters['duration']]
            );
        }

        // Đúng số sao trung bình đã chọn.
        if (isset($filters['rating'])) {
            $query->where(
                'ratings.average_rating',
                '=',
                (int) $filters['rating']
            );
        }

        // Khoảng giá người lớn.
        if (isset($filters['min_price'])) {
            $query->where('tours.priceAdult', '>=', $filters['min_price']);
        }

        if (isset($filters['max_price'])) {
            $query->where('tours.priceAdult', '<=', $filters['max_price']);
        }

        // Sắp xếp toàn bộ kết quả trước khi phân trang.
        switch ($filters['sort'] ?? 'default') {
            case 'old':
                $query->orderBy('tours.tourid', 'asc');
                break;
            case 'high-to-low':
                $query->orderBy('tours.priceAdult', 'desc')
                    ->orderBy('tours.tourid', 'desc');
                break;
            case 'low-to-high':
                $query->orderBy('tours.priceAdult', 'asc')
                    ->orderBy('tours.tourid', 'desc');
                break;
            case 'new':
            default:
                $query->orderBy('tours.tourid', 'desc');
                break;
        }

        // Phân trang và giữ cả bộ lọc lẫn lựa chọn sắp xếp.
        $tours = $query
            ->paginate(12)
            ->withQueryString();

        // Lấy ảnh cho các tour thuộc trang hiện tại.
        $images = self::orderedImages()
            ->whereIn('tourid', $tours->getCollection()->pluck('tourid'))
            ->get()
            ->groupBy('tourid');

        foreach ($tours as $tour) {
            $tour->images = $images
                ->get($tour->tourid, collect())
                ->pluck('imageURL');
        }

        return $tours;
    }
}
