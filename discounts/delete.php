<?php
if (isset($_GET["discount_id"])) {
    $discount_id = $_GET["discount_id"];

    $connection = new mysqli(
        "localhost",
        "root",
        "",
        "park"
    );

    $sql = "DELETE FROM discounts WHERE discount_id=$discount_id";
    $connection->query($sql);

    header("location: /index.php");
    exit;
}
?>