<?php

$connection = new mysqli(
    "localhost",
    "root",
    "",
    "park"
);

$activity_id = "";
$activity_title = "";
$price = "";
$age_restrictions = "";
$max_count_people = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (!isset($_GET["activity_id"])) {
        header("location: /index.php");
        exit;
    }

    $activity_id = $_GET["activity_id"];

    $sql = "SELECT * FROM activities WHERE activity_id=$activity_id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: /index.php");
        exit;
    }

    $activity_title = $row["activity_title"];
    $price = $row["price"];
    $age_restrictions = $row["age_restrictions"];
    $max_count_people = $row["max_count_people"];

} else {

    $activity_id = $_POST["activity_id"];
    $activity_title = $_POST["activity_title"];
    $price = $_POST["price"];
    $age_restrictions = $_POST["age_restrictions"];
    $max_count_people = $_POST["max_count_people"];

    do {
        if (
                empty($activity_id) ||
                empty($activity_title) ||
                empty($price) ||
                empty($age_restrictions) ||
                empty($max_count_people)
        ) {
            $errorMessage = "Все поля должны быть заполнены";
            break;
        }

        $sql = "UPDATE activities " .
            "SET activity_title = '$activity_title', 
            price = '$price', 
            age_restrictions = '$age_restrictions', 
            max_count_people = '$max_count_people' " .
            "WHERE activity_id = $activity_id";

        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $successMessage = "Успешно обновлено";

        header("location: /index.php");
        exit;

    } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Парк активного отдыха</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container my-5">
        <h2>Изменить данные</h2>

        <?php
        if (!empty($errorMessage)) {
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        ?>

        <form method="post">
            <input type="hidden" name="activity_id" value="<?php echo $activity_id; ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Название</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="activity_title" value="<?php echo $activity_title; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Стоимость</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="price" value="<?php echo $price; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Возрастные ограничения</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="age_restrictions" value="<?php echo $age_restrictions; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Максимальное количество человек</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="max_count_people" value="<?php echo $max_count_people; ?>">
                </div>
            </div>

            <?php
            if (!empty($successMessage)) {
                echo "
                <div class='row mb-3'>
                    <div class='offset-sm-3 col-sm-6'>
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong>$successMessage</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                    </div>
                </div>
                ";
            }
            ?>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Подтвердить</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/park/index.php" role="button">Отменить</a>
                </div>
            </div>
        </form>
    </div>
</body>

</html>