<?php 
/**________________________________________________________________________________
Author:         QUANG HIEU VO
Date:           Mar 16, 2021     
Parameters:     N/A
References:     N/A
Revisions:      N/A
________________________________________________________________________________
DELETE USER PAGE
**/
$page="delete"; include './partial/top.php';  ?>

<!--JS SCRIPT TO PREVENT SUBMITTING LOOP-->
<script>    
    if(typeof window.history.pushState == 'function') 
        window.history.pushState({}, "Hide", '<?php echo $_SERVER['PHP_SELF'];?>');
</script>

<!--CONTACT ME FORM SECTION-->
<div style="text-align: center;">
  <div style="text-align: center;"><br><h1 class="display-4">DELETE USER - CONFIDENTIAL</h1></div>
    
    <!--USERS TABLE-->
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
          <?php
          // IMPORT DAO
          require_once('./dao/userDAO.php');  
          $userDAO = new userDAO();

          // HANDLE GET REQUEST FOR DELETE USER
          if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
              $deleteId = $_GET["id"];
              $result   = $userDAO->deleteUser($deleteId);
              if($result) { 
                ?><h3>User with id <?php echo $deleteId;?> was deleted successfully!<i style="color: green;" class="fas fa-check-circle"></i></h3><?php
              };
          }

          // GET THE CURRENT WEB URL
          $uri_parts    = explode('?', $_SERVER['REQUEST_URI'], 2);
          $actual_link  = "http://$_SERVER[HTTP_HOST]$uri_parts[0]";

          // GET USERS FROM DAO AND RENDER
          $users=$userDAO->getUsers();   
          if($users)
            foreach($users as $user){ ?>	
              <tr>
                  <td><?php echo htmlspecialchars($user->getId(), ENT_QUOTES, 'UTF-8');?></td>
                  <td><?php echo htmlspecialchars($user->getFirstName(), ENT_QUOTES, 'UTF-8');?></td>
                  <td><?php echo htmlspecialchars($user->getLastName(), ENT_QUOTES, 'UTF-8');?></td>
                  <td><?php echo htmlspecialchars($user->getEmail(), ENT_QUOTES, 'UTF-8');?></td>
                  <td><?php echo htmlspecialchars($user->getAge(), ENT_QUOTES, 'UTF-8');?></td>
                  <td><?php echo htmlspecialchars($user->getLocation(), ENT_QUOTES, 'UTF-8');?></td>
                  <td><?php echo htmlspecialchars($user->getDate(), ENT_QUOTES, 'UTF-8');?></td>
                  <td nowrap="nowrap">
                    <a class="btn btn-danger btn-sm" href="<?php echo $actual_link;?>?id=<?php echo $user->getId()?>"><i class="far fa-trash-alt"></i> Delete</a>  
                  </td>
              </tr>
            <?php } ?>
      </tbody>
    </table>
  </div>
</div>
<?php include './partial/bottom.php'; ?>