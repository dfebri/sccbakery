<?php
namespace sccbakery\Admin\Controllers;

use Folklore\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use sccbakery\Http\Requests\Request;
use sccbakery\Libraries\JS;
use sccbakery\Libraries\Alert;
use DB;

class ScaffoldController extends AdminController {
	public $model;
	public $query 				= array();
	public $fields;
	public $base_url;
	public $before_delete;
	public $after_delete;
	public $before_save;
	public $after_save;
	public $before_multiple_delete;
	public $after_multiple_delete;
	public $table_id			= 'id';
	public $module_name     	= '';
	public $action 				= 'list';
	public $order_by 			= ['id'=>'desc'];

	public $manage_order    	= FALSE;
    public $order_model			= '';
	public $order_field			= 'order_id';
	public $order_type_image	= TRUE;
	public $order_text_field	= 'title';
	public $order_image_field	= 'img';
	public $order_image_path	= '';
	public $order_filter 		= null;
	public $order_text_language = false;

	private $_edited;
	private $_redirect;
	private $_button 			= [];
	private $_removed_button 	= [];
	private $_where 			= [];
	private $_action_button 	= [];
	private $_removed_action 	= [];
	private $_list_setting		= [
									'multiple_delete' 		=> TRUE,
									'action'		  		=> TRUE,
									'action_title'	  		=> "Action",
									'show_number'	  		=> TRUE,
									'show_search_button'   	=> TRUE,
									'manage_order'   		=> FALSE,
									'delete_file'			=> null,
									'delete_path'			=> null,
									'breadcrumb'			=> TRUE,
								  ];

	public function __construct(){
		parent::__construct();
		DB::enableQueryLog();
		$this->action   = \Input::get('act');
	}

	public function _config($setting_key){
		return isset($this->_list_setting[$setting_key]) ? $this->_list_setting[$setting_key] : '';
	}

	public function set($setting, $value=''){
		if(is_array($setting)){
			$this->_list_setting = array_merge($this->_list_setting, $setting);
		}else{
			$this->_list_setting[$setting] = $value;
		}
	}

	public function add_range_filter($field){
		$this->data['loadjqueryui'] = TRUE;
		$result = '<div class="row"><div class="col-xs-6 col-xs-offset-6"><div class="date-picker">'.
	        			'From '. \Form::text($field."_1", \Input::get($field."_1"), array('class'=>'datepicker date-range field1 search')) .
	        			'To '. \Form::text($field."_2", \Input::get($field."_2"), array('class'=>'datepicker date-range field2 search')) .
	        	  '</div></div></div>';

	    $field1 = \Input::get($field."_1");
	    $field2 = \Input::get($field."_2");

	    if(!empty($field1) && !empty($field2) && strtotime($field2) >= strtotime($field1)){
	    	$this->_where[] = $field." BETWEEN '".$field1."' AND '".$field2."'";
	    }

		$this->data['date_range_filter'] = $result;
	}

	public function add_action_button($action, $url = NULL, $text = NULL, $attributes = []){
		if(!isset($attributes['title'])){
			$attributes['title'] = empty($text) ? $text : ucfirst($action);
		}

		$appended_action[$action]['action'] 		= $action;
		$appended_action[$action]['attributes'] 	= $attributes;
		$appended_action[$action]['text'] 			= !empty($text) ? $text : ucfirst($action);

		if(!strstr($url, 'http://'))
			$url = \URL::to($url);

		$appended_action[$action]['url']			= $url;
		$this->_action_button			 			= array_merge($this->_action_button, $appended_action);
	}

	public function remove_action_button($args){
		$actions = func_get_args();
		$this->_removed_action = array_merge($actions, $this->_removed_action);
	}

	public function add_button($type, $url = NULL, $text = NULL, $attributes = []){
		if(!isset($attributes['title'])){
			$attributes['title'] = empty($text) ? $text : ucfirst($type);
		}

		$appended_button[$type]['action'] 		= $type;
		$appended_button[$type]['attributes'] 	= $attributes;
		$appended_button[$type]['url'] 			= $url;
		$appended_button[$type]['text'] 		= !empty($text) ? $text : ucfirst($type);

		$this->_button				   			= array_merge($this->_button, $appended_button);
	}

	public function remove_button($args){
		$type = func_get_args();
		$this->_removed_button = array_merge($type, $this->_removed_button);
	}

	private function _default_action(){
		$this->add_action_button(
				'edit',
				\URL::to($this->base_url.(strstr($this->base_url, '?') ? '&' : '?')."act=edit&".$this->table_id."={".$this->table_id."}"),
				'<i class="glyphicon glyphicon-edit"></i>', array('class'=>'btn btn-xs btn-success')
			);

		$this->add_action_button(
				'delete',
				\URL::to($this->base_url.(strstr($this->base_url, '?') ? '&' : '?')."act=delete&".$this->table_id."={".$this->table_id."}"),
				'<i class="glyphicon glyphicon-trash"></i>',
				array('class'=>'btn btn-xs btn-danger', 'onclick'=>'return before_delete(this);')
			);

		$this->_run_delete_action();
	}

	private function _run_delete_action(){
		if(!empty($this->_removed_action)){
			foreach ($this->_removed_action as $action) {
				if(isset($this->_action_button[$action]))
					unset($this->_action_button[$action]);
			}
		}
	}

