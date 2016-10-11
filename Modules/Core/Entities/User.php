<?php

namespace Modules\Core\Entities;

use Illuminate\Notifications\Notifiable;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;




class User extends Authenticatable
{
	use Notifiable;
	use SoftDeletes;

	//-------------------------------------------------
	protected $table = 'core_users';
	//-------------------------------------------------
	protected $dates = [
		'birth_date', 'activated_at', 'last_login',
		'created_at', 'updated_at', 'deleted_at'
	];
	//-------------------------------------------------
	protected $dateFormat = 'Y-m-d H:i:s';
	//-------------------------------------------------

	protected $fillable = [
		'name', 'email', 'password', 'username', 'mobile', 'country_calling_code',
		'gender', 'birth_date', 'enable', 'activation_code', 'activated_at',
		'last_login', 'last_login_ip', 'created_by', 'updated_by', 'deleted_by'
	];
	//-------------------------------------------------
	protected $hidden = [
		'password', 'remember_token',
	];
	//-------------------------------------------------
	public function scopeEnabled($query)
	{
		return $query->where('enable', 1);
	}

	//-------------------------------------------------
	public function scopeDisabled($query)
	{
		return $query->where('enable', 0);
	}
	//-------------------------------------------------
	public function scopeUsername($query, $username)
	{
		return $query->where('username', $username);
	}
	//-------------------------------------------------
	public function scopeEmail($query, $email)
	{
		return $query->where('email', $email);
	}
	//-------------------------------------------------
	public function scopeMobile($query, $mobile)
	{
		return $query->where('mobile', $mobile);
	}
	//-------------------------------------------------
	public function scopeActivatedBetween($query, $from, $to)
	{
		return $query->whereBetween('activated_at', array($from, $to));
	}
	//-------------------------------------------------
	public function scopeCreatedBy($query, $user_id)
	{
		return $query->where('created_by', $user_id);
	}
	//-------------------------------------------------
	public function scopeUpdatedBy($query, $user_id)
	{
		return $query->where('updated_by', $user_id);
	}
	//-------------------------------------------------
	public function scopeDeletedBy($query, $user_id)
	{
		return $query->where('deleted_by', $user_id);
	}
	//-------------------------------------------------
	public function scopeCreatedBetween($query, $from, $to)
	{
		return $query->whereBetween('created_at', array($from, $to));
	}
	//-------------------------------------------------
	public function scopeUpdatedBetween($query, $from, $to)
	{
		return $query->whereBetween('updated_at', array($from, $to));
	}
	//-------------------------------------------------
	public function scopeDeletedBetween($query, $from, $to)
	{
		return $query->whereBetween('deleted_at', array($from, $to));
	}
	//-------------------------------------------------
	public function scopeActivated($query)
	{
		return $query->whereNotNull('activated_at');
	}
	//-------------------------------------------------
	public function scopeNotActivated($query)
	{
		return $query->whereNull('activated_at');
	}
	//-------------------------------------------------
	public function scopeLoggedInBetween($query, $from, $to)
	{
		return $query->whereBetween('last_login', array($from, $to));
	}
	//-------------------------------------------------
	public function scopeNeverLoggedIn($query)
	{
		return $query->whereNull('last_login');
	}

	//-------------------------------------------------
	public function roles()
	{
		return $this->belongsToMany('Modules\Core\Entities\Role',
			'core_user_role', 'core_user_id', 'core_role_id'
		);
	}
	//-------------------------------------------------
	public function countAdmins()
	{
		$count = User::whereHas('roles', function ($query){
			$query->slug('admin');
		})->count();

		return $count;
	}
	//-------------------------------------------------
	public function permissions()
	{
		return $this->hasManyThrough(
			'Modules\Core\Entities\Permission',
			'Modules\Core\Entities\Role'
		);
	}
	//-------------------------------------------------
	public function getByEmail($email)
	{
		try {
			$user = User::where('email', $email)->firstOrFail();
			$response['status'] = 'success';
			$response['data'] = $user;
			return $response;
		} catch (\Exception $e) {
			$response['status'] = 'failed';
			$response['errors'][] = $e->getMessage();
			return $response;
		}
	}

	//-------------------------------------------------
	public function getByMobile($mobile)
	{
		try {
			$user = User::where('mobile', $mobile)->firstOrFail();
			$response['status'] = 'success';
			$response['data'] = $user;
			return $response;
		} catch (\Exception $e) {
			$response['status'] = 'failed';
			$response['errors'][] = $e->getMessage();
			return $response;
		}
	}
	//-------------------------------------------------
	public function getByUsername($username)
	{
		try {
			$user = User::where('username', $username)->firstOrFail();
			$response['status'] = 'success';
			$response['data'] = $user;
			return $response;
		} catch (\Exception $e) {
			$response['status'] = 'failed';
			$response['errors'][] = $e->getMessage();
			return $response;
		}
	}
	//-------------------------------------------------
	public static function rulesAdminCreate()
	{
		$rules = [
			'name' => 'required|string|max:255',
			'email' => 'required|email|unique:core_users|max:255',
			'mobile' => 'required|unique:core_users|max:10',
			'password' => 'required|max:255',
		];

		return $rules;
	}
	//-------------------------------------------------
	//-------------------------------------------------


}
