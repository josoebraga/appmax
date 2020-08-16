<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Product;
use Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::
          leftJoin('product_send', 'product.id', '=', 'product_send.id_product')
        ->leftJoin('client', 'product_send.id_client', '=', 'client.id')
        /* ->where('product_send.status', null) */ //Não se aplica, deixei apenas para referência
        ->select('product.id', 'sku', 'product.name', 'description', 'price', 'product_send.status', 'client.name as client_name')
        ->orderBy('product.id', 'asc')
        ->paginate(10);
        return view('product.index', ['products' => $products]);
    }

    public function productData()
    {
        return $products = datatables()->of(Product::orderBy('name', 'asc')->get())->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = $request->name;
        $price = str_replace(',', '.', str_replace('.', '', $request->price));
        $description = $request->description;

        $product = new Product;
        $product->name = $name;
        $product->price = $price;
        $product->description = $description;
        $product->save();

        return redirect()->route('product');

    }

    /**
     * Display the specified resource.
     *
     */
    public function show(Request $request)
    {
        $products = Product::where('id', $request->id)->get();
        return view('product.show', compact('products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit(Request $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function update(Request $request)
    {
        Product::where('id', $request->id)
                ->update([  'name' => $request->name,
                            'price' => str_replace(',', '.', str_replace('.', '', $request->price)),
                            'description' => $request->description,
                            ]);

        return redirect()->route('product');

    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy(Request $request)
    {
        /*
        Para manter a integridade dos dados, correto é ter uma coluna de "situação" no banco de dados
        e fazer um update no dado marcando ele como inativo,
        mas a critério de demonstração eu criei esta opção para realmente excluir o registro.
        */
        if(Auth::user()->id == 1) {
        $products = Product::where('id', $request->id);
        $products->delete();
        }
    }
}
