<?php namespace sccbakery\Systems\Controllers;

use Illuminate\Support\Facades\Cache;
use sccbakery\Systems\SystemsModel;

class Systems {

    public static function load_config($type, $reset = FALSE){
        $global_config = Cache::get('config');
        if(empty($global_config) || $reset){
            $configs = SystemsModel::where('config_type', $type)->orWhere('config_type', 'both')->get();
            $global_config = array();
            foreach($configs as $config){
                $global_config[$config->name] = $config->value;
            }
            Cache::put('config', $global_config, 86400);
        }
        return $global_config;
    }

    public static function get($type, $name){
        $global_config = self::load_config($type);
        $result = "";

        if(isset($global_config[$name])){
            $result = $global_config[$name];
        }
        return $result;
    }
}