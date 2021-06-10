<?php
/**________________________________________________________________________________
Author:         QUANG HIEU VO  
Parameters:     N/A
References:     N/A
Revisions:      N/A
________________________________________________________________________________**/

    // ABSTRACT DAO CLASS FOR CHILD DAO CLASS TO IMPLEMENT DB CONNECTION
    class abstractDAO {

        /** DATABSE CONFIGURATIONS */
        protected static $DB_HOST     = "XXXXXXXXXXXXX";
        protected static $DB_USERNAME = "XXXXXXXXXXXXX";
        protected static $DB_PASSWORD = "XXXXXXXXXXXXX";
        protected static $DB_DATABASE = "XXXXXXXXXXXXX";

        /** PROTECTED VARIABLE TO STORE mysqli OBJECT */
        protected $mysqli;
        
        /** CONSTRUCTOR TO CREATE DAO OBJECT */
        function __construct() {
            try{
                $this->mysqli = new mysqli(self::$DB_HOST, self::$DB_USERNAME, self::$DB_PASSWORD, self::$DB_DATABASE); 
            }catch(mysqli_sql_exception $e){
                throw $e;
            }
        }
        
        /** GETTER TO GET mysqli INSTANCE */
        public function getMysqli() { return $this->mysqli; } 
    }

?>
