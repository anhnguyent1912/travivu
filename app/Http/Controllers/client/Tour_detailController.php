<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Contracts\View\Factory;
use App\Models\client\tour;

class Tour_detailController extends Controller
{
    private $tour;
    public function __construct()
    {
        $this->tour = new tour();
    }

    public function index($id=0): Factory|View
    {
        $title = 'Chi tiết tour';

        $tourdetail = $this->tour->gettourdetail($id);
        // dd($tourdetail);
        return view(view: 'clients.tour-detail', data: compact('title', 'tourdetail'));
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
