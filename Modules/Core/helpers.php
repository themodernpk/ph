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
//---------------------------------------------------