<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Model\Product;
use App\Model\ProductApiModel;
use Exception;
use DB;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AdicionarProdutos extends Controller
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    public function toArray(Request $request)
    {
        //http://127.0.0.1:8000/api/adicionar-produtos/nome/1945.48/teste teste aa dad a

        $name = $request->name;
        $price = str_replace(',', '.', str_replace('.', '', $request->price));
        $description = $request->description;

    try {
        $product = new Product;
        $product->name = $name;
        $product->price = $price;
        $product->description = $description;
        $product->save();
        $insertedId = $product->id;

        $productApiModel = new ProductApiModel;
        $productApiModel->id_product = $insertedId;
        $productApiModel->status = 'Enviado Via Api';
        $productApiModel->save();

        return [
            'id' => $insertedId,
            'status' => 'sucesso',
        ];

    } catch (Exception $e) {
        return [
            'id' => '',
            'status' => 'erro',
        ];
    }

}

}
