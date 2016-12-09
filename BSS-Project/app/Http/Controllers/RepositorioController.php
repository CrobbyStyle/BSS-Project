<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Http\Request;
use App\Events\HelloPusherEvent;
use PushNotification;
use App\bssConfig\firebase;
use App\bssConfig\push;

class RepositorioController extends Controller
{
	public $restful = true;	

    public function index(){
        return view('test');
    }

	public function pushAlert(Request $request){
        $message= $request->input('chat_text');

        $current = file_get_contents("../storage/app/bss-storage/datos.txt");
        $current .= $message."\n";
        file_put_contents("../storage/app/bss-storage/datos.txt", $current);

		event(new HelloPusherEvent($message));

        error_reporting(-1);
        ini_set('display_errors', 'On');
 
        $firebase = new Firebase();
        $push = new Push();
  
        $payload = array();
        $payload['team'] = 'India';
        $payload['score'] = '5.6';
        // notification title
        $title = 'BSS: Alerta de Prueba para materia integradora';
         
        // notification message
        $message = 'Se aconseja tomar un receso';
         
        // push type - single user / topic
        $push_type = 'topic';
 
 
        $push->setTitle($title);
        $push->setMessage($message);
        $push->setIsBackground(FALSE);
        $push->setPayload($payload);
 
 
        $json = '';
        $response = '';
        error_log("A ENVIAR PUSH");
        if ($push_type == 'topic') {
            $json = $push->getPush();
            $response = $firebase->sendToTopic('global', $json);
            error_log("ENVIANDO");
            error_log(json_encode($json));
        }
        
    }

}