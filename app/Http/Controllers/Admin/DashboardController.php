<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\client\Booking;
use App\Models\client\tour;

class DashboardController extends Controller
{
    public function index()
    {
        $activeTours = tour::where('availability', 1)->count();
        $totalBookings = Booking::count();
        $pendingBookings = Booking::where('bookingStatus', 'pending')
            ->count();
        $confirmedValue = Booking::where('bookingStatus', 'confirmed')
            ->sum('totalPrice');

        //số tour trong các khu vực
        $domainCounts = (new tour())->getDomain();
        $domainLabels = [
            'b' => 'Miền Bắc',
            't' => 'Miền Trung',
            'n' => 'Miền Nam',
        ];
        //đơn theo từng trạng thái
        $statusCounts = Booking::query()
            ->select('bookingStatus')
            ->selectRaw('COUNT(*) AS total')
            ->groupBy('bookingStatus')
            ->pluck('total', 'bookingStatus');

        $statusLabels = [
            'pending' => 'Chờ xác nhận',
            'confirmed' => 'Đã xác nhận',
            'cancelled' => 'Đã hủy',
        ];
        // 4 đơn đặt mới nhất.
        $latestBookings = Booking::query()
            ->leftJoin('tbl_tour', 'tbl_booking.tourid', '=', 'tbl_tour.tourid')
            ->select('tbl_booking.*', 'tbl_tour.title as tour_title')
            ->orderByDesc('tbl_booking.bookingDate')
            ->orderByDesc('tbl_booking.bookingid')
            ->limit(4)
            ->get();

        // 5 tour có nhiều đơn nhất, không tính đơn đã hủy.
        $popularTours = Booking::query()
            ->join('tbl_tour', 'tbl_booking.tourid', '=', 'tbl_tour.tourid')
            ->whereIn('tbl_booking.bookingStatus', ['pending', 'confirmed'])
            ->select('tbl_tour.tourid', 'tbl_tour.title')
            ->selectRaw('COUNT(*) AS total_bookings')
            ->groupBy('tbl_tour.tourid', 'tbl_tour.title')
            ->orderByDesc('total_bookings')
            ->orderBy('tbl_tour.tourid')
            ->limit(5)
            ->get();
        return view('admin.dashboard', compact(
            'activeTours',
            'totalBookings',
            'pendingBookings',
            'confirmedValue',
            'domainCounts',
            'domainLabels',
            'statusCounts',
            'statusLabels',
            'latestBookings',
            'popularTours'
        ));
    }
}
