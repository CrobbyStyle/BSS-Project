<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use App\Events\HelloPusherEvent;
use PushNotification;

class RepositorioController extends Controller
{
	public $restful = true;	

	public function pushAlert(){

		$deviceToken = '2dfafFMVSP84eAvg:APadf21bEiWPOBVkcyMBsaSiyXXbhqaV22DatihS0D1irxUmek0_Vh81H8DGjkr80y25dA212AdfDFeHkl@lijhiCLa8V9NgTP-x7f3nXnQaolhKeuNMJ2cXg2_0';

        $message = 'We have successfully sent a push notification!';

        // Send the notification to the device with a token of $deviceToken
        $collection = PushNotification::app('appNameAndroid')
            ->to($deviceToken)
            ->send($message);

		event(new HelloPusherEvent("25,23,30,40"));
    	return view('test');
    }

}