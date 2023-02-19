<?php

$connection = new mysqli(
    "localhost",
    "root",
    "",
    "park"
);

$fullname = "";
$age = "";
$position = "";
$phone = "";
$email = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = $_POST["fullname"];
    $age = $_POST["age"];
    $position = $_POST["position"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];

    do {
        if (
            empty($fullname) ||
            empty($age) ||
            empty($position) ||
            empty($phone) ||
            empty($email)
        ) {
            $errorMessage = "Заполните все поля";
            break;
        }

        if (!(preg_match("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i", $email))) {
            $errorMessage = "Некорректный email";
            break;
        }

        $sql = "INSERT INTO employees (fullname, age, position, phone, email)" .
            "VALUES ('$fullname', '$age', '$position', '$phone', '$email')";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Неверное значение: " . $connection->error;
            break;
        }


        $fullname = "";
        $age = "";
        $position = "";
        $phone = "";
        $email = "";

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
                <label class="col-sm-3 col-form-label">Должность</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="position" value="<?php echo $position; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Телефон</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="phone" value="<?php echo $phone; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
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