<?php
/**________________________________________________________________________________
Author:         QUANG HIEU VO
Date:           Mar 16, 2021     
Parameters:     N/A
References:     N/A
Revisions:      N/A
________________________________________________________________________________
CREATE USER PAGE
**/



// INCLUDE TOP HTML PART 
$page="create"; include './partial/top.php';
require_once('./dao/userDAO.php');

// HANDLING POST REQUEST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userDAO = new userDAO(); 

    // CHECK If FIELDS ARE EMPTY
    if($_POST['firstname'] == "" || $_POST['lastname'] == "" || $_POST['email'] == "" || $_POST['age'] == "" || $_POST['location'] == "")
      echo "<div class=\"alert alert-danger\"><strong><i class=\"far fa-exclamation-triangle\"></i> Warning!</strong> Please filled out all fields</div>";
    
    // CHECK IF AGE IS A NUMBER
    else if (!is_numeric($_POST['age'])) 
      echo "<div class=\"alert alert-danger\"><strong><i class=\"far fa-exclamation-triangle\"></i> Warning!</strong> Age must be numeric</div>";

    else {
        // SET PARAMETER AND EXECUTE, THE REPLACE BASICALLY REPLACE ALL THE ` CHARACTER WITH ', TO RENDER SAFELY TO FRONT-END
        $firstname  = str_replace("`","'", $_POST['firstname']);
        $lastname   = str_replace("`","'", $_POST['lastname']);
        $email      = str_replace("`","'", $_POST['email']);
        $age        = str_replace("`","'", $_POST['age']==""?null:$_POST['age']);
        $location   = str_replace("`","'", $_POST['location']);
        
        // CREATE NEW USER AND ADD TO DAO
        $user = new User(null, $firstname, $lastname, $email, $age, $location, null);
        $addSuccess = $userDAO->addUser($user);

        // IF SUCCESS, PRINT THE SUCCESS MESSAGE
        if($addSuccess) 
          echo "<div class=\"alert alert-success\"><strong>Success! </strong> User ".htmlspecialchars($firstname, ENT_QUOTES, 'UTF-8')." ".htmlspecialchars($lastname, ENT_QUOTES, 'UTF-8')." was created successfully  <i style=\"color: green;\" class=\"fas fa-check-circle\"></i></div>";
        $addSuccess = null;
    }
}
?>

<!-------------------------- CREATE USER FORM -------------------------->
<br><h1 class="display-4">CREATE USER</h1><br>
<form method="POST">
    <div class="form-group row">
        <label for="firstname" class="col-sm-2 col-form-label">First name</label>
        <div class="col-sm-10">
        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Enter your first name" value="<?php if (isset($_POST["firstname"])) echo $_POST['firstname']?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="lastname" class="col-sm-2 col-form-label">Last name</label>
        <div class="col-sm-10">
        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter your last name" value="<?php if (isset($_POST["lastname"])) echo $_POST['lastname']?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="email" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
        <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" value="<?php if (isset($_POST["email"])) echo $_POST['email']?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="age" class="col-sm-2 col-form-label">Age</label>
        <div class="col-sm-10">
        <input type="text" class="form-control" id="age" name="age" placeholder="Enter your age" value="<?php if (isset($_POST["age"])) echo $_POST['age']?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="location" class="col-sm-2 col-form-label">Location</label>
        <div class="col-sm-10">
        <input type="text" class="form-control" id="location" name="location" placeholder="Enter your location" value="<?php if (isset($_POST["location"])) echo $_POST['location']?>">
        </div>
    </div>
    <button type="submit" onclick="loading()" class="btn btn-primary"><i class="far fa-user-plus" ></i> Add User</button>
</form>


<!-------------------------- BOTTOM PART -------------------------->
<?php include './partial/bottom.php';  ?>