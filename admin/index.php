<?php

session_start();
if($_SESSION['grade_utilisateur'] == 1){

    include('header.php');


}else{
    header('location: ../error404.php');
}