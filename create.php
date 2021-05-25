<!DOCTYPE html>
<html lang="en">


<?php
require __DIR__ . '/users.php';

$accountNumber = 'LT' . 12 . 10001 . rand(10000000000, 1999999999);
$account = json_decode(file_get_contents(__DIR__.'/users.json'), true);
$newAcc = [];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if ((strlen($_POST['name']) > 3) && (strlen($_POST['surname']) > 3) && (checkID($_POST['personal_code']))) {
        foreach ($account as $key => $value){
            if ($_POST['personal_code']  == $value['ak']){
                alertFailure('Wrong data, check your data');
                return;
            }
        }
        $newAcc['name'] = ($_POST['name']);
        $newAcc['surname'] = ($_POST['surname']);
        $newAcc['ak'] = ($_POST['personal_code']);
        $newAcc['account_number'] = $accountNumber;
        $newAcc['id'] = $accountNumber;
        $newAcc['balance'] = 0;
        $account[] = $newAcc;
        file_put_contents(__DIR__ . '/users.json', json_encode($account));
        echo "<script>
alert('Account created');
window.location.href='http://localhost/nd/bank_2/';
</script>";
    } else {
        alertFailure('Added data is incorect, please try again');
    }
    
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account creation</title>
    <link rel="stylesheet" href="./main.css">
</head>
<h1 class="title">Account creation</h1>

<body>
    <div>

        <form method="post" action="">

            <label for="name">Name</label>
            <br>
            <input type="text" method="post" name="name"><br>

            <label for="surname">Surname</label>
            <br>
            <input type="text" method="post" name="surname"><br>

            <label for="account_number">Account number</label>
            <br>
            <input type="text" method="post" name="account_number" placeholder="<?= $accountNumber ?>" readonly><br>

            <label for="personal_code">Personal code</label>
            <br>
            <input type="text" method="post" name="personal_code"><br>
            <br>
            <button type="submit" name="post">Create account</button>
        </form>

        <br>
        <button class="btn btn-back">
            <a href="http://localhost/nd/bank_2/">Back to main</a>
        </button>


    </div>
</body>

</html>