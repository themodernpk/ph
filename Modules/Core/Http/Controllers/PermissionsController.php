<?php
namespace Modules\Core\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Core\Entities\Module;
use Modules\Core\Entities\Permission;
use Modules\Core\Entities\User;

class PermissionsController extends Controller {
	public $data;

	function __construct( Request $request ) {
		$this->data        = new \stdClass();
		$this->data->view  = "core::backend.permissions.";
		$this->data->input = $request->all();
	}

	//------------------------------------------------------
	public function index() {
		$this->data->title = "Permissions";

		return view( $this->data->view . "index" )
			->with( "data", $this->data );
	}

	//------------------------------------------------------
	public function getList( Request $request ) {
		$list = Permission::withCount( [ 'roles' ] );
		if ( $request->has( "s" ) ) {
			$list->where( "name", "like", "%" . $request->get( 's' ) . "%" )
			     ->orWhere( "prefix", "like", "%" . $request->get( 's' ) . "%" );
		}
		$list->orderBy("created_at", 'desc');
		$data = $list->paginate( 2 );

		return response()->json( $data );
	}

	//------------------------------------------------------
	public function create() {
		return view( 'core::create' );
	}

	//------------------------------------------------------
	public function store( Request $request ) {


	}

	//------------------------------------------------------
	public function edit() {
		return view( 'core::edit' );
	}

	//------------------------------------------------------
	public function update( Request $request ) {
	}

	//------------------------------------------------------
	public function destroy() {
	}

	//------------------------------------------------------
	public function toggle( Request $request ) {
		if ( ! \Auth::user()->hasPermission( "core", "backend-admin-permission-update" ) ) {
			$response['status']   = 'failed';
			$response['errors'][] = getConstant( 'permission.denied' );

			return response()->json( $response );
		}
		$input = $request->all();
		try {
			$permission = Permission::findOrFail( $input['id'] );
			if ( $request->has( "enable" ) ) {
				$permission->enable = $request->get( "enable" );
			} else {
				if ( $permission->enable == 1 ) {
					$permission->enable = 0;
				} else {
					$permission->enable = 1;
				}
			}
			$permission->save();
			$response['status'] = 'success';
			$response['data']   = $permission;
		} catch ( Exception $e ) {
			$response['status']   = 'failed';
			$response['errors'][] = $e->getMessage();
		}

		return response()->json( $response );
	}
	//------------------------------------------------------
	public function read(Request $request, $id)
	{
		try{
			$this->data->item = Permission::with(['roles', 'createdBy',
				'updatedBy', 'deletedBy'])->findOrFail($id);

			return view( $this->data->view . "item" )
				->with( "data", $this->data );
		}catch(Exception $e)
		{
		    $response['status'] = 'failed';
		    $response['errors'][] = $e->getMessage();
		    return response()->json($response);
		}





	}
	//------------------------------------------------------
}
