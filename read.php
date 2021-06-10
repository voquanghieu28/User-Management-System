<?php 
/**________________________________________________________________________________
Author:         QUANG HIEU VO
Date:           Mar 16, 2021     
Parameters:     N/A
References:     N/A
Revisions:      N/A
________________________________________________________________________________
READ BY ID PAGE **/
$page="read"; include './partial/top.php';  ?>

<br><h1 class="display-4">SEARCH BY LOCATION</h1><br>

<!--SEARCH BY ID BAR-->
<form class="form-inline" method="POST" >         
    <div class="form-group mx-sm-3 mb-2">
        <label for="inputPassword2" class="sr-only">Password</label>
        <input type="text" class="form-control" id="inputPassword2" name="keyword" placeholder="Enter location">
    </div>
    <button type="submit" onclick="loading()" class="btn btn-primary mb-2"><i class="fas fa-search-location"></i> Search</button>
</form>

<!--RESULTS TABLE-->
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
    </tr>
  </thead>
        
  <tbody>
    <?php
      // HANDLING POST REQUEST FOR SEARCH
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        // GET SEARCH KEY WORD
        $keyword = $_POST['keyword'];
        
        // IMPORT AND CREATE DAO
        require_once('./dao/userDAO.php');  
        $userDAO = new userDAO();

        // CALL GET BY LOCATION FROM DAO
        $users=$userDAO->getUserByLocation($keyword);   
        
        // IF THERE ARE RESULT, THEN RENDER THEM, ALSO DISPLAY NUMBER OF RESULTS
        if($users!=null) {
            echo "<h4>".count($users)." results founded</h4>";
            //htmlspecialchars IS TO PREVENT XSS
            foreach($users as $user){ ?>	
                <tr>
                    <td><?php echo htmlspecialchars($user->getId(), ENT_QUOTES, 'UTF-8');?></td>
                    <td><?php echo htmlspecialchars($user->getFirstName(), ENT_QUOTES, 'UTF-8');?></td>
                    <td><?php echo htmlspecialchars($user->getLastName(), ENT_QUOTES, 'UTF-8');?></td>
                    <td><?php echo htmlspecialchars($user->getEmail(), ENT_QUOTES, 'UTF-8');?></td>
                    <td><?php echo htmlspecialchars($user->getAge(), ENT_QUOTES, 'UTF-8');?></td>
                    <td><?php echo htmlspecialchars($user->getLocation(), ENT_QUOTES, 'UTF-8');?></td>
                    <td><?php echo htmlspecialchars($user->getDate(), ENT_QUOTES, 'UTF-8');?></td>
                </tr><?php       
            } 
        }   
          else echo "<h4>No results founded</h4>";
      }
    ?>

  </tbody>
</table>

<!--BOTOM PART-->
<?php include './partial/bottom.php';  ?>