<?php
session_start();
$title = 'Регистрация';
require 'include/header.php';
require 'include/config.php';
?>

<div id="form">
    <h3>Форма за регистрация</h3>
    <hr>
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
                <div>
                    Повторете паролата:
                </div>
                <div>
                    <input type="password" name="repeatpass" placeholder="Парола" class="field1">
                </div></br>
            </div>
            <div class="reg1">
                <input type="submit" name="logIn" value="Регистрация" class="button"></br>
            </div>
            <hr>
            <div>
                <a href="login.php">Вход</a>
            </div>
            <div>
                <a href="index.php">Книги</a>
            </div>
        </div>


        <?php
        $logerror = FALSE;

        if ($_POST) {
            $user = trim(strtolower($_POST['username']));
            $pass = trim($_POST['password']);
            $rpass = trim($_POST['repeatpass']);

            $userlen = mb_strlen($user, "UTF-8");
            $passlen = mb_strlen($pass, "UTF-8");


            if ($userlen >= 3 && $passlen >= 3) {

                if (!$database_link) {

                    echo 'Грешка с базата данни';
                    exit;
                }
                if ($rpass != $pass) {
                    echo 'Паролата не съвпада!';
                }
                else {

                    $user = mysqli_real_escape_string($database_link, $user);
                    $pass = mysqli_real_escape_string($database_link, $pass);

                    $check = mysqli_query($database_link, 'SELECT * FROM users');

                    while ($data = $check->fetch_assoc()) {

                        if ($data['username'] == $user) {

                            echo 'Потребителското име е заето!';
                            $logerror = TRUE;
                            break;
                        }
                    }

                    if ($logerror == FALSE) {

                        $sql = 'INSERT INTO users (username, password) VALUES ("' . $user . '", "' . $pass . '")';

                        if (mysqli_query($database_link, $sql)) {

                            echo 'Регистрирахте се успешно!';
                            header('Location:login.php');
                        }
                        else {

                            echo 'Грешка при регистрация!';
                        }
                    }
                }
            }
            else {

                echo 'Името и паролата трябва да бъдат минимум 3 символа';
            }
        }
        ?>
</div>
<?php
require 'include/footer.php';
?>
