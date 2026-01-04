<?php

/**

 * Created by PhpStorm.

 * User: Kim

 * Date: 6/23/2015

 * Time: 1:13 PM

 */



namespace sccbakery\Admin\Controllers;



use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\URL;

use sccbakery\Admin\Models\SocialLinkModel;



class SocialLink extends ScaffoldController {

    function __construct(){

        parent::__construct();

        $this->beforeFilter('auth');

        $this->data['page_title'] = "Social Link";

    }

    public function index(){

        $this->module_name 	= 'Social Link';

        $this->base_url 	= '_admin/social_link';

        $this->model 		= New SocialLinkModel;

        $this->set('manage_order', true);

        $this->set('delete_file', 'picture');

        $this->set('delete_path', array('resources/assets/uploads/social_link'));



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

                break;

            default:

                $this->data['sub_title'] = "List ".$this->module_name;

                $this->_default();

                break;

        }



        return $this->build();

    }



    private function _order(){

        $this->order_field			= 'order_id';

        $this->order_type_image		= TRUE;

        $this->order_text_field		= 'name';

        $this->order_image_field	= 'picture';

        $this->order_image_path		= 'assets/uploads/social_link/';

    }



    private function _default(){

        $this->fields = [

            [

                'name'=>'picture',		//-- Field dari database

                'title'=>'Picture',		//-- Nama header Field di View

                'type'=>'image',

                'path'=>URL::asset('resources/assets/uploads/social_link').'/',

                'width'=>50,

            ],

            [

                'name'=>'name',

                'title'=>'Name',

                'sort'=> TRUE,

                'type'=>'text',

                'search'=>'text',

            ],

            [

                'name'=>'link',

                'title'=>'URL',

                'sort'=> TRUE,

                'type'=>'text',

                'search'=>'text',

            ],

            [

                'name'=>'publish',

                'title'=>'Publish',

                'sort'=> TRUE,

                'type'=>'check',

            ],



        ];

    }



    private function _add(){

        $orderno		= SocialLinkModel::orderBy('order_id', 'DESC')->first();

        if(!empty($orderno))		$orderno	= $orderno->order_id + 1;

        else						$orderno	= 1;

        $this->fields 	= [

            [

                'name'=>'name',

                'label'=>'Name',

                'validation'=>'required'

            ],

            [

                'name'=>'link',

                'label'=>'URL',

                'suffix'=>'with http(s)://'

            ],

            [

                'name'=>'publish',

                'label'=>'Publish',

                'type'=>'radio',

                'option'=>array('1'=>'Yes', '0'=>'No'),

                'validation'=>'required'

            ],

            [

                'name'=>'picture',

                'label'=>'Picture',

                'type'=>'file',

                'path'=>base_path().'/resources/assets/uploads/social_link/',

                'validation'=>'required|image',

                'file_notes'=>'For Best Resolution: 30x30 px'

            ],

            [

                'name'=>'order_id',

                'type'=>'hidden',

                'value'=> $orderno,

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

            ],

            [

                'name'=>'link',

                'label'=>'URL',

                'suffix'=>'with http(s)://'

            ],

            [

                'name'=>'publish',

                'label'=>'Publish',

                'type'=>'radio',

                'option'=>array('1'=>'Yes', '0'=>'No'),

                'validation'=>'required'

            ],

            [

                'name'=>'picture',

                'label'=>'Picture',

                'type'=>'file',

                'path'=>base_path().'/resources/assets/uploads/social_link/',

                'validation'=>'image',

                'file_notes'=>'For Best Resolution: 30x30 px'

            ],



        ];

    }

}