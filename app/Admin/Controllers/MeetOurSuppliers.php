<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 6/25/2015
 * Time: 8:43 PM
 */
namespace sccbakery\Admin\Controllers;

use sccbakery\Admin\Models\MeetOurSuppliersModel;

class MeetOurSuppliers extends ScaffoldController {
    public function __construct() {
        parent::__construct();
        $this->data['page_title']   = "Meet Our Suppliers";
        $this->model                = new MeetOurSuppliersModel;
    }

    public function index() {
        $this->module_name 	= 'Meet Our Suppliers';
        $this->base_url 	= '_admin/meet_our_suppliers';
        $this->set('manage_order', true);

        switch($this->action){
            case "add":
                $this->data['sub_title'] = 'Add '.$this->module_name;
                $this->_add();
                break;
            case "edit":
                $this->data['sub_title'] = "Edit ".$this->module_name;
                $this->_edit();
                break;
            case "order":
                $this->data['sub_title'] = "Order ".$this->module_name;
                $this->_order();
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
                'name'=>'title',
                'title'=>'Title',
                'sort'=>true,
                'search'=>'text'
            ],
            [
                'name'=>'description',
                'title'=>'Description',
                'sort'=> TRUE,
                'search'=> 'text'
            ],
            [
                'name'=>'publish',
                'title'=>'Publish',
                'sort'=> TRUE,
                'type'=> 'check'
            ]
        ];
    }

    private function _add(){
        $this->fields 	= [
            [
                'name'=>'title',
                'label'=>'Title',
                'validation'=> 'required'
            ],
            [
                'name'=>'description',
                'label'=>'Content',
                'type'=>'tinymce',
                'validation'=> 'required'
            ]
        ];
    }

    private function _order(){
        $this->order_model          = new MeetOurSuppliersModel;
        $this->order_field			= 'order_id';
        $this->order_type_image		= false;
        $this->order_text_field		= 'title';
    }

    private function _edit(){
        $this->fields 	= [
            [
                'name'=>'title',
                'label'=>'Title',
                'validation'=> 'required'
            ],
            [
                'name'=>'description',
                'label'=>'Content',
                'type'=>'tinymce',
                'validation'=> 'required'
            ]
        ];
    }
}