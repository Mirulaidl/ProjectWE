<?php

// connect.php
// To connect between php scripting and database.
define("DATABASE_HOST", "10.26.30.17");
define("DATABASE_USER", "cd22098");
define("DATABASE_PASSWORD", "cd22098");

// To establish a connection to database and save in Sconn
$conn = mysqli_connect(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD);

// If connection failed then dsplay mysql error
if (mysqli_connect_errno())
	{
	 echo "Failed to connect to MySQL: " . mysqli_connect_error ();
	}

// To select one particular database to be used
mysqli_select_db($conn,"cd22098") or die( "Could not open products database");

//set the default time zone to use in Malaysia
date_default_timezone_set('Asia/Kuala_Lumpur');
?>