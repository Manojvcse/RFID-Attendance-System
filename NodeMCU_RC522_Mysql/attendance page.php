<?php
    $Write="<?php $" . "UIDresult=''; " . "echo $" . "UIDresult;" . " ?>";
    file_put_contents('UIDContainer.php', $Write);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            position: relative;
            min-height: 100vh;
            margin: 0;
            padding-bottom: 50px; /* Prevent footer overlap */
        }
        th {
            background-color: #05bd3c;
            color: #FFFFFF;
        }
        .btn-delete {
            background-color: transparent;
            color: #000000; /* Default text color */
            border: none;
            padding: 0; /* Remove padding */
            font-size: inherit;
            text-decoration: none; /* Remove underline */
            cursor: pointer; /* Keep pointer cursor for better UX */
        }
        .btn-delete:hover {
            text-decoration: none; /* Ensure no underline on hover */
            color: red; /* Change text color to red on hover */
        }
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #333;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
        }
        .sidebar a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 18px;
            color: #ffffff;
            display: flex; /* Use flexbox for alignment */
            align-items: center; /* Center items vertically */
            transition: 0.3s;
        }
        .sidebar a img {
            margin-right: 8px; /* Space between icon and text */
            width: 22px; /* Set the size of the icon */
            height: 22px; /* Set the size of the icon */
        }
        .sidebar a:hover {
            background-color: #575757;
        }
        .open-btn {
            font-size: 20px;
            cursor: pointer;
            background-color: #000000; /* Changed to black */
            color: white;
            padding: 10px 30px; /* Increased width */
            border: none;
            position: fixed;
            top: 20px;
            left: 10px;
            z-index: 1001;
            border-radius: 4px; /* Added border-radius for better aesthetics */
        }
        .main-content {
            margin-left: 260px; /* Same width as the sidebar + some margin */
            padding: 20px;
            transition: margin-left 0.5s;
        }
        .scroll-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 8px 12px;
            cursor: pointer;
            font-size: 16px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        .scroll-btn:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }
        .search-container {
            float: right;
            margin-top: 10px;
            margin-right: 20px;
            display: flex;
            align-items: center;
        }
        .search-container input[type=text] {
            padding: 4px 8px; /* Smaller padding for smaller size */
            font-size: 14px; /* Smaller font size */
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-right: 10px; /* Add margin to separate from button */
        }
        .search-container button {
            padding: 4px 8px; /* Smaller padding for smaller size */
            background: #05bd3c;
            font-size: 14px; /* Smaller font size */
            border: none;
            cursor: pointer;
            border-radius: 4px;
            color: white;
        }
        .search-container button:hover {
            background: #0056b3;
        }
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            .main-content {
                margin-left: 0;
            }
            .open-btn {
                position: relative;
                top: 0;
                left: 0;
            }
            .search-container {
                margin-top: 0;
                margin-right: 0;
                justify-content: center;
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div id="mySidebar" class="sidebar">
        <a href="home.php">
            <img src="home icon.png" alt="Home Icon">
            Home
        </a>
        <a href="user present count.php">
            <img src="users.png" alt="Present Icon">
            No of Present
        </a>
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">
            <img src="exit.png" alt="Exit Icon">
            Exit
        </a>
    </div>
    <button class="open-btn" onclick="openNav()">☰</button>
    
    <div class="main-content">
        <div class="container">
            <div class="row">
               <h3 style="text-align: center; font-family: 'Arial', sans-serif; font-size: 28px; color: #333; margin-top: 20px;">USER PRESENT TABLE</h3>
                <div class="search-container">
                    <input type="text" id="searchInput" placeholder="Search by name..." oninput="searchTable()">
                    <button onclick="searchTable()">Search</button>
                </div>
            </div>
            <div class="row">
                <table class="table table-striped table-bordered" id="dataTable">
                    <thead>
                        <tr>
                            <th>RO NO</th>
                            <th>ID</th>
                            <th>NAME</th>
                            <th>DATE</th>
                            <th>ATTENDANCE</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            include 'database.php';
                            $pdo = Database::connect();
                            $sql = 'SELECT * FROM attendance_rfid_list ORDER BY name ASC';
                            $row_number = 1;
                            foreach ($pdo->query($sql) as $row) {
                                echo '<tr>';
                                echo '<td>'. htmlspecialchars($row_number) . '</td>';
                                echo '<td>'. htmlspecialchars($row['id']) . '</td>';
                                echo '<td>'. htmlspecialchars($row['name']) . '</td>';
                                echo '<td>'. htmlspecialchars($row['date']) . '</td>';
                                echo '<td>'. htmlspecialchars($row['attendance']) . '</td>';
                                echo '<td>';
                                echo '<a class="btn-delete" href="delete.php?id='. htmlspecialchars($row['id']) .'">Delete</a>';
                                echo '</td>';
                                echo '</tr>';
                                $row_number++;
                            }
                            Database::disconnect();
                        ?>
                    </tbody>
                </table>
            </div>
        </div> <!-- /container -->
    </div>

    <script>
        function openNav() {
            document.getElementById("mySidebar").style.width = "250px";
            document.querySelector('.main-content').style.marginLeft = "260px";
        }

        function closeNav() {
            document.getElementById("mySidebar").style.width = "0";
            document.querySelector('.main-content').style.marginLeft= "10px";
        }

        function scrollToTop() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        function scrollToBottom() {
            window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth' });
        }

        function searchTable() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("dataTable");
            tr = table.getElementsByTagName("tr");

            for (i = 1; i < tr.length; i++) { // Start from 1 to skip header row
                td = tr[i].getElementsByTagName("td")[2]; // Column index for NAME
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
</body>
</html>
    <button class="scroll-btn" onclick="scrollToTop()">↑</button>
    <button class="scroll-btn" style="bottom: 60px;" onclick="scrollToBottom()">↓

