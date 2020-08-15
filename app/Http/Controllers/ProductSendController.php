<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Product;
use App\ProductSend;
use App\Client;
Use DB;

class ProductSendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productsToSend =
        DB::select("
        SELECT * FROM appmax.product p
            WHERE
            NOT EXISTS (
                SELECT * FROM appmax.product_send ps WHERE ps.id_product = p.id
            )
        ");
        dd($productsToSend);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $products = Product::where('id', $request->id)
        ->whereNotExists(function ($query) {
            $query->select(DB::raw(1))
                  ->from('product_send')
                  ->whereRaw('product_send.id_product = product.id');
        })
        ->get();;
        $clients = Client::get();
        return view('productSend.index', compact('products', 'clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // Tem maneiras mais simples, eu sei, mas é bom demonstrar um exemplo de uso além do Eloquent

        $validateProductsToSend =
        DB::select("
        SELECT p.id, ps.id_product
        FROM appmax.product p
        left join appmax.product_send ps ON ps.id_product = p.id
        WHERE p.id = ? AND
        ps.id is null
        LIMIT 1", [$request->id]);
        $validade = '';
        foreach ($validateProductsToSend as $validateProductToSend) {
            $validade = $validateProductToSend->id_product;
        }

        if($validade == null) {
            try{
                $productSend = new ProductSend;
                $productSend->id_product = $request->id;
                $productSend->id_client = $request->id_client;
                $productSend->status = 'Enviado Via Sistema';
                $productSend->save();
            } catch (Exception $e) {
                // Em um ambiente real, aqui seria colocado algum tratamento, mas neste exemplo não se aplica.
            }
        }
            return redirect()->route('product');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
