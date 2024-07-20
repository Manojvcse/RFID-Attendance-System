<?php
    require 'database.php';

    $id = null;
    if (!empty($_GET['id'])) {
        $id = $_GET['id'];
    }

    if ($id != null) {
        $pdo = Database::connect();
        $sql = "DELETE FROM attendance_rfid_list WHERE id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        Database::disconnect();
        header("Location: attendance page.php");
    }
?>
