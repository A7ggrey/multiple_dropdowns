<?php
// ajax.php

include 'db_config.php';

if (isset($_POST['item_id'])) {
    $item_id = $_POST['item_id'];

    //echo $item_id;

    $sql = "SELECT id, price FROM prices WHERE item_id = $item_id";
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