	private function _default_button(){
		if(empty($this->action) || $this->action == 'list'){
			$this->add_button('add', \URL::to($this->base_url.(strstr($this->base_url, '?') ? '&' : '?')."act=add"), '<i class="glyphicon glyphicon-plus"></i> Add '.$this->module_name, array('class'=>'btn btn-info'));
			if($this->_config('manage_order'))
				$this->add_button('order', \URL::to($this->base_url.(strstr($this->base_url, '?') ? '&' : '?')."act=order"), '<i class="glyphicon glyphicon-th-large"></i> Order '.$this->module_name, array('class'=>'btn btn-warning'));
		}elseif($this->action == 'order'){
			$this->add_button('save', '#', '<i class="glyphicon glyphicon-floppy-disk"></i> Save Order', array('class'=>'btn btn-info', 'onclick'=>'return submit_form("form_order");'));
			$this->add_button('back', \URL::to($this->base_url), '&laquo; Back', array('class'=>'btn btn-default'));
		}else{
			$this->add_button('save', '#', '<i class="glyphicon glyphicon-floppy-disk"></i> Save', array('class'=>'btn btn-info', 'onclick'=>'return submit_form();'));
			$this->add_button('back', \URL::to($this->base_url), '&laquo; Back', array('class'=>'btn btn-default'));
		}

		$this->_run_delete_button();
		$this->_generate_button();
	}

	private function _run_delete_button(){
		if(!empty($this->_removed_button)){
			foreach ($this->_removed_button as $action) {
				if(isset($this->_button[$action]))
					unset($this->_button[$action]);
			}
		}
	}

	private function _generate_button(){
		$this->data['button'] = '';
		foreach ($this->_button as $button) {
			$button['attributes']['href'] = $button['url'];
			$this->data['button'] .= "<a ". \HTML::attributes($button['attributes']) .">".$button['text']."</a> ";
		}
	}

