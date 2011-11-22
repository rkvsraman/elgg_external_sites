<?php

if ( !function_exists('make_link')) {
	function make_link($href, $title, $target_blank = false) {
		if ($target_blank) {
			return '<a href="' . $href . '" target="_blank">' .$title . '</a>';
		} else {
			return '<a href="' . $href . '" target="_self">' .$title . '</a>';
		}
	}
}
if (!function_exists('get_my_links')) {
	function get_my_links() {
		$collaboration_sites  = elgg_get_entities(
			array( 
				'type' => 'object', 
				'subtype' => 'collaboration',
			)
		);
		$submenus = array();

		foreach($collaboration_sites as $site) {
			if ($site->name == '' || $site->url == '') {
				continue;
			}
			$submenu =  array(
				'title' => $site->name,
			);
			if ($site->use_iframe) {
				$url =  make_link( $site->url, $site->name );
			} else {
				$url =  make_link( $site->url, $site->name, true );
			}
			$submenu['url'] = $url;
			$submenus[] = $submenu;
		}
		return $submenus;

	}
}
$submenus = get_my_links();
?>
<ul class="topbardropdownmenu">
	<li class="drop"><a href="#" class="menuitemtools">Sites</a>
	<ul>
	<?php
		foreach($submenus as $menu) {
			echo "<li>{$menu['url']}</li>";
		}
	?>
	</ul>
	</li>
</ul>
<script type="text/javascript">
jQuery(function() {
	jQuery('ul.topbardropdownmenu').elgg_topbardropdownmenu();
});
</script>
