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

$users = getUserById($userId);

$balance = getAccount($userId);
$data = file_get_contents('users.json');
$clients = json_decode($data);
// echo '<pre>';
// print_r($clients);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (is_numeric($_POST['deduct_amount']) && $_POST['deduct_amount'] >= 0 ) {
    foreach ($clients as $value) {
        
            if ($value->id == $userId) {
                if (((float)$value->balance - (float)$_POST['deduct_amount']) > 0) {
                    (float)$value->balance -= (float)$_POST['deduct_amount'];
                    file_put_contents(__DIR__ . '/users.json', json_encode($clients), 1); // JSON_PRETTY_PRINT kad graziai sudetu, pasiziureti pretty print funkcija);
                    alertSuccess('Funds deducted successfully!');
                    $balance = getAccount($userId);
                    -(float)$_POST['deduct_amount'];
                } else {
                    $value->balance = 0;
                    file_put_contents(__DIR__ . '/users.json', json_encode($clients), 1); // JSON_PRETTY_PRINT kad graziai sudetu, pasiziureti pretty print funkcija);
                    alertFailure('You account cannot be negative, your new balance is 0!');
                    $balance = 0;
                    
                }
            }
        } 
    } else {
        alertFailure('Failed to deduct funds, please add valid number!');
    }
}

?>
<div class="title">
<h1 >Deduct funds from <?= $users['name'] ?></h1>
<h2 >Client info</h2>
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
    Balance:<b> <?php echo $balance; ?> Eur </b>
    <br>
    <br>
</div>


<div>

    <form method="post" action="./deduct.php?id=<?= $userId ?>">

        <label for="deduct_amount">How much to deduct?</label>
        <br>
        <input type="float" method="post" name="deduct_amount" placeholder="Amount in Eur"><br>
        <br>
        <button type="submit" name="post">Deduct funds</button>

    </form>
    <br>
    <button class="btn btn-back">
        <a href="http://localhost/nd/bank_2/">Back to main</a>
    </button>


</div>