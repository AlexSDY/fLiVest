<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . '/load.php');

	$seo = getSeoOptions();
	extract($seo);
	
	require_once(PATH . '/header.php');
	require_once(PATH . '/views/front_page.php');
	require_once(PATH . '/footer.php');
?>