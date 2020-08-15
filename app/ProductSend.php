<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSend extends Model
{
    protected $table = 'product_send';
    protected $primaryKey = 'id';

    public function produtos(){
        return $this->hasOne(Product::class);
    }

}
