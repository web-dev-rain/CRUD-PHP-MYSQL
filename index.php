<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Парк активного отдыха</title>
    <link rel="stylesheet" href="../park/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">

</head>

<body>

<div>

    <div class="container my-5">
        <h2>Мероприятия</h2>
        <a class="btn btn-primary" href="/activities/create.php" role="button">Добавить</a>
        <br>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Стоимость</th>
                <th>Возрастные ограничения</th>
                <th>Максимальное количество человек</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            <?php

            $connection = new mysqli(
                "localhost",
                "root",
                "",
                "park"
            );

            if ($connection->connect_error) {
                die("Connection failed: " . $connection->connect_error);
            }

            $sql = "SELECT * FROM activities";
            $result = $connection->query($sql);

            if (!$result) {
                die("Invalid query: " . $connection->error);
            }

            while ($row = $result->fetch_assoc()) {
                echo "
                    <tr>
                    <td>$row[activity_id]</td>
                    <td>$row[activity_title]</td>
                    <td>$row[price]</td>
                    <td>$row[age_restrictions]</td>
                    <td>$row[max_count_people]</td>
                    <td>
                        <a class='btn btn-primary btn-sm ' href='/activities/edit.php?activity_id=$row[activity_id]'>Изменить</a>
                        <a class='btn btn-danger btn-sm' href='/activities/delete.php?activity_id=$row[activity_id]'>Удалить</a>
                    </td>
                    </tr>
                    ";
            }

            ?>

            </tbody>
        </table>
    </div>

    <div class="container my-5">
        <h2>Скидки</h2>
        <a class="btn btn-primary" href="/discounts/create.php" role="button">Добавить</a>
        <br>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Размер скидки (%)</th>
                <th>Условия для получения</th>
                <th>Суммируется с другими скидками</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            <?php

            $connection = new mysqli(
                "localhost",
                "root",
                "",
                "park"
            );

            if ($connection->connect_error) {
                die("Connection failed: " . $connection->connect_error);
            }

            $sql = "SELECT * FROM discounts";
            $result = $connection->query($sql);

            if (!$result) {
                die("Invalid query: " . $connection->error);
            }

            while ($row = $result->fetch_assoc()) {
                echo "
                    <tr>
                    <td>$row[discount_id]</td>
                    <td>$row[discount_value]</td>
                    <td>$row[receive_conditions]</td>
                    <td>$row[is_cumulative]</td>
                    <td>
                        <a class='btn btn-primary btn-sm ' href='/discounts/edit.php?discount_id=$row[discount_id]'>Изменить</a>
                        <a class='btn btn-danger btn-sm' href='/discounts/delete.php?discount_id=$row[discount_id]'>Удалить</a>
                    </td>
                    </tr>
                    ";
            }

            ?>

            </tbody>
        </table>
    </div>

    <div class="container my-5">
        <h2>Должности</h2>
        <a class="btn btn-primary" href="/jobs/create.php" role="button">Добавить</a>
        <br>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Наименование должности</th>
                <th>Обязанности сотрудника</th>
                <th>Требуемый опыт работы</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $connection = new mysqli(
                "localhost",
                "root",
                "",
                "park"
            );

            if ($connection->connect_error) {
                die("Connection failed: " . $connection->connect_error);
            }

            $sql = "SELECT * FROM jobs";
            $result = $connection->query($sql);

            if (!$result) {
                die("Invalid query: " . $connection->error);
            }

            while ($row = $result->fetch_assoc()) {
                echo "
                    <tr>
                    <td>$row[job_id]</td>
                    <td>$row[job_title]</td>
                    <td>$row[responsibilities]</td>
                    <td>$row[work_experience]</td>
                    <td>
                        <a class='btn btn-primary btn-sm ' href='/jobs/edit.php?job_id=$row[job_id]'>Изменить</a>
                        <a class='btn btn-danger btn-sm' href='/jobs/delete.php?job_id=$row[job_id]'>Удалить</a>
                    </td>
                    </tr>
                    ";
            }

            ?>

            </tbody>
        </table>
    </div>

    <div class="container my-5">
        <h2>Посетители</h2>
        <a class="btn btn-primary" href="/clients/create.php" role="button">Добавить</a>
        <br>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>ФИО</th>
                <th>Возраст</th>
                <th>Наличие статуса постоянного клиента</th>
                <th>Доступные скидки</th>
                <th>Любимое мероприятие</th>
                <th>Наличие запрета</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $connection = new mysqli(
                "localhost",
                "root",
                "",
                "park"
            );

            if ($connection->connect_error) {
                die("Connection failed: " . $connection->connect_error);
            }

            $sql = "SELECT * FROM clients";
            $result = $connection->query($sql);

            if (!$result) {
                die("Invalid query: " . $connection->error);
            }

            while ($row = $result->fetch_assoc()) {
                echo "
                    <tr>
                    <td>$row[client_id]</td>
                    <td>$row[fullname]</td>
                    <td>$row[age]</td>
                    <td>$row[is_regular_customer]</td>
                    <td>$row[available_discount]</td>
                    <td>$row[favorite_activity]</td>     
                    <td>$row[is_banned]</td>
                    <td>
                        <a class='btn btn-primary btn-sm ' href='/clients/edit.php?client_id=$row[client_id]'>Изменить</a>
                        <a class='btn btn-danger btn-sm' href='/clients/delete.php?client_id=$row[client_id]'>Удалить</a>
                    </td>
                    </tr>
                    ";
            }

            ?>

            </tbody>
        </table>
    </div>

    <div class="container my-5">
        <h2>Сотрудники</h2>
        <a class="btn btn-primary" href="/employees/create.php" role="button">Добавить</a>
        <br>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>ФИО</th>
                <th>Возраст</th>
                <th>Должность</th>
                <th>Номер телефона</th>
                <th>Email</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $connection = new mysqli(
                "localhost",
                "root",
                "",
                "park"
            );

            if ($connection->connect_error) {
                die("Connection failed: " . $connection->connect_error);
            }

            $sql = "SELECT * FROM employees";
            $result = $connection->query($sql);

            if (!$result) {
                die("Invalid query: " . $connection->error);
            }

            while ($row = $result->fetch_assoc()) {
                echo "
                    <tr>
                    <td>$row[employee_id]</td>
                    <td>$row[fullname]</td>
                    <td>$row[age]</td>
                    <td>$row[position]</td>
                    <td>$row[phone]</td>
                    <td>$row[email]</td>     
                    <td>
                        <a class='btn btn-primary btn-sm ' href='/employees/edit.php?employee_id=$row[employee_id]'>Изменить</a>
                        <a class='btn btn-danger btn-sm' href='/employees/delete.php?employee_id=$row[employee_id]'>Удалить</a>
                    </td>
                    </tr>
                    ";
            }

            ?>

            </tbody>
        </table>
    </div>

</div>

</body>

</html>