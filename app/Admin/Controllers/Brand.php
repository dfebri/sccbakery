<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 6/25/2015
 * Time: 11:01 PM
 */
namespace sccbakery\Admin\Controllers;

use sccbakery\Admin\Models\BrandModel;
use sccbakery\Systems\Controllers\Systems;

class Brand extends ScaffoldController {
    public function __construct() {
        parent::__construct();
        $this->data['page_title']   = "Brands";
        $this->model                = new BrandModel;
    }

    public function index() {
        $this->module_name 	= 'Brands';
        $this->base_url 	= '_admin/brands';
        $this->set('manage_order', true);

        switch($this->action){
            case "edit":
                $this->data['sub_title'] = "Edit ".$this->module_name;
                $this->_edit();
                break;
            case "add":
                $this->data['sub_title'] = "Add ".$this->module_name;
                $this->_add();
                break;
            case "order":
                $this->data['sub_title'] = "Order ".$this->module_name;
                $this->_order();
                return $this->build();
                break;
            default:
                $this->data['sub_title'] = "List ".$this->module_name;
                $this->_default();
                break;
        }

        return $this->build();
    }

    private function _default(){
        $this->order_by 	= array('order_id'=>'asc');
        $this->fields = [
            [
                'name'=>'name',
                'title'=>'Name',
                'sort'=> TRUE,
                'search'=> 'text'
            ],
        ];
    }

    private function _order(){
        $this->model                = New BrandModel;
        $this->order_model          = New BrandModel;
        $this->table_id             = 'id';
        $this->order_field          = 'order_id';
        $this->order_type_image     = TRUE;
        $this->order_text_field     = 'callback:get_name';
        $this->order_image_field    = 'callback:get_image';
        $this->order_image_path     = 'resources/assets/uploads/product/'.Systems::Get('back','product_admin_size').'/';
    }

    public function get_name($data){
        return $data->name;
    }

    public function get_image(){
        return 'none.png';
    }

    private function _add(){
        $this->fields 	= [
            [
                'name'=>'name',
                'label'=>'Name',
                'validation'=> 'required',
                'permalink'=>'permalink'
            ]
        ];
    }

    private function _edit(){
        $this->fields 	= [
            [
                'name'=>'name',
                'label'=>'Name',
                'validation'=> 'required',
                'permalink'=>'permalink'
            ]
        ];
    }
}