	private function _create_list(){
		$search 		= '';
		$havesearch		= FALSE;
		$page 			= (int)\Input::get('page') == 0 ? 1 : (int)\Input::get('page');
		$limit 			= 20;
		$total_column 	= count($this->fields);
		$head 			= '<thead><tr>';

		//Collect query string
		$qs 		  = \Request::server('QUERY_STRING');
		$query_string = array();

		if(!empty($qs)){
			parse_str($qs, $query_string);
		}
		// foreach($query_string as $key => $value){
		// 	if($value=="all" || $key==0){
		// 		unset($query_string[$key]);
		// 	}
		// }

		if($this->_config('multiple_delete') == TRUE){
			$head .= "<th width='20'><input type='checkbox' value='1' name='check_all' id='check_all'/></th>";
			$total_column++;
		}
		if($this->_config('show_number') == TRUE){
			$head .= "<th>No</th>";
			$total_column++;
		}
		$i 				= 0;
		foreach ($this->fields as $field) {
			$this->_set_default_list($field);
			$i++;
			if($i==1){
				if($this->_config('multiple_delete') == TRUE)
					$search .= '<th></th>';
				if($this->_config('show_number') == TRUE)
					$search .= "<th></th>";
			}

			if(isset($field['sort']) && $field['sort']){
				$qs 	 = array();
				$sort 	 = \Input::get('sort');
				$method  = \Input::get('method');
				$sorted  = $sort == $field['name'];
				$sortasc = $sorted && $method == 'asc';
				$class 	 = 'sort'.($sorted?' sorted '.$method : '');

				$qs['sort'] 	= $field['name'];
				$qs['method'] 	= $sortasc ? 'desc' : 'asc';

				$head 	.= "<th ". \HTML::attributes($field['title_cell_attributes']) .">";
				$head 	.= "<a href='". \URL::to($this->base_url."?".http_build_query($qs))."' class='".$class."'><span ".\HTML::attributes($field['title_attributes']).">".$field['title']."</span></a>";
				$head 	.= "</th>";

				if(!empty($sort) && !empty($method)){
					$this->order_by = array($sort=>$method);
				}
			}else{
				$head 	.= "<th ". \HTML::attributes($field['title_cell_attributes']) ."><span ".\HTML::attributes($field['title_attributes']).">".$field['title']."</span></th>";
			}
			$search .="<th>";
			if(isset($field['search']) && $field['search']){
				$havesearch 				= TRUE;
				$property['class'] 			= 'form-control search select2';
				$search_name 				= $field['custom_search'] ? $field['custom_search'] : "s_".$field['name'];
				$search_val 				= \Input::get($search_name);
				$search_val					= str_replace(array('*', '--all--', '-all-'), '', $search_val);

				if(is_array($field['search'])){
					$search .= \Form::select($search_name, $field['search'], \Input::get("s_".$field['name']), $property);
					if(!empty($search_val))
						if($search_val!="all"){
							$this->_where[] = $field['name']." = '".$search_val."'";
						}
				}else{
					if($field['custom_search']){
						$search_query = $this->_callback($search_val, $field['custom_search']);
						if(!empty($search_query))
							$this->_where[] = $search_query;
					}elseif($field['search'] == 'datepicker'){
						$property['class'].= ' datepicker';
						$this->data['loadjqueryui'] = TRUE;
						if(!empty($search_val))
							$this->_where[] = $field['name']." = '".$search_val."'";
					}else{
						if(!empty($search_val))
							$this->_where[] = $field['name']." LIKE '%".$search_val."%'";
					}
					$search .= \Form::text($search_name, $search_val, $property);
				}
			}
			$search .="</th>";
		}

		if($this->_config('action') !== FALSE){
			//SET DEFAULT ACTION BUTTON
			$this->_default_action();
			$head 	.= "<th width='120'>".$this->_config('action_title')."</th>";
			if($havesearch){
				$search .= '<th><a href="#" onclick="collect_and_search();" class="btn btn-info" title="Search"><i class="glyphicon glyphicon-search"></i></a>&nbsp;<a href="'.\URL::to($this->base_url).'" class="btn btn-warning" title="Reset"><i class="glyphicon glyphicon-refresh"></i></a></th>';
			}
		}

		if($havesearch){
			$this->data['loadsearch'] = TRUE;
			$search = "<tr>".$search."</tr>";
		}else{
			$search = '';
		}

		$head .= '</tr>'.$search.'</thead>';

		//Generating Data Query
		$order_by_raw = array();
		foreach ($this->order_by as $key => $value) {
			$order_by_raw[] = $key." ".$value;
		}

		if(!empty($this->_where)) {
			$list_data = $this->model->whereRaw(implode(' AND ', $this->_where))->orderByRaw(implode(', ', $order_by_raw));
		}else{
			$list_data  = $this->model->orderByRaw(implode(', ', $order_by_raw));
		}
		$list_data = $list_data->paginate($limit);
		$list_data->appends($query_string);

		//generating List of data
		$list 	= '';
		$no 	= ($page - 1) * $limit;
		foreach($list_data as $data){
			$no++;
			$list .= "<tr>";
			if($this->_config('multiple_delete') == TRUE){
				$list .= "<td><input type='checkbox' value='".$data->{$this->table_id}."' name='deleted_items[]' class='check_item' id='check_item[]'/></td>";
			}
			if($this->_config('show_number') == TRUE){
				$list .= "<td width='30'>".$no."</td>";
			}
			foreach ($this->fields as $field) {
				$this->_set_default_list($field);
				$cell_attributes  = '';
				if($field['align']){
					if(isset($field['cell_attributes']['style'])){
						$field['cell_attributes'] .= "text-align: ".$field['align'];
					}else{
						$field['cell_attributes']['style'] = "text-align: ".$field['align'];
					}
				}
				if(isset($field['cell_attributes']) && is_array($field['cell_attributes']))
					$cell_attributes = \HTML::attributes($field['cell_attributes']);

				$attributes  = '';
				if(isset($field['attributes']) && is_array($field['attributes']))
					$attributes = \HTML::attributes($field['attributes']);
				$list .= "<td ".$cell_attributes.">".$field['prefix'];

				if($field['type']=='custom'){
					$list .= $this->_callback($data, $field['before_show']);
				}elseif($field['type']=='check'){
					$this->data['ajax_checkbox'] = TRUE;
					$field['before_update'] = isset($field['before_update']) ? $field['before_update'] : '';
					$list .= "<div class='ajax-btn' style='width:100%; text-align:center;'>";
					$list .= '<a href="'.\URL::to($this->base_url.'?act=ajax_update&field='.$field['name'].'&value=0&'.$this->table_id.'='.$data->{$this->table_id}.'&callback='.$field['before_update']).'" title="Click Turn Off" class="on'.($data->{$field['name']} == 1 ? '':' hide').'"><i class="glyphicon glyphicon-ok"></i></a>';
					$list .= '<a href="'.\URL::to($this->base_url.'?act=ajax_update&field='.$field['name'].'&value=1&'.$this->table_id.'='.$data->{$this->table_id}.'&callback='.$field['before_update']).'" title="Click Turn On" class="off'.($data->{$field['name']} != 1 ? '':' hide').'"><i class="glyphicon glyphicon-remove"></i></a>';
					$list .= "</div>";
				}elseif($field['type']=='image' && isset($field['path'])){
					$attributes['width'] = "100%";
					$list .= "<img src='". trim($field['path'], '/')."/".$data->{$field['name']}."' ". \HTML::attributes($attributes)."/>";
				}elseif(!empty($field['belongs_to'])){
					// field['belongs_to'] should be array (model_method, field_name/*, callback)
					$related = $data->{$field['belongs_to'][0]}()->find($data->{$field['name']});
					$field_value = "[".$data->{$field['name']}."]"; //if relation not found return it self
					if($related){
						if($field['belongs_to'][1] == '*'){ //ge all field
							$field_value = $related;
						}else{
							$field_value = $this->_format($field['format'], $related->{$field['belongs_to'][1]});
						}
					}
					if(isset($field['belongs_to'][2])){
						$field_value = $this->_callback($field_value, $field['belongs_to'][2]);
					}
					$list .= "<span ".$attributes.">".$this->_callback($field_value, $field['before_show'])."</span>";
				}else{
					$field_value = $data->{$field['name']};
					if($field['language'] !== false){
						$field_value =  \Helper::lang($data->{$field['name']}, $field['language']);
					}
					$field_value = $this->_limit_text($field_value, $field['limit_text']);
					$list 		.= "<span ".$attributes.">".$this->_format($field['format'], $this->_callback($field_value, $field['before_show']))."</span>";
				}
				$list .= $field['sufix']."</td>";
			}

			if($this->_config('action') !== FALSE){
				$list .= "<td style='text-align:center;'>";
				foreach($this->_action_button as $action){
					$action['url'] = $this->_replace_url($action['url'], $data->toArray());
					$list .= "<a href='".$action['url']."' ". \HTML::attributes($action['attributes']) .">".$action['text']."</a> ";
				}
				$list .= "</td>";
			}
			$list .= "</tr>";
		}

		//Generate Content
		$result  = \Form::open(array('method'=>'POST', 'url'=>\Request::fullUrl(), 'id'=>'form-scaffold'));
//		$result  = "<div class='pagination top'>".$list_data->links('pagination::slider-3')."</div>";
		$result .= "<table class='table table-hover table-striped'>".$head.$list."</table>";
        $setPath    = explode('/', $this->base_url);
        $setPath    = end($setPath);
		$result .= "<div class='pagination bottom'>".$list_data->setPath($setPath)->render()."</div>";
		$result .= \Form::close();

		if($this->_config('multiple_delete') == TRUE){
			$this->data['multiple_delete'] = TRUE;
			$result .= '<div class="form-action">
							<form id="form-multiple-delete" method="POST" action="'. \URL::to($this->base_url) .'?act=multiple_delete" ></form>
							<a href="#" id="btn-multiple-delete" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete Selected</a>
						</div>';
		}

		$this->data['content'] = $result;
	}

