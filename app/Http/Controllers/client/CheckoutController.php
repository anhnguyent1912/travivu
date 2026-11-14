<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, string $tourid)
    {
        $title = 'Thanh toán';
        //Lấy tour theo mã
        $tour = DB::table('tbl_tour')->where('tourid', $tourid)->first();

        abort_if(!$tour, 404, 'Tour không tồn tại.');
        //Lấy số khách từ trang chi tiết
        $data = $request->validate([
            'adult_quantity' => 'required|integer|min:1|max:100',
            'child_quantity' => 'required|integer|min:0|max:100',
        ], [
            'required' => 'Vui lòng nhập :attribute.',
            'integer' => ':attribute phải là số nguyên.',
            'min' => ':attribute phải lớn hơn hoặc bằng :min.',
            'max' => ':attribute phải nhỏ hơn hoặc bằng :max.',
        ],[
            'adult_quantity' => 'Số lượng người lớn',
            'child_quantity' => 'Số lượng trẻ em',
        ]);
        //Số khách đã chọn
        $numAdults = (int) $data['adult_quantity'];
        $numChildren = (int) $data['child_quantity'];
        //Đơn giá từ database
        $unitPriceAdult = (int) round($tour->priceAdult);
        $unitPriceChild = (int) round($tour->priceChild);
        //Tính tiền
        $adultTotal = $numAdults * $unitPriceAdult;
        $childTotal = $numChildren * $unitPriceChild;
        $totalPrice = $adultTotal + $childTotal;

        return view('clients.checkout', compact(
            'title', 'tour',
            'numAdults', 'numChildren',
            'unitPriceAdult','unitPriceChild',
            'adultTotal','childTotal','totalPrice'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
