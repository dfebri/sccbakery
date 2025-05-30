<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 6/23/2015
 * Time: 10:53 AM
 */
namespace sccbakery\Admin\Controllers;

use Illuminate\Support\Facades\URL;
use sccbakery\Admin\Models\PagesModel;

class Pages extends ScaffoldController {

    public function __construct() {
        parent::__construct();
        $this->data['page_title']   = "Pages";
        $this->model                = new PagesModel;
    }

    public function index() {
        $this->module_name 	= 'Pages';
        $this->base_url 	= '_admin/pages';
        $this->set('manage_order', false);
        $this->set('delete_file', 'img');
        $this->set('delete_path', array(base_path().'/resources/assets/uploads/pages/'));

        switch($this->action){
            case "edit":
                $this->data['sub_title'] = "Edit ".$this->module_name;
                $this->_edit();
                break;
            case "add":
                $this->data['sub_title'] = "Add ".$this->module_name;
                $this->_add();
                break;
            default:
                $this->data['sub_title'] = "List ".$this->module_name;
                $this->_default();
                break;
        }

        return $this->build();
    }

    private function _default(){
        $this->model        = $this->model->where('custom_page', '=', '0');
        $this->order_by 	= array('ordered_no'=>'asc');
        $this->fields = [
            [
                'name'=>'name',
                'title'=>'Name',
                'sort'=> TRUE,
                'search'=> 'text'
            ],
            [
                'name'=>'permalink',
                'title'=>'URL',
                'before_show'=>'_get_url'
            ],
            [
                'name'=>'show_footer',
                'title'=>'Show on Footer',
                'sort'=> TRUE,
                'type'=>'check'
            ],
            [
                'name'=>'publish',
                'title'=>'Publish',
                'sort'=> TRUE,
                'type'=>'check'
            ]
        ];
    }

    protected function _get_url($permalink) {
        return env('APP_URL').'/'.$permalink;
    }

    private function _add(){
        $this->fields 	= [
            [
                'name'=>'name',
                'label'=>'Name',
                'validation'=> 'required',
                'permalink'=>'permalink'
            ],
            [
                'name'=>'page_type',
                'label'=>'Page Type',
                'type'=>'select',
                'option'=> array('0'=>'Content', 1=>'Link'),
                'toggle'=> array('0'=>'test', 1=>'link'),
                'validation'=> 'required'
            ],
            [
                'name'=>'description',
                'label'=>'Content',
                'type'=>'tinymce',
                'group'=>'test',
                'validation'=> ''
            ],
            [
                'name'=>'img',
                'label'=>'Picture',
                'type'=>'file',
                'path'=>base_path().'/resources/assets/uploads/pages/',
                'group'=>'test',
                'validation'=>'image',
                'file_notes'=>'For Best Resolution: 1920x550 px'
            ],
            [
                'name'=>'url',
                'label'=>'URL',
                'group'=>'link'
            ],
            [
                'name'=>'meta_title',
                'label'=>'Meta Title',
            ],
            [
                'name'=>'meta_keyword',
                'label'=>'Meta Keyword',
            ],
            [
                'name'=>'meta_description',
                'label'=>'Meta Description',
            ],
        ];
    }


    private function _edit(){
        $this->fields 	= [
            [
                'name'=>'name',
                'label'=>'Name',
                'validation'=> 'required',
                'permalink'=>'permalink'
            ],
            [
                'name'=>'page_type',
                'label'=>'Page Type',
                'type'=>'select',
                'option'=> array('0'=>'Content', 1=>'Link'),
                'toggle'=> array('0'=>'test', 1=>'link'),
                'validation'=> 'required'
            ],
            [
                'name'=>'description',
                'label'=>'Content',
                'type'=>'tinymce',
                'group'=>'test',
                'validation'=> ''
            ],
            [
                'name'=>'img',
                'label'=>'Picture',
                'type'=>'file',
                'path'=>base_path().'/resources/assets/uploads/pages/',
                'group'=>'test',
                'validation'=>'image',
                'file_notes'=>'For Best Resolution: 1920x550 px'
            ],
            [
                'name'=>'url',
                'label'=>'URL',
                'group'=>'link'
            ],
            [
                'name'=>'meta_title',
                'label'=>'Meta Title',
            ],
            [
                'name'=>'meta_keyword',
                'label'=>'Meta Keyword',
            ],
            [
                'name'=>'meta_description',
                'label'=>'Meta Description',
            ],

        ];
    }

}