	private function _replace_url($text, $data){
		$text = preg_replace_callback("/(\{\w*\})/", function($match) use (&$data) {
			$key = str_replace(array('{', '}'),'', $match[0]);
			if(isset($data[$key]))
				return $data[$key];
			else
				return '';
		},  $text);

		return $text;
	}

	private function _create_order(){
		if(\Input::get('save_order') && \Input::get($this->table_id)){
			$this->_do_save_order();
		}

		$where  	= array();
		$filter 	= '';
		if(!empty($this->order_filter)){
			$property 	= array('class'=>'order_filter','onchange'=>'return order_filter();');
			foreach ($this->order_filter as $key => $value) {
				$filter .= "<div>";
				$filter .= $value['title']." ";
				$filter .= \Form::select($key, $value['data'], \Input::get($key), $property);
				$filter .= "</div>";
				$where[$key] = \Input::get($key);
			}
		}

		$list_data = $this->model->where($where)->orderBy($this->order_field, 'asc')->get();
		$this->data['loadjqueryui'] = TRUE;
		$this->data['sortable'] 	= TRUE;
		$i = 0;
		$order = '';
		$image = '';
		foreach($list_data as $data){
			$i++;
			$order .="<li>".$i."</li>";

			$image .="<li id='arrayorder_".$data->{$this->table_id}."'>";
			if($this->order_type_image){
				$this->order_image_path = rtrim($this->order_image_path, '/')."/";
				$img = '';
				if(strpos($this->order_image_field, 'callback:') !== FALSE){
					$img = $this->_callback($data, str_replace('callback:', '', $this->order_image_field));
				}else
					$img = $data->{$this->order_image_field};

				if(!\File::exists($this->order_image_path.$img)){
					$image .="<div class='order_img' style='background-image:url(".\URL::asset($this->data['asset_path'].'assets/images/none.png').") center no-repeat; background-size: cover;'></div>";
				}else{
					$image .="<div class='order_img'  style='background-image:url(".\URL::asset($this->order_image_path.$img)."); background-size: cover;'></div>";
				}
			}
			// else{
			// 	$image .="<div class='order_img'>".$data->{$this->text_field}."</div>";
			// }
			$title = '';
			if(strpos($this->order_text_field, 'callback:')	!== FALSE)
				$title = $this->_callback($data, str_replace('callback:', '', $this->order_text_field));
			else{
				$title = $data->{$this->order_text_field};
				if($this->order_text_language !== false){
					$title = \Helper::lang($data->{$this->order_text_field}, $this->order_text_language);
				}
			}

			$image .="<div class='order_detail'>
							<a href='".\URL::to($this->base_url."?act=edit&".$this->table_id."=".$data->{$this->table_id})."' target='_blank'>".$title."&nbsp;</a>
							<div class='pull-right'>
								<!--<input type='text' class='order_id' style='width:30px;' name='order_id[]' value='".$i."'/>-->
								<input type='hidden' class='".$this->table_id."' name='".$this->table_id."[]' value='".$data->{$this->table_id}."'/>
							</div>
						</div>
					</li>";
		}

		$result  ='<form id="form_order" action="'.\URL::to($this->base_url. (strstr($this->base_url, '?') ? '&' : '?') ."act=order").'" method="post">';

		if(!empty($filter)){
			$result .='<div id="filterbox" class="filter-box" style="margin-bottom:20px;">'.$filter.'</div>';
		}

		$result .='<div id="orderingcontainer" class="order-box">';
		$result .='<ul class="ordering ordering-back clearfix">'.$order.'</ul>';
		$result .='<ul class="rdering ordering-content clearfix">'.$image.'</ul>';
		$result .='<input type="hidden" name="save_order" value="1">';
		$result .='<input type="hidden" name="_token" value="'.csrf_token().'">';
		$result .='</div>';
		$result .='</form>';

		$this->data['content'] = $result;
	}

	private function _do_save_order(){
		$qs = '';
		if(!empty($this->order_filter)){
			foreach ($this->order_filter as $key => $value) {
				$update[$key] = \Input::get($key);
			}
			$qs = http_build_query($update);
		}

		$ids = \Input::get($this->table_id);
		$i = 1;
		foreach ($ids as $id) {
			$data = $this->order_model->find($id);
			$data->{$this->order_field} = $i;
			$data->save();
			$i++;
		}

		\Alert::add('Save order success.', 'success');
		$this->_redirect = \Request::fullUrl().(!empty($qs) ? "&".$qs : '');
	}

