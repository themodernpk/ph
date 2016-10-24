<?php
//---------------------------------------------------
function moduleAssets( $name ) {
	$asset = asset( "assets/" . $name );

	return $asset;
}

//---------------------------------------------------
function assetsCoreGlobal() {
	$asset = asset( "assets/theme/global" );

	return $asset;
}

//---------------------------------------------------
function assetsCoreGlobalVendor() {
	$asset = asset( "assets/theme/global/vendor" );

	return $asset;
}

//---------------------------------------------------
function assetsCoreMmenu() {
	$asset = asset( "assets/theme/mmenu/assets" );

	return $asset;
}

//---------------------------------------------------
function loadExtendableView( $view_name ) {
	$modules = new Modules\Core\Entities\Module();
	$modules = $modules->enabled()->slugs()->toArray();
	$view    = "";
	foreach ( $modules as $item ) {
		$full_view_name = $item . '::backend.extendable.' . $view_name;
		if ( View::exists( $full_view_name ) ) {
			try {
				$view .= \View::make( $full_view_name );
				echo $view;
			} catch ( Exception $e ) {
				echo json_encode( $e->getMessage() );
			}
		}
	}
}

//---------------------------------------------------
//---------------------------------------------------
//---------------------------------------------------
//---------------------------------------------------
function getConstant( $key ) {
	$val = null;
	switch ( $key ) {
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