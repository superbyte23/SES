<?php 

require_once '../config/connection.php'; 
require_once '../Model/Subject.php';
$db = new Connection;
$subjects = new Subject($db);

$subject_list = $subjects->list_subject();

if (isset($_GET['id'])) {
	$subject_info = $subjects->subject_info($_GET['id']);
	
}