<?php

namespace App\Models\client;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;


class tour extends Model
{
    use HasFactory;

    protected $table = 'tbl_tour';

    public function gettourdetail($id)
    {
        $tourdetail = DB::table($this->table)
            ->where('tourid', $id)
            ->first();

        if (!$tourdetail) {
            return null;
        }

        $tourdetail->images = DB::table('tbl_images')
            ->where('tourid', $tourdetail->tourid)
            ->limit(5)
            ->pluck('imageURL');

            $tourdetail->timeline = DB::table('tbl_timeline')
            ->where('tourid', $tourdetail->tourid)
            ->get();
        

        return $tourdetail;
    }
}