	private function _create_edit(){
		$id 			= Input::get($this->table_id);
		if(empty($this->query)){
			$this->query  = array($this->table_id => Input::get($this->table_id));
		}

		if(isset($_POST['save'])){
			$this->_do_save_edit();
		}

		$this->_edited = $this->model->where($this->query)->first();

		if(!$this->_edited){
			Alert::add('Data not found!');
			$this->_redirect = Request::url();
			return false;
		}

		$form = '';
		foreach($this->fields as $field){
			$this->_set_default($field);

			$field['value'] = $field['type'] == 'hidden' && $field['value'] ? $field['value'] : $this->_edited->{$field['name']};

			if($field['type'] == 'tinymce')
				$this->data['loadmce'] = TRUE;
			if($field['type'] == 'checkbox' || $field['type'] == 'list' || $field['type'] == 'listtokenize' || $field['type'] == 'multiselect'){
				$field['value'] = json_decode($field['value'], TRUE);
			}elseif($field['multi_language'] === true){
				$f_value = json_decode($field['value'], TRUE);
				if( $f_value === null || !is_array($f_value)){
					$f_value = $field['value'];
				}
				$field['value'] = $f_value;
			}elseif(($field['type'] == 'file' || $field['type'] == 'image') && !empty($field['value'])){
				$file = $field['path'].$field['value'];
				if(File::exists($file)){
					$ext = File::extension($file);
					if($ext == 'png' || $ext == 'jpg' || $ext='gif' || $ext='jpeg'){
						$field['value'] = 'data:image/'.$ext.';base64, '.base64_encode(File::get($file));
					}
				}else{
					$field['value'] = $field['value']."<br /><span style='color:red; font-size:11px; font-weight:bold;'>Warning: File doesn't exists!</span>";
				}
			}

			//$form .= View::make('admin::scaffold.'.$field['type'], $field);
			if(!empty($field['toggle'])){
				$this->_create_script_toggle($field);
			}

			if($field['multi_language'] === true){
				$form .= View::make('admin::scaffold.ml.'.($field['type'] == 'image' ? 'file' : $field['type']), $field)->render();
			}else{
				$form .= View::make('admin::scaffold.'.($field['type'] == 'image' ? 'file' : $field['type']), $field)->render();
			}
		}

		$result  = \Form::open(array('method'=>'POST', 'url'=>\Request::fullUrl(), 'id'=>'form-scaffold', 'enctype'=>'multipart/form-data'));
		$result .= "<div class='form'>".$form."</div>";
		$result .= \Form::hidden('save', 1);
		$result .= \Form::close();

		$this->data['content'] = $result;
	}

	private function _do_save_edit(){
		$this->_edited 	= $this->model->where($this->query)->first();
		$input 			= array();
		$rules 			= array();
		$error_message	= NULL;
		$upload_files	= array();

		foreach($this->fields as $field){
			$this->_set_default($field);
			$new_value = '_destroy';

			if($field['type'] == 'file' || $field['type'] == 'image'){
				$file 		= Input::file($field['name']);
				$removed 	= Input::get($field['name']."_removed");
				if(isset($field['validation'])){
					if($field['multi_language']){
						foreach (Input::get('other.supported_language') as $lang) {
							$input[$field['name'].".".$lang] = $file;
							$rules[$field['name'].".".$lang] = $field['validation'];
						}
					}else{
						$input[$field['name']] = $file;
						$rules[$field['name']] = $field['validation'];
					}
				}

				if(Input::hasfile($field['name'])){
					$field['uploaded'] 	= $file;
					$upload_files[] 	= $field;
				}elseif(!empty($removed)){
					$new_value = '';
					$old = $this->_edited->{$field['name']};
					@unlink(rtrim($field['path'], '/')."/".$old);
					if(isset($field['image_option']['thumbnail'])){
						foreach ($field['image_option']['thumbnail'] as $thumb) {
							if(isset($thumb[2])){
								@unlink(rtrim($thumb[2], '/')."/".$old);
							}
						}
					}
				}
			}else{
				$new_value = Input::get($field['name']);
				if(isset($field['validation'])){
					$input[$field['name']] = $new_value;
					$rules[$field['name']] = $field['validation'];
				}
			}

			if(!empty($field['before_save'])){
				$new_value = $this->_callback($new_value, $field['before_save']);
			}

			if(is_array($new_value)){
				$new_value = json_encode($new_value);
			}

			if($new_value != '_destroy' ){
				$this->_edited->{$field['name']} = $new_value;
				if(!empty($field['permalink'])){
					$this->_edited->{$field['permalink']} = $this->_permalink($field['permalink'], $new_value, $field['multi_language'], $this->_edited->id);
				}
			}

		}

		$do_save = true;
		if(!empty($rules) && !empty($input)){
			$validator  = Validator::make($input, $rules);
			$do_save 	= !$validator->fails();
			$error 		= $validator->messages();
		}


		if($do_save){
			if(!empty($upload_files)){
				foreach ($upload_files as $uploaded) {
					$old = $this->_edited->{$uploaded['name']};
					@unlink(rtrim($uploaded['path'], '/')."/".$old);
					if(isset($uploaded['image_option']['thumbnail'])){
						foreach ($uploaded['image_option']['thumbnail'] as $thumb) {
							if(isset($thumb[2])){
								@unlink(rtrim($thumb[2], '/')."/".$old);
							}
						}
					}
					$this->_edited->{$uploaded['name']} = $this->_do_upload($uploaded);
				}
			}


			$this->_edited->save();

			if($this->after_save){
				$this->_callback($this->_edited, $this->after_save);
			}

			Alert::add('Update data success.', 'success');
			$this->_redirect = URL::to($this->base_url);
		}else{
			$message = implode('<br />', $error->all());
            Alert::add($message);
			$this->_redirect = Request::fullUrl();
		}
	}

	private function _create_add(){
		if(isset($_POST['save'])){
			$this->_do_save_add();
		}

		$form = '';
		foreach($this->fields as $field){
			$this->_set_default($field);

			if(!empty($field['toggle'])){
				$this->_create_script_toggle($field);
			}
			if($field['multi_language'] == true){
				$form .= View::make('admin::scaffold.ml.'.($field['type'] == 'image' ? 'file' : $field['type']), $field)->render();
			}else{
				$form .= View::make('admin::scaffold.'.($field['type'] == 'image' ? 'file' : $field['type']), $field)->render();
			}
		}

		$result  = \Form::open(array('method'=>'POST', 'url'=>\Request::fullUrl(), 'id'=>'form-scaffold', 'enctype'=>'multipart/form-data'));
		$result .= "<div class='form'>".$form."</div>";
		$result .= \Form::hidden('save', 1);
		$result .= \Form::close();

		$this->data['content'] = $result;
	}

