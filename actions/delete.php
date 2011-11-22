<?php

//delete only if admin login
if (!isadminloggedin()){
	forward('pg/collaboration/admin');
}
$guids_to_delete = get_input('to_delete');
foreach($guids_to_delete as $guid) {
	delete_entity($guid);
}
forward('pg/collaboration/admin');
