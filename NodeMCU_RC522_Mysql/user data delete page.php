<?php
    require 'database.php';
    $id = 0;
     
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( !empty($_POST)) {
        // keep track post values
        $id = $_POST['id'];
         
        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM table_nodemcu_rfidrc522_mysql  WHERE id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        Database::disconnect();
        header("Location: user data.php");
         
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/bootstrap.min.js"></script>
    <title>Delete : NodeMCU V3 ESP8266 / ESP12E with MYSQL Database</title>
</head>
 
<body>
    <h2 align="center"></h2>

    <div class="container">
        <div class="span10 offset1">
            <div class="row">
                <h3 align="center">Delete User</h3>
            </div>

            <form id="deleteForm" class="form-horizontal" action="user data delete page.php" method="post">
                <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                <p class="alert alert-error">Are you sure to delete?</p>
                <div class="form-actions">
                    <button type="button" id="confirmDelete" class="btn btn-danger">Yes</button>
                    <a class="btn" href="user data.php">No</a>
                </div>
            </form>
        </div>
    </div> <!-- /container -->

    <script>
        document.getElementById('confirmDelete').addEventListener('click', function(event) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Deleted!',
                        text: 'Your file has been deleted.',
                        icon: 'success'
                    }).then(() => {
                        document.getElementById('deleteForm').submit();
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire({
                        title: 'Cancelled',
                        text: 'Your data is safe :)',
                        icon: 'error'
                    });
                }
            });
        });
    </script>
</body>
</html>
