<?php

namespace App\Models\client;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
class Home extends Model
{
    use HasFactory;


    protected $table = 'tbl_tour';

    public function gethomeTour() {
    // 1. Lấy danh sách tour
    $getTour = DB::table($this->table)->get();

    // 2. Chạy vòng lặp 
    foreach ($getTour as $tour) {
        
        // 3. Lấy hình ảnh 
        $tour->images = DB::table('tbl_images')
            ->where('tourid', $tour->tourid)
            ->pluck('imageUrl');

        // 4. Lấy lịch trình 
        // $tour->timeline = DB::table('tbl_timeline')
        //     ->where('tourid', $tour->tourid)
        //     ->get(); 
    }

    return $getTour;
}
}
