<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 6/23/2015
 * Time: 1:32 PM
 */
namespace sccbakery\Admin\Controllers;

use sccbakery\Admin\Models\ContactMessageModel;

class ContactMessage extends ScaffoldController {
    function __construct(){
        parent::__construct();
        $this->data['page_title'] = "Contact Message";
        $this->model 		= New ContactMessageModel;
    }

    public function index(){
        $this->module_name 	= 'Contact Message';
        $this->base_url 	= '_admin/contact_message';
        $this->set('action',FALSE);
        $this->set('multiple_delete',FALSE);
        $this->remove_button('add');

        switch($this->action){
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
                'name'=>'name',		//-- Field dari database
                'title'=>'Name',		//-- Nama header Field di View
                'search'=>'text',
                'sort'=>TRUE,
            ],
            [
                'name'=>'email',		//-- Field dari database
                'title'=>'Email',		//-- Nama header Field di View
                'search'=>'text',
                'sort'=>TRUE,
            ],
            [
                'name'=>'subject',		//-- Field dari database
                'title'=>'Subject',		//-- Nama header Field di View
                'search'=>'text',
                'sort'=>TRUE,
            ],
            [
                'name'=>'message',		//-- Field dari database
                'title'=>'Message',		//-- Nama header Field di View
                'search'=>'text',
                'sort'=>TRUE,
            ],
            [
                'name'=>'created_at',
                'title'=>'Created At',
                'sort'=> TRUE,
                'search'=>'text',
            ],

        ];
    }
}