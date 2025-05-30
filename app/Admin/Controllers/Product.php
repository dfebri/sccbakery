<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 6/23/2015
 * Time: 2:51 PM
 */
namespace sccbakery\Admin\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use sccbakery\Admin\Models\BrandModel;
use sccbakery\Admin\Models\CategoryModel;
use sccbakery\Admin\Models\ProductModel;
use sccbakery\Admin\Models\ProductImageModel;
use sccbakery\Libraries\Alert;
use sccbakery\Systems\Controllers\Systems;
use Folklore\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Imagine\Image\Box;
use Validator;
use DB;

class Product extends ScaffoldController {

  var $thumbnails;
  var $upload_path;
  var $thumbnails_effect;
  var $product_stage;
  var $keep_original;
  var $admin_size;

    function __construct(){
        parent::__construct();
        $this->beforeFilter('auth');
        $this->data['page_title'] = "Product";
        $this->model         = New ProductModel;
        DB::enableQueryLog();
        $this->data['product_admin_size']   = Systems::get('back','product_admin_size');
        $this->data['product_stage_size']   = Systems::get('back','product_stage_size');

        $this->thumbnails  			= Systems::get('both', 'product_carousel_size');
        $this->upload_path 			= rtrim(Systems::get('back', 'product_upload_folder'), '/')."/";
        $this->product_stage        = Systems::get('back', 'product_stage_size');
        $this->thumbnails_effect 	= array();
        $this->keep_original 		= Systems::get('back', 'product_keep_original');
        $this->admin_size 			= Systems::get('back', 'product_admin_size');

        if(!is_dir($this->upload_path))
            @mkdir($this->upload_path);
    }

    public function index(){
        $this->module_name                  = 'Product';
        $this->base_url                     = '_admin/product';

        $this->set('multiple_delete', false);
//        $this->remove_action_button('delete');

        $this->add_button('export_excel', URL::to('_admin/product?act=export_excel&'.http_build_query(Input::except('act'))), $text = "<i class='glyphicon glyphicon-share'></i> Export to Excel", ['class'=>'btn btn-success']);
        $this->add_button('order_category', \URL::to($this->base_url.(strstr($this->base_url, '?') ? '&' : '?')."act=order&type=category"), '<i class="glyphicon glyphicon-th-large"></i> Ord By Category', array('class'=>'btn btn-warning'));
        $this->add_button('order_brand', \URL::to($this->base_url.(strstr($this->base_url, '?') ? '&' : '?')."act=order&type=brand"), '<i class="glyphicon glyphicon-th-large"></i> Ord By Brand', array('class'=>'btn btn-warning'));
        switch($this->action){
            case "edit":
                $this->data['sub_title'] = "Edit ".$this->module_name;
                return $this->_edit();
                break;
            case "add":
                $this->data['sub_title'] = "Add ".$this->module_name;
                return $this->_add();
                break;
            case "export_excel":
                return $this->_export_excel();
                break;
            case "order":
                $this->data['sub_title'] = "Order ".$this->module_name;
                if (\Request::has('type')){
                    \Cache::forget('type');
                    \Cache::add('type',\Request::input('type'), 60);
                }
                $type = \Cache::get('type');
                if ($type == "category"){
                    $this->_order_category();
                }else if($type == "brand"){
                    $this->_order_brand();
                }
                return $this->build();
                break;
            default:
                $this->data['sub_title'] = "List ".$this->module_name;
                $this->_default();
                return $this->build();
                break;
        }
    }

    private function _order_category(){
        $this->order_model       = New Productmodel;
        // $this->model             = New Category_model;               //
        // $this->model             = $this->model->where('level', 1);
        // $this->table_id          = 'id';
        $this->model                = $this->model->orderBy('order_category');
        $this->order_field      = 'order_category';
        $this->order_text_field  = 'name';
        // $this->order_type_image  = TRUE;
        // $this->order_image_field = 'callback:get_image';
        $this->order_image_path  = 'resources/assets/uploads/products/';
        $this->order_filter      = [
                                      'category_id' => [
                                                          'title' => "Select Category",
                                                          'data'  => $this->_get_parent_category()
                                                       ]
                                   ];
    }

