<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\client\Booking;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;


class BookingController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Tour đã đặt';

        $bookings = Booking::query()
            ->leftJoin('tbl_tour', 'tbl_booking.tourid', '=', 'tbl_tour.tourid')
            ->where('tbl_booking.userid', $request->user()->userid)
            ->select('tbl_booking.*', 'tbl_tour.title as tour_title')
            ->orderByDesc('tbl_booking.bookingDate')
            ->orderByDesc('tbl_booking.bookingid')
            ->paginate(5);

        $statusLabels = [
            'pending' => 'Chờ xác nhận',
            'confirmed' => 'Đã xác nhận',
            'cancelled' => 'Đã hủy',
        ];

        return view('clients.booking', compact(
            'title',
            'bookings',
            'statusLabels'
        ));
    }

    public function store(Request $request, string $tourid)
    {
        $data = $request->validate([
            'adult_quantity' => ['required', 'integer', 'min:1', 'max:100'],
            'child_quantity' => ['required', 'integer', 'min:0', 'max:100'],
            'contactName' => ['required', 'string', 'max:100'],
            'contactEmail' => ['required', 'email', 'max:255'],
            'contactPhone' => ['required', 'string', 'regex:/\A[0-9]{10}\z/'],
            'specialRequests' => ['nullable', 'string', 'max:255'],
            'contactAddress' => ['nullable', 'string', 'max:255'],
            'paymentMethod' => ['required', 'in:office,bank'],
        ], [
            'required' => 'Vui lòng nhập :attribute.',
            'integer' => ':attribute phải là một số nguyên.',
            'string' => ':attribute không hợp lệ.',

            'adult_quantity.min' => 'Cần có ít nhất 1 người lớn.',
            'adult_quantity.max' => 'Số lượng người vượt tối đa.',
            'child_quantity.min' => 'Số lượng trẻ em không được âm.',
            'child_quantity.max' => 'Số lượng trẻ em vượt tối đa.',

            'contactName.max' => 'Họ và tên không được vượt quá 100 ký tự.',
            'contactEmail.email' => 'Email không hợp lệ.',
            'contactEmail.max' => 'Email không được vượt quá 255 ký tự.',
            'contactPhone.regex' => 'Số điện thoại phải gồm 10 chữ số.',
            'specialRequests.max' => 'Yêu cầu đặc biệt không được vượt quá 255 ký tự.',
            'contactAddress.max' => 'Địa chỉ không được vượt quá 255 ký tự.',
            'paymentMethod.in' => 'Phương thức thanh toán không hợp lệ.',
        ], [
            'adult_quantity' => 'số lượng người lớn',
            'child_quantity' => 'số lượng trẻ em',
            'contactName' => 'họ và tên',
            'contactEmail' => 'email',
            'contactPhone' => 'số điện thoại',
            'specialRequests' => 'yêu cầu thêm',
            'contactAddress' => 'địa chỉ liên hệ',
            'paymentMethod' => 'phương thức thanh toán',
        ]);
        //Mặc định người đặt là tk đăng nhập
        $user = $request->user();

        //Kiểm tra chỗ và lưu đơn trong cùng 1 giao dịch.
        $booking = DB::transaction(function () use ($data, $tourid, $user) {
            $tour = DB::table('tbl_tour')->where('tourid', $tourid)->lockForUpdate()->first();
            abort_if(!$tour, 404, 'Tour không tồn tại.');

            //Kiểm tra tour đã mở đặt chưa
            if ((int)$tour->availability !== 1) {
                throw ValidationException::withMessages([
                    'booking' => 'Tour hiện không mở đặt.',
                ]);
            }
            //Đóng đặt từ ngày khởi hành
            if (!$tour->startDate || $tour->startDate <= today()->toDateString()) {
                throw ValidationException::withMessages([
                    'booking' => 'Tour chưa có ngày khởi hành hoặc đã quá hạn đặt.',
                ]);
            }
            // Tính số khách đơn mới
            $numAdults = (int)$data['adult_quantity'];
            $numChildren = (int)$data['child_quantity'];
            $requestSeats = $numAdults + $numChildren;

            //Tính số chỗ đã được giữ
            $reservedSeats = (int) DB::table('tbl_booking')
                ->where('tourid', $tourid)
                ->whereIn('bookingStatus', ['pending', 'confirmed'])
                ->sum(DB::raw('numAdults + numChildren'));

            $remainingSeats = max(0, (int) $tour->quantity - $reservedSeats);
            if ($requestSeats > $remainingSeats) {
                throw ValidationException::withMessages([
                    'booking' => "Tour chỉ còn {$remainingSeats} chỗ.",
                ]);
            }
            //Lấy giá từ database
            $unitPriceAdult = (int) round($tour->priceAdult);
            $unitPriceChild = (int) round($tour->priceChild);
            if ($unitPriceAdult <= 0 || $unitPriceChild < 0) {
                throw ValidationException::withMessages([
                    'booking' => 'Giá tour chưa hợp lệ. Vui lòng liên hệ hỗ trợ.',
                ]);
            }
            $totalPrice = ($numAdults * $unitPriceAdult) + ($numChildren * $unitPriceChild);
            //Gán dữ liệu cho dơn
            $booking = new Booking();

            $booking->tourid = $tour->tourid;
            $booking->userid = $user->userid;
            $booking->bookingDate = now();

            $booking->numAdults = $numAdults;
            $booking->numChildren = $numChildren;

            $booking->unitPriceAdult = $unitPriceAdult;
            $booking->unitPriceChild = $unitPriceChild;
            $booking->totalPrice = $totalPrice;

            $booking->contactName = $data['contactName'];
            $booking->contactEmail = $data['contactEmail'];
            $booking->contactPhone = $data['contactPhone'];
            $booking->contactAddress = $data['contactAddress'] ?? null;
            $booking->paymentMethod = $data['paymentMethod'];
            $booking->specialRequests = $data['specialRequests'] ?? null;

            $booking->bookingStatus = 'pending';

            $booking->save();
            return $booking;
        });
        return redirect()
            ->route('booking.success', ['bookingid' => $booking->bookingid])
            ->with('booking_success', 'Đặt tour thành công! Đơn của bạn đang chờ xác nhận.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $bookingid)
    {
        $title = 'Thông tin đặt hàng';

        $booking = Booking::where('userid', $request->user()->userid) //ng dat
            ->where('bookingid', $bookingid) //don
            ->firstOrFail();

        $tour = DB::table('tbl_tour')->where('tourid', $booking->tourid)->first();

        $statusLabels = [
            'pending' => 'Chờ xác nhận',
            'confirmed' => 'Đã xác nhận',
            'cancelled' => 'Đã hủy',
        ];

        $statusText = $statusLabels[$booking->bookingStatus] ?? 'Đang cập nhật';

        return view('clients.booking-status', compact('title', 'booking', 'tour', 'statusText'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function cancel(Request $request, string $bookingid)
    {
        $booking = Booking::where('userid', $request->user()->userid)->where('bookingid', $bookingid)->firstOrFail();
        //CHỉ hủy khi đang chờ xác nhận
        $updated = Booking::where('bookingid', $booking->bookingid)
            ->where('userid', $request->user()->userid)
            ->where('bookingStatus', 'pending')
            ->update(['bookingStatus' => 'cancelled',]);

        if (!$updated){
            return back()->with(
                'booking_error', 'Chỉ có thể hủy đơn hàng khi chưa xác nhận.'
            );
        }
        return back()->with(
            'booking_success', 'Đã hủy đơn đặt tour thành công.'
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
