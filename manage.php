<?php 
/**________________________________________________________________________________
Author:         QUANG HIEU VO
Date:           Mar 16, 2021     
Parameters:     N/A
References:     N/A
Revisions:      N/A
________________________________________________________________________________**/
$page="update"; include './partial/top.php';  ?>


<!--CONTACT ME FORM SECTION-->
<div >
    <br><h1 class="display-4">MANAGE USER - CONFIDENTIAL</h1>

    <?php //-------------------------- PHP SCRIPT TO HANDLE POST REQUEST -------------------------- 
    // IMPORT DAO
    require_once('./dao/userDAO.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // NEW DAO OBJECT
        $userDAO = new userDAO(); 

        // CHECK IF ALL FIELDS ARE NOT EMPTY
        if($_POST['firstname'] == "" || $_POST['lastname'] == "" || $_POST['email'] == "" || $_POST['age'] == "" || $_POST['location'] == "")
            echo "<div class=\"alert alert-danger\"><strong><i class=\"far fa-exclamation-triangle\"></i> Warning!</strong> Please filled out all fields</div>";
        
        // CHECK IF AGE IS NUMERIC
        else if (!is_numeric($_POST['age'])) 
            echo "<div class=\"alert alert-danger\"><strong><i class=\"far fa-exclamation-triangle\"></i> Warning!</strong> Age must be numeric</div>";

        // IF NO ISSUE WITH THE INPUTS, THEN READY TO UPDATE
        else {

            // SET PARAMETER AND EXECUTE, THE REPLACE BASICALLY REPLACE ALL THE ` CHARACTER WITH ', TO RENDER SAFELY TO FRONT-END
            $id         = str_replace("`","'", $_POST['id']);
            $firstname  = str_replace("`","'", $_POST['firstname']);
            $lastname   = str_replace("`","'", $_POST['lastname']);
            $email      = str_replace("`","'", $_POST['email']);
            $age        = str_replace("`","'", $_POST['age']==""?null:$_POST['age']);
            $location   = str_replace("`","'", $_POST['location']);
    
            // NEW USER OBJECT AND UPDATE TO DB
            $user = new User($id, $firstname, $lastname, $email, $age, $location, null);
            $result = $userDAO->updateUser($user);
    
            // IF SUCCESS, PRINT SUCCESS MESSAGE
            if($result) 
                echo "<h3>User ".htmlspecialchars($firstname, ENT_QUOTES, 'UTF-8')." ".htmlspecialchars($lastname, ENT_QUOTES, 'UTF-8')."has been updated successfully!<i style=\"color: green;\" class=\"fas fa-check-circle\"></i></h3>";
        } 
    } else if (isset($_GET["id"])){
        $userDAO = new userDAO(); 
        $deleteId = $_GET["id"];
        $result   = $userDAO->deleteUser($deleteId);
        if($result) { 
          ?><h3>User with id <?php echo $deleteId;?> was deleted successfully!<i style="color: green;" class="fas fa-check-circle"></i></h3><?php
        };
    }
    
    
    //-------------------------- END OF PHP SCRIPT --------------------------?>

    <!-------------------------- USER TABLE -------------------------->
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th><i class="far fa-key"></i> ID</th>
                <th>First name</th>
                <th>Last name</th>
                <th>Email</th>
                <th>Age</th>
                <th>Location</th>
                <th>Date created</th>
                <th>Actions</th>
            </tr>
        </thead>
        
        <tbody>
            <?php // PHP LOOP TO RENDER ALL USERS DATA
                require_once('./dao/userDAO.php');  // Importing DAO
                $userDAO = new userDAO();           // Create new DAO object
                $users=$userDAO->getUsers();        // Get all users from DAO   
                if($users)                          // If there is users, then loop to render
                    foreach($users as $user){?>	 
                        <tr>
                            <td><?php echo $user->getId()?></td>
                            <td><?php echo htmlspecialchars($user->getFirstName(),  ENT_QUOTES, 'UTF-8');?></td>
                            <td><?php echo htmlspecialchars($user->getLastName(),   ENT_QUOTES, 'UTF-8');?></td>
                            <td><?php echo htmlspecialchars($user->getEmail(),      ENT_QUOTES, 'UTF-8');?></td>
                            <td><?php echo htmlspecialchars($user->getAge(),        ENT_QUOTES, 'UTF-8');?></td>
                            <td><?php echo htmlspecialchars($user->getLocation(),   ENT_QUOTES, 'UTF-8');?></td>
                            <td><?php echo htmlspecialchars($user->getDate(),       ENT_QUOTES, 'UTF-8');?></td>
                            <td nowrap="nowrap">
                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#exampleModal" 
                                    onclick="setEditValue(`<?php echo $user->getId()?>`, `<?php echo $user->getFirstName()?>`, `<?php echo $user->getLastName()?>`, `<?php echo $user->getEmail()?>`, `<?php echo $user->getAge()?>`, `<?php echo $user->getLocation()?>`, `<?php echo $user->getDate()?>`)"
                                ><i class="far fa-user-edit"></i> Edit </button>
                                <a onclick="loading()" class="btn btn-danger btn-sm" href="<?php echo $actual_link;?>?id=<?php echo $user->getId()?>"><i class="far fa-trash-alt"></i> Delete</a>  

                            </td>
                        </tr>
            <?php } // END OF RENDER LOOP ?>

        </tbody>
    </table>
    <!-------------------------- END OF TABLE -------------------------->
