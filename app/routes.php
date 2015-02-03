<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

Route::controller('subscribers','SubscribersController');

Route::get('queue/process',function(){
	Queue::push('SendEmail');
	return 'Queue Processed Successfully!';
});

Route::post('queue/post',function(){
	return Queue::marshall();
});

class SendEmail{

	public function fire($job,$data){

		$subscribers = Subscribers::all();

		foreach($subscribers as $each){
			Mail::send('emails.test',
				array('email'=>$each->email),function($message){
					$message->from('hector.rz11@gmail.com','Our Name');
					$message->to($each->email);
				}
			);
		}
		$job->delete();
	}
}