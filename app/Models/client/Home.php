<?php

namespace App\Models\client;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class Home extends Model
{
    use HasFactory;


    protected $table = 'tbl_tour';

    public function gethomeTour()
    {
        // 1. Lấy danh sách tour
        $getTour = DB::table($this->table)
            ->whereIn('display_position', ['both', 'home'])
            ->get();

        // 2. Chạy vòng lặp 
        foreach ($getTour as $tour) {

            // 3. Lấy hình ảnh 
            $tour->images = tour::orderedImages()
                ->where('tourid', $tour->tourid)
                ->pluck('imageURL');
        }

        return $getTour;
    }
    public function getPopularDestinations()
    {
        return DB::table('tbl_tour as t')
            ->leftJoin('tbl_images as i', 'i.tourid', '=', 't.tourid')
            ->whereIn('t.display_position', ['both', 'tours'])
            ->where('t.destination', '<>', '')
            ->select('t.destination')
            ->selectRaw("MIN(NULLIF(i.imageURL, '')) AS photo")
            ->groupBy('t.destination')
            ->orderByRaw('COUNT(DISTINCT t.tourid) DESC')
            ->orderBy('t.destination')
            ->limit(6)
            ->get();
    }
}
