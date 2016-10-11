<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{

	use SoftDeletes;

	//-------------------------------------------------
	protected $table = 'core_permissions';
	//-------------------------------------------------
	protected $dates = [
		'created_at', 'updated_at', 'deleted_at'
	];
	//-------------------------------------------------
	protected $dateFormat = 'Y-m-d H:i:s';
	//-------------------------------------------------

	protected $fillable = [
		'name', 'slug', 'details', 'enable',
		'created_by', 'updated_by', 'deleted_by'
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
	public function roles()
	{
		return $this->belongsToMany('Modules\Core\Entities\Role',
			'core_role_permission', 'core_permission_id', 'core_role_id'
		);
	}
	//-------------------------------------------------
	//-------------------------------------------------
	//-------------------------------------------------
	//-------------------------------------------------
}
