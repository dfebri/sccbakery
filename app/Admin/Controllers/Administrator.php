<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 6/23/2015
 * Time: 2:13 PM
 */
namespace sccbakery\Admin\Controllers;

use Illuminate\Support\Facades\Auth;
use sccbakery\Admin\Models\AdministratorModel;
use Illuminate\Support\Facades\Input;

class Administrator extends ScaffoldController {
    function __construct(){
        parent::__construct();
        $this->data['page_title'] = "Administrator";
        $this->model 		= New AdministratorModel;
    }

    public function index(){
        $this->module_name 	= 'Administrator';
        $this->base_url 	= '_admin/administrator';

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
        $currentUserID  = Auth::user()->id;
        $this->model    = $this->model->where('id', '!=', 1)->where('id', '!=', $currentUserID);
        $this->fields = [
            [
                'name'=>'email',		//-- Field dari database
                'title'=>'Email',		//-- Nama header Field di View
                'sort'=>TRUE,
                'type'=>'text',
            ],
            [
                'name'=>'name',
                'title'=>'Name',
                'sort'=> TRUE,
                'type'=>'text',
                'search'=>'text',
            ],
            [
                'name'=>'active',
                'title'=>'Active',
                'sort'=> TRUE,
                'type'=>'check',
            ],

        ];
        $this->before_delete	= "prevent_delete";
    }

    private function _add(){
        $this->fields 	= [
            [
                'name'=>'name',
                'label'=>'Name',
                'validation'=>'required'
            ],
            [
                'name'=>'email',
                'label'=>'Email',
                'validation'=>'required'
            ],
            [
                'name'=>'password',
                'label'=>'Password',
                'validation'=>'required',
                'type'=>'password'
            ],

        ];
    }

    private function _edit(){
        $id 			= Input::get('id');
        $this->query 	= ['id'=>$id];
        $this->fields 	= [
            [
                'name'=>'name',
                'label'=>'Name',
                'validation'=>'required'
            ],
            [
                'name'=>'email',
                'label'=>'Email',
                'validation'=>'required'
            ],
            [
                'name'=>'password',
                'label'=>'Password',
                'type'=>'password'
            ],
        ];
    }

    
    function prevent_delete($data){
        if($data->id == Auth::user()->id){
            \Alert::add('Your ID cannot be deleted', 'warning');
            return false;
        }
        return true;
    }
}