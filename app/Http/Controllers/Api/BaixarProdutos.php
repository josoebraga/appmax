<?php

namespace App\Http\Controllers\Api;
Use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use App\Model\ProductSend;
use Exception;
use DB;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BaixarProdutos extends Controller
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    public function toArray(Request $request)
    {
        //http://127.0.0.1:8000/api/baixar-produtos/1/1

        $validateProductsToSend =
        DB::select("
        SELECT p.id, ps.id_product
        FROM appmax.product p
        left join appmax.product_send ps ON ps.id_product = p.id
        WHERE p.id = ?
        LIMIT 1", [$request->id]);
        $validade = '';
        foreach ($validateProductsToSend as $validateProductToSend) {
            $validade = $validateProductToSend->id_product;
        }

        if($validade == null) {
            try{
                $productSend = new ProductSend;
                $productSend->id_product = $request->id;
                $productSend->id_client = $request->idClient;
                $productSend->status = 'Enviado Via Api';
                $productSend->save();
                return [
                    'id' => $request->id,
                    'id_client' => $request->idClient,
                    'status' => 'sucesso',
                ];
            } catch (Exception $e) {
                return [
                    'id' => $request->id,
                    'id_client' => $request->idClient,
                    'status' => 'erro',
                ];
            }
        } else {
            return [
                'id' => $request->id,
                'id_client' => $request->idClient,
                'status' => 'erro - ja enviado',
            ];
    }

   }

}
