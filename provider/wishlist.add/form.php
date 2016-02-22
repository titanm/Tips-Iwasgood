<?php
	$table = 'wishlists';
	$formName = 'new-wishlist';
	$form = array(
		'owner_id' => array('type'=>'justadd', 'default'=>$loggedin['id']),
		'for' => array('label'=>'Add new wishlist for', 'type'=>'text', 'valid'=>array('required')),
	);
?>