<?php

// require autoload
require "../../vendor/autoload.php";

// Routes
require "../rest/routes/blogRoutes.php";
require "../rest/routes/userRoutes.php";
require "../rest/routes/categoryRoutes.php";
require "../rest/routes/authRoutes.php";

// Start FlightPHP
Flight::start();

// echo "IS THIS WORKING AT ALL";

// try {
//     // Assuming there's a table 'users' in your database
//     $baseDao = new BaseDao("blogs"); // Replace "users" with a valid table name for initialization
//     $users = $baseDao->get_all(); // This method needs to be defined to fetch all records or similar simple operation

//     echo "<pre>";
//     print_r($users); // Output the results
//     echo "</pre>";
// } catch (Exception $e) {
//     echo "Error: " . $e->getMessage();
// }

?>