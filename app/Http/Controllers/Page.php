<?php namespace sccbakery\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use sccbakery\AboutModel;
use sccbakery\ContactModel;
use sccbakery\Http\Requests;
use sccbakery\Http\Controllers\Controller;

use Illuminate\Http\Request;
use sccbakery\IndustrialModel;
use sccbakery\MeetOurSuppliersModel;
use sccbakery\Systems\Controllers\Pages;
use sccbakery\UpcomingEventsModel;
use sccbakery\WhyModel;

class Page extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function error() {
        $this->data['title']    = 'Page Not Found';
        $this->data['page']     = 'page-not-found';

        return view('pageNotFound',$this->data);
    }

    public function create($permalink) {
        $this->data['title']    = ucwords(str_replace('-', ' ', $permalink));
        $this->data['page']     = $permalink;

        $content    = Pages::get($permalink, 1);
        if(empty($content)) {
            return Redirect::route('error-page');
        }
        if($permalink == 'why-choose-us') {
            $this->_why();
        } else if($permalink == 'meet-our-suppliers') {
            $this->_meetSuppliers();
        } else if($permalink == 'upcoming-events') {
            $this->_events();
        } else if($permalink == 'contact') {
            $this->_contact();
        } else if($permalink == 'about') {
            $this->_about();
        } else if($permalink == 'industrial-line') {
            $this->_industrial();
        }

        $this->data['img']  = $content->img;
        $permalink          = strtolower(str_replace('-', '', $permalink));
        return view($permalink, $this->data);
    }

    private function _industrial() {
        $this->data['industrial']       = IndustrialModel::first();
        $this->data['title']            = $this->data['industrial_meta_title'];
        $this->data['meta_description'] = $this->data['industrial_meta_description'];
        $this->data['meta_keywords']    = $this->data['industrial_meta_keyword'];
    }

    private function _meetSuppliers() {
        $this->data['suppliers']    = MeetOurSuppliersModel::where('publish', 1)->orderBy('order_id')->get();
        $this->data['title']	 			= $this->data['meet_meta_title'];
        $this->data['meta_description'] 	= $this->data['meet_meta_description'];
        $this->data['meta_keywords'] 		= $this->data['meet_meta_keyword'];
    }

    private function _about() {
        $this->data['content']              = AboutModel::first();
        $this->data['title']	 			= $this->data['about_meta_title'];
        $this->data['meta_description'] 	= $this->data['about_meta_description'];
        $this->data['meta_keywords'] 		= $this->data['about_meta_keyword'];
    }

    private function _events() {
        $this->data['events']   = UpcomingEventsModel::where('publish', 1)->orderBy('order_id')->get();
        $this->data['title']	 			= $this->data['upcoming_meta_title'];
        $this->data['meta_description'] 	= $this->data['upcoming_meta_description'];
        $this->data['meta_keywords'] 		= $this->data['upcoming_meta_keyword'];
    }

    private function _why() {
        $this->data['content']  = WhyModel::first();
        $this->data['title']	 			= $this->data['why_meta_title'];
        $this->data['meta_description'] 	= $this->data['why_meta_description'];
        $this->data['meta_keywords'] 		= $this->data['why_meta_keyword'];
    }

    private function _contact() {

        $this->data['location']             = ContactModel::where('publish', 1)->get();
        $this->data['title']	 			= $this->data['contact_meta_title'];
        $this->data['meta_description'] 	= $this->data['contact_meta_description'];
        $this->data['meta_keywords'] 		= $this->data['contact_meta_keyword'];
    }

    public function load($permalink) {
        $content    = Pages::get($permalink);
        if(empty($content)) {
            return Redirect::route('error-page');
        }
        $this->data['title']	= $content->name;
        $this->data['page']		= $permalink;
        $this->data['content']  = $content;
        $this->data['page']     = $permalink;
        $this->data['img']      = $content->img;

        return view('page', $this->data);
    }
}