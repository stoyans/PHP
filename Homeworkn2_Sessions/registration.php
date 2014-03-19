<?php
session_start();
$title = 'Регистрация';
require 'header.php';
?>

    <body>
        
        <div id="form">
         <form method="POST">
            <div class="data">
                <div>
                    Потребител:
                </div>
                <div>
                    <input type="text" name="username" action="index.php" placeholder="Потребителско име" class="field1">
                </div></br>             
            </div>
            <div>
                <div class="data">
                    <div>
                        Парола:
                    </div>
                    <div>
                        <input type="password" name="password" placeholder="Парола" class="field1">
                    </div></br>
                </div>
                <div class="reg1">
                    <input type="submit" name="logIn" value="Регистрация" class="button"></br>
                </div>
                <div class="reg2">
                    <a href="index.php">Вход</a>
                </div>
            </div>
        </div>
</html>

<?php

$logerror = FALSE;

if ($_POST) {
    $user = trim(strtolower($_POST['username']));
    $pass = trim($_POST['password']);
    $userFolder = "$user.upload";
    
    if (strlen($user) > 3 && strlen($pass) > 3) {
        
        if (file_exists('userDatabase.txt')) {
            
            file_get_contents('userDatabase.txt');
            $userCheck = file('userDatabase.txt');

            foreach ($userCheck as $value) {
                
                $data = explode('|', $value);

                    if (strtolower($user) == strtolower($data[0])) {                     
                        $logerror = TRUE;
                    }
            }           
        }
        
        if ($logerror == FALSE) {
                
            echo 'Регистрирахте се успешно!';
            $data = $user.'|'.$pass.'|'.$userFolder.'|'."\n";
            mkdir($userFolder);
            file_put_contents('userDatabase.txt', $data, FILE_APPEND);
        }
        else {
            echo 'Потребител с това име вече същестува!';
        }
    }
    
    else {
        
        echo 'Името и паролата трябва да бъдат > 3 символа';  
    } 
}

?>