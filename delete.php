<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $conn->query("DELETE FROM maharishis WHERE id = $id");
}

header("Location: admin.php");
?>