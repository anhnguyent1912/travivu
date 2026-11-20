<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\client\Booking;
use App\Models\client\tour as TourModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class TourController extends Controller
{
    public function index()
    {
        $reservedSeats = Booking::query()
            ->selectRaw('COALESCE(SUM(numAdults + numChildren), 0)')
            ->whereColumn('tbl_booking.tourid', 'tbl_tour.tourid')
            ->whereIn('bookingStatus', ['pending', 'confirmed']);

        $tours = TourModel::query()
            ->select('tbl_tour.*')
            ->selectSub($reservedSeats, 'reserved_seats')
            ->orderByDesc('tourid')
            ->paginate(10);

        $domainLabels = [
            'b' => 'Miền Bắc',
            't' => 'Miền Trung',
            'n' => 'Miền Nam',
        ];

        return view('admin.tours', compact('tours', 'domainLabels'));
    }

    public function updateAvailability(Request $request, string $tourid)
    {
        $data = $request->validate([
            'availability' => ['required', 'in:0,1'],
        ], [
            'availability.required' => 'Vui lòng chọn trạng thái nhận đặt.',
            'availability.in' => 'Trạng thái nhận đặt không hợp lệ.',
        ]);

        $tour = TourModel::findOrFail($tourid);
        $availability = (int) $data['availability'];

        if (
            $availability === 1 &&
            (!$tour->startDate || $tour->startDate <= today()->toDateString())
        ) {
            return back()->with('admin_error', 'Chỉ mở nhận đặt cho tour có ngày khởi hành sau hôm nay.');
        }
        $tour->availability = $availability;
        $tour->save();
        $message = $availability === 1 ? 'Đã mở nhận đặt' : 'Đã đóng nhận đặt';
        return back()->with('admin_success', "{$message} cho tour #{$tourid}.");
    }
    public function create()
    {
        $tour = new TourModel();
        $timeline = collect();
        $images = collect();

        return view('admin.dstour', compact('tour', 'timeline', 'images'));
    }

    public function edit(string $tourid)
    {
        $tour = TourModel::findOrFail($tourid);

        $timeline = DB::table('tbl_timeline')
            ->where('tourid', $tourid)
            ->orderBy('timeLineid')
            ->get();

        $images = TourModel::orderedImages()->where('tourid', $tourid)->pluck('imageURL');
        return view('admin.dstour', compact('tour', 'timeline', 'images'));
    }
    private function validateTour(Request $request): array
    {
        return $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'destination' => ['required', 'string', 'max:255'],
            'domain'      => ['required', 'in:b,t,n'],
            'time'        => ['required', 'string', 'max:255'],
            'startDate'   => ['required', 'date_format:Y-m-d'],
            'endDate'     => ['required', 'date_format:Y-m-d', 'after_or_equal:startDate'],
            'quantity'    => ['required', 'integer', 'min:1', 'max:2147483647'],
            'priceAdult'  => ['required', 'integer', 'min:1'],
            'priceChild'  => ['required', 'integer', 'min:0'],
            'display_position' => ['required', 'in:both,home,tours'],
            'description' => ['required', 'string', 'max:10000'],
            'timeline' => ['sometimes', 'array'],
            'timeline.*' => ['array:timeLineid,title,description'],
            'timeline.*.timeLineid' => ['nullable', 'integer', 'min:1', 'distinct'],
            'timeline.*.title' => [
                'required_with:timeline.*.description,timeline.*.timeLineid',
                'nullable',
                'string',
                'max:255',
            ],
            'timeline.*.description' => [
                'required_with:timeline.*.title,timeline.*.timeLineid',
                'nullable',
                'string',
                'max:10000',
            ],
            'tour_images' => ['sometimes', 'array', 'min:1', 'max:5'],
            'tour_images.*' => ['bail', 'required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ], [
            'required' => 'Vui lòng nhập :attribute.',
            'string' => ':attribute không hợp lệ.',
            'integer' => ':attribute phải là số nguyên.',
            'min' => ':attribute phải từ :min trở lên.',
            'max' => ':attribute vượt quá giới hạn :max.',
            'date_format' => ':attribute không đúng định dạng ngày.',
            'domain.in' => 'Vui lòng chọn một trong ba khu vực.',
            'tour_images.max' => 'Vui lòng chọn tối đa 5 ảnh.',
            'tour_images.*.image' => 'Tệp đã chọn phải là ảnh.',
            'tour_images.*.mimes' => 'Ảnh phải có định dạng JPG, PNG hoặc WebP.',
            'tour_images.*.max' => 'Mỗi ảnh được có dung lượng tối đa 5 MB.',
            'tour_images.*.uploaded' => 'Không thể tải ảnh lên. Vui lòng kiểm tra lại dung lượng tệp.',
            'endDate.after_or_equal' => 'Ngày kết thúc phải từ ngày khởi hành trở đi.',
            'timeline.*.title.required_with' => 'Ngày :position còn thiếu tên chặng.',
            'timeline.*.description.required_with' => 'Ngày :position còn thiếu nội dung.',
            'timeline.*.title.max' => 'Tên chặng ngày :position tối đa 255 ký tự.',
            'timeline.*.description.max' => 'Nội dung ngày :position tối đa 10.000 ký tự.',
        ], [
            'title' => 'tên tour',
            'destination' => 'điểm đến',
            'domain' => 'khu vực',
            'time' => 'thời lượng',
            'startDate' => 'ngày khởi hành',
            'endDate' => 'ngày kết thúc',
            'quantity' => 'tổng số chỗ',
            'priceAdult' => 'giá người lớn',
            'priceChild' => 'giá trẻ em',
            'description' => 'mô tả',
        ]);
    }
    public function store(Request $request)
    {
        $tour = $this->saveTour($request);

        return redirect()->route('admin.tours.index')
            ->with('admin_success', "Đã thêm tour #{$tour->tourid}.");
    }

    public function update(Request $request, string $tourid)
    {
        $this->saveTour($request, $tourid);

        return redirect()->route('admin.tours.index')
            ->with('admin_success', "Đã cập nhật tour #{$tourid}.");
    }

    private function saveTour(Request $request, ?string $tourid = null): TourModel
    {
        $data = $this->validateTour($request);

        $files = $data['tour_images'] ?? [];
        $days = $data['timeline'] ?? [];

        unset($data['tour_images'], $data['timeline']);

        $disk = Storage::build([
            'driver' => 'local',
            'root' => public_path('clients/assets/images/image-tour'),
            'throw' => true,
        ]);
        $newPaths = [];
        $oldPaths = [];
        try {
            foreach (array_values($files) as $index => $file) {
                $name = ($index + 1) . '-' . $file->hashName();
                $newPaths[] = $disk->putFileAs('uploads', $file, $name);
            }

            $tour = DB::transaction(function () use ($tourid, $data, $days, $newPaths, &$oldPaths) {
                if ($tourid === null) {
                    $tour = new TourModel();
                    $tour->availability = 0;
                } else {
                    $tour = TourModel::whereKey($tourid)->lockForUpdate()->firstOrFail();
                    $reservedSeats = (int) Booking::where('tourid', $tourid)
                        ->whereIn('bookingStatus', ['pending', 'confirmed'])
                        ->sum(DB::raw('numAdults + numChildren'));
                    if ($data['quantity'] < $reservedSeats) {
                        throw ValidationException::withMessages([
                            'quantity' => "Tour đã giữ {$reservedSeats} chỗ. Tổng số chỗ phải ít nhất là {$reservedSeats}.",
                        ]);
                    }
                }

                $tour->fill($data)->save();
                foreach ($days as $i => $day) {
                    // Admin bấm thêm ngày nhưng để trống cả hai ô.
                    if (blank($day['title'] ?? null) && blank($day['description'] ?? null)) {
                        continue;
                    }

                    $values = [
                        'title' => $day['title'],
                        'description' => $day['description'],
                    ];

                    if (empty($day['timeLineid'])) {
                        // Ngày mới: tạo một dòng gắn với tour vừa lưu.
                        DB::table('tbl_timeline')->insert([
                            'tourid' => $tour->tourid,
                            ...$values,
                        ]);
                    } else {
                        // Ngày cũ: tìm đúng ngày thuộc tour đang sửa.
                        $row = DB::table('tbl_timeline')
                            ->where('tourid', $tour->tourid)
                            ->where('timeLineid', $day['timeLineid']);

                        if (!$row->exists()) {
                            throw ValidationException::withMessages([
                                "timeline.$i.timeLineid" => 'Ngày này không còn thuộc lịch trình của tour. Hãy tải lại trang.',
                            ]);
                        }

                        $row->update($values);
                    }
                }
                if ($newPaths) {
                    $images = DB::table('tbl_images')->where('tourid', $tour->tourid);
                    $oldPaths = $images->pluck('imageURL')->all();
                    $images->delete();
                    $uploadedAt = now();
                    foreach ($newPaths as $path) {
                        DB::table('tbl_images')->insert([
                            'tourid' => $tour->tourid,
                            'imageURL' => $path,
                            'description' => $tour->title,
                            'uploadDate' => $uploadedAt,
                        ]);
                    }
                }
                return $tour;
            });
        } catch (\Throwable $e) {
            $disk->delete($newPaths);
            throw $e;
        }

        foreach ($oldPaths as $path) {
            if (
                preg_match('~^uploads/[1-5]-[a-zA-Z0-9]{40}\.(?:jpg|jpeg|png|webp)$~D', $path)
                && !DB::table('tbl_images')->where('imageURL', $path)->exists()
            ) {
                $disk->delete($path);
            }
        }
        return $tour;
    }
}
