<?php 
	require_once '../Library/Enrollment.php';

	if (isset($_POST['enroll'])) {
		$result = $enrollment->enroll_student($_POST);		
		echo $result;
	} 