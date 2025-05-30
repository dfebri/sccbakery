<?php namespace sccbakery\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use sccbakery\CategoryModel;
use sccbakery\SocialLinkModel;
use sccbakery\Systems\Controllers\Static_Content;
use sccbakery\Systems\Controllers\Systems;
use sccbakery\Systems\PagesModel;

abstract class Controller extends BaseController {

	use DispatchesCommands, ValidatesRequests;
    public $config;
    public $content;
    public $data;
    public $configType  = 'front';
    public $reset       = true;

    public function __construct() {
        $this->_setup_global();

        $this->_start_up(Systems::load_config($this->configType, $this->reset));
        $this->_start_up(Static_Content::load_content($this->reset));

        if(Systems::get($this->configType, 'maintenance_mode')) {
            return view('errors.503');
            exit;
        }
    }

    public function _setup_global() {
        $this->data['social_link_list']	= SocialLinkModel::where('publish', '=', '1')->orderBy('order_id')->get();
        $this->data['page_list']		= PagesModel::where('publish', '=', '1')->where('show_footer','=','1')->orderBy('ordered_no')->get();
        $this->data['category_list']	= CategoryModel::where('publish', '=', '1')->orderBy('order_id')->get();
    }

    public function _start_up($config) {
        foreach($config as $key => $conf)
            $this->data[$key] = $conf;
    }

    public function render_view($name) {
        return view($name, $this->data);
    }
}