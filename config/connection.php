<?php
class Connection
{
	

	private $host="localhost";
	private $user="root";
	private $db="subject_evaluation";
	private $pass="";
	protected $conn; 
    
	public function __construct(){
	 	$this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->db,$this->user,$this->pass);
	 	// $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}

	public function authenticate_page($stmt){
		if (!$stmt) {
			header('location: 404.php');
		}
	}
}

?>