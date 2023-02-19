<?php
if (isset($_GET["client_id"])) {
    $client_id = $_GET["client_id"];

    $connection = new mysqli(
        "localhost",
        "root",
        "",
        "park"
    );

    $sql = "DELETE FROM clients WHERE client_id=$client_id;";
    $connection->query($sql);

    header("location: /index.php");
    exit;
}
?>