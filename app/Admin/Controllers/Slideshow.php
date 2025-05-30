<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 6/22/2015
 * Time: 4:01 PM
 */
namespace sccbakery\Admin\Controllers;

use Illuminate\Support\Facades\URL;
use sccbakery\Admin\Models\SlideshowModel;
use sccbakery\Libraries\Alert;

class Slideshow extends ScaffoldController {

    public function __construct() {
        parent::__construct();
        $this->data['page_title']   = "Slideshow";
        $this->model                = new SlideshowModel;
    }

    public function index() {
        $this->module_name 	= 'Slideshow';
        $this->base_url 	= '_admin/slideshow';
        $this->set('manage_order', true);
        $this->set('delete_file', 'img');
        $this->set('delete_path', array(base_path().'/resources/assets/uploads/home_slideshow/'));

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
        $this->order_model          = new SlideshowModel;
        $this->order_field			= 'order_id';
        $this->order_type_image		= TRUE;
        $this->order_text_field		= 'title';
        $this->order_image_field	= 'img';
        $this->order_image_path		= 'resources/assets/uploads/home_slideshow/';
    }

    private function _default(){
        $this->order_by 	= array('order_id'=>'asc');
        $this->fields = [
            [
                'name'=>'img',
                'title'=>'Image',
                'type'=> 'image',
                'path'=> URL::to('resources/assets/uploads/home_slideshow/'),
                'width'=> 160
            ],
            [
                'name'=>'title',
                'title'=>'Title',
                'sort'=> TRUE,
                'search'=> 'text'
            ],
            [
                'name'=>'url',
                'title'=>'URL',
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
                'label'=>'Title'
            ],
            [
                'name'=>'url',
                'label'=>'URL',
                'suffix'=>'with http://',
            ],
            [
                'name'=>'img',
                'label'=>'Image ',
                'validation'=>'required',
                'type'=>'file',
                'path'=> base_path()."/resources/assets/uploads/home_slideshow/",
                'file_notes'=>'For Best Resolution: 1600 x 620 px<br>File type:.jpg | .jpeg | .png<br>Max size: 2Mb'
            ]
        ];
    }

    private function _edit(){
        $this->fields 	= [
            [
                'name'=>'title',
                'label'=>'Title'
            ],
            [
                'name'=>'url',
                'suffix'=>'with http://',
                'label'=>'URL'
            ],
            [
                'name'=>'img',
                'label'=>'Image (1600 x 620 px)',
                'type'=>'file',
                'path'=> base_path()."/resources/assets/uploads/home_slideshow/",
                'file_notes'=>'For Best Resolution: 1600 x 620 px<br>File type:.jpg | .jpeg | .png<br>Max size: 2Mb'
            ]
        ];
    }
}