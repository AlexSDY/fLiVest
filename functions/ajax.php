<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . '/load.php');

	switch ($_POST['action']) 
	{
		case 'saveOrder':
			$result = saveOrder($_POST, $db);
			break;
		
		default:
			# code...
			break;
	}

	echo json_encode($result);

?>