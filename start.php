<?php
global $CONFIG;


register_action("collaboration/insert_site", 
	false, 
	$CONFIG->pluginspath . "collaboration/actions/insert.php"
);
/*
register_action("collaboration/view",
	false,
	$CONFIG->pluginspath . "collaboration/actions/view.php"
);*/

function collaboration_page_handler($page) {
	
	if (isset($page[0])) {
		switch ($page[0]) {
		case 'add':
			include (dirname(__FILE__) ."/add.php");
			break;
		case 'delete':
			include (dirname(__FILE__) ."/actions/delete.php");
			break;
		case 'view':
			include (dirname(__FILE__) ."/view.php");
			break;
		case 'admin':
			include (dirname(__FILE__) ."/admin.php");
			break;
		}
	} else {
		register_error('Page not found');
		forward( $CONFIG->wwwroot );
	}
	return true;
}

function collaboration_init() {
	register_page_handler('collaboration', 'collaboration_page_handler');
	elgg_extend_view('elgg_topbar/extend', 'collaboration/topbar');
}

function collaboration_pagesetup() {
	global $CONFIG;
	if (get_context() == 'admin' && isadminloggedin()) {
		add_submenu_item('Manage external sites', $CONFIG->wwwroot . 'pg/collaboration/admin');
	}
}

register_elgg_event_handler('init', 'system', 'collaboration_init');
register_elgg_event_handler('pagesetup', 'system', 'collaboration_pagesetup');
