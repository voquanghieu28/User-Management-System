<?php
/**________________________________________________________________________________
Author:         QUANG HIEU VO
Date:           Mar 16, 2021     
Parameters:     N/A
References:     N/A
Revisions:      N/A
________________________________________________________________________________**/

/** IMPORT DAO ABSTRACT SUPPER CLASS AND MODAL CLASS */
require_once('abstractDAO.php');
require_once('./model/user.php');

/** USER DAO CLASS TO HANDLE DB CONNECTION FOR USERS */
class userDAO extends abstractDAO {
        
    /*************** CONSTRUCTOR TO CREATE USER DAO INSTANCE ***************/
    function __construct() {
        try{                                    // Call parent constructor in try catch block for safety     
            parent::__construct();              // Call parent constructor  
        } catch(mysqli_sql_exception $ex) {     // Catch any exceptions
            throw $ex;                          // Throw any exception
        }
    }
    
    /*************** FUNCTION TO GET ALL USERS ***************/
    public function getUsers(){
        $result = $this->mysqli->query('SELECT * FROM users');  // Query DB
        $users  = Array();                                      // Get result in array format
        
        if($result->num_rows >= 1){                             // If there is result then conver it to array of Users
            while($row = $result->fetch_assoc()){
                
                $user = new User($row['id'], $row['firstname'], $row['lastname'], $row['email'], $row['age'], $row['location'], $row['date']);
                $users[] = $user;
            }
            $result->free();
            return $users;
        }
        $result->free();
        return false;
    }
    
    /*************** FUNCTION TO ADD USERS ***************/
    public function addUser($user){
        // IF ERR RETURN FALSE, ELSE TRUE
        if($this->mysqli->connect_errno) return false;
        
        // GET DATA FROM DTO
        $firstName  = $user->getFirstName();
        $lastName   = $user->getLastName();
        $email      = $user->getEmail();
        $age        = $user->getAge();
        $location   = $user->getLocation();

        // ADD USER INTO DB
        $query  = 'INSERT INTO users(firstname, lastname, email, age, `location`) VALUES (?,?,?,?,?)';
        $stmt   = $this->mysqli->prepare($query);          
        $stmt->bind_param('sssss', $firstName, $lastName, $email, $age, $location);
        $stmt->execute();

        // IF ERR RETURN FALSE, ELSE TRUE
        if($stmt->error) return false;
        else return true;
    }
	
    /*************** FUNCTION TO DELETE USERS ***************/
	public function deleteUser($id){
        // IF ERR RETURN FALSE, ELSE TRUE
        if($this->mysqli->connect_errno) return false;

        // DELETE USE FROM DB
        $query  = 'DELETE FROM users WHERE id = ?';
        $stmt   = $this->mysqli->prepare($query);
        $stmt->bind_param('s', $id);
        $stmt->execute();

        // IF ERR RETURN FALSE, ELSE TRUE
        if($stmt->error) return false;
        else return true;
    }

    /*************** FUNCTION TO UPDATE A SPECIFIC USER ***************/
    public function updateUser($user){
        // IF ERR RETURN FALSE, ELSE TRUE
        if($this->mysqli->connect_errno) return false;

        // GET DATA FROM DTO
        $id         = $user->getId();
        $firstName  = $user->getFirstName();
        $lastName   = $user->getLastName();
        $email      = $user->getEmail();
        $age        = $user->getAge();
        $location   = $user->getLocation();        

        // UPDATE USER WITH NEW DATA
        $query  = 'UPDATE users SET firstname = ?, lastname = ?, email = ?, age = ?, `location` = ? WHERE id=?';
        $stmt   = $this->mysqli->prepare($query);
        $stmt->bind_param('ssssss', $firstName, $lastName, $email, $age, $location,$id);
        $stmt->execute();

        // IF ERR RETURN FALSE, ELSE TRUE
        if($stmt->error) return false;
        else return true;
    }
	
    /*************** FUNCTION TO GET USER BY LOCATION ***************/
	public function getUserByLocation($location){
        // GET BY ID SQL QUERY
        $query      = "SELECT * FROM users WHERE `location` LIKE ?";
        $stmt       = $this->mysqli->prepare($query);
        $location   = "%$location%";    // Wrap keyword around %, therefore it could found anywhere in the string and not case sensitive
        
        // EXECUTE QUERY
        $stmt->bind_param('s', $location);
        $stmt->execute();
        $result = $stmt->get_result();

        // IF THERE IS RESULT, THEN PREPARE RESULT FOR RETURN
        if($result->num_rows >= 1){
            while($row = $result->fetch_assoc()){
                $user = new User($row['id'], $row['firstname'], $row['lastname'], $row['email'], $row['age'], $row['location'], $row['date']);
                $users[] = $user;
            }
            $result->free();
            return $users;
        }
        $result->free();
        return null;
    }
}
/*************** END OF FILE ***************/
?>
