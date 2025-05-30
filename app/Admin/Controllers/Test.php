<?php 
namespace sccbakery\Admin\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use sccbakery\Admin\Controllers\ScaffoldController;
use sccbakery\Admin\Models\ContactAddressModel;

class Test extends ScaffoldController
{
	function __construct(){
		parent::__construct();
		$this->beforeFilter('auth');
		$this->data['page_title'] = "Contact";
        $this->model 		= New ContactAddressModel;
	}

	public function index(){
//        echo sha1("sccbakery");
        echo Crypt::encrypt(Auth::user()->id);
        exit;
//		$act = \Input::get('act');
//		if($act == 'country'){
//			$countries = Country_model::where('id','!=', 'ID');
//			foreach ($countries as $country) {
//				$province = new Province_model;
//				$province->country_id = $country->id;
//				$province->name = 'N/A';
//				$province->save();
//
//				$city = new City_model;
//				$city->province_id = $province->id;
//				$city->name = 'N/A';
//				$city->save();
//			}
//
//		}else
//			echo "<form action='".\URL::to('_admin/product_image?act=upload&id=6')."' method='POST' enctype='multipart/form-data'><input type='file' name='Filedata' /><input type='submit'></form>";

		 $this->module_name 	= 'Test';
        	$this->base_url 	= '_admin/test';
//        	$this->remove_button('add');
//        	$this->setup_list(array('action'=>FALSE, 'multiple_delete'=>FALSE));

        	switch($this->action){
        		case "edit":
        			$this->data['sub_title'] = "Edit ".$this->module_name;
        			$this->_edit();
        		break;
        		case "add":
        			$this->data['sub_title'] = "Add ".$this->module_name;
        			$this->_add();
        		break;
        		default:
        			$this->data['sub_title'] = "List ".$this->module_name;
        			$this->_default();
        		break;
        	}

        	return $this->build();
    }

    private function _default(){
    	$this->order_by 	= array('created_at'=>'desc');
    	$this->fields = [
			    			[
			    				'name'=>'name',
			    				'title'=>'Name',
			    				'sort'=> TRUE,
			    				'search'=> 'text'
			    			],
			    			[
			    				'name'=>'email',
			    				'title'=>'Email',
			    				'sort'=> TRUE,
			    				'search'=> 'text'
			    			],
			    			[
			    				'name'=>'subject',
			    				'title'=>'Subject',
			    				'sort'=> TRUE,
			    				'search'=> 'text'
			    			],
			    			[
			    				'name'=>'message',
			    				'title'=>'Message',
			    				'sort'=> TRUE,
			    				'search'=> 'text'
			    			],
			    			[
			    				'name'=>'created_at',
			    				'title'=>'Created At',
			    				'sort'=> TRUE
			    			]
			    		];
    }

    private function _add(){
    	$this->fields 	= [
			    			[
			    				'name'=>'name',
			    				'label'=>'Name'
			    			],
			    			[
			    				'name'=>'email',
			    				'label'=>'Image',
			    				'type'=>'image',
			    				'path'=>'assets/uploads/test/',
			    				'image_option'=>[
			    									'resize'=>true,
			    									'width'=>1600,
			    									'height'=>1600,
			    									'filter'=>'blur:3',
			    									'thumbnail'=> array(150, 150, 'assets/uploads/test/50/', 'negative')
			    								]
			    			]
			    		];
    }
}