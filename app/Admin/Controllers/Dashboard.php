<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 6/22/2015
 * Time: 2:25 PM
 */
namespace sccbakery\Admin\Controllers;

use Illuminate\Support\Facades\Redirect;

class Dashboard extends AdminController {
    public function __construct() {
        parent::__construct();
        $this->data['page_title']   = 'Dashboard';
    }

    public function index() {
        return Redirect::route('admin_slideshow');
        return $this->render_view('dashboard.dashboard');
    }
}