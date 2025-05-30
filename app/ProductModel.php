<?php namespace sccbakery;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model {
    protected $table = 'product';

    public function category(){
        return $this->belongsTo('sccbakery\CategoryModel', 'category_id');
    }

    public function brand() {
        return $this->belongsTo('sccbakery\BrandModel', 'brand_id');
    }

    public function image() {
        return $this->hasMany('sccbakery\ProductImageModel', 'product_id')->orderBy('as_default','DESC');
    }
}
