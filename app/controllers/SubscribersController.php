<?php

class SubscribersController extends \BaseController {

	public function getIndex(){
		
		return View::make('subscribe_form');
	}

	public function postSubmit() {
		//we check if it's really an AJAX request
		if(Request::ajax()) {
			$validation = Validator::make(Input::all(), array(
				'email' => 'required|email|unique:subscribers,email'
			));

			if($validation->fails()) {
				return $validation->errors()->first();
			} else {
				$create = Subscribers::create(array(
					'email' => Input::get('email')
				));

				return $create?'1':'We could not save your address to our system, please try again later';
			}
		} else {
			return Redirect::to('subscribers');
		}
	}

}
