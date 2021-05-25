<?php
function getUsers()
{
    return json_decode(file_get_contents(__DIR__ . '/users.json'), true);
}

function getUserById($id)
{
    $users = getUsers();
    foreach ($users as $user) {
        if ($user['id'] == $id) {
            return $user;
        }
    }
    return null;
}

function getAccount($id)
{
    $users = getUsers();
    foreach ($users as $user) {
        if ($user['id'] == $id) {
            return $user['balance'];
        }
    }
    return null;
}
function addToAccount($data, $id)
{

}


function createUser($data)
{
}



function deleteUser($id)
{
}

function alertSuccess($message) {
  ?> <div class="alert-positive">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
  <?= $message ?>
</div>
<?php
}
function alertFailure($message) {
    ?> <div class="alert-negative">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
  <?= $message ?>
</div>
<?php

}

function checkID($ID){
    $valid = false;
    if (strlen($ID) == 11) {
        if ($ID[0] > 2 && $ID[0] < 7) {
            if (checkdate(substr($ID, 3, 2), substr($ID, 5, 2), substr($ID, 1, 2))) {
                $str = $ID[0] * 1 + $ID[1] * 2 + $ID[2] * 3 + $ID[3] * 4 + $ID[4] * 5 + $ID[5] * 6 + $ID[6] * 7 + $ID[7] * 8 + $ID[8] * 9 + $ID[9] * 1;
                $str = $str % 11;
                if ($str == 10) {
                    $str = $ID[0] * 3 + $ID[1] * 4 + $ID[2] * 5 + $ID[3] * 6 + $ID[4] * 7 + $ID[5] * 8 + $ID[6] * 9 + $ID[7] * 1 + $ID[8] * 2 + $ID[9] * 3;
                    $str = $str % 11;
                    if ($str == 10 && substr($ID, 10, 1) == "0")
                        $valid = true;
                    elseif ($str == substr($ID, 10, 1))
                        $valid = true;
                } elseif ($str == substr($ID, 10, 1))
                    $valid = true;
            }
        }
    }
    return $valid;
}