<?php
	function proc_img($src, $dst, $x, $y) {
		$im = new Imagick();
		$im->readImage($src);
		$im->thumbnailImage($x,$x,false,true);
		$im->writeImage($dst);
	}
?>