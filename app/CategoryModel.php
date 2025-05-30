<?php namespace sccbakery;

use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model {
    protected $table = 'category';

    public function product(){
        return $this->hasMany('sccbakery\ProductModel', 'category_id');
    }
}