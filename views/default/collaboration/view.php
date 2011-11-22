<?php
 $site_id = get_input('id');
 $entity = get_entity($site_id);
 
 $area2 = "<iframe src=\"{$entity->url}\" width=\"100%\" height=\"718px\"></iframe>";
?>
<div class="conentWrapper">
 <?= $area2 ?>
</div>


