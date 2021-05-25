<?php
require 'users.php';

$users = getUsers();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Greatest bank in the west</title>
    <link rel="stylesheet" href="./main.css">
</head>

<body>

    <div class="title">
        <h1>Greatest bank in the west</h1>
        <h2>Current accounts</h2>
        
    </div>
    
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Surname</th>
                <th>P/C</th>
                <th>Account number</th>
                <th>Balance</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user) : ?>
                <tr>
                    <td><?php echo $user['name'] ?></td>
                    <td><?php echo $user['surname'] ?></td>
                    <td><?php echo $user['ak'] ?></td>
                    <td><?php echo $user['account_number'] ?></td>
                    <td><?php echo $user['balance'] ?> Eur</td>
                    <td>
                        <button class="btn btn-delete">
                            <a href="delete.php?id=<?php echo $user['id'] ?>">Delete</a>
                        </button>
                        <button class="btn btn-delete">
                            <a href="add.php?id=<?php echo $user['id'] ?>">Add funds</a>
                        </button>
                        <button class="btn btn-delete">
                            <a href="deduct.php?id=<?php echo $user['id'] ?>">Deduct funds</a>
                        </button>
                    </td>
                </tr>
            <?php endforeach;; ?>
        </tbody>
    </table>
    <br>
    <button class="btn btn-create_account">
        <a href="create.php"> Create new account </a>
    </button>

</body>

</html>