<?php
	$groups = elgg_get_entities(array('type' => 'group', 'owner' => 0, 'full_view' => false));
	$options = array();
	$options_values = array();
	$options[] = 'All groups';
	$options_values[0] = 'All groups';

	foreach( $groups as $group) {
		$options[] = $group->name;
		$options_values[$group->getGUID()] = $group->name;
	}
?>
<div class="conentWrapper">
<form action="<?php echo $vars['url']; ?>action/collaboration/insert_site" method="post">
<fieldset style="border: 1px solid gold;padding: 18px; margin: 10px;">
<legend> Add a new collaboration site. Enter the name and url of the site below. </legend>
<label for="site_name">Name:</label>
<?php echo elgg_view('input/text', array('internalname' => 'site_name')); ?>

<label for="site_url">Url:</label>
<?php echo elgg_view('input/text', array('internalname' => 'site_url')); ?>
<label for="group_assigned">Visible to:</label>
<?php echo elgg_view('input/pulldown',
	array(
		'internalname' => 'group_visibility', 
		'options' => $options, 
		'options_values' => $options_values
	)
);
?>
<br>
<label for="use_iframe">Open the site in new window:</label>
<input type="checkbox" name="use_iframe"></input>

<?php echo elgg_view('input/securitytoken'); ?>
<br>
<?php echo elgg_view('input/submit', array('value' => elgg_echo('Add site'))); ?>
</fieldset>

</form>
