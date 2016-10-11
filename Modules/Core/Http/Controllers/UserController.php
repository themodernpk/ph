<?php

namespace Modules\Core\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;


use Modules\Core\Entities\User;
use Validator;


class UserController extends Controller
{
	public $data;

	function __construct()
	{
		$this->data = new \stdClass();
	}


	//--------------------------------------------------------
    public function index()
    {
	    $this->data->body_class= "animsition page-login-v3 layout-full";
	    return view('core::frontend.login')->with('data', $this->data);
    }
	//--------------------------------------------------------
	public function register()
	{
		$this->data->body_class= "animsition page-login-v3 layout-full";
		return view('core::frontend.register')->with('data', $this->data);
	}
	//--------------------------------------------------------
	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), User::rulesAdminCreate());

		if ($validator->fails()) {

			if($request->ajax())
			{
				$errors = $validator->errors();
				$response['status'] = 'failed';
				$response['errors'] = $errors;
				return response()->json($response);
			} else
			{
				return \Redirect::back()
				                ->withErrors($validator)
				                ->withInput();
			}
		}


	}
	//--------------------------------------------------------
	//--------------------------------------------------------
	//--------------------------------------------------------
	//--------------------------------------------------------

}
