<?php
require_once '../config/connection.php';

class User extends Connection{
	
	public function __construct(connection $conn) {
        $this->conn = $conn->conn;
    }

    public function lists_users()
    {
    	try {
    		$stmt = $this->conn->prepare("SELECT * FROM `users`");
    		$stmt->execute();
    		if($stmt->rowCount() > 0)
    		{
    			return $stmt->fetchALL(PDO::FETCH_ASSOC);
    		}
    	} catch (PDOException $e) {
    		print($E->get_message());
    	}
    }

	public function login_user($user_name, $password){
		$hash = sha1($password);
		$stmt = $this->conn->prepare("SELECT * FROM `users` WHERE `user_name` = :username AND `user_password` = :password");
		$stmt->bindParam(':username', $user_name);
		$stmt->bindParam(':password', $hash);
		$stmt->execute();

		$result = $stmt->rowCount();
		if($result > 0){ 
			$user = $stmt->fetch(PDO::FETCH_ASSOC);
			require_once '../config/session.php';
			$_SESSION['user_id'] = $user['user_id'];
			$_SESSION['user_type'] = $user['user_type'];

			if ($_SESSION['user_type'] == 'administrator' || $_SESSION['user_type'] == 'developer') {
				header('location: index.php');
			}
		}else{
			header('location: index.php');
		}

	}

	public function get_user($id){
		$sql = "SELECT * FROM `users` WHERE `user_id` = :id";
		$q = $this->conn->prepare($sql);
		$q->bindParam(':id', $id);
		$q->execute();

		$user = $q->fetch(PDO::FETCH_ASSOC);
		return $user;
	}

	public function create_user(){

	}
}