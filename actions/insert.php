<?php
//add only if admin login
if (!isadminloggedin()) {
	forward('pg/collaboration/admin');
}
$site_name  = get_input('site_name');
$site_url = get_input('site_url');
$use_iframe = get_input('use_iframe');
$group_id = get_input('group_visibility');

$site = saveCollaborativeSite($site_name, $site_url, $use_iframe, $group_id);
forward('pg/collaboration/admin');

/**
 * Function inserts the site entered by the admin into database
 * @params $site_name => The user friendly display name of the site
 * @params $site_url => The url of the collaborative site.
 *
 * All the parameters must properly validated and sanitized
 */
function saveCollaborativeSite($site_name, $site_url, $in_new_window = false, $group_id) {
	$site = new ElggObject();
	$site->subtype = "collaboration";
	$site->name  = $site_name;
	$site->url = $site_url;
	$site->access_id = ACCESS_PUBLIC;
	$site = setVisibility($site, $group_id);
	if ($in_new_window) {
		$site->use_iframe = false;
	} else {
		$site->use_iframe = true;
	}


	$site->save();

	return $site;
}

function setVisibility(ElggObject $site, $group_id = 0) {
	$group = get_entity($group_id);

	if ($group instanceof ElggGroup) {
		$site->access_id = $group->group_acl;
	}
	return $site;
}
