<?php

$connection = new mysqli(
    "localhost",
    "root",
    "",
    "park"
);

$discount_id = "";
$discount_value = "";
$receive_conditions = "";
$is_cumulative = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (!isset($_GET["discount_id"])) {
        header("location: /index.php");
        exit;
    }

    $discount_id = $_GET["discount_id"];

    $sql = "SELECT * FROM discounts WHERE discount_id=$discount_id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: /index.php");
        exit;
    }

    $discount_value = $row["discount_value"];
    $receive_conditions = $row["receive_conditions"];
    $is_cumulative = $row["is_cumulative"];
} else {

    $discount_id = $_POST["discount_id"];
    $discount_value = $_POST["discount_value"];
    $receive_conditions = $_POST["receive_conditions"];
    $is_cumulative = $_POST["is_cumulative"];

    do {
        if (
            empty($discount_id) ||
            empty($discount_value) ||
            empty($receive_conditions) ||
            empty($is_cumulative)
        ) {
            $errorMessage = "Все поля должны быть заполнены";
            break;
        }

        $sql = "UPDATE discounts " .
            "SET discount_value = '$discount_value', receive_conditions = '$receive_conditions', is_cumulative = '$is_cumulative'" .
            "WHERE discount_id = $discount_id";

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
        <input type="hidden" name="discount_id" value="<?php echo $discount_id; ?>">
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Размер (%)</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="discount_value" value="<?php echo $discount_value; ?>">
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
            <label class="col-sm-3 col-form-label">Суммируется ли с другими скидками</label>
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