    private function _get_parent_category(){
        $cat_model = New Categorymodel;
        $all = $cat_model->where('order_id','!=','0')->orderBy('name', 'asc')->get();
        $cat[''] = '&laquo; Select Parent category &raquo;';
        $cat[0] = 'All Category';
        foreach($all as $c){
            $cat[$c->id] = $c['name'];
        }

        return $cat;
    }

    private function _order_brand(){
        $this->order_model       = New Productmodel;
        // $this->model             = New Category_model;               //
        // $this->model             = $this->model->where('level', 1);
        // $this->table_id          = 'id';
        $this->model                = $this->model->orderBy('order_brand');
        $this->order_field      = 'order_brand';
        $this->order_text_field  = 'name';
        // $this->order_type_image  = TRUE;
        // $this->order_image_field = 'callback:get_image';
        $this->order_image_path  = 'resources/assets/uploads/brands/';
        $this->order_filter      = [
                                      'brand_id' => [
                                                          'title' => "Select Brand",
                                                          'data'  => $this->_get_parent_brand()
                                                       ]
                                   ];
    }

    private function _get_parent_brand(){
        $cat_model = New Brandmodel;

        $all = $cat_model->where('order_id','!=','0')->orderBy('name', 'asc')->get();
        $cat[''] = '&laquo; Select Parent brand &raquo;';
        foreach($all as $c){
            $cat[$c->id] = $c['name'];
        }

        return $cat;
    }

    private function _default(){
        $this->order_by   = array('name'=>'asc');
        $this->add_range_filter('created_at');
        $this->before_delete  = 'beforeDelete';
        $this->fields = [
            [
                'name'=>'id',
                'title'=>'Image',
                'width'=> 110,
                'before_show'=>'image'
            ],
            [
                'name'=>'name',
                'title'=>'Name',
                'sort'=> TRUE,
                'search'=> 'text'
            ],
            [
                'name'=>'subtitle',
                'title'=>'Subtitle',
                'sort'=> TRUE,
                'search'=> 'text'
            ],
            [
                'name'=>'category_id',
                'title'=>'Category',
                'belongs_to'=>array('category','name'),
                'search'=> $this->_get_category()
            ],[
                'name'=>'brand_id',
                'title'=>'Brand',
                'belongs_to'=>array('brand','name'),
                'search'=> $this->_get_brand()
            ],
            [
                'name'=>'publish',
                'title'=>'Publish',
                'sort'=> TRUE,
                'type'=> 'check'
            ]
        ];
    }

    public function beforeDelete($data) {
        $productImages  = ProductImageModel::where('product_id', '=', $data->id)->get();
        $path           = base_path().'/resources/assets/uploads/products/';
        foreach($productImages as $productImage) {
            $img    = $productImage->img;
            if(file_exists($path.$this->data['product_admin_size'].'/'.$img))
	    	unlink($path.$this->data['product_admin_size'].'/'.$img);
	    if(file_exists($path.$this->data['product_stage_size'].'/'.$img))
            	unlink($path.$this->data['product_stage_size'].'/'.$img);

            $productImage->delete();
        }
    }

    public function _get_category() {
        $categories = CategoryModel::get();
        $return[0]  = '--Select Category--';
        $return['all']  = '--All Category--';
        foreach ($categories as $cat) {
            $return[$cat->id]   = $cat->name;
        }
        return $return;
    }

    public function _get_brand() {
        $brands = BrandModel::get();
        $return[0]  = '--Select Brand--';
        $return['all']  = '--All Brand--';
        foreach ($brands as $cat) {
            $return[$cat->id]   = $cat->name;
        }
        return $return;
    }

    private function _add(){
        if(Input::get('submit_save')){
            return $this->save();
        }

        $this->data['action']           = "add";
        $this->data['data']             = ProductModel::find(0);
        $this->data['loadmce']          = true;
        $this->data['loadjqueryui']     = true;
        $this->data['category_list']    = CategoryModel::all();
        $this->data['brand_list']       = BrandModel::all();

        return $this->render_view("product.form");
    }

    private function _edit(){
        if(Input::get('submit_save')){
            return $this->save();
        }

        $id = Input::get('id');
        $this->data['action']          = "edit";
        $this->data['data']            = ProductModel::where('product.id',$id)->first();
        $this->data['loadmce']         = true;
        $this->data['loadjqueryui']    = true;
        $this->data['category_list']   = CategoryModel::all();
        $this->data['brand_list']      = BrandModel::all();

        return $this->render_view("product.form");
    }

