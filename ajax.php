<?php
// ajax.php

include 'db_config.php';

if (isset($_POST['category_id'])) {
    $category_id = $_POST['category_id'];

    $sql = "SELECT id, name FROM subcategories WHERE category_id = $category_id";
    $result = mysqli_query($conn, $sql);

    $subcategories = array();

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $subcategories[] = $row;
        }
    }

    echo json_encode($subcategories);
}

mysqli_close($conn);
?>
