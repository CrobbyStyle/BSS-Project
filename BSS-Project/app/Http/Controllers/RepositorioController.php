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

        $configValues = file_get_contents(app_path()."/bssStorage/config.txt");
        $listaValores = explode(",", $configValues);
        $valTemp = intval($listaValores[0]);
        $valHumi = intval($listaValores[1]);
        $valNois = intval($listaValores[2]);
        $valVoic = intval($listaValores[3]);
        $valClock = intval($listaValores[4]);

        if($val1>$valTemp){
            if($val2>$valHumi){
                if($val3>$valNois){
                    if($val4>$valVoic){
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

    public function guardarConfig(Request $request){
        $valorTemp=$request->valorTemp;
        $valorHumi = $request->valorHumi;
        $valorNois=$request->valorNois;
        $valorVoic = $request->valorVoic;
        $valorClock=$request->valorClock;

        $message = $valorTemp.",".$valorHumi.",".$valorNois.",".$valorVoic.",".$valorClock. "\n";
        file_put_contents(app_path()."/bssStorage/config.txt", $message);

        error_log($message);
    }

    public function mostrarAdmin(){
        $current = file_get_contents(app_path()."/bssStorage/config.txt");
        $listSubstr = explode(",", $current);
        $val1 = intval($listSubstr[0]);
        $val2 = intval($listSubstr[1]);
        $val3 = intval($listSubstr[2]);
        $val4 = intval($listSubstr[3]);
        $val5 = intval($listSubstr[4]);
        $args = array(
                    'valTemp'=> $val1,
                    'valHumi'=> $val2,
                    'valNois'=> $val3,
                    'valVoic'=> $val4,
                    'valClock'=> $val5,
                    );
        return view('admin')->with($args);
    }

}