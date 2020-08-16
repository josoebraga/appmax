<?php

namespace App\Model;

use BinaryCats\Sku\HasSku;
use BinaryCats\Sku\Concerns\SkuOptions;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasSku;
    protected $table = 'product';
    protected $primaryKey = 'id';

    /**
     * Get the options for generating the Sku.
     *
     * @return BinaryCats\Sku\SkuOptions
     */
    public function skuOptions() : SkuOptions
    {
        return SkuOptions::make()
            ->forceUnique(true)
            ->generateOnCreate(true)
            ->refreshOnUpdate(false);
    }

}