</div><br>

<!-------------------------- JS SCRIPT TO SET DATA TO INPUT FIELDS FOR MODAL ---------------------------->
<script>
    function setEditValue (id, firstName, lastName, email, age, location, date) {
        document.getElementById('firstname').value  = firstName;
        document.getElementById('lastname').value   = lastName;
        document.getElementById('email').value      = email;
        document.getElementById('age').value        = age;
        document.getElementById('location').value   = location;
        document.getElementById('id').value         = id;
        document.getElementById('date').value       = date;
        document.getElementById('exampleModalLabel').innerHTML="Update customer with id "+id;   
    }
</script>

<!-------------------------- MODAL FOR UPDATE FORM ---------------------------->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form method="POST">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!--MODAL HEADER-->
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Manage customer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!--MODAL BODY PART CONTAINS A FORM FOR UPDATE-->
                <div class="modal-body">
                    <div class="d-flex justify-content-center">
                        <img style="height:200px; width: auto;"src="https://upload.wikimedia.org/wikipedia/commons/0/0c/Chris_Hadfield_2011.jpg" alt="Girl in a jacket" width="500" height="600">
                    </div>
                    <br><br>
                    
                    <!--FIRST NAME-->
                    <div class="form-group row">
                        <label for="firstname" class="col-sm-4 col-form-label">First name</label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Enter your first name">
                        </div>
                    </div>
                    <!--LAST NAME-->
                    <div class="form-group row">
                        <label for="lastname" class="col-sm-4 col-form-label">Last name</label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter your last name">
                        </div>
                    </div>
                    <!--EMAIL-->
                    <div class="form-group row">
                        <label for="email" class="col-sm-4 col-form-label">Email</label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email">
                        </div>
                    </div>
                    <!--AGE-->
                    <div class="form-group row">
                        <label for="age" class="col-sm-4 col-form-label">Age</label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control" id="age" name="age" placeholder="Enter your age">
                        </div>
                    </div>
                    <!--LOCATION-->
                    <div class="form-group row">
                        <label for="location" class="col-sm-4 col-form-label">Location</label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control" id="location" name="location" placeholder="Enter your location">
                        </div>
                    </div>
                    <!--HIDDEN FIELDS FOR BACKEND-->
                    <input type="hidden" id="id" name="id"/>
                    <input type="hidden" id="date" name="date"/>       
                </div>

                <!--MODAL FOOTER INCLUDE BUTTON FOR SUBMIT OR CANCEL-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="far fa-times-circle"></i> Close</button>
                    <button onclick="loading();" type="submit" class="btn btn-primary"><i class="far fa-save"></i> Save</button>
                </div>
            </div>
        </div>
    </form>
</div>
<!-------------------------- END OF MODAL ---------------------------->

<!-- BOTTOM PART-->
<?php include './partial/bottom.php';  ?>
