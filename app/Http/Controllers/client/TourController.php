<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\client\tour;

class TourController extends Controller
{
    private $tour;

    public function __construct()
    {
        $this->tour = new tour();
    }
    public function index(Request $request)
    {
        $filters = $request->validate([
            'domain' => ['nullable', 'in:b,t,n'],
            'rating' => ['nullable', 'integer', 'between:1,5'],
            'duration' => ['nullable', 'in:1n1d,3n2d,4n3d,5n4d'],
            'min_price' => ['nullable', 'numeric', 'between:100000,10000000'],
            'max_price' => ['nullable', 'numeric', 'between:100000,10000000'],
        ], [
            'domain.in' => 'Khu vực không hợp lệ.',
            'rating.integer' => 'Số sao phải là số nguyên.',
            'rating.between' => 'Số sao phải từ 1 đến 5.',
            'duration.in' => 'Thời gian tour không hợp lệ.',
            'min_price.numeric' => 'Giá thấp nhất phải là số.',
            'max_price.numeric' => 'Giá cao nhất phải là số.',
            'min_price.between' => 'Giá phải từ 100.000 đến 10.000.000 VND.',
            'max_price.between' => 'Giá phải từ 100.000 đến 10.000.000 VND.',
        ]);

        if (
            isset($filters['min_price'], $filters['max_price'])
            && $filters['min_price'] > $filters['max_price']
        ) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'max_price' => 'Giá cao nhất phải lớn hơn hoặc bằng giá thấp nhất.',
            ]);
        }

        $title = 'Tour';
        $tours = $this->tour->filterTour($filters);
        $domain = $this->tour->getDomain();

        return view('clients.tour', compact('title', 'tours', 'domain'));
    }

}
