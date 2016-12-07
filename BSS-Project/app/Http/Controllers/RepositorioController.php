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
		PushNotification::app('appNameAndroid')
		                ->to(PushNotification::Device('token', array('badge' => 1)))
		                ->send('Hello World, i`m a push message');

		event(new HelloPusherEvent("25,23,30,40"));
    	return view('test');
    }

}