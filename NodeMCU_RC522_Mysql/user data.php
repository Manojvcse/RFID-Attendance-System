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
        background-color: #3e64f9; /* Matched background color */
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

    ul.topnav li a:hover:not(.active) {background-color: #1d05b8;} /* Matched hover color */

    ul.topnav li a.active {
        background-color: #333;
        border-radius: 5px; /* Added rounded corners */
    }

    ul.topnav li.right {float: right;}

    @media screen and (max-width: 600px) {
        ul.topnav li.right, 
        ul.topnav li {float: none;}
    }
    
    .table {
        margin: auto;
        width: 90%; 
    }
    
    thead {
        color: #FFFFFF;
    }

    .btn-edit, .btn-delete {
        padding: 6px 12px;
        font-size: 14px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        text-decoration: none !important; /* Ensure no underline */
        display: inline-block;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    /* Edit Button */
    .btn-edit {
        background-color: #28a745;
        color: white;
    }

    .btn-edit:hover {
        background-color: #218838;
        transform: scale(1.05);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        color: white; /* Change text color to white on hover */
    }

    /* Delete Button */
    .btn-delete {
        background-color: #dc3545;
        color: white;
    }

    .btn-delete:hover {
        background-color: #c82333;
        transform: scale(1.05);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        color: white; /* Change text color to white on hover */
    }

    /* Accessibility enhancement: focus states */
    .btn-edit:focus, .btn-delete:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.25);
    }

    </style>
    
    <title>User Data : NodeMCU</title>
</head>

<body>
    <h2></h2>
    <ul class="topnav">
        <li><a href="home.php">Home</a></li>
        <li><a class="active" href="user data.php">User Data</a></li>
        <li><a href="registration.php">Registration</a></li>
        <li><a href="read tag.php">Read Tag ID</a></li>
    </ul>
    <br>
    <div class="container">
        <div class="row">
            <h3>User Data Table</h3>
        </div>
        <div class="row">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr bgcolor="#05bd3c" color="#FFFFFF">
                        <th>Name</th>
                        <th>ID</th>
                        <th>Gender</th>
                        <th>Email</th>
                        <th>Mobile Number</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include 'database.php';
                        $pdo = Database::connect();
                        $sql = 'SELECT * FROM table_nodemcu_rfidrc522_mysql ORDER BY name ASC';
                        foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['name'] . '</td>';
                            echo '<td>'. $row['id'] . '</td>';
                            echo '<td>'. $row['gender'] . '</td>';
                            echo '<td>'. $row['email'] . '</td>';
                            echo '<td>'. $row['mobile'] . '</td>';
                            echo '<td><a class="btn-edit" href="user data edit page.php?id='.$row['id'].'">Edit</a>';
                            echo ' ';
                            echo '<a class="btn-delete" href="user data delete page.php?id='.$row['id'].'">Delete</a>';
                            echo '</td>';
                            echo '</tr>';
                        }
                        Database::disconnect();
                    ?>
                </tbody>
            </table>
        </div>
    </div> <!-- /container -->
</body>
</html>
