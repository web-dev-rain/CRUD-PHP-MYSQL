<?php
if (isset($_GET["job_id"])) {
    $job_id = $_GET["job_id"];

    $connection = new mysqli(
        "localhost",
        "root",
        "",
        "park"
    );

    $sql = "DELETE FROM jobs WHERE job_id=$job_id";
    $connection->query($sql);

    header("location: /index.php");
    exit;
}
?>