<?php
if (!function_exists('get_all_links')) {
	function get_all_links() {
		$links = array();
		$collaboration_sites = elgg_get_entities(
			array(
				'type' => 'object',
				'subtype' => 'collaboration'
			)
		);

		foreach($collaboration_sites as $site) {
			if ($site->name == '' || $site->url == '') {
				continue;
			}
			$links[] =  array(
				'name' => $site->name,
				'id' => $site->getGUID()
			);
		}
		return $links;
	}
}	
?>

<?php
$delete_path = $CONFIG->wwwroot . "pg/collaboration/delete";
$links = get_all_links();

if (count($links) ) {
	echo '<form action="' .$delete_path .'" method="post">
	    <fieldset style="border: 1px solid gold; padding: 10px;margin: 10px;">
	    <legend>All collaboration sites</legend>
		<ol style="list-style-type: decimal;">';
	foreach($links as $link) {
		echo '<li>'. $link['name'] .'
			<input type="checkbox" name="to_delete[]" value="'.
			$link['id'] ."\"></input>";
		echo '</li>';
	}
	echo '</ol>';
	echo elgg_view('input/securitytoken');
	echo '<br>';
	echo elgg_view(
		'input/submit', 
		array(
			'value' => elgg_echo("Remove selected sites")
		)
	);
	echo	'</fieldset>
		</form>';
} else {
	echo 'No sites found. Please add sites using the above form.';
}
?>
