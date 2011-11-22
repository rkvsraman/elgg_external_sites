<?php

include_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");

gatekeeper();

$title = "";

$area1 = elgg_view_title($title);

$area1 .= elgg_view('collaboration/view');

$body = elgg_view_layout('one_column', $area1);

echo page_draw($title, $body);
