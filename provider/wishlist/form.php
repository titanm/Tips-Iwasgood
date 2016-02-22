<?php
	$table = 'wishes';
	$formName = 'wishes';
	$form = array(
		'wishlist_id' => array('type'=>'justadd', 'default'=>$wishlist['id']),
		'name' => array('label'=>'Name', 'type'=>'text', 'valid'=>array('required')),
		'description' => array('label'=>'Description', 'type'=>'textarea', 'valid'=>array()),
		'image' => array('label'=>'Image', 'type'=>'image', 'valid'=>array(), 'resizeTo'=>'60x60', 'dest'=>'userfiles/wish#.jpg'),
	);
?>