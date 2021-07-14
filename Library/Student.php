<?php 

require_once '../config/connection.php'; 
require_once '../Model/Student.php';
$db = new Connection;
$students = new Students($db);

$student_list = $students->list_students();

if (isset($_GET['id'])) {
	$student_info = $students->student_info($_GET['id']);
	
}