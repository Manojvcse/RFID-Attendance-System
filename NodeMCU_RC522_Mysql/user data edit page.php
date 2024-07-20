<?php
    require 'database.php';
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM table_nodemcu_rfidrc522_mysql where id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();
?>

<!DOCTYPE html>
<html lang="en">
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        html {
            font-family: Arial;
            display: inline-block;
            margin: 0px auto;
        }
        
        textarea {
            resize: none;
        }

        ul.topnav {
            list-style-type: none;
            margin: auto;
            padding: 0;
            overflow: hidden;
            background-color: #4CAF50;
            width: 70%;
        }

        ul.topnav li {float: left;}

        ul.topnav li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        ul.topnav li a:hover:not(.active) {background-color: #3e8e41;}

        ul.topnav li a.active {background-color: #333;}

        ul.topnav li.right {float: right;}

        @media screen and (max-width: 600px) {
            ul.topnav li.right, 
            ul.topnav li {float: none;}
        }

        .btn-update, .btn-back {
    padding: 8px 16px;          /* Increased padding for better clickability */
    font-size: 14px;            /* Slightly larger font for better readability */
    border: none;
    border-radius: 4px;
    cursor: pointer;
    text-decoration: none;      /* Ensure no underline */
    display: inline-block;      /* Ensure buttons are block elements for consistency */
    transition: background-color 0.3s ease, transform 0.2s ease; /* Smooth transitions */
    margin-right: 10px;         /* Add margin between buttons */
}

/* Update Button */
.btn-update {
    background-color: #28a745; /* Attractive green */
    color: white;              /* Ensure text is white */
}

.btn-update:hover {
    background-color: #218838; /* Darker green on hover */
    transform: scale(1.05);    /* Slightly increase size on hover for feedback */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Subtle shadow on hover */
    text-decoration: none;     /* Remove underline on hover */
}

/* Back Button */
.btn-back {
    background-color: #dc3545; /* Attractive red */
    color: white;              /* Ensure text is white */
}

.btn-back:hover {
    background-color: #c82333; /* Darker red on hover */
    transform: scale(1.05);    /* Slightly increase size on hover for feedback */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Subtle shadow on hover */
    text-decoration: none;     /* Remove underline on hover */
    color: white;              /* Change text color to white on hover */
}



    </style>
    
    <title>Edit : NodeMCU V3 ESP8266 / ESP12E with MYSQL Database</title>
    
</head>

<body>

    <h2 align="center"></h2>
    
    <div class="container">
 
        <div class="center" style="margin: 0 auto; width:495px; border-style: solid; border-color: #f2f2f2;">
            <div class="row">
                <h3 align="center">Edit User Data</h3>
                <p id="defaultGender" hidden><?php echo $data['gender'];?></p>
            </div>
     
            <form id="updateForm" class="form-horizontal" action="user data edit tb.php?id=<?php echo $id?>" method="post">
                <div class="control-group">
                    <label class="control-label">ID</label>
                    <div class="controls">
                        <input name="id" type="text"  placeholder="" value="<?php echo $data['id'];?>" readonly>
                    </div>
                </div>
                
                <div class="control-group">
                    <label class="control-label">Name</label>
                    <div class="controls">
                        <input name="name" type="text"  placeholder="" value="<?php echo $data['name'];?>" required>
                    </div>
                </div>
                
                <div class="control-group">
                    <label class="control-label">Gender</label>
                    <div class="controls">
                        <select name="gender" id="mySelect">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                </div>
                
                <div class="control-group">
                    <label class="control-label">Email Address</label>
                    <div class="controls">
                        <input name="email" type="text" placeholder="" value="<?php echo $data['email'];?>" required>
                    </div>
                </div>
                
                <div class="control-group">
                    <label class="control-label">Mobile Number</label>
                    <div class="controls">
                        <input name="mobile" type="text"  placeholder="" value="<?php echo $data['mobile'];?>" required>
                    </div>
                </div>
                
                <div class="form-actions">
                    <button type="button" id="updateButton" class="btn-update">Update</button>
                    <a class="btn-back" href="user data.php">Back</a>
                </div>
            </form>
        </div>               
    </div> <!-- /container -->    
    
    <script>
        var g = document.getElementById("defaultGender").innerHTML;
        if(g=="Male") {
            document.getElementById("mySelect").selectedIndex = "0";
        } else {
            document.getElementById("mySelect").selectedIndex = "1";
        }

        document.getElementById('updateButton').addEventListener('click', function(event) {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Your work has been updated',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                document.getElementById('updateForm').submit();
            });
        });
    </script>
</body>
</html>
