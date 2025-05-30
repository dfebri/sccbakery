<?php namespace sccbakery\Admin\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use sccbakery\Http\Requests;
use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use sccbakery\Systems\Controllers\Systems;

use Illuminate\Http\Request;

class AdminController extends BaseController {

	public      $data           = array();
    protected   $scaffold       = array();
    protected   $layout         = 'admin::blank';
    protected   $breadcrumb     = array();
    public      $configType     = 'back';

    public function __construct($scaffold = false) {
        $this->_setup_global();

        $this->_start_up(Systems::load_config($this->configType, true));
    }

    protected function render_view($view)
    {
        $this->data['breadcrumb'] = $this->get_breadcrumb();

        return view::make('admin::'.$view, $this->data);
    }

    public function _setup_global() {
        /**
         * Set Global Settings here
         * or you can fetch data from model here
         */
        $this->data['loadjqueryui']             = false;
        $this->data['loadmce']                  = false;
        $this->data['sortable']                 = false;
        $this->data['ajax_checkbox']            = false;
        $this->data['loadjquerytokenize']       = false;
        $this->data['loadjquerymultiselect']    = false;
        $this->data['scripts']                  = array();
    }

    public function _start_up($config) {
        foreach($config as $key => $conf)
            $this->data[$key] = $conf;
    }

    protected function redirect_back($data = []){
        return Redirect::back()->withInput()->with($data);
    }

    public function redirect_referer(){
        $referer = Request::server('HTTP_REFERER');

        return Redirect::to($referer);
    }

    protected function redirect_route($route, $data = []){
        return Redirect::route($route, $data);
    }

    public function add_breadcrumb($title, $link){
        $this->breadcrumb[] = array(
            'title' => $title,
            'link'  => $link
        );
    }

    public function get_breadcrumb($separator = ''){
        $breadcrumbs = "<ul id='breadcrumbs'>";
        $i = 0;
        $count = count($this->breadcrumb);
        foreach ($this->breadcrumb as $breadcrumb) {
            if(!empty($separator) && $i>0){
                $breadcrumbs .="<li><span>".$separator."</span></li>";
            }
            $i++;

            if(empty($breadcrumb['link'])){
                $breadcrumbs .= "<li". ($i==$count ? ' class="last"' : '') ."><span>".$breadcrumb['title']."</span></li>";
            }else{
                $breadcrumbs .= "<li". ($i==$count ? ' class="last"' : '') ."><a href='".$breadcrumb['link']."'>".$breadcrumb['title']."</a></li>";
            }
        }
        $breadcrumbs .= "</ul>";

        return $breadcrumbs;
    }
}
