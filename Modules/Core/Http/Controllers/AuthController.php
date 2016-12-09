<?php
namespace Modules\Core\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;


use Modules\Core\Entities\User;

class AuthController extends Controller
{
    public $data;

    function __construct()
    {
        $this->data = new \stdClass();
    }

    //--------------------------------------------------------
    public function login(Request $request)
    {
        $response = User::login($request);
        if ($request->ajax()) {
            return response()->json($response);
        } else {
            if ($response['status'] == 'failed') {
                $return = back()->withErrors($response['errors']);
            } else {
                $return = redirect($response['redirect']);
            }
            return $return;
        }
    }

    //--------------------------------------------------------
    public function logout(Request $request)
    {
        Auth::logout();
        $redirect = $request->input('redirect_url', \URL::route('core.frontend.login'));
        $response['status'] = 'success';
        $response['redirect'] = $redirect;
        if ($request->ajax()) {
            return response()->json($response);
        } else {
            $request->session()->flash('flash_success', getConstant('core.backend.logout'));
            $return = redirect($response['redirect']);
            return $return;
        }
    }
    //--------------------------------------------------------
    //--------------------------------------------------------
    //--------------------------------------------------------
    //--------------------------------------------------------
}
