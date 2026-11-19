<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\client\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $statusLabels = [
            'pending' => 'Chờ xác nhận',
            'confirmed' => 'Đã xác nhận',
            'cancelled' => 'Đã hủy',
        ];

        $validator = Validator::make($request->query(), [
            'keyword' => ['nullable', 'string', 'max:100'],
            'status' => ['nullable', 'string', 'in:pending,confirmed,cancelled'],
        ], [
            'keyword.string' => 'Từ khóa tìm kiếm không hợp lệ.',
            'keyword.max' => 'Từ khóa tối đa 100 ký tự.',
            'status.string' => 'Trạng thái không hợp lệ.',
            'status.in' => 'Trạng thái không hợp lệ. Vui lòng chọn lại.',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.bookings.index')
                ->withErrors($validator);
        }

        $filters = $validator->validated();
        $keyword = trim($filters['keyword'] ?? '');
        $status = $filters['status'] ?? '';

        $query = Booking::query()
            ->leftJoin('tbl_tour', 'tbl_booking.tourid', '=', 'tbl_tour.tourid')
            ->select('tbl_booking.*', 'tbl_tour.title as tour_title');

        if (preg_match('/^#([0-9]+)$/', $keyword, $matches)) {
            // Ví dụ: #12 chỉ tìm đúng đơn số 12.
            $query->where('tbl_booking.bookingid', $matches[1]);
        } elseif ($keyword !== '') {
            $query->where(function ($search) use ($keyword) {
                $pattern = '%' . $keyword . '%';

                $search->where('tbl_booking.contactName', 'like', $pattern)
                    ->orWhere('tbl_booking.contactEmail', 'like', $pattern)
                    ->orWhere('tbl_booking.contactPhone', $keyword)
                    ->orWhere('tbl_tour.title', 'like', $pattern);

                if (ctype_digit($keyword)) {
                    $search->orWhere('tbl_booking.bookingid', $keyword);
                }
            });
        }

        if ($status !== '') {
            $query->where('tbl_booking.bookingStatus', $status);
        }

        $bookings = $query
            ->orderByDesc('tbl_booking.bookingDate')
            ->orderByDesc('tbl_booking.bookingid')
            ->paginate(10)
            ->withQueryString();

        return view('admin.bookings.index', compact(
            'bookings',
            'statusLabels',
            'keyword',
            'status'
        ));
    }
    public function show(string $bookingid)
    {
        $booking = Booking::query()
            ->leftJoin('tbl_tour', 'tbl_booking.tourid', '=', 'tbl_tour.tourid')
            ->select('tbl_booking.*', 'tbl_tour.title as tour_title')
            ->where('tbl_booking.bookingid', $bookingid)
            ->firstOrFail();

        $statusLabels = [
            'pending' => 'Chờ xác nhận',
            'confirmed' => 'Đã xác nhận',
            'cancelled' => 'Đã hủy',
        ];
        $paymentLabels = [
            'office' => 'Thanh toán tại văn phòng',
            'bank' => 'Chuyển khoản ngân hàng',
        ];

        return view('admin.bookings.show', compact(
            'booking',
            'statusLabels',
            'paymentLabels'
        ));
    }

    public function confirm(string $bookingid)
    {
        $booking = Booking::findOrFail($bookingid);

        $update = Booking::where('bookingid', $booking->bookingid)
            ->where('bookingStatus', 'pending')
            ->update(['bookingStatus' => 'confirmed',]);

        if (!$update) {
            return back()->with(
                'admin_error',
                'chỉ có thể xác nhận đơn hàng đang chờ xác nhận.'
            );
        }
        return back()->with(
            'admin_success',
            'Đã xác nhận đơn #' . $booking->bookingid . '.'
        );
    }
    public function cancel(string $bookingid)
    {
        $updated = Booking::where('bookingid', $bookingid)
            ->where('bookingStatus', 'pending')
            ->update(['bookingStatus' => 'cancelled']);

        if (!$updated) {
            return back()->with('admin_error', 'Chỉ có thể hủy đơn đang chờ xác nhận.');
        }

        return back()->with('admin_success', "Đã hủy đơn #{$bookingid}.");
    }
}
