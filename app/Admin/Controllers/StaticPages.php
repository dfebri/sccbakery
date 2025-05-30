<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 6/25/2015
 * Time: 8:34 AM
 */
namespace sccbakery\Admin\Controllers;

use Illuminate\Support\Facades\URL;
use sccbakery\Admin\Models\PagesModel;

class StaticPages extends ScaffoldController {
    public function __construct() {
        parent::__construct();
        $this->data['page_title']   = "StaticPages";
        $this->model                = new PagesModel;
    }

    public function index() {
        $this->module_name 	= 'Static Pages';
        $this->base_url 	= '_admin/static_pages';
        $this->set('multiple_delete',FALSE);
        $this->remove_action_button('delete');
        $this->remove_button('add');

        $this->set('delete_file', 'img');
        $this->set('delete_path', array(base_path().'/resources/assets/uploads/pages/'));

        switch($this->action){
            case "edit":
                $this->data['sub_title'] = "Edit ".$this->module_name;
                $this->_edit();
                break;
            default:
                $this->data['sub_title'] = "List ".$this->module_name;
                $this->_default();
                break;
        }

        return $this->build();
    }

    private function _default(){
        $this->model        = $this->model->where('custom_page', '=', '1');
        $this->order_by 	= array('ordered_no'=>'asc');
        $this->fields = [
            [
                'name'=>'img',
                'title'=>'Picture',
                'before_show'=>'image',
            ],
            [
                'name'=>'name',
                'title'=>'Name',
                'sort'=> TRUE,
                'search'=> 'text'
            ],
            [
                'name'=>'show_footer',
                'title'=>'Show on Footer',
                'sort'=> TRUE,
                'type'=>'check'
            ]
        ];
    }

    public function image($img){
        if($img != ''){
            return "<img width='100' src='".URL::asset('resources/assets/uploads/pages/'.$img)."'/>";
        }else{
            return "<img width='100' src='".URL::asset('resources/assets/images/none.png')."'/>";
        }
    }

    private function _edit(){
        $this->fields 	= [
            [
                'name'=>'img',
                'label'=>'Picture',
                'type'=>'file',
                'path'=>base_path().'/resources/assets/uploads/pages/',
                'group'=>'test',
                'validation'=>'image',
                'file_notes'=>'For Best Resolution: 1920x550 px'
            ]
        ];
    }
}