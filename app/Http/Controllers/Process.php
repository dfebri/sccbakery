<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 6/29/2015
 * Time: 12:52 PM
 */
namespace sccbakery\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use sccbakery\ContactMessageModel;
use sccbakery\Http\Controllers\Controller;
use sccbakery\NewsletterModel;
use sccbakery\Systems\Controllers\Systems;

class Process extends Controller {
    public function do_subscribe(){
        $json['class']		= "error";
        $data['email']		= Input::get('email');
        $rules		= array(
            'email'=>'required|email|unique:newsletter,email',
        );
        $validation	= Validator::make($data, $rules);

        if($validation->fails()){
            $json['message']		= $validation->messages();
        }else{
            NewsletterModel::insert($data);
            $json['class']			= "success";
            $json['message']		= "Thank You we will reply you soon!";
        }
        echo json_encode($json);
    }

    public function sendMessage() {

        $validator = Validator::make(
            array('email' => Input::get('email'), 'name'=> Input::get('name'), 'subject'=>Input::get('subject'), 'message'=>Input::get('message')),
            array('email' => 'required|email', 'name'=>'required', 'subject'=>'required', 'message'=>'required|min:25')
        );
        $auth = Input::get('auth');

        if($validator->fails()){
            return Response::json(array('error'=>true, 'message'=>$validator->messages()->first()));
        }else{
            if($auth == ''){
                $contact 			= new ContactMessageModel;
                $contact->name		= Input::get('name');
                $contact->email		= Input::get('email');
                $contact->subject	= Input::get('subject');
                $contact->message	= Input::get('message');

                $contact->save();

                $data               = $contact->toArray();
                $data['title']      = 'New Contact Message | SCC Bakery';
                $data['created_at'] = $contact->created_at->format('D, d M Y H:i:s');
                unset($data['message']);
                $data['content']    = $contact->message;

                $email  = Systems::get('front', 'no_reply_email');
                \Mail::send('emails.contact', $data, function ($message) use ($email)
                {
                    $message->subject('New Contact Message');
                    $message->to($email);
                });

            }
            return Response::json(array('error'=>false, 'message'=>"Hai ".Input::get('name')." thanks for contact us, we will reply you soon"));
        }
    }
}
