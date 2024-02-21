<?php

namespace App\Http\Controllers;

use App\Models\Item_Venda;
use Illuminate\Http\Request;

class ItemVendaController extends Controller
{
    private $item;

    function __construct() {
        $this->item = new Item_Venda();
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(Item_Venda $item_Venda)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item_Venda $item_Venda)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item_Venda $item_Venda)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item_Venda $item_Venda)
    {
        //
    }
}
