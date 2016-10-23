<?php

namespace Modules\Core\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Core\Entities\Permission;

class PermissionsController extends Controller
{

	public $data;

	function __construct(Request $request)
	{
		$this->data = new \stdClass();
		$this->data->view = "core::backend.permissions.";
		$this->data->input = $request->all();
	}
	//------------------------------------------------------
    public function index()
    {
    	$this->data->title = "Permissions";
        return view($this->data->view."index")
	        ->with("data", $this->data);
    }

    //------------------------------------------------------

	public function getList(Request $request)
	{
		$list = Permission::paginate(1);
		return response()->json($list);
	}
	//------------------------------------------------------


    public function create()
    {
        return view('core::create');
    }

	//------------------------------------------------------
    public function store(Request $request)
    {
    }

	//------------------------------------------------------
    public function edit()
    {
        return view('core::edit');
    }

	//------------------------------------------------------
    public function update(Request $request)
    {
    }

	//------------------------------------------------------
    public function destroy()
    {
    }
}
