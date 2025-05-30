<?php namespace sccbakery;

use Illuminate\Database\Eloquent\Model;

class BrandModel extends Model {
    protected $table = 'brand';

    public function product(){
        return $this->hasMany('sccbakery\ProductModel', 'brand_id');
    }
}
