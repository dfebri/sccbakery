<?php namespace sccbakery;

use Illuminate\Database\Eloquent\Model;

class ProductImageModel extends Model {
    protected $table    = 'product_image';

    public function image(){
        return $this->belongsTo('sccbakery\ProductModel', 'product_id');
    }
}
