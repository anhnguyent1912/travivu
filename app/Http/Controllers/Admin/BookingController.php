<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\client\Booking;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::query()
        ->leftJoin('tbl_tour', 'tbl_booking.tourid', '=', 'tbl_tour.tourid')
        ->select('tbl_booking.*','tbl_tour.title as tour_title')
        ->orderByDesc('tbl_booking.bookingDate')
        ->orderByDesc('tbl_booking.bookingid')
        ->paginate(10);

        $statusLabels = [
            'pending' => 'Chờ xác nhận',
            'confirmed' => 'Đã xác nhận',
            'cancelled' => 'Đã hủy',
        ];
        return view('admin.bookings.index', compact(
            'bookings',
            'statusLabels'
        ));
    }

    public function confirm(string $bookingid)
    {
        $booking = Booking::findOrFail($bookingid);

        $update = Booking::where('bookingid', $booking->bookingid)
            ->where('bookingStatus', 'pending')
            ->update(['bookingStatus' => 'confirmed',]);

        if (!$update){
            return back()->with(
                'admin_error', 'chỉ có thể xác nhận đơn hàng đang chờ xác nhận.'
            );
        }

        return back()->with(
            'admin_success', 'Đã xác nhận đơn #' . $booking->bookingid . '.'
        );

    }

}