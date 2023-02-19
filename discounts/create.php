<?php

$connection = new mysqli(
    "localhost",
    "root",
    "",
    "park"
);

$discount_value = "";
$receive_conditions = "";
$is_cumulative = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $discount_value = $_POST["discount_value"];
    $receive_conditions = $_POST["receive_conditions"];
    $is_cumulative = $_POST["is_cumulative"];

    do {
        if (
            empty($discount_value) ||
            empty($receive_conditions) ||
            empty($is_cumulative)
        ) {
            $errorMessage = "Заполните все поля";
            break;
        }

        if ($is_cumulative !== 'Да' && $is_cumulative !== 'Нет') {
            $errorMessage = "Введите корректные данные ('Да' или 'Нет')";
            break;
        }

        $sql = "INSERT INTO discounts (discount_value, receive_conditions, is_cumulative)" .
            "VALUES ('$discount_value', '$receive_conditions', '$is_cumulative')";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Неверное значение: " . $connection->error;
            break;
        }


        $discount_value = "";
        $receive_conditions = "";
        $is_cumulative = "";

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
            <label class="col-sm-3 col-form-label">Размер скидки (%)</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="discount_value"
                       value="<?php echo $discount_value; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Условия для получения</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="receive_conditions"
                       value="<?php echo $receive_conditions; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Суммируется ли с другими</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="is_cumulative" value="<?php echo $is_cumulative; ?>">
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