<?php

namespace sccbakery\Libraries;

use Illuminate\Support\Facades\Session;

class Alert
{
	public static function add($message, $type = 'error'){
        if(is_array($message)){
        	foreach($message as $type => $msg){
          		Session::Flash($type.'_message', $msg);
        	}
      	}else{
        	Session::Flash($type.'_message', $message);
      	}
    }

    public static function show(){
	    $message  = '';
	    $message .= self::get('error');
	    $message .= self::get('success');
	    $message .= self::get('info');
	    $message .= self::get('warning');
	    
	    return $message;
	}

	public static function get($type){
    	$message = Session::get($type."_message");

	    if($message){
		    $message = '
					    <div class="alert alert-'. ($type == 'error' ? 'danger' : $type ).' alert-dismissable">
					        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					        <strong>'.ucfirst($type).'!</strong><br /> ' . $message . '
					    </div>';
	    }

    	return $message;
  	}
}