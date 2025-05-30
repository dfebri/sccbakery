<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 6/23/2015
 * Time: 8:24 AM
 */
namespace sccbakery\Admin\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use sccbakery\Admin\Models\ContentModel;
use sccbakery\Libraries\Alert;

class Content extends AdminController {
    public function __construct() {
        parent::__construct();
    }

    public function header_link() {
        $this->_do_save_edit();
        $this->add_breadcrumb('Banner', URL::route('admin_header_link'));
        $this->data['page_title']   = "Bakeware&Co Link";
        $content                    = ContentModel::all();

        foreach($content as $list){
            $edit_data[$list->name]		= $list->value;
        }
        $this->data['edit_data']	= (object)array_merge((array)$edit_data, $_POST);
        $this->data['breadcrumb']   = $this->get_breadcrumb();

        return $this->render_view('content/header_link');
    }

    public function seo() {
        $this->_do_save_edit();
        $this->add_breadcrumb('SEO', URL::route('admin_seo'));
        $this->data['page_title']   = "SEO";
        $content                    = ContentModel::all();

        foreach($content as $list){
            $edit_data[$list->name]		= $list->value;
        }
        $this->data['edit_data']	= (object)array_merge((array)$edit_data, $_POST);
        $this->data['breadcrumb']   = $this->get_breadcrumb();

        return $this->render_view('content.seo');
    }

    public function banner(){
        $this->_do_save_edit();
        $this->add_breadcrumb('Banner', URL::route('admin_banner'));
        $this->data['page_title']   = "Banner";
        $content                    = ContentModel::all();

        foreach($content as $list){
            $edit_data[$list->name]		= $list->value;
        }
        $this->data['edit_data']	= (object)array_merge((array)$edit_data, $_POST);
        $this->data['breadcrumb']   = $this->get_breadcrumb();

        return $this->render_view('content/banner');
    }

    public function video() {
        $this->_do_save_edit();
        $this->add_breadcrumb('Home Video', URL::route('admin_home_video'));
        $this->data['page_title']   = "Home Video";
        $content                    = ContentModel::all();

        foreach($content as $list){
            $edit_data[$list->name]		= $list->value;
        }
        $this->data['edit_data']	= (object)array_merge((array)$edit_data, $_POST);
        $this->data['breadcrumb']   = $this->get_breadcrumb();

        return $this->render_view('content/video');
    }

    public function footer() {
        $this->_do_save_edit();
        $this->add_breadcrumb('Footer', URL::route('admin_banner'));
        $this->data['page_title']   = "Footer";
        $content			        = ContentModel::all();

        foreach($content as $list){
            $edit_data[$list->name]		= $list->value;
        }
        $this->data['edit_data']	= (object)array_merge((array)$edit_data, $_POST);
        $this->data['breadcrumb']   = $this->get_breadcrumb();
        return $this->render_view('content/footer');
    }

    private function _do_save_edit(){
        $this->data['error_message']	= "";
        if(isset($_POST['save'])){
            $post				= Input::all();
            $content			= ContentModel::all();
            foreach($content as $list){
                if(Input::hasfile($list->name)){
                    $file 			= Input::file($list->name);
                    $success 		= $file->move('resources/assets/uploads/content', $file->getClientOriginalName());
                    $update			= ContentModel::find($list->id);
                    $update->value	= $file->getClientOriginalName();
                    $update->save();
                }else if(isset($post[$list->name])){
                    $update			= ContentModel::find($list->id);
                    $update->value	= $post[$list->name];
                    $update->save();
                }
            }
            Alert::add('Update data success.', 'success');
            return Redirect::to('author/add')->withInput();
        }
    }
}