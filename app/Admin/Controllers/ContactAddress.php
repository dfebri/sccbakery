<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 6/23/2015
 * Time: 1:35 PM
 */
namespace sccbakery\Admin\Controllers;

use sccbakery\Admin\Models\ContactAddressModel;

class ContactAddress extends ScaffoldController {

    public function __construct() {
        parent::__construct();
        $this->data['page_title']   = "Contact Address";
        $this->model                = new ContactAddressModel;
    }

    public function index() {
        $this->remove_action_button('delete');
        $this->set('multiple_delete',FALSE);
        $this->remove_button('add');
        $this->module_name 	= 'Contact Address';
        $this->base_url 	= '_admin/contact_address';
        $this->set('manage_order', false);

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
        $this->order_by 	= array('ordered_no'=>'asc');
        $this->fields = [
            [
                'name'=>'name',
                'title'=>'Name',
                'sort'=> TRUE,
                'search'=> 'text'
            ],
            [
                'name'=>'address',
                'title'=>'Address',
                'sort'=>false,
                'search'=>'text'
            ],
            [
                'name'=>'longitude',
                'title'=>'Longitude',
                'sort'=> false,
                'type'=>'text'
            ],
            [
                'name'=>'latitude',
                'title'=>'Latitude',
                'sort'=> false,
                'type'=>'text'
            ],
            [
                'name'=>'publish',
                'title'=>'Publish',
                'sort'=> TRUE,
                'type'=>'check'
            ]
        ];
    }
    private function _edit(){
        $this->fields 	= [
            [
                'name'=>'name',
                'label'=>'Name',
                'validation'=> 'required'
            ],
            [
                'name'=>'address',
                'label'=>'Address',
                'type'=>'tinymce',
                'validation'=> ''
            ],
            [
                'name'=>'longitude',
                'label'=>'Longitude',
                'validation'=>'required'
            ],
            [
                'name'=>'latitude',
                'label'=>'Latitude',
                'validation'=>'required'
            ],
        ];
    }
}