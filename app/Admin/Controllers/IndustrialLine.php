<?php
/**
 * Created by PhpStorm.
 * User: Hendry
 * Date: 10/19/2015
 * Time: 4:01 PM
 */
namespace sccbakery\Admin\Controllers;

use sccbakery\Admin\Models\IndustrialLineModel;

class IndustrialLine extends ScaffoldController {
    public function __construct() {
        parent::__construct();
        $this->data['page_title']   = "Industrial Line";
        $this->model                = new IndustrialLineModel;
    }

    public function index() {
        $this->module_name 	= 'Industrial';
        $this->base_url 	= '_admin/industrial_line';
        $this->set('manage_order', false);
        $this->remove_button('add');
        $this->set('multiple_delete',FALSE);
        $this->remove_action_button('delete');

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
        $this->fields = [
            [
                'name'=>'description',
                'title'=>'Description',
                'sort'=> TRUE,
                'search'=> 'text'
            ]
        ];
    }

    private function _edit(){
        $this->fields 	= [
            [
                'name'=>'description',
                'label'=>'Content',
                'type'=>'tinymce',
                'group'=>'test',
                'validation'=> ''
            ]
        ];
    }
}