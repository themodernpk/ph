<?php

namespace Modules\Core\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

use Modules\Core\Events\UserLoggedIn;


class AuthController extends Controller
{
	public $data;

	function __construct()
	{
		$this->data = new \stdClass();
	}
	//--------------------------------------------------------
    public function login(Request $request )
    {

    	$rules = array(
    	    'email' => 'required|email',
    	    'password' => 'required',
    	);

	    $validator = \Validator::make( $request->all(), $rules);
    	if ( $validator->fails() ) {
    	    if ( $request->ajax() ) {
    	        $errors             = $validator->errors();
    	        $response['status'] = 'failed';
    	        $response['errors'] = $errors;

    	        return response()->json( $response );
    	    } else {
    	        return \Redirect::back()
    	                        ->withErrors( $validator )
    	                        ->withInput();
    	    }
    	}
	    $remember = false;

	    if($request->get("remember") == "on")
	    {
		    $remember = true;
	    }


	    $redirect = $request->input('redirect_url', \URL::route('core.backend.dashboard'));

	    if (Auth::attempt([
	    	'email' => $request->get('email'),
		    'password' => $request->get('password'
		    )], $remember
		    ))
	    {


	    	if(!Auth::user()->hasPermission('core', 'backend-login'))
		    {
			    $response['status'] = 'failed';
			    $response['errors'][] = getConstant('permission.denied');
		    } else
		    {
		    	//fire the event
			    event(new UserLoggedIn(Auth::user()));

			    $response['status'] = 'success';
			    $response['data'] = Auth::user();
			    $response['redirect'] = $redirect;
		    }

		    die("<hr/>line number=123");

	    } else
	    {
		    $response['status'] = 'failed';
		    $response['errors'][] = getConstant('credentials.invalid');
	    }


	    if ( $request->ajax() )
	    {
		    return response()->json( $response );
	    } else {
		    if($response['status'] == 'failed')
		    {
			    $return =  back()->withErrors($response['errors']);
		    }  else
		    {
			    $return =  redirect($response['redirect']);
		    }

		    return $return;
	    }

    }
	//--------------------------------------------------------
	public function logout(Request $request )
	{
		Auth::logout();
		$redirect = $request->input('redirect_url', \URL::route('core.frontend.login'));
		$response['status'] = 'success';
		$response['redirect'] = $redirect;
		if ( $request->ajax() )
		{
			return response()->json( $response );
		} else {
			$request->session()->flash('flash_success', getConstant('core.backend.logout'));
			$return =  redirect($response['redirect']);
			return $return;
		}
	}
	//--------------------------------------------------------
	//--------------------------------------------------------
	//--------------------------------------------------------
	//--------------------------------------------------------

}
