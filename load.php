<?php
// Include the constants file
require_once "includes/dbConnection.php";  // Ensure this path is correct
require_once"includes\constants.php";
require_once 'database/processForm.php';
// Autoload function for classes
function classAutoLoad($className)
{
    // The different folders containing the classes
    $directories = ["contents", "menus", "layouts", "database", "global"];
    
    // Loop through the folders
    foreach ($directories as $dir) {
        // Get the names of the files from the folders
        $fileName = dirname(__FILE__) . DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR . $className . ".php";
        
        // Check if the file exists and if it is also readable
        if (file_exists($fileName) && is_readable($fileName)) {
            // Require the file
            require_once $fileName;
        }
    }
}

// Automatically load the required files
spl_autoload_register('classAutoLoad');

// Create object of the global functions
$globalObj = new fncs();

// Create instances of all the classes
$menuObj = new menus();
$layoutsObj = new layouts();
$headingsObj = new headings();
$contentsObj = new contents();

// Create the connection object with constants
$conn = new dbConnection(dbType, hostName, dbPort, hostUser, hostPass, dbName);

// Create an instance of processForm
$processObj = new processForm();

// Call the signup function
$processObj->signup($conn, $globalObj);
