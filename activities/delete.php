<?php
if (isset($_GET["activity_id"])) {
    $activity_id = $_GET["activity_id"];
    $connection = new mysqli(
        "localhost",
        "root",
        "",
        "park"
    );

    $sql = "DELETE FROM activities WHERE activity_id=$activity_id";
    $connection->query($sql);

    header("location: /index.php");
    exit;
}
?>