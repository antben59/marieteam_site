<?php
// On détruit la session et on redirige la personne vers la page index.php
session_start();
session_destroy();
header('location:index.php');