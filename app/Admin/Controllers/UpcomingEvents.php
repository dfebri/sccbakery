<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 6/25/2015
 * Time: 9:06 AM
 */
namespace sccbakery\Admin\Controllers;

use sccbakery\Admin\Models\UpcomingEventsModel;

class UpcomingEvents extends ScaffoldController {

    public function __construct() {
        parent::__construct();
        $this->data['page_title']   = "Upcoming Events";
        $this->model                = new UpcomingEventsModel;
    }

    public function index() {
        $this->module_name 	= 'Upcoming Events';
        $this->base_url 	= '_admin/upcoming_events';
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
                'sort'=> TRUE,
                'search'=> 'text'
            ],
            [
                'name'=>'description',
                'title'=>'Description',
                'sort'=> TRUE,
                'search'=> 'text'
            ],
            [
                'name'=>'events_date',
                'title'=>'Date',
                'sort'=> TRUE,
                'type'=>'custom',
                'before_show'=>'_get_date',
                'width'=>200
            ],
            [
                'name'=>'publish',
                'title'=>'Publish',
                'sort'=> TRUE,
                'type'=>'check'
            ]
        ];
    }

    private function _order(){
        $this->order_model          = new UpcomingEventsModel;
        $this->order_field			= 'order_id';
        $this->order_type_image		= false;
        $this->order_text_field		= 'title';
    }

    protected  function _get_date($data) {
        $date_format    = 'd M Y';
        $is_period  = $data->period_time;
        if($is_period) return $data->start_date->format($date_format).' - '.$data->end_date->format($date_format);
        else {
          if($data->events_date != "0000-00-00") {
            return $data->events_date->format($date_format);
          }else{
            return "No Date Selected";
          }
        }
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
            ],
            [
                'name'=>'period_time',
                'label'=>'Event Date Type',
                'validation'=> 'required',
                'type'=>'select',
                'option'=>array('0'=>'Whole Day', '1'=>'Period Time'),
                'toggle'=> array('0'=>'oneday', '1'=>'period')
            ],
            [
                'name'=>'events_date',
                'label'=>'Date',
                'type'=>'datepicker',
                'group'=>'oneday'
            ],
            [
                'name'=>'start_date',
                'label'=>'Start Date',
                'type'=>'datepicker',
                'group'=>'period'
            ],
            [
                'name'=>'end_date',
                'label'=>'End Date',
                'type'=>'datepicker',
                'group'=>'period'
            ]
        ];
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
            ],
            [
                'name'=>'period_time',
                'label'=>'Event Date Type',
                'validation'=> 'required',
                'type'=>'select',
                'option'=>array('0'=>'Whole Day', '1'=>'Period Time'),
                'toggle'=> array('0'=>'oneday', '1'=>'period')
            ],
            [
                'name'=>'events_date',
                'label'=>'Date',
                'type'=>'datepicker',
                'group'=>'oneday'
            ],
            [
                'name'=>'start_date',
                'label'=>'Start Date',
                'type'=>'datepicker',
                'group'=>'period'
            ],
            [
                'name'=>'end_date',
                'label'=>'End Date',
                'type'=>'datepicker',
                'group'=>'period'
            ]
        ];
    }
}
