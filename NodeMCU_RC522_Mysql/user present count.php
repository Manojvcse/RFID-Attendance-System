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
            padding-bottom: 50px;
        }
        th {
            background-color: #05bd3c;
            color: #FFFFFF;
        }
        .btn-delete {
            padding: 6px 12px;
            font-size: 14px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none !important;
            display: inline-block;
            transition: background-color 0.3s ease, transform 0.2s ease;
            background-color: #d9534f;
            color: #ffffff;
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
            display: flex;
            align-items: center;
            transition: 0.3s;
        }
        .sidebar a img {
            margin-right: 8px;
            width: 22px;
            height: 22px;
        }
        .sidebar a:hover {
            background-color: #575757;
        }
        .open-btn {
            font-size: 20px;
            cursor: pointer;
            background-color: #000000;
            color: white;
            padding: 10px 30px;
            border: none;
            position: fixed;
            top: 20px;
            left: 10px;
            z-index: 1001;
            border-radius: 4px;
        }
        .main-content {
            margin-left: 260px;
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
        .total-present {
            text-align: center;
            font-size: 24px;
            margin: 20px 0;
        }
        .exit-btn {
            font-size: 20px;
            cursor: pointer;
            background-color: #ff0000;
            color: white;
            padding: 10px 30px;
            border: none;
            position: fixed;
            top: 70px;
            left: 10px;
            z-index: 1001;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div id="mySidebar" class="sidebar">
        <a href="attendance page.php">
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
                <h3 style="text-align: center; font-family: 'Arial', sans-serif; font-size: 28px; color: #333; margin-top: 20px;">USER TOTAL PRESENT</h3>
            </div>
            <div class="row">
                <div class="total-present">
                    Total No Present: 
                    <?php
                        include 'database.php';
                        $pdo = Database::connect();
                        $totalSql = 'SELECT COUNT(*) as total_present FROM attendance_rfid_list WHERE attendance="present"';
                        $totalResult = $pdo->query($totalSql)->fetch(PDO::FETCH_ASSOC);
                        echo htmlspecialchars($totalResult['total_present']);
                        Database::disconnect();
                    ?>
                </div>
            </div>
            <div class="row">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>NAME</th>
                            <th>TOTAL PRESENT</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $pdo = Database::connect();
                            $sql = 'SELECT name, COUNT(*) as total_present FROM attendance_rfid_list WHERE attendance="present" GROUP BY name ORDER BY name ASC';
                            $row_number = 1;
                            foreach ($pdo->query($sql) as $row) {
                                echo '<tr>';
                                echo '<td>'. htmlspecialchars($row_number) . '</td>';
                                echo '<td>'. htmlspecialchars($row['name']) . '</td>';
                                echo '<td>'. htmlspecialchars($row['total_present']) . '</td>';
                                echo '</tr>';
                                $row_number++;
                            }
                            Database::disconnect();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <button class="scroll-btn" onclick="scrollToTop()">↑</button>
    <button class="scroll-btn" style="bottom: 60px;" onclick="scrollToBottom()">↓</button>

    <script>
        function openNav() {
            document.getElementById("mySidebar").style.width = "250px";
            document.getElementById("main-content").style.marginLeft = "250px";
        }

        function closeNav() {
            document.getElementById("mySidebar").style.width = "0";
            document.getElementById("main-content").style.marginLeft= "0";
        }

        function scrollToTop() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        function scrollToBottom() {
            window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth' });
        }
    </script>
</body>
</html>
    <button class="scroll-btn" onclick="scrollToTop()">↑</button>
    <button class="scroll-btn" style="bottom: 60px;" onclick="scrollToBottom()">↓