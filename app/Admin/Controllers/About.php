<?php

/**

 * Created by PhpStorm.

 * User: Kim

 * Date: 6/25/2015

 * Time: 8:19 PM

 */

namespace sccbakery\Admin\Controllers;



use sccbakery\Admin\Models\AboutModel;



class About extends ScaffoldController {

    public function __construct() {

        parent::__construct();

        $this->data['page_title']   = "About";

        $this->model                = new AboutModel();

    }



    public function index() {

        $this->module_name 	= 'About';

        $this->base_url 	= '_admin/about';

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