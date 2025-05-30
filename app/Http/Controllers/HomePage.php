<?php namespace sccbakery\Http\Controllers;

use sccbakery\HomeSlideShowModel;
use sccbakery\Http\Requests;
use sccbakery\Http\Controllers\Controller;

use Illuminate\Http\Request;

class HomePage extends Controller {

    public function __construct() {
        parent::__construct();
        $this->data['page']		            = "home";
        $this->data['title']	 			= $this->data['home_meta_title'];
        $this->data['meta_description'] 	= $this->data['home_meta_description'];
        $this->data['meta_keywords'] 		= $this->data['home_meta_keyword'];
    }

	public function index()
	{
        $this->data['slideshow_list']		= HomeSlideShowModel::where('publish', '=', 1)->orderBy('order_id')->get();

        return view('home', $this->data);
	}
}
