<?php
if (isset($_GET["employee_id"])) {
    $employee_id = $_GET["employee_id"];

    $connection = new mysqli(
        "localhost",
        "root",
        "",
        "park"
    );

    $sql = "DELETE FROM employees WHERE employee_id=$employee_id;";
    $connection->query($sql);

    header("location: /index.php");
    exit;
}
?>