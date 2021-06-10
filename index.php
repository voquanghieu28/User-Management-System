<?php 
/**________________________________________________________________________________
Author:         QUANG HIEU VO
Date:           Mar 16, 2021     
Parameters:     N/A
References:     N/A
Revisions:      N/A
________________________________________________________________________________
PAGE TO LIST ALL USERS **/
$page="index"; include './partial/top.php';  ?>

<!--CONTACT ME FORM SECTION-->
<div style="text-align: center;">
    <div style="text-align: center;"><br><h1 class="display-4">CUSTOMER DATA - CONFIDENTIAL</h1></div>
        
        <!--USERS TABLE-->
        <table class="table table-hover table-striped">
            <thead class="thead-dark">
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
                    // IMPORTING DAO
                    require_once('./dao/userDAO.php');  
                    $userDAO = new userDAO();

                    // GET USERS FROM DAO AND RENDER
                    $users=$userDAO->getUsers();   
                    if($users)
                        // htmlspecialchars IS TO PREVENT XSS
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
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include './partial/bottom.php';  ?>
