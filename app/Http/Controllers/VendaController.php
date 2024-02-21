<?php

namespace App\Http\Controllers;

use App\Models\Venda;
use App\Models\Cliente;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\PDF;

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
        $sales = $this->sale->where('id_seller', '=', Auth::user()->id)->get();
        $clients = Cliente::withTrashed()->get();
        $products = Produto::withTrashed()->get();

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
            if($product[2] != 0){
                $sale->items()->create([
                    'id_product' => $product[0],
                    'price_uni' => $product[1],
                    'quantity' => $product[2],
                ]);
            }
        }

        foreach ($request->payments as $payment) {
            $sale->payments()->create([
                'num' => $payment[2],
                'value' => $payment[0],
                'invoice' => $payment[1],
            ]);
        }

        return redirect()->route('sale.create')->with('status', 'Venda Cadastrada!');
    }

    /**
     * Display the specified resource.
     */
    public function gerarPdf(Request $request){
        $sales = $this->sale->orderByDesc('created_at')->get();
    
        $pdf = PDF::loadView('pdf', ['sales' => $sales])->setPaper('a4', 'portrait');
    
        return $pdf->download('vendas-vekshop.pdf');
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
        $sale->method = $request->method;
        $sale->save();

        foreach ($request->products as $product) {
            if($product[2] != 0){
                $sale->items()->firstOrCreate([
                    'id_product' => $product[0],
                    'price_uni' => $product[1],
                    'quantity' => $product[2],
                ]);
            }else{
                if($sale->items()->where('id_product', $product[0])->exists()){
                    $sale->items()->where('id_product', $product[0])->delete();
                }
            }
        }

        $sale->payments()->where('id_sale', $sale->id)->delete();

        foreach ($request->payments as $payment) {
            $sale->payments()->create([
                'num' => $payment[2],
                'value' => $payment[0],
                'invoice' => $payment[1],
            ]);
        }

        return redirect()->route('sale.create')->with('status', 'Venda Editada!');
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