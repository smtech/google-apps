<?php

/*

https://skunkworks.stmarksschool.org/google/drive-search.php?domain=stmarksschool.org&within=to%3Afacultyresources%40stmarksschool.org&target=_blank&title=Faculty%20Resources&browse_url=https%3A%2F%2Fdrive.google.com%2Fa%2Fstmarksschool.org%2Ffolderview%3Fid%3D0Bx1atGpuKjk9YkNyb2Q1RUNoOWM%26usp%3Dsharing&directions=If%20you%20are%20not%20already%20logged%20in%20to%20your%20Google%20Apps%20account%2C%20you%20will%20be%20asked%20to%20log%20in%20to%20view%20the%20search%20results.

*/

require_once('common.inc.php');

// optional google apps domain
$domain = (!empty($_REQUEST['domain']) ? $_REQUEST['domain'] : false);
if ($domain) {
	$formHidden['domain'] = $domain;
}

// optional restrictions to be added to the search (e.g. 'to:user@domain.com')
$within = (!empty($_REQUEST['within']) ? $_REQUEST['within'] : false);
if ($within) {
	$formHidden['within'] = $within;
}

/* if we're receiving query, handle that rather than showing a form */
if (isset($_REQUEST['query'])) {
	echo('<html><body onload="window.location=\'https://drive.google.com/' . (!empty($domain) ? "a/$domain/" : '') . "#search/{$_REQUEST['query']}" . (!empty($within) ? "+$within" : '') . '\';"></body></html>');
	exit;
} else {
	// search button name and default title text
	if (!empty($_REQUEST['submit'])) {
		$smarty->assign('search', $_REQUEST['submit']);
	}

	// title text
	if (!empty($_REQUEST['title'])) {
		$smarty->assign('title', $_REQUEST['title']);
	}

	// optional directions
	if (!empty($_REQUEST['directions'])) {
		$smarty->assign('directions', $_REQUEST['directions']);
	}

	// href target for search
	if (!empty($_REQUEST['target'])) {
		$smarty->assign('target', $_REQUEST['target']);
	}

	// query placeholder in search form
	if (!empty($_REQUEST['placeholder'])) {
		$smarty->assign('placeholder', $_REQUEST['placeholder']);
	}

	// optional url to a file browsing interface (e.g. Google Drive)
	if (!empty($_REQUEST['browse_url'])) {
		$smarty->assign('browseUrl', $_REQUEST['browse_url']);
	}

	// browse link text
	if (!empty($_REQUEST['browse_text'])) {
		$smarty->assign('browseText', $_REQUEST['browse_text']);
	}

	// href target of browse link
	if (!empty($_REQUEST['browse_target'])) {
		$smarty->assign('browseTarget', $_REQUEST['browse_target']);
	}

	$smarty->addStylesheet(dirname($_SERVER['REQUEST_URI']) . '/css/drive-search.css');

	// optional url to css styleheet
	if (!empty($_REQUEST['css'])) {
		$smarty->addStylesheet($_REQUEST['css'], 'custom');
	}

	$smarty->assign('formHidden', $formHidden);
	$smarty->display('drive-search.tpl');
}

?>
