<?php
require_once '../config/connection.php';

class Grade extends Connection{

	public function __construct(connection $conn) {
		$this->conn = $conn->conn;
	}
	/**
	 * [add_grades description]
	 * @param [type] $request [description]
	 */
	public function add_grades($request)
	{
		
	}
	/**
	 * [submit_grade description]
	 * @param  [type] $stud_subject_id [description]
	 * @param  [type] $grade           [description]
	 * @return [type]                  [description]
	 */
	public function submit_grade($stud_subject_id, $grade)
	{
		try {
			$check = $this->check_grade_exist($stud_subject_id);
			if ($check == true) {
				
				// Update Grade
				$update = $this->update_grade($stud_subject_id, $grade);

				if ($update) {
					return "Successfully Updated";
					die();
				}
			}else{
				$stmt = $this->conn->prepare("INSERT INTO `grades`(`stud_subject_id`, `gwa`) VALUES (:stud_subject_id, :grade)");
				$stmt->bindParam(":stud_subject_id", $stud_subject_id);
				$stmt->bindParam(":grade", $grade);
				$stmt->execute();
				if ($stmt == true) {
					return "Grade Successfully Submitted";
				}
			}
		} catch (PDOException $e) {
			echo $e->get_message();
			die();
		}
	}

	public function check_grade_exist($stud_subject_id)
	{
		try {

			$stmt = $this->conn->prepare("SELECT * FROM `grades` WHERE `stud_subject_id` = :stud_subject_id AND `gwa` <> ''");
			$stmt->bindParam(":stud_subject_id", $stud_subject_id); 
			$stmt->execute();
			if ($stmt->rowCount() > 0) {
				return true;
			}
			
		} catch (PDOException $e) {
			echo $e->get_message();
			die();
		}
	}

	public function update_grade($stud_subject_id, $grade)
	{
		try {

			$stmt = $this->conn->prepare("UPDATE `grades` SET `gwa`= :grade WHERE `stud_subject_id` = :stud_subject_id");
			$stmt->bindParam(":stud_subject_id", $stud_subject_id); 
			$stmt->bindParam(":grade", $grade);
			$stmt->execute();
			
			return $stmt;
			
		} catch (PDOException $e) {
			echo $e->get_message();
			die();
		}
	}
}