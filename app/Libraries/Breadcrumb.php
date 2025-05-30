<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 6/12/2015
 * Time: 6:26 AM
 */

namespace sccbakery\Libraries;

class Breadcrumb
{
    private static $_breadcrumbs = array();

    public static function add($text, $url = ''){
        $count = count(self::$_breadcrumbs);

        if($count>0)
            self::$_breadcrumbs[$count - 1]['last'] = false;

        self::$_breadcrumbs[$count]['text'] 	= ucwords($text);
        self::$_breadcrumbs[$count]['url'] 		= $url;
        self::$_breadcrumbs[$count]['last'] 	= true;
    }

    public static function get($separator = '&nbsp;/&nbsp;', $wrapp = "li"){
        $return = '';

        if($wrapp == 'li'){
            $return  .= "<ul class='breadcrumb'>";
            foreach(self::$_breadcrumbs as $bc){
                $return .= "<li". ($bc['last']?' class="last"':'') ."><a href='".$bc['url']."'>".$bc['text']."</a></li>";
                if($separator!='' && !$bc['last']){
                    $return .= "<li class='span'>".$separator."</li>";
                }
            }
            $return .= "</ul>";
        }else{
            $return .= "<a href='".$bc['url']."' ". ($bc['last']?' class="last"':'') .">".$bc['text']."</a>";
            if($separator!='' && !$bc['last']){
                $return .= "<span>".$separator."</span>";
            }
        }

        return $return;
    }

    public static function get_raw(){
        return self::$_breadcrumbs;
    }
}
