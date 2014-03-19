<?php
    session_start();
    $title = 'Вход';
    require 'header.php';
    //echo '<pre>'.print_r($_SESSION['logged'],true).'<pre>';
?>

    <body>
        
        <div id="form">
         <form method="POST">
            <div class="data">
                <div>
                    Потребител:
                </div>
                <div>
                    <input type="text" name="user" action="index.php" placeholder="Потребителско име" class="field"></br>
                    (по подразбиране: user)
                </div></br>             
            </div>
            <div>
                <div class="data">
                    <div>
                        Парола:
                    </div>
                    <div>
                        <input type="password" name="pass" placeholder="Парола" class="field"></br>
                        (по подразбиране: qwerty)
                    </div></br>
                </div>
                <div class="data">
                    <input type="submit" name="logIn" value="Вход" class="button">
                </div>
                <div class="reg">
                    <a href="registration.php">Регистрация</a>
                </div>
            </div>
         </form>
        </div>
        
        <?php

        $error = true;
        
        if($_POST)
        {
            $username = strtolower(trim($_POST['user']));
            $password = trim($_POST['pass']);

            if ($username == "user" && $password == "qwerty") {
                    $_SESSION['logged'] = true;
                    $error=false;
                    file_put_contents('loggedName.txt', $_POST['user']);
                }
            else if (file_exists('userDatabase.txt')) {
                
                file_get_contents('userDatabase.txt');
                $userdata = file('userDatabase.txt');

                foreach ($userdata as $value) {
                
                $Row = explode('|', $value);

                    if ($username == $Row[0] && $password == $Row[1]) {
                        
                            $_SESSION['logged'] = true;
                            $error=false;
                            file_put_contents('loggedName.txt', $_POST['user']);
                    }
                    
                    else {
                        
                        $error = true;
                    }
                }
            }
            if ($error == true) {
                echo 'Невалидни данни!';
            }
        }
        if ($_SESSION) 
        {
            if ($_SESSION['logged'] == true) 
            {
               header('Location:files.php');
            }
        }
        
        ?>
        
    </body>
</html>
