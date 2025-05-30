<?php namespace sccbakery\Http\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use sccbakery\BrandModel;
use sccbakery\Http\Requests;
use Illuminate\Http\Request;
use DB;
use sccbakery\Http\Controllers\Controller;
use sccbakery\ProductModel;
use sccbakery\CategoryModel;
use sccbakery\Libraries\Breadcrumb;
use sccbakery\Systems\Controllers\Systems;

class Product extends Controller {
    public function __construct(){
        parent::__construct();
        DB::enableQueryLog();
        $this->data['title']	            = "Products";
        $this->data['page']		            = "product";
        $this->data['product_stage_size']   = Systems::get('front', 'product_stage_size');
        Breadcrumb::add('products');
    }

    public function detail($type="", $name="", $permalink="")
    {
        $this->data['subPage']              = $type;
        $this->data['menuList']             = $this->getMenuList($type);
        Breadcrumb::add($type, URL::route($type.'_null'));
        if($name != 'all-products') Breadcrumb::add(str_replace('-', ' ', $name), URL::route($type, $name));
        Breadcrumb::add(str_replace('-', ' ', $permalink));

        $productDetail  = ProductModel::with('image')->where('permalink','=',$permalink)->first();
        if(!$productDetail){
            return Redirect::route($type.'_null');
        }

        $primaryImage   = $productDetail->image()->where('as_default',1)->first();


        $product['permalink']               = $name;
        $product                            = (object)$product;
        $this->data['type']                 = $type;
        $this->data['typeName']             = $name;
        $this->data['primaryImage']         = $primaryImage;
        $this->data['product']              = $product;
        $this->data['productDetail']        = $productDetail;
        $this->data['title']	 			= $productDetail->name;
        $this->data['meta_description'] 	= $productDetail->meta_description;
        $this->data['meta_keywords'] 		= $productDetail->meta_keyword;
        $this->data['breadcrumb']           = Breadcrumb::get();

        return view('productDetail', $this->data);
    }



    public function category($category = '') {
        $this->data['subPage']  = 'category';
        $this->data['menuList'] = $this->getMenuList('category');
        Breadcrumb::add($this->data['subPage'], URL::route('category_null'));

        if($category != ''){
            $product			= CategoryModel::where('publish',1)->where('permalink','=',$category)->first();
            if(!$product){
                return Redirect::route('error-page');
            }
            $product_list				= $product->product()->where('publish',1)->orderBy('order_category')->paginate(12);
            $product_list = ProductModel::with('image')
                                ->join('category as b','b.id','=','product.category_id')
                                ->where('product.category_id','!=',0)
                                ->where('b.permalink',$category)
                                ->where('product.publish',1)
                                ->select('product.*')
                                ->orderBy('b.order_id','asc')
                                ->orderBy('product.order_category','asc')
                                ->groupBy('product.id')
                                ->paginate(12);

            $this->data['title']	 			= $product->meta_title;
            $this->data['meta_description'] 	= $product->meta_description;
            $this->data['meta_keywords'] 		= $product->meta_keyword;
        }else{
            $product['name']			= "All Products";
            $product['permalink']       = 'all-products';
            $product                    = (object)$product;
            $product_list				= ProductModel::with(array('image'=>function ($query) {
                $query->where('as_default',1);
            }))->where('category_id', '!=', '0')->where('publish',1)->orderBy('order_category','asc')->paginate(12);
            $product_list = ProductModel::with('image')
                                ->join('category as b','b.id','=','product.category_id')
                                ->where('product.category_id','!=',0)
                                ->where('product.publish',1)
                                ->select('product.*')
                                ->orderBy('b.order_id','asc')
                                ->orderBy('product.order_category','asc')
                                ->groupBy('product.id')
                                ->paginate(12);
            $this->data['title']	 			= $this->data['product_meta_title'];
            $this->data['meta_description'] 	= $this->data['product_meta_description'];
            $this->data['meta_keywords'] 		= $this->data['product_meta_keyword'];
        }

        Breadcrumb::add($category == '' ? 'All Products' : $category);

        $this->data['product']				= $product;
        $this->data['product_list']			= $product_list;
        $this->data['breadcrumb']           = Breadcrumb::get();
	$this->data['data'] = $category;
        return view('product', $this->data);
    }

    public function brand($brand = '') {
        $this->data['subPage']  = 'brand';
        $this->data['menuList'] = $this->getMenuList('brand');
        Breadcrumb::add($this->data['subPage'], URL::route('brand_null'));

        if($brand != ''){
            $product			        = BrandModel::where('publish',1)->where('permalink','=',$brand)->first();
            if(!$product){
                return Redirect::route('error-page');
            }
            $product_list				= $product->product()->where('publish',1)->orderBy('order_brand')->paginate(12);
            $product_list = ProductModel::with('image')
                                ->join('brand as b','b.id','=','product.brand_id')
                                ->where('product.brand_id','!=',0)
                                ->where('b.permalink',$brand)
                                ->where('product.publish',1)
                                ->select('product.*')
                                ->orderBy('b.order_id','asc')
                                ->orderBy('product.order_brand','asc')
                                ->groupBy('product.id')
                                ->paginate(12);
            $this->data['title']	 			= $product->meta_title;
            $this->data['meta_description'] 	= $product->meta_description;
            $this->data['meta_keywords'] 		= $product->meta_keyword;

        }else{
            $product['name']			= "All Products";
            $product['permalink']       = 'all-products';
            $product                    = (object)$product;
            $product_list				= ProductModel::with(array('image'=>function ($query) {
                $query->where('as_default',1);
            }))->where('brand_id', '!=', '0')->where('publish',1)->orderBy('order_brand')->paginate(12);
            $product_list = ProductModel::with('image')
                                ->join('brand as b','b.id','=','product.brand_id')
                                ->where('product.brand_id','!=',0)
                                ->where('product.publish',1)
                                ->select('product.*')
                                ->orderBy('b.order_id','asc')
                                ->orderBy('product.order_brand','asc')
                                ->groupBy('product.id')
                                ->paginate(12);
            $this->data['title']	 			= $this->data['product_meta_title'];
            $this->data['meta_description'] 	= $this->data['product_meta_description'];
            $this->data['meta_keywords'] 		= $this->data['product_meta_keyword'];
        }


        Breadcrumb::add($brand == '' ? 'All Products' : $brand);

        $this->data['product']				= $product;
        $this->data['product_list']			= $product_list;
        $this->data['breadcrumb']           = Breadcrumb::get();
        $this->data['data'] = $brand;
        return view('product', $this->data);
    }

    public function getMenuList($type) {
        if($type == 'category') {
            return CategoryModel::where('publish', 1)->orderBy('order_id')->get();
        } else if($type == 'brand') {
            return BrandModel::where('publish', 1)->orderBy('order_id')->get();
        }
    }
}
