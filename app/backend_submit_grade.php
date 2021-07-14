<?php 
	if (isset($_POST['submit'])) {
		require_once '../Library/Grades.php';
		$score = $_POST['grade'];
		$stud_subject_id = $_POST['id'];

		$add_grade = $grade->submit_grade($stud_subject_id, $score);
		print($add_grade);
	}
?>