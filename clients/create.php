<?php

$connection = new mysqli(
    "localhost",
    "root",
    "",
    "park"
);

$fullname = "";
$age = "";
$is_regular_customer = "";
$favorite_activity = "";
$available_discount = "";
$is_banned = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = $_POST["fullname"];
    $age = $_POST["age"];
    $is_regular_customer = $_POST["is_regular_customer"];
    $favorite_activity = $_POST["favorite_activity"];
    $available_discount = $_POST["available_discount"];
    $is_banned = $_POST["is_banned"];

    do {
        if (
            empty($fullname) ||
            empty($age) ||
            empty($is_regular_customer) ||
            empty($favorite_activity) ||
            empty($available_discount) ||
            empty($is_banned)
        ) {
            $errorMessage = "Заполните все поля";
            break;
        }

        if ($is_regular_customer !== 'Да' && $is_regular_customer !== 'Нет') {
            $errorMessage = "Введите корректные данные ('Да' или 'Нет')";
        }

        if ($is_banned !== 'Да' && $is_banned !== 'Нет') {
            $errorMessage = "Введите корректные данные ('Да' или 'Нет')";
        }

        $sql = "INSERT INTO clients (fullname, age, is_regular_customer, favorite_activity, available_discount, is_banned)" .
            "VALUES ('$fullname', '$age', '$is_regular_customer', '$favorite_activity', '$available_discount', '$is_banned')";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Неверное значение: " . $connection->error;
            break;
        }


        $fullname = "";
        $age = "";
        $is_regular_customer = "";
        $favorite_activity = "";
        $available_discount = "";
        $is_banned = "";

        $successMessage = "Успешно добавлено";

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
        <h2>Добавить</h2>

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
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">ФИО</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="fullname" value="<?php echo $fullname; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Возраст</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="age" value="<?php echo $age; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Наличие статуса постоянного клиента</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="is_regular_customer"
                        value="<?php echo $is_regular_customer; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Любимое мероприятие</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="favorite_activity"
                        value="<?php echo $favorite_activity; ?>">
                </div>
            </div><div class="row mb-3">
                <label class="col-sm-3 col-form-label">Доступные скидки</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="available_discount"
                        value="<?php echo $available_discount; ?>">
                </div>
            </div><div class="row mb-3">
                <label class="col-sm-3 col-form-label">Наличие запрета на посещение парка</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="is_banned"
                        value="<?php echo $is_banned; ?>">
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
                    <a class="btn btn-outline-primary" href="/index.php" role="button">Отменить</a>
                </div>
            </div>
        </form>
    </div>
</body>

</html>