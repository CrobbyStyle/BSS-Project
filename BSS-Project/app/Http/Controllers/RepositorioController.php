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
use App\Lugar as Lugar;
use App\Vector as Vector;
use DB;
use DateTime;

class RepositorioController extends Controller
{
	public $restful = true;	

    public function index(){
        return view('test');
    }

    //Para la ventana de pusher en la aplicacion web
	public function pushAlert(Request $request){
        date_default_timezone_set('America/Bogota');
        setlocale(LC_TIME,'es_ES');

        $message= $request->input('chat_text');
        
        $current = file_get_contents(app_path()."/bssStorage/datos.txt");
        $current .= $message."\n";
        file_put_contents(app_path()."/bssStorage/datos.txt", $current);

		event(new HelloPusherEvent($message));

        $today = new DateTime('now');

        $listSubstr = explode(",", $message);
        $val1 = intval($listSubstr[0]);
        $val2 = intval($listSubstr[1]);
        $val3 = intval($listSubstr[2]);
        $val4 = intval($listSubstr[3]);


        try{
            Vector::insert(array(
                "temperatura"=> $val1,
                "humedad"=> $val2,
                "ruido" => $val3,
                "voz" => $val4,
                "fecha" => $today,
                "lugar_id" => 1
            ));
            error_log("hola2");

        }catch (\Exception $e) {
            error_log($e);
        }
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
                        // error_reporting(-1);
                        // ini_set('display_errors', 'On');
                 
                        // $firebase = new Firebase();
                        // $push = new Push();
                  
                        // $payload = array();
                        // $payload['Message'] = 'Breaktime!';
                        // //$payload['score'] = '9.9';
                        // $title = 'BSS: Alerta de Prueba para materia integradora';
                        // $message = 'Se aconseja tomar un receso';
                        // $push_type = 'topic';
                 
                 
                        // $push->setTitle($title);
                        // $push->setMessage($message);
                        // $push->setIsBackground(FALSE);
                        // $push->setPayload($payload);
                 
                        // $json = '';
                        // $response = '';
                        // error_log("A ENVIAR PUSH");
                        // if ($push_type == 'topic') {
                        //     $json = $push->getPush();
                        //     $response = $firebase->sendToTopic('global', $json);
                        //     error_log("ENVIANDO");
                        //     error_log(json_encode($json));
                        // }

                        $url = 'https://fcm.googleapis.com/fcm/send';

                        $fields = array(
                                'to' => "/topics/global",
                                'data' => array(
                                        "keyname" => "Hello"
                                ),
                                'notification' => array(
                                    'title' => 'hello',
                                    'text' => 'this is text',
                                )
                        );
                        $fields = json_encode ( $fields );

                        $headers = array(
                                'Authorization: key=' . "AIzaSyBFyZnF_tp0co4VE8utiFiItYOi78vPJgQ",
                                'Content-Type: application/json'
                        );

                        $ch = curl_init ();
                        curl_setopt ( $ch, CURLOPT_URL, $url );
                        curl_setopt ( $ch, CURLOPT_POST, true );
                        curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
                        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
                        curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );

                        $result = curl_exec ( $ch );
                        error_log($result);
                        curl_close ( $ch );

                    }

                }

            }

        }
        

    }

    //Para mandar pusher events desde la vista
    public function pushReceive(Request $request){

        date_default_timezone_set('America/Bogota');
        setlocale(LC_TIME,'es_ES');
        
        // $current = file_get_contents(app_path()."/bssStorage/datos.txt");
        // $current .= $message."\n";
        // file_put_contents(app_path()."/bssStorage/datos.txt", $current);

        $val1 = $request->valorTemp;
        $val2 = $request->valorHumi;
        $val3 = $request->valorNois;
        $val4 = $request->valorVoic;

        try{
            Vector::insert(array(
                "temperatura"=> $val1,
                "humedad"=> $val2,
                "ruido" => $val3,
                "voz" => $val4,
                "fecha" => $today,
                "lugar_id" => 1
            ));
            error_log("hola2");

        }catch (\Exception $e) {
            error_log($e);
        }

        $configValues = file_get_contents(app_path()."/bssStorage/config.txt");
        $listaValores = explode(",", $configValues);
        $valTemp = intval($listaValores[0]);
        $valHumi = intval($listaValores[1]);
        $valNois = intval($listaValores[2]);
        $valVoic = intval($listaValores[3]);
        $valClock = intval($listaValores[4]);

        error_log("Valores del sensor");
        error_log($val1);
        error_log($val2);
        error_log($val3);
        error_log($val4);

        error_log("Valores Limite");
        error_log($valTemp);
        error_log($valHumi);
        error_log($valNois);
        error_log($valVoic);

        if($val1>$valTemp){
            if($val2>$valHumi){
                if($val3>$valNois){
                    if($val4>$valVoic){
                        // error_reporting(-1);
                        // ini_set('display_errors', 'On');
                 
                        // $firebase = new Firebase();
                        // $push = new Push();
                  
                        // $payload = array();
                        // $payload['Message'] = 'Breaktime!';
                        // //$payload['score'] = '9.9';
                        // $title = 'BSS: Alerta de Prueba para materia integradora';
                        // $message = 'Se aconseja tomar un receso';
                        // $push_type = 'topic';
                 
                 
                        // $push->setTitle($title);
                        // $push->setMessage($message);
                        // $push->setIsBackground(FALSE);
                        // $push->setPayload($payload);
                 
                        // $json = '';
                        // $response = '';
                        // error_log("A ENVIAR PUSH");
                        // if ($push_type == 'topic') {
                        //     $json = $push->getPush();
                        //     $response = $firebase->sendToTopic('global', $json);
                        //     error_log("ENVIANDO");
                        //     error_log(json_encode($json));
                        // }

                        $url = 'https://fcm.googleapis.com/fcm/send';

                        $fields = array(
                                'to' => "/topics/global",
                                'data' => array(
                                        "keyname" => "Hello"
                                ),
                                'notification' => array(
                                    'title' => 'hello',
                                    'text' => 'this is text',
                                )
                        );
                        $fields = json_encode ( $fields );

                        $headers = array(
                                'Authorization: key=' . "AIzaSyBFyZnF_tp0co4VE8utiFiItYOi78vPJgQ",
                                'Content-Type: application/json'
                        );

                        $ch = curl_init ();
                        curl_setopt ( $ch, CURLOPT_URL, $url );
                        curl_setopt ( $ch, CURLOPT_POST, true );
                        curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
                        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
                        curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );

                        $result = curl_exec ( $ch );
                        error_log($result);
                        curl_close ( $ch );

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

        /*try{
            Lugar::insert(array(
                "nombre"=> "Sala",
                "descripcion"=> "Esta es la sala"
            ));

        }catch (\Exception $e) {
            error_log($e);
        }*/
        return view('admin')->with($args);
    }

}