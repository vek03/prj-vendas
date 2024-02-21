<?php

namespace App\Http\Controllers;

use App\Models\Venda;
use App\Models\Cliente;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendaController extends Controller
{
    private $sale;

    function __construct() {
        $this->sale = new Venda();
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
        $sales = $this->sale->all();
        $clients = Cliente::all();
        $products = Produto::all();

        return view('sales', [
            'sales' => $sales,
            'clients' => $clients,
            'products' => $products,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $sale = $this->sale->create([
            'id_client' => $request->id_client,
            'id_seller' => Auth::user()->id,
            'method' => $request->method,
        ]);

        foreach ($request->products as $product) {
            $sale->items()->create([
                'id_product' => $product[0],
                'quantity' => $product[1],
                'subtotal' => $request->total,
            ]);
        }

        foreach ($request->payments as $payment) {
            $sale->payments()->create([
                'value' => $payment[0],
                'invoice' => $payment[1],
            ]);
        }

        return redirect()->route('sale.create')->with('status', 'Venda Cadastrada!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Venda $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Venda $sale)
    {
        $products = Produto::all();

        return view('sale-info', [
            'sale' => $sale,
            'products' => $products,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Venda $sale)
    {
        $sale->save($request->all);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Venda $sale)
    {
        $sale->delete();

        return redirect()->route('sale.create')->with('status', 'Venda deletada com sucesso!');
    }
}