	private function _do_save_add(){
		$input 			= array();
		$rules 			= array();
		$error_message	= NULL;
		$upload_files	= array();

		foreach($this->fields as $field){
			$this->_set_default($field);

			if($field['type'] == 'file' || $field['type'] == 'image'){
				$file = \Input::file($field['name']);
				if(isset($field['validation'])){
					$input[$field['name']] = $file;
					$rules[$field['name']] = $field['validation'];
				}

				if(\Input::hasfile($field['name'])){
					$field['uploaded'] 	= $file;
					$upload_files[] 	= $field;
				}
			}else{
				$new_value = \Input::get($field['name']);
				if(isset($field['validation'])){
					$input[$field['name']] = $new_value;
					$rules[$field['name']] = $field['validation'];
				}

				if(!empty($field['before_save'])){
					$new_value = $this->_callback($new_value, $field['before_save']);
				}

				if(is_array($new_value)){
					$new_value = json_encode($new_value);
				}

				if($new_value != '_destroy'){
					$this->model->{$field['name']} = $new_value;
					if(!empty($field['permalink'])){
						$this->model->{$field['permalink']} = $this->_permalink($field['permalink'], $new_value, $field['multi_language']);
					}
				}
			}
		}

		$do_save = true;
		if(!empty($rules) && !empty($input)){
			$validator  	= Validator::make($input, $rules);
			$do_save 		= !$validator->fails();
			$error 		 	= $validator->messages();
		}

		if($do_save){
			if(!empty($upload_files)){
				foreach ($upload_files as $uploaded) {
					$this->model->{$uploaded['name']} = $this->_do_upload($uploaded);
				}
			}

			$this->model->save();

			if($this->after_save){
				$this->_callback($this->model, $this->after_save);
			}

			\Alert::add('Adding data successfully.', 'success');
			$this->_redirect = $this->base_url;
		}else{
			$message = implode('<br />', $error->all());
			\Alert::add($message);
			$this->_redirect = \Request::fullUrl();
		}
	}

	private function _do_upload($uploaded){
		$file 		= $uploaded['uploaded'];
		$filename 	= str_replace(' ', '-', $file->getClientOriginalName());
		$file_path	= rtrim($uploaded['path'], '/')."/".$filename;
		$this->_image_option($uploaded['image_option']);

		if(!$uploaded['overwrite_file']){
			$i = 0;
			while (file_exists($file_path)) {
				$i++;
				$ext 	   = substr($filename, strrpos($filename, '.'));
				$filename  = preg_replace('/[^a-zA-Z0-9\']/', '_', substr($filename, 0, strrpos($filename, '.') + ($i>1 ? -1 : 0))).($i+1).$ext;
				$file_path = rtrim($uploaded['path'], '/')."/".$filename;
			}
		}
		$success 	= $file->move($uploaded['path'], $filename);

		if($success){
			if(!empty($uploaded['image_option'])){
				$option 	= $uploaded['image_option'];
				$img 		= Image::open($file_path);

				if($option['thumbnail']){
					if(!is_array($option['thumbnail'][0])){
						$opt 					= $option['thumbnail'];
						unset($option['thumbnail']);
						$option['thumbnail'][]  = $opt;
					}

					foreach ($option['thumbnail'] as $thumb_prop) {
						$thumb = Image::open($file_path)->thumbnail(new \Imagine\Image\Box($thumb_prop[0], $thumb_prop[1]));
						if(isset($thumb_prop[3]) && !empty($thumb_prop[3])){
							if(!is_array($thumb_prop[3]))
								$thumb_prop[3][] = $thumb_prop[3];

							foreach ($thumb_prop[3] as $filter) {
								$filter_prop = explode(":", strtolower($filter));
								switch($filter_prop[0]){
									case "colorize":
										$color = $img->palette()->color($filter_prop[1]);
										$thumb->effects()->colorize($color);
										break;
									case "blur":
										$thumb->effects()->blur($filter_prop[1]);
										break;
									case "negative":
										$thumb->effects()->negative();
										break;
									case "grayscale":
										$thumb->effects()->grayscale();
										break;
								}
							}
						}
						$thumb->save(rtrim($thumb_prop[2], '/').'/'.$filename);
					}
				}

				if($option['resize'] || !empty($option['filter'])){
					if($option['resize'])
						$img = Image::open($file_path)->thumbnail(new \Imagine\Image\Box($option['width'], $option['height']));

					if(!empty($option['filter'])){
						if(!is_array($option['filter']))
							$option['filter'] = (array)$option['filter'];

						foreach ($option['filter'] as $filter) {
							$filter_prop = explode(":", strtolower($filter));
							switch($filter_prop[0]){
								case "colorize":
									$color = $img->palette()->color($filter_prop[1]);
									$img->effects()->colorize($color);
									break;
								case "blur":
									$img->effects()->blur($filter_prop[1]);
									break;
								case "negative":
									$img->effects()->negative();
									break;
								case "grayscale":
									$img->effects()->grayscale();
									break;
							}
						}
					}
					$img->save($file_path);
				}
			}
			return $filename;
		}

		return '';
	}

	private function _callback($value, $method){
		if(!empty($method)){
			if(function_exists($method)){
				$value = call_user_func($method, $value);
			}elseif(method_exists($this, $method)){
				$value = call_user_func(array($this, $method), $value);
			}else{
				\Alert::add("Method ".$method." doesn\'t exists!", 'warning');
			}
		}

		return $value;
	}

