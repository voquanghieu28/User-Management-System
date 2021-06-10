<!DOCTYPE html>
<?php 
/**________________________________________________________________________________
Author:         QUANG HIEU VO
Date:           Mar 16, 2021     
Parameters:     N/A
References:     N/A
Revisions:      N/A
________________________________________________________________________________
THIS IS THE TOP OF EVERY PAGES, INCLUDING THE HEADER & NAVIGATION BARS
**/ ?>

<!-------------------------- HEADER -------------------------->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User management system</title>
    <!--INCLUDING BOOTSTRAP, FONTAWESOME AND CSS-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="icon" href="./image/title.png" type="image/x-icon" >
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./style/style.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>

<body>
    

    <!-------------------------- NAVIGATION BAR -------------------------->
    <nav style="font-size: 21px;"  class="navbar navbar-expand-lg bg-dark navbar-dark ">
        <!--NAVIGATION ICON-->
        <a class="navbar-brand" href="index">
          <img src="./image/mylogo.png" height="35" alt="" style="margin-right:40px; border-radius: 7px;">
        </a>
        <!--COLLAPSE BUTTON-->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <!--NAVIGATION ITEM-->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item <?php if(!strcmp($page, "create")) echo "active"?>">
                    <a class="nav-link" onclick="loading()" href="./create.php">CREATE</a>
                </li>
                <li class="nav-item <?php if(!strcmp($page, "read")) echo "active"?>">
                    <a class="nav-link" onclick="loading()" href="./read.php">SEARCH</a>
                </li>
                <li class="nav-item <?php if(!strcmp($page, "update")) echo "active"?>">
                    <a class="nav-link" onclick="loading()" href="./manage.php">MANAGE</a>
                </li>
            </ul>

            <!--SOCIAL MEDIA LINK-->
            <ul class="navbar-nav">
            <li class="nav-item"  style="display: inline-block;">
                <a class="nav-link"  onclick="loading()" href="https://www.linkedin.com/in/qhieuvo/"><i class="fab fa-linkedin fa-lg"></i></a>
            </li>
            <li class="nav-item" style="display: inline-block;">
                <a class="nav-link"  onclick="loading()" href="https://github.com/voquanghieu28/"><i class="fab fa-github-square fa-lg"></i></a>
            </li>
            <li class="nav-item" style="display: inline-block;">
                <a class="nav-link"  onclick="loading()" href="https://www.instagram.com/quanghieuvo28/"><i class="fab fa-instagram fa-lg"></i></a>
            </li>  
        </ul>
        </div>
    </nav>

    <!-------------------------- MAIN SECTION -------------------------->
    <div class="container-sm" style="height: 100%;">
    <br>

    

