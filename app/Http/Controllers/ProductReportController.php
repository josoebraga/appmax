<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Auth;
use DB;


class ProductReportController extends Controller
{

    public function index()
    {
        $products = DB::select("
        SELECT
        DISTINCT
        product.name, ifnull(product_api.status, 'Enviado Via Sistema') statusAdicionar,
        ifnull(product_send.status, 'Disponível') statusBaixa
        from product
        left join product_send on product.id = product_send.id_product
        left join product_api on product_api.id_product = product.id
        ");
        $i = 0;
        foreach($products as $product) {
            if($product->statusBaixa == 'Disponível') { $i++; }
        }

        return  view('productReport.index', compact('products', 'i'));
    }


}