    private function save(){
        if(Input::get('submit_save')){
            $action  = Input::get('action');

            if($action == 'add'){
                $product = New ProductModel();
            }else{
                $product = ProductModel::find(Input::get('id'));
            }
            $all = Input::all();

            $postAction   = $all['postAction'];

            foreach ($all as $key => $value) {
                if($key != 'submit_save' && $key != 'img' && $key != 'action' && $key != 'act' && $key !='category' && $key != 'postAction' && $key != '_token'){
                    $save = 1;
                    $product->{$key} = $value;
                }
            }

            if($save){
                $product->permalink = Str::slug($product->name);
                if($action == 'edit')
                {
                    $slugCount = count(ProductModel::where('id', '!=', $product->id)->whereRaw("permalink REGEXP '^" . $product->permalink . "(-[0-9]*)?$'")->get());
                }
                else
                    $slugCount = count( ProductModel::whereRaw("permalink REGEXP '^".$product->permalink."(-[0-9]*)?$'")->get() );


                if($slugCount > 0)
                    $product->permalink .= "-".($slugCount+1);

                $product->save();

                if(isset($all['category'])){
                    foreach ($all['category'] as $cat) {
                        $category = array('category_id'=>$cat, 'product_id'=>$product->id);
                        CategoryModel::insert($category);
                    }
                }

                if($action=='edit' && Input::hasFile('img')){
                  $product_id = $product->id;
                  $files 			    = Input::file('img');

                  foreach ($files as $file) {
                      $filename 		= str_replace(' ', '-', strtolower($product->permalink)).".".$file->getClientOriginalExtension();
                      $file_path		= $this->upload_path.$this->product_stage.'/'.$filename;
                      //AUTO RENAME IF EXISTS
                      $i = 0;
                      while (file_exists($file_path)) {
                          $i++;
                          $ext 	   = substr($filename, strrpos($filename, '.'));
                          $filename  = substr($filename, 0, strrpos($filename, '.') + ($i>1 ? -1 : 0)).($i+1).$ext;
                          $file_path = $this->upload_path.$this->product_stage.'/'.$filename;
                      }

                      $success = $file->move($this->upload_path.$this->product_stage.'/', $filename);

                      if($success){
                          $thumb      = $this->thumbnails;
                          $thumbnail  = Image::open($file_path)->thumbnail(new Box($thumb, $thumb));
                          if(!is_dir($this->upload_path.$thumb."/"))
                              @mkdir($this->upload_path.$thumb."/");

                          $thumbnail->save($this->upload_path.$thumb."/".$filename);

                          if(!$this->keep_original){
                              unlink($file_path);
                          }

                          $check = ProductImageModel::where('product_id', $product_id)->orderBy('as_default', 'desc')->orderBy('id', 'asc')->first();

                          $image 					= New ProductImageModel();
                          $image->product_id 		= $product_id;
                          $image->img 			= $filename;
                          $image->as_default 		= 0;
                          $image->publish 		= true;
                          $image->save();

                      }
                  }
                }

                Alert::add(ucfirst($action).' product success!', 'success');

                if($postAction)
                    return Redirect::to('_admin/product?act=edit&id='.$product->id);
                return Redirect::to('_admin/product');
            }
        }
    }

    public function image($product_id){
        $product = ProductModel::find($product_id);
        if($product->images()->first()){
            return "<img width='100' src='".URL::asset('resources/assets/uploads/products/'.Systems::get('back','product_admin_size').'/'.$product->images()->first()->img)."'/>";
        }else{
            return "<img width='100' src='".URL::asset('resources/assets/images/none.png')."'/>";
        }
    }

    private function _export_excel(){
        $this->data['products_list'] = ProductModel::orderBy('name', 'asc')->get();

        $content    = $this->render_view('excel.product', $this->data);
        $myName     = "sccbakery-product-list.xls";
        $headers    = ['Content-type'=>'application/vnd-ms-excel', 'Content-Disposition'=>sprintf('attachment; filename="%s"', $myName)];
        return Response::make($content, 200, $headers);
    }

    public function _save_sorting_data(){
        dd(\Request::method());
    }
}
