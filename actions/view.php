<?php

$site_id = get_input('site_id');

$area1 = elgg_view_title($title);

$area1 = elgg_view('collaboration/view');

$body = elgg_view_layout('one_column
