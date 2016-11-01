<?php
namespace Modules\Core\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Core\Entities\Role;

class RolesController extends Controller {
	//------------------------------------------------------
	public $data;

	function __construct( Request $request ) {
		$this->data                      = new \stdClass();
		$this->data->view                = "core::backend.roles.";
		$this->data->route               = "core.backend.roles";
		$this->data->permission          = new \stdClass();
		$this->data->permission->prefix  = "core";
		$this->data->permission->pretext = "backend-admin-role-";
		$this->data->input               = $request->all();
	}

	//------------------------------------------------------
	public function index() {
		$this->data->title = "Roles";

		return view( $this->data->view . "index" )
			->with( "data", $this->data );
	}

	//------------------------------------------------------
	public function getList( Request $request ) {
		$list = Role::withCount( [ 'users', 'permissions' ] );
		if ( $request->has( "s" ) ) {
			$list->where( "name", "like", "%" . $request->get( 's' ) . "%" );
			$list->withTrashed();
		} elseif ( $request->has( "trashed" ) && $request->get( "trashed" ) == 1 ) {
			$list->withTrashed();
		}
		$list->orderBy( "created_at", 'desc' );
		$config             = \Config::get( "core" );
		$data['list']       = $list->paginate( $config['settings']->records_per_page );
		$data['trashCount'] = Role::onlyTrashed()->count();

		return response()->json( $data );
	}

	//------------------------------------------------------
	public function toggle( Request $request ) {
		if ( ! \Auth::user()->hasPermission( $this->data->permission->prefix,
			$this->data->permission->pretext . "update" )
		) {
			$response['status']   = 'failed';
			$response['errors'][] = getConstant( 'permission.denied' );

			return response()->json( $response );
		}
		$rules     = array(
			'id' => 'required',
		);
		$validator = \Validator::make( (array) $this->data->input, $rules );
		if ( $validator->fails() ) {
			$errors             = $validator->errors();
			$response['status'] = 'failed';
			$response['errors'] = $errors;

			return response()->json( $response );
		}
		$input = $request->all();
		try {
			$item = Role::withTrashed()->findOrFail( $input['id'] );
			if ( $request->has( "enable" ) ) {
				$item->enable = $request->get( "enable" );
			} else {
				if ( $item->enable == 1 ) {
					$item->enable = 0;
				} else {
					$item->enable = 1;
				}
			}
			$item->save();
			$response['status'] = 'success';
			$response['data']   = $item;
		} catch ( Exception $e ) {
			$response['status']   = 'failed';
			$response['errors'][] = $e->getMessage();
		}

		return response()->json( $response );
	}

	//------------------------------------------------------
	public function create() {
		return view( 'core::create' );
	}

	//------------------------------------------------------
	public function store( Request $request ) {
		$rules     = array(
			'name' => 'required|max:50',
		);
		$validator = \Validator::make( (array) $this->data->input, $rules );
		if ( $validator->fails() ) {
			$errors             = $validator->errors();
			$response['status'] = 'failed';
			$response['errors'] = $errors;

			return response()->json( $response );
		}
		$item       = new Role();
		$item->name = $request->get( 'name' );
		if ( $request->has( 'details' ) ) {
			$item->details = $request->get( 'name' );
		}
		if ( $request->has( 'enable' ) ) {
			$item->enable = $request->get( 'enable' );
		}
		try {
			$item->save();
			$response['status'] = 'success';
		} catch ( Exception $e ) {
			$response['status']   = 'failed';
			$response['errors'][] = $e->getMessage();
		}

		return response()->json( $response );
	}

	//------------------------------------------------------
	public function read( Request $request, $id ) {
		if ( ! \Auth::user()->hasPermission( $this->data->permission->prefix,
			$this->data->permission->pretext . "read" )
		) {
			return redirect()->route( $this->data->route )
			                 ->withErrors( [ getConstant( 'permission.denied' ) ] );
		}
		$this->data->item  = Role::with( [
			'createdBy',
			'updatedBy',
			'deletedBy'
		] )->findOrFail( $id );
		$this->data->title = $this->data->item->name;

		return view( $this->data->view . "item" )
			->with( "data", $this->data );
	}

	//------------------------------------------------------
	public function edit() {
		return view( 'core::edit' );
	}

	//------------------------------------------------------
	public function update( Request $request ) {
	}

	//------------------------------------------------------
	public function delete( Request $request, $id ) {
		$item = Role::withTrashed()->findOrFail( $id );
		try {
			$item->delete();
			$response['status'] = 'success';
		} catch ( Exception $e ) {
			$response['status']   = 'failed';
			$response['errors'][] = $e->getMessage();
		}

		return response()->json( $response );
	}

	//------------------------------------------------------
	public function restore( Request $request, $id ) {
		$item = Role::withTrashed()->findOrFail( $id );
		try {
			$item->restore();
			$response['status'] = 'success';
		} catch ( Exception $e ) {
			$response['status']   = 'failed';
			$response['errors'][] = $e->getMessage();
		}

		return response()->json( $response );
	}

	//------------------------------------------------------
	public function deletePermanent( $id ) {
		$item = Role::withTrashed()->findOrFail( $id );
		try {
			$item->permissions()->detach();
			$item->users()->detach();
			$item->forceDelete();
			$response['status'] = 'success';
		} catch ( Exception $e ) {
			$response['status']   = 'failed';
			$response['errors'][] = $e->getMessage();
		}

		return response()->json( $response );
	}
	//------------------------------------------------------
}
