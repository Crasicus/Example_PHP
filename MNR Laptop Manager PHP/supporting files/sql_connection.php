<?php # sql_connect.php

//This file contains the database access information.
//This file also establishes a connection to the SQL Server,
//selects the database, and sets the encoding.

//Set the database access information as constants:
DEFINE ('DB_USER', 'a9264574_lapform');
DEFINE ('DB_PASSWORD', '**********');
DEFINE ('DB_HOST', 'mysql3.000webhost.com');
DEFINE ('DB_NAME', 'a9264574_lapform');

//Make the connection:
$dbc = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die ('Could not connect to SQL Server: ' . mysqli_connect_error() );

//Set the encoding...
mysqli_set_charset($dbc, 'utf8');