<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 6/23/2015
 * Time: 2:04 PM
 */
namespace sccbakery\Admin\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;
use sccbakery\Admin\Models\NewsletterModel;

class Newsletter extends ScaffoldController {
    function __construct(){
        parent::__construct();
        $this->data['page_title'] = "Contact Message";
        $this->model 		= New NewsletterModel;
    }

    public function index(){
        $this->module_name 	= 'Contact Message';
        $this->base_url 	= '_admin/contact_message';
        $this->set('action',FALSE);
        $this->set('multiple_delete',FALSE);
        $this->remove_button('add');

        $this->add_button('export_excel', URL::to('_admin/newsletter?act=export_excel&'.http_build_query(Input::except('act'))), $text = "<i class='glyphicon glyphicon-share'></i> Export to Excel", ['class'=>'btn btn-success']);

        switch($this->action){
            case "export_excel":
                return $this->_export_excel();
                break;
            default:
                $this->data['sub_title'] = "List ".$this->module_name;
                $this->_default();
                break;
        }

        return $this->build();
    }

    private function _default(){
        $this->fields = [
            [
                'name'=>'email',		//-- Field dari database
                'title'=>'Email',		//-- Nama header Field di View
                'search'=>'text',
                'sort'=>TRUE,
            ],
            [
                'name'=>'created_at',
                'title'=>'Created At',
                'sort'=> TRUE,
                'search'=>'text',
            ],
        ];
    }

    private function _export_excel(){
        $this->data['newsletters'] = NewsletterModel::orderBy('email', 'asc')->get();

        $content    = $this->render_view('excel.newsletter', $this->data);
        $myName     = "sccbakery-newsletter.xls";
        $headers    = ['Content-type'=>'application/vnd-ms-excel', 'Content-Disposition'=>sprintf('attachment; filename="%s"', $myName)];
        return Response::make($content, 200, $headers);
    }
}