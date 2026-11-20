<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\client\tour as TourModel;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->validate([
            'destination' => ['nullable', 'string', 'max:255'],
            'start_date'  => ['nullable', 'date_format:Y-m-d'],
        ], [
            'start_date.date_format' => 'Ngày khởi hành không hợp lệ.',
        ]);

        $tours = (new TourModel())->filterTour($filters);

        $title = 'Tìm kiếm';
        return view('clients.search', compact('title', 'tours'));
    }
}
