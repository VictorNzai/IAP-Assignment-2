<?php
// Require the 'load' file
require_once "load.php";

// Call the functions using the objects
$layoutsObj->header();
// $menuObj->navMenu();

$contentsObj->signUpForm($globalObj);
$headingsObj->signUpBanner();
$processObj->signup($conn, $globalObj); // Handles form submission
$layoutsObj->footer();
?>