	private function _create_script_toggle($field){
		$id = $field['name'];
		if(isset($field['property']['id'])){
			$id = $field['property']['id'];
		}

		$script  = "$('#$id').change(function(){";
		$script .= "var value = $(this).val();";
		$script  .= "$('.". implode(', .', array_values($field['toggle'])) ."').hide();";
		foreach ($field['toggle'] as $key => $group) {
			$script .= "if(value == $key){
							$('.$group').show();
						}
						";
		}
		$script .= "}).trigger('change');";
//	print($script);exit;
		JS::add_jquery($script);
	}

	private function _delete(){
		$id 		= \Input::get($this->table_id);
		$data 		= $this->model->where($this->table_id, '=', $id)->first();

		$do_delete 	= true;
		if($this->before_delete){
			$do_delete = $this->_callback($data, $this->before_delete);
		}

		if($do_delete !== FALSE){
			$img_field = $this->_config('delete_file');

			if(!empty($img_field)){
				foreach ((array)$img_field as $img) {
					$this->_delete_file($data->{$img}, $this->_config('delete_path'));
				}
			}

			$data->delete();
			\Alert::add('Delete data succeeded!', 'success');
            if($this->after_delete){
                $this->_callback($data, $this->after_delete);
            }
        }else{
			\Alert::add('Delete data failed!');
		}

		$this->_redirect = \URL::previous();
	}

	private function _multiple_delete(){
		$deleted_items 	= \Input::get('check_item');
		$data 			= $this->model->whereIn($this->table_id, $deleted_items)->get();
		$do_delete 		= true;
		if($this->before_multiple_delete){
			$do_delete = $this->_callback($data, $this->before_multiple_delete);
		}

		if($do_delete){
			$i = 0;
			foreach ($data as $item) {
				$img_field = $this->_config('delete_file');
				if(!empty($img_field)){
					foreach ((array)$img_field as $img) {
						$this->_delete_file($item->{$img}, $this->_config('delete_path'));
					}
				}
				$item->delete();
				$i++;
			}
            if($this->after_multiple_delete){
                $this->_callback($data, $this->after_multiple_delete);
            }
			\Alert::add('Delete '.$i.' data succeeded!', 'success');
		}else{
			\Alert::add('Delete data failed!');
		}

		$this->_redirect = \URL::previous();
	}

	private function _delete_file($filename, $folders){

		$folders = (array) $folders;
		foreach ($folders as $folder) {
			@unlink(rtrim($folder, '/')."/".$filename);
		}
	}

	private function _ajax_update(){
		$id 			= \Input::get($this->table_id);
		$field 			= \Input::get('field');
		$value 			= \Input::get('value');
		$before_update	= \Input::get('callback');
		$data 			= $this->model->where(array($this->table_id=>$id))->first();

		if(!empty($before_update)){
			$data = \Input::all();
			$this->_callback($data, $before_update);
		}

		$data->{$field} = $value;
		$data->save();

		echo 1;
		exit;
	}

	private function _image_option(&$option){
		$option['overwrite'] 	= false;
		$option['resize'] 		= isset($option['resize']) ? $option['resize'] : false;
		$option['filter'] 		= isset($option['filter']) ? $option['filter'] : null; //colorize:[hex_color_value], blur:[blur_value], gamma:[gamma_value], negative, grayscale
		$option['width'] 		= isset($option['width']) ? $option['width'] : null;
		$option['height'] 		= isset($option['height']) ? $option['height'] : null;
		$option['thumbnail'] 	= isset($option['thumbnail']) ? $option['thumbnail'] : array(); // array(width, height, folder, filters)
	}

	private function _set_default_list(&$field){
		$field['name']  				= isset($field['name']) ? $field['name'] : null;
		$field['title'] 				= isset($field['title']) ? $field['title'] : ucfirst(str_replace('_', ' ', $field['name']));
		$field['type']  				= isset($field['type']) ? $field['type'] : 'text';
		$field['search'] 				= isset($field['search']) ? $field['search'] : FALSE;
		$field['sort']					= isset($field['sort']) ? $field['sort'] : FALSE;
		$field['width']					= isset($field['width']) ? $field['width'] : null;
		$field['align']					= isset($field['align']) ? $field['align'] : null;
		$field['title_attributes'] 		= isset($field['title_attributes']) ? $field['title_attributes'] : array();
		$field['title_cell_attributes'] = isset($field['title_cell_attributes']) ? $field['title_cell_attributes'] : array();
		$field['cell_attributes'] 		= isset($field['cell_attributes']) ? $field['cell_attributes'] : array();
		$field['attributes']			= isset($field['attributes']) ? $field['attributes'] : array();
		$field['belongs_to']			= isset($field['belongs_to']) ? $field['belongs_to'] : array();
		$field['before_show']			= isset($field['before_show']) ? $field['before_show'] : null;
		$field['limit_text']			= isset($field['limit_text']) ? $field['limit_text'] : array();
		$field['combine']				= isset($field['combine']) ? $field['combine'] : array();
		$field['separator']				= isset($field['separator']) ? $field['separator'] : ' ';
		$field['prefix']				= isset($field['prefix']) ? $field['prefix'] : '';
		$field['sufix']					= isset($field['sufix']) ? $field['sufix'] : '';
		$field['format']				= isset($field['format']) ? $field['format'] : '';
		$field['custom_search']			= isset($field['custom_search']) ? $field['custom_search'] : '';
		$field['language']				= isset($field['language']) ? $field['language'] : false;

		if(!empty($field['width'])){
			$field['title_cell_attributes']['width'] = $field['width'];
		}
	}

	private function _set_default(&$field){
		$field['option'] 			= isset($field['option']) ? $field['option'] : array();
		$field['inline']			= isset($field['inline']) ? $field['inline'] : false;
		$field['value'] 			= isset($field['value']) ? $field['value'] : '';
		$field['property'] 			= isset($field['property']) ? $field['property'] : array();
		$field['label_property'] 	= isset($field['label_property']) ? $field['label_property'] : array();
		$field['label_width'] 		= isset($field['label_width']) ? $field['label_width'] : 3;
		$field['input_width'] 		= isset($field['input_width']) ? $field['input_width'] : 5;
		$field['type'] 				= isset($field['type']) ? $field['type'] : 'text';
		$field['overwrite_file'] 	= isset($field['overwrite_file']) ? $field['overwrite_file'] : false;
		$field['image_option'] 		= isset($field['image_option']) ? $field['image_option'] : array();
		$field['path'] 				= isset($field['path']) ? $field['path'] : '';
		$field['permalink'] 		= isset($field['permalink']) ? $field['permalink'] : null;
		$field['before_validation'] = isset($field['before_validation']) ? $field['before_validation'] : '';
		$field['before_save'] 		= isset($field['before_save']) ? $field['before_save'] : '';
		$field['after_save'] 		= isset($field['after_save']) ? $field['after_save'] : '';
		$field['group'] 			= isset($field['group']) ? $field['group'] : '';
		$field['toggle'] 			= isset($field['toggle']) ? $field['toggle'] : array();
		$field['suffix'] 			= isset($field['suffix']) ? $field['suffix'] : '';
		$field['value'] 			= isset($field['value']) ? $field['value'] : '';
		$field['addon_prefix'] 		= isset($field['addon_prefix']) ? $field['addon_prefix'] : null;
		$field['addon_suffix'] 		= isset($field['addon_suffix']) ? $field['addon_suffix'] : null;
		$field['always_empty']		= isset($field['always_empty']) ? $field['always_empty'] : false;
		$field['save_if_empty']		= isset($field['save_if_empty']) ? $field['save_if_empty'] : true;
		$field['multi_language']	= isset($field['multi_language']) ? $field['multi_language'] : false;
		$field['option_column']		= isset($field['option_column']) ? $field['option_column'] : 1;
		if($field['multi_language'] === true)
			$field['languages']		= \Config::get('others.supported_language');

		if($field['type'] != 'checkbox' && $field['type'] != 'radio' && $field['type'] != 'file' && $field['type'] != 'image'){
			if(isset($field['property']['class'])){
				$field['property']['class'] .= " form-control";
			}else{
				$field['property']['class']  = "form-control";
			}
		}

		if($field['type'] == 'datepicker'){
			$this->data['loadjqueryui'] = TRUE;
			$field['property']['class'] .= " datepicker";
		}elseif($field['type'] == 'tinymce'){
			$this->data['loadmce'] = TRUE;
			$field['property']['class'] .= " wysiwyg";
		}elseif($field['type'] == 'listtokenize'){
			$this->data['loadjquerytokenize'] = TRUE;
			$field['property']['class'] .= " tokenize";
			$field['property']['multiple'] = " true";
		}elseif($field['type'] == 'multiselect'){
			$this->data['loadjquerymultiselect'] = TRUE;
			$field['property']['class'] .= " multiselect";
			$field['property']['multiple'] = " true";
		}elseif($field['type'] == 'list'){
			$field['property']['multiple'] = " true";
		}
	}

	private function _limit_text($text, $limit, $suffix = '...'){
		$clean_text = strip_tags($text);
		$len 		= strlen($clean_text);
		if($len > $limit){
			$text = substr($clean_text, 0, $limit).$suffix;
		}

		return $text;
	}

	private function _format($format, $value){
		$format = explode('|', $format);
		$return = $value;

		switch ($format[0]) {
			case 'currency':
				if(isset($format[1])){
					$return = \Helper::currency($value, $format[1]);
				}else{
					$return = \Helper::currency($value);
				}
				break;
			case 'date':
				$return = date($format[1], strtotime($value));
				break;
		}

		return $return;
	}

	private function _permalink($field, $text, $multi_language, $edit_id = 0){
		if($multi_language === true)
			$text = \Helper::lang($text, \Config::get('app.locale'));

		$permalink = Str::slug($text);
		$slugCount = count( $this->model->where('id', '!=', $edit_id)->whereRaw("$field REGEXP '^{$permalink}(-[0-9]*)?$'")->get() );

    	return ($slugCount > 0) ? "{$permalink}-{$slugCount}" : $permalink;
	}

	public function _validate_first(){

		if($this->action != 'order'){
			if(empty($this->fields)){
				$this->data['content'] = 'Please set $fields variable.';
				return false;
			}
		}

		if(empty($this->model)){
			$this->data['content'] = 'Please set $model variable.';
			return false;
		}

		if(empty($this->base_url)){
			$this->data['content'] = 'Please specify $base_url variable.';
			return false;
		}

		return true;
	}

    public function build(){
        if($this->_validate_first()){
            $this->_default_button();

            if($this->_config('breadcrumb')){
                $this->add_breadcrumb($this->module_name, \URL::to($this->base_url));
            }

            switch($this->action){
                case 'add':
                    if($this->_config('breadcrumb')){
                        $this->add_breadcrumb('Add '.$this->module_name, '#');
                    }
                    $this->_create_add();
                    break;
                case 'edit':
                    if($this->_config('breadcrumb')){
                        $this->add_breadcrumb('Edit '.$this->module_name, '#');
                    }
                    $this->_create_edit();
                    break;
                case 'delete':
                    $this->_delete();
                    break;
                case 'multiple_delete':
                    $this->_multiple_delete();
                    break;
                case 'order':
                    if($this->_config('breadcrumb')){
                        $this->add_breadcrumb('Order '.$this->module_name, '#');
                    }
                    $this->_create_order();
                    break;
                case 'ajax_update':
                    $this->_ajax_update();
                    break;
                default:
                    $this->_create_list();
                    break;
            }

            if(!empty($this->_redirect))
                return \Redirect::to($this->_redirect)->withInput();
        }

        $this->data['base_url'] = $this->base_url;

        return $this->render_view('scaffold.view');
    }
}
