<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 6/4/2015
 * Time: 8:44 PM
 */

namespace sccbakery\Systems\Controllers;

use sccbakery\Systems\PagesModel;

class Pages{
    public static function get($permalink, $custom = 0) {
        return PagesModel::where('custom_page', $custom)->where('permalink', $permalink)->first();
    }
}