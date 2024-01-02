<?php
include('../config/constants.php');
//1. destroy the session
session_destroy();
header('location:'.SITEURL.'admin/login.php');





?>