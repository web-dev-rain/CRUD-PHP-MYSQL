<?php

$connection = new mysqli(
    "localhost",
    "root",
    "",
    "park"
);

$job_title = "";
$responsibilities = "";
$work_experience = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $job_title = $_POST["job_title"];
    $responsibilities = $_POST["responsibilities"];
    $work_experience = $_POST["work_experience"];

    do {
        if (
            empty($job_title) ||
            empty($responsibilities) ||
            empty($work_experience)
        ) {
            $errorMessage = "Заполните все поля";
            break;
        }

        $sql = "INSERT INTO jobs (job_title, responsibilities, work_experience)" .
            "VALUES ('$job_title', '$responsibilities', '$work_experience')";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Неверное значение: " . $connection->error;
            break;
        }


        $job_title = "";
        $responsibilities = "";
        $work_experience = "";

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
            <label class="col-sm-3 col-form-label">Наименование</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="job_title"
                       value="<?php echo $job_title; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Обязанности</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="responsibilities"
                       value="<?php echo $responsibilities; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Требуемый опыт</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="work_experience" value="<?php echo $work_experience; ?>">
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