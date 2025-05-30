<?php
namespace sccbakery\Libraries;

class JS{
	private static $links 		= array();
	private static $scripts 	= array();
	private static $includes 	= array();
	private static $jquerys 	= array();

	public static function add_link($js_url){
		self::$links[sha1($js_url)] = \HTML::script($js_url);
	}

	public static function import($file){
		self::$includes[sha1($file)] = $file;
	}

	public static function add_script($script){
		self::$scripts[sha1($script)] = $script;
	}

	public static function add_jquery($jquery){
		self::$jquerys[sha1($jquery)] = $jquery;
	}

	public static function render(){
		$result = '';
		foreach (self::$links as $link) {
			$result .= "$link\n";
		}
		foreach (self::$includes as $include) {
			$result .= "includes\n";
		}
		if(!empty(self::$jquerys)){
			$result .="<script type='text/javascript'>\n";
			$result .="$(function(){\n";
			foreach (self::$jquerys as $jquery) {
				$result .= "$jquery\n";
			}
			$result .="});\n";
			$result .="</script>\n";
		}
		if(!empty(self::$scripts)){
			$result .="<script type='text/javascript'>\n";
			foreach (self::$scripts as $script) {
				$result .= "$script\n";
			}
			$result .="</script>\n";
		}

		return $result;
	}
}

?>