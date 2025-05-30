<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 6/23/2015
 * Time: 3:25 PM
 */
namespace sccbakery\Admin\Controllers;

use Folklore\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Imagine\Image\Box;
use sccbakery\Admin\Models\ProductImageModel;
use sccbakery\Admin\Models\ProductModel;
use sccbakery\Systems\Controllers\Systems;

class ProductImage extends AdminController {

    var $thumbnails;
    var $upload_path;
    var $thumbnails_effect;
    var $product_stage;
    var $keep_original;
    var $admin_size;

    function __construct(){
        parent::__construct();

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
        $action = Input::get('act');

        switch($action){
            case "upload":
                return $this->_upload();
                break;
            case "publish":
                return $this->_publish();
                break;
            case "delete":
                return $this->_delete();
                break;
            case "default":
                return $this->_default();
                break;
        }
    }

    private function _delete(){
        $id 	= Input::get('id');
        $image 	= ProductImageModel::find($id);

        if($image){
            @unlink($this->upload_path.$image->img);
            @unlink($this->upload_path.$this->thumbnails."/".$image->img);

            $image->delete();

            return Response::json(array('success'=>true));
        }

        return Response::json(array('error'=>true, 'message'=>'Image not found!'));
    }

    private function _publish(){
        $id 	= Input::get('id');
        $image 	= ProductImageModel::find($id);

        if($image){
            $image->publish = !$image->publish;
            $publish 		= (int)$image->publish;
            $image->save();

            return Response::json(array('success'=>true, 'status'=>$publish));
        }

        return Response::json(array('error'=>true, 'message'=>'Image not found!'));
    }

    private function _default(){
        $id 	= Input::get('id');
        $image 	= ProductImageModel::find($id);

        if($image){
            $image->as_default 	= !$image->as_default;
            $default 			= (int)$image->as_default;
            $image->save();

            return Response::json(array('success'=>true, 'status'=>$default));
        }

        return Response::json(array('error'=>true, 'message'=>'Image not found!'));
    }

    private function _upload(){
        $product_id 	    = Input::get('id');
        $product 		    = ProductModel::find($product_id);

        $file 			    = Input::file('Filedata');

        $input['Filedata']  = $file;
        $rules['Filedata']  = 'required';

        $validator  	    = Validator::make($input, $rules);

        if($validator->fails()) {
            $result['error']   = true;
            $result['message'] = implode('<br />', $validator->messages()->all());

            return Response::json($result);
        }else{
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
                $image->as_default 		= $check ? false : true;
                $image->publish 		= true;
                $image->save();

                $result['error']			= false;
                $result['file_name']		= $image->img;
                $result['publish']			= $image->publish;
                $result['default']			= $image->as_default;
                $result['file_id']			= $image->id ;
                $result['file_url']			= URL::asset($this->upload_path.$image->img);
                $result['thumb_url']		= URL::asset($this->upload_path.$this->admin_size."/".$image->img);
                $result['publish_url']		= URL::asset('_admin/product_image?act=publish&id='.$image->id);
                $result['default_url']		= URL::asset('_admin/product_image?act=default&id='.$image->id);
                $result['delete_url']		= URL::asset('_admin/product_image?act=delete&id='.$image->id);

                return Response::json($result);
            }
        }
    }

}