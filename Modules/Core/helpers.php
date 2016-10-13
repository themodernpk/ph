<?php

//---------------------------------------------------
function moduleAssets($name) {
	$asset = asset("assets/".$name);
	return $asset;
}
//---------------------------------------------------
function assetsCoreGlobal() {
	$asset = asset("assets/core/global");
	return $asset;
}
//---------------------------------------------------
function assetsCoreGlobalVendor() {
	$asset = asset("assets/core/global/vendor");
	return $asset;
}
//---------------------------------------------------
function assetsCoreMmenu() {
	$asset = asset("assets/core/mmenu/assets");
	return $asset;
}
//---------------------------------------------------
function getModuleExtendOrder()
{
	$list = Module::all();
	echo "<pre>";
	print_r( json_encode($list) );
	echo "</pre>";

}
//---------------------------------------------------
//---------------------------------------------------
//---------------------------------------------------
//---------------------------------------------------
function getConstant($key)
{
	switch ($key)
	{
		case 'permission.denied':
			$val = "Permission denied";
			break;
		//------------------------------------------
		case 'credentials.invalid':
			$val = "Invalid credentials";
				break;
		//------------------------------------------
		case 'account.disabled':
			$val = "Your account is disabled";
			break;
		//------------------------------------------
		case 'login.required':
			$val = "You must be logged in";
			break;
		//------------------------------------------
		case 'core.backend.logout':
			$val = "You have successfully logged out";
			break;

		//------------------------------------------
	}

	return $val;
}
//---------------------------------------------------
//---------------------------------------------------
//---------------------------------------------------
//---------------------------------------------------
//---------------------------------------------------
//---------------------------------------------------