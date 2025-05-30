<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 6/23/2015
 * Time: 2:39 PM
 */
namespace sccbakery\Admin\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use sccbakery\Admin\Models\ConfigModel;
use Illuminate\Support\Facades\Input;
use sccbakery\Libraries\Alert;

class Setting extends AdminController {
    public function __construct() {
        parent::__construct();
    }

    public function index(){
        $this->_do_save_edit();
        $this->add_breadcrumb('Email', URL::route('admin_setting'));
        $this->data['page_title']   = "Setting";
        $content                    = ConfigModel::where('name', '=','no_reply_email')->first();

        $edit_data[$content->name]  = $content->value;

        $this->data['edit_data']	= (object)array_merge((array)$edit_data, $_POST);
        $this->data['breadcrumb']   = $this->get_breadcrumb();

        return $this->render_view('setting/email');
    }

    public function ga(){
        $this->_do_save_edit();
        $this->add_breadcrumb('Google Analytics', URL::route('admin_ga'));
        $this->data['page_title']   = "Setting";
        $content                    = ConfigModel::where('name', '=','ga_code')->first();

        $edit_data[$content->name]  = $content->value;

        $this->data['edit_data']	= (object)array_merge((array)$edit_data, $_POST);
        $this->data['breadcrumb']   = $this->get_breadcrumb();

        return $this->render_view('setting/ga');
    }

    private function _do_save_edit(){
        $this->data['error_message']	= "";
        if(isset($_POST['save'])){
            $post				= Input::all();
            $content			= ConfigModel::all();
            foreach($content as $list){
                if(Input::hasfile($list->name)){
                    $file 			= Input::file($list->name);
                    $success 		= $file->move('./assets/uploads/content', $file->getClientOriginalName());
                    $update			= ConfigModel::find($list->id);
                    $update->value	= $file->getClientOriginalName();
                    $update->save();
                }else if(isset($post[$list->name])){
                    $update			= ConfigModel::find($list->id);
                    $update->value	= $post[$list->name];
                    $update->save();
                }
            }
            Alert::add('Update data success.', 'success');
            return Redirect::to('author/add')->withInput();
        }
    }
}