<?php 
	if (isset($_POST['enrollment_id'])) {
		require_once '../Library/Enrollment.php';
		$enrollment_details = $enrollment->enrollment_details($_POST['enrollment_id']); 
		print $enrollment_details; 
	}elseif (isset($_POST['showsubject'])) {
		require_once '../Library/Enrollment.php'; 
		$student_subjects = $enrollment->student_subjects($_POST['enrollmentid2']);
		print $student_subjects; 
	}
?>