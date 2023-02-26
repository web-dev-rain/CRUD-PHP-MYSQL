<?php
$connection = new mysqli(
    "localhost",
    "root",
    "",
    "park");

$position_title = "";
$duties = "";
$min_experience = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $position_title = $_POST["position_title"];
    $duties = $_POST["duties"];
    $min_experience = $_POST["min_experience"];

    do {
        if (
            empty($position_title) ||
            empty($duties) ||
            empty($min_experience)
        ) {
            $errorMessage = "Все поля должны быть заполнены";
            break;
        }

        $sql = "INSERT INTO positions (position_title, duties, min_experience)" .
            "VALUES ('$position_title', '$duties', '$min_experience')";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Неверное значение: " . $connection->error;
            break;
        }


        $position_title = "";
        $duties = "";
        $min_experience = "";

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
            <label class="col-sm-3 col-form-label">Должность</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="position_title" value="<?php echo $position_title; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Обязанности</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="position_title" value="<?php echo $duties; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Требуемый опыт</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="age_restrictions"
                       value="<?php echo $min_experience; ?>">
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