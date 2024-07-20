<?php
    $Write="<?php $" . "UIDresult=''; " . "echo $" . "UIDresult;" . " ?>";
    file_put_contents('UIDContainer.php',$Write);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
    <style>
    html {
        font-family: Arial;
        display: inline-block;
        margin: 0px auto;
        text-align: center;
    }

    ul.topnav {
        list-style-type: none;
        margin: auto;
        padding: 0;
        overflow: hidden;
        background-color: #3e64f9;
        width: 70%;
        border-radius: 10px; /* Added rounded corners */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Added shadow */
    }

    ul.topnav li {float: left;}

    ul.topnav li a {
        display: block;
        color: white;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        border-radius: 5px; /* Added rounded corners */
        margin: 5px; /* Added margin between items */
        transition: background-color 0.3s; /* Smooth transition for hover effect */
    }

    ul.topnav li a:hover:not(.active) {background-color: #1d05b8;} /* New hover color */

    ul.topnav li a.active {
        background-color: #333;
        border-radius: 5px; /* Added rounded corners */
    }

    ul.topnav li.right {float: right;}

    @media screen and (max-width: 600px) {
        ul.topnav li.right, 
        ul.topnav li {float: none;}
    }
    
    img {
        display: block;
        margin-left: auto;
        margin-right: auto;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        border: solid 1px black;
        
    }

    /* Style for the button */
    .attendance-button {
        padding: 12px 24px;
        font-size: 18px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        text-decoration: none !important; /* Ensure no underline */
        display: inline-block;
        transition: background-color 0.3s ease, transform 0.2s ease;
        
        
    }
    
    .attendance-button {
        background-color: #28a745;
        color: white;
    }

    .attendance-button:hover {
        background-color: #218838;
        transform: scale(1.05);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        color: white; /* Change text color to white on hover */
    }

    </style>
    
    <title>Home : NodeMCU</title>
</head>

<body>
    <h2></h2>
    <ul class="topnav">
        <li><a class="active" href="home.php">Home</a></li>
        <li><a href="user data.php">User Data</a></li>
        <li><a href="registration.php">Registration</a></li>
        <li><a href="read tag.php">Read Tag ID</a></li>
    </ul>
    <br>
    <img src="homepage.jpg" alter="home" width="700px">
    <h3></h3>
    <!-- Moved the button below the h3 heading -->
    <a class="attendance-button" href="attendance page.php">Attendance Page</a>
</body>
</html>