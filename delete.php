<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Greatest bank in the west</title>
    <link rel="stylesheet" href="./main.css">
</head>
<?php
require __DIR__ . '/users.php';

$userId = $_GET['id'];

$user = getUserById($userId);

$users = getUserById($userId);

$data = file_get_contents('users.json');

$clients = json_decode($data);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($users['balance'] == 0) {
        foreach ($clients as $key => $value) {
            if ($value->id == $userId) {
                array_splice($clients, $key, 1);
                alertSuccess('Account deleted successfully');
                file_put_contents(__DIR__ . '/users.json', json_encode($clients), 1);
                header("Location: http://localhost/nd/bank_2/");
                die;
            }
        }
    } else {
        alertFailure('Account balance must be 0, deduct remaining funds first!');
    }
}
?>
<div class="title">
<h1 >Delete account of <?= $users['name'] ?></h1>
<h2>Client info</h2>
</div>
<div>
    
    Name: <b> <?= $users['name'] ?> </b>
    <br>
    Surname: <b> <?= $users['surname'] ?></b>
    <br>
    PC: <b> <?= $users['ak'] ?> </b>
    <br>
    Account number: <b><?= $users['id'] ?> </b>
    <br>
    Balance:<b> <b><?= $users['balance'] ?> </b>
        <br>
        <br>
</div>

<div>

    <form method="post" action="./delete.php?id=<?= $userId ?>">

        <label for="delete_confirm">Are you really whant to delete account?</label>
        <br>
        <br>
        <button type="submit" name="post">DELETE</button>

    </form>
    <br>
    <button class="btn btn-back">
        <a href="http://localhost/nd/bank_2/">Back to main</a>
    </button>


</div>

