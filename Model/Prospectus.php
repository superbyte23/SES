<?php 

require_once '../config/connection.php'; 

class Prospectus extends Connection{  
	 
	public function list_prospectus($id, $sem)
	{ 
		try {
			$stmt = $this->conn->prepare("
				SELECT `prospectus`.`id` as 'pid', 
				`prospectus`.`curriculum_id`, 
				`prospectus`.`curriculum_level_id`, 
				`prospectus`.`subject_id`, 
				`subject`.* 
				FROM `prospectus` 
				LEFT JOIN `subject` ON `prospectus`.`subject_id` = `subject`.`id`
			    WHERE `prospectus`.`curriculum_level_id` = :id AND `prospectus`.`semester` = :sem ORDER BY `subject`.`subject_code`");
			$stmt->bindParam(':id' , $id);
			$stmt->bindParam(':sem' , $sem);
			$stmt->execute();			 
			return $stmt;			
			 
		} catch (PDOException $e) {
			
		}
	}

	public function prospectus_add($sql)
	{
		$stmt = $this->conn->prepare($sql);  
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
	public function prospectus_info($id)
	{
		try {
			$stmt = $this->conn->prepare("
				SELECT `prospectus`.`id` as 'pid', 
				`subject`.* 
				FROM `subject`
				LEFT JOIN `prospectus` ON `subject`.`id` = `prospectus`.`subject_id` 
				WHERE `prospectus`.`id` = :id"
				); 
			$stmt->bindParam(':id' , $id);
			$stmt->execute();		

			return json_encode($stmt->fetch(PDO::FETCH_ASSOC));
		} catch (PDOException $e) {
			echo $e->get_message();
		}
	}
	public function prospectus_update($request)
	{
		 
	}
	public function prospectus_delete($id)
	{
		 
	}
	public function prospectus_per_curriculum($cid)
	{
		try {
			$stmt = $this->conn->prepare("
				SELECT
					`prospectus`.`id` as 'pid',
				    `subject`.*
				FROM
				    `subject`
				LEFT JOIN `prospectus` ON
				    `subject`.`id` = `prospectus`.`subject_id`
				LEFT JOIN `curriculum_level` ON `prospectus`.`curriculum_level_id` = `curriculum_level`.`id`
				LEFT JOIN `curriculum` ON `curriculum_level`.`curriculum_id` = `curriculum`.`id`
				WHERE `curriculum`.`id` = :cid
				"); 
			$stmt->bindParam(':cid' , $cid);
			$stmt->execute();			 
			return $stmt;			
			 
		} catch (PDOException $e) {
			
		}
	}
	public function prospectus_per_level($clid)
	{
		try {
			$stmt = $this->conn->prepare("SELECT `curriculum_level_id`,`semester` FROM `prospectus` WHERE `curriculum_level_id` = :clid GROUP BY `semester`");
			// $stmt->bindParam(':cid' , $cid);
			$stmt->bindParam(':clid' , $clid);
			$stmt->execute();			 
			return $stmt;			
			 
		} catch (PDOException $e) {
			
		}
	}

	public function prospectus_per_semester($clid, $sem)
	{
		try {
			$stmt = $this->conn->prepare("
				SELECT 
					`subject`.`id`, 
					`subject`.`subject_code`, 
					`subject`.`subject_title`, 
					`subject`.`subject_desc`, 
					`subject`.`units`, 
					`subject`.`prerequisite`, 
					`prospectus`.`id` as 'pid', 
					`prospectus`.`curriculum_id`, 
					`prospectus`.`curriculum_level_id`, 
					`prospectus`.`subject_id`, 
					`prospectus`.`semester`  
				FROM `curriculum` 
				LEFT JOIN `curriculum_level` ON `curriculum`.`id` = `curriculum_level`.`curriculum_id` 
				LEFT JOIN `prospectus` ON `curriculum_level`.`id` = `prospectus`.`curriculum_level_id` 
				LEFT JOIN `subject` ON `prospectus`.`subject_id` = `subject`.`id` 
				WHERE `prospectus`.`curriculum_level_id` = :clid AND `prospectus`.`semester` = :sem 
				ORDER BY `subject`.`subject_code` ASC");
			$stmt->bindParam(':clid' , $clid); 
			$stmt->bindParam(':sem' , $sem); 
			$stmt->execute();			 
			return $stmt;			
			 
		} catch (PDOException $e) {
			
		}
	}

	public function prospectus_total_per_semester($clid, $sem)
	{
		try {
			$stmt = $this->conn->prepare("
				SELECT SUM(`subject`.`units`) AS 'total' 
				FROM `prospectus` 
				LEFT JOIN `subject` ON `prospectus`.`subject_id` = `subject`.`id` 
				WHERE `prospectus`.`curriculum_level_id` = :clid AND `prospectus`.`semester` = :sem"); 
			$stmt->bindParam(':clid' , $clid);
			$stmt->bindParam(':sem' , $sem);
			$stmt->execute();			 
			return $stmt;			
			 
		} catch (PDOException $e) {
			
		}
	}

	public function prospectus_per_course($stid, $clid, $sem)
	{
		try {
			$stmt = $this->conn->prepare("
				SELECT `prospectus`.`curriculum_level_id`, `subject`.* 
				FROM `prospectus` 
				LEFT JOIN `subject` on `prospectus`.`subject_id` = `subject`.`id` 
				LEFT JOIN `curriculum_level` on `prospectus`.`curriculum_level_id` = `curriculum_level`.`id` 
				LEFT JOIN `curriculum` on `curriculum_level`.`curriculum_id` = `curriculum`.`id` 
				LEFT JOIN `students` on `curriculum`.`course_id` = `students`.`course` 
				WHERE `students`.`id` = :stid and (`prospectus`.`curriculum_level_id` = :clid AND `prospectus`.`semester` = :sem)");
			$stmt->bindParam(':stid', $stid);
			$stmt->bindParam(':clid' , $clid);
			$stmt->bindParam(':sem' , $sem);
			$stmt->execute();			 
			return $stmt;			
			 
		} catch (PDOException $e) {
			
		}
	}
	
}


?>
