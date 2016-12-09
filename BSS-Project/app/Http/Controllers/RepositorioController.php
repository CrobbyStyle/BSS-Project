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

        $current = file_get_contents(app_path()."/bssStorage/datos.txt");
        $current .= $message."\n";
        file_put_contents(app_path()."/bssStorage/datos.txt", $current);

		event(new HelloPusherEvent($message));

        $listSubstr = explode(",", $message);
        $val1 = intval($listSubstr[0]);
        $val2 = intval($listSubstr[1]);
        $val3 = intval($listSubstr[2]);
        $val4 = intval($listSubstr[3]);

        if($val1>69){
            if($val2>69){
                if($val3>69){
                    if($val4>69){
                        error_reporting(-1);
                        ini_set('display_errors', 'On');
                 
                        $firebase = new Firebase();
                        $push = new Push();
                  
                        $payload = array();
                        $payload['team'] = 'Ecuador';
                        $payload['score'] = '9.9';
                        $title = 'BSS: Alerta de Prueba para materia integradora';
                        $message = 'Se aconseja tomar un receso';
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

            }

        }
        

    }

}