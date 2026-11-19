<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\client\Booking;
use App\Models\client\tour as TourModel;
use Illuminate\Http\Request;

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
}
