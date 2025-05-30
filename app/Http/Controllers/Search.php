<?php namespace sccbakery\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use sccbakery\Http\Requests;
use Illuminate\Http\Request;
use sccbakery\ProductModel;

class Search extends Controller {
    public function __construct(){
        parent::__construct();
        $this->data['page']		= "search";
    }

    public function index() {
        if(Input::has('search') || Input::has('search1'))
        return Redirect::route("search_params", Input::get('search'));
        else return Redirect::route('error-page');
    }

    public function search($param)
    {
        $this->data['search']   = $param;
        $this->data['title']	= 'Search result "'.$param.'"';
        $search_list = ProductModel::whereRaw("name LIKE '%" . $param . "%' OR subtitle LIKE '%" . $param . "%' OR description LIKE '%" . $param . "%'");
        $totalfound = $search_list->count();
        if ($totalfound <= 1) $totalfound .= " POST";
        else                        $totalfound .= " POSTS";

        $this->data['search_list']  = $search_list->paginate(8);
        $this->data['totalfound']   = $totalfound;
        $this->data['subPage']      = $param;

        return $this->render_view('search');
    }

}

