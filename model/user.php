<?php
/**________________________________________________________________________________
Author:         QUANG HIEU VO
Date:           Mar 16, 2021     
Parameters:     N/A
References:     N/A
Revisions:      N/A
________________________________________________________________________________**/

	// A DATA TRANSFER OBJECT FOR USER
	class User{
		
		/** PRIVATE CLASS MEMBER */
		private $id;
		private $firstName;
		private $lastName;
		private $email;
		private $age;
		private $location;
		private $date;
		
		/** CONSTRUCTOR TO CREATE USER OBJECT*/
		function __construct($id, $firstName, $lastName, $email, $age, $location, $date){
			$this->setId($id);
			$this->setFirstName($firstName);
			$this->setLastName($lastName);
			$this->setEmail($email);
			$this->setAge($age);
			$this->setLocation($location);
			$this->setDate($date);
		}

		/** GETTER & SETTER FOR ID */
		public function getId() { return $this->id; }
		public function setId($id){ $this->id = $id; }

		/** GETTER & SETTER FOR FIRST NAME */
		public function getFirstName() { return $this->firstName; }
		public function setFirstName($firstName){ $this->firstName = $firstName; }

		/** GETTER & SETTER FOR LAST NAME */
		public function getLastName() { return $this->lastName; }
		public function setLastName($lastName){ $this->lastName = $lastName; }

		/** GETTER & SETTER FOR EMAIL */
		public function getEmail() { return $this->email; }
		public function setEmail($email){ $this->email = $email; }

		/** GETTER & SETTER FOR AGE */
		public function getAge() { return $this->age; }
		public function setAge($age){ $this->age = $age; }

		/** GETTER & SETTER FOR LOCATION */
		public function getLocation() { return $this->location; }
		public function setLocation($location){ $this->location = $location; }

		/** GETTER & SETTER FOR DATE */
		public function getDate() { return $this->date; }
		public function setDate($date){ $this->date = $date; }
	}
?>