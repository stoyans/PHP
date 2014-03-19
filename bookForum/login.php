<?php
session_start();
$title = 'Вход';
require 'include/header.php';
require 'include/config.php';
//echo '<pre>'.print_r($data,true).'<pre>';
?>

<div id="form1">
    <h3>Добре дошли!</h3>

    <hr>
    <form method="POST">
        <div class="data">
            <div>
                Потребител:
            </div>
            <div>
                <input type="text" name="user" action="index.php" placeholder="Потребителско име" class="field"></br>
            </div></br>             
        </div>
        <div>
            <div class="data">
                <div>
                    Парола:
                </div>
                <div>
                    <input type="password" name="pass" placeholder="Парола" class="field"></br>
                </div></br>
            </div>
            <div class="data">
                <input type="submit" name="logIn" value="Вход" class="button">
            </div>
            <hr>
            <div>
                <a href="registration.php">Регистрация</a>
            </div>
            <div>
                <a href="index.php">Книги</a>
            </div>
        </div>
    </form>


    <?php
    $error = FALSE;

    if ($_POST) {
        $username = mysqli_real_escape_string($database_link, strtolower(trim($_POST['user'])));
        $password = mysqli_real_escape_string($database_link, trim($_POST['pass']));

        $check = mysqli_query($database_link, 'SELECT * FROM users');

        while ($data = $check->fetch_assoc()) {

            if ($data['username'] == $username && $data['password'] == $password) {

                $_SESSION['logged'] = true;
                $idquery = mysqli_query($database_link, 'SELECT user_id FROM users WHERE username ="' . $username . '"');
                $id = mysqli_fetch_assoc($idquery);
                $_SESSION['user_id'] = $id['user_id'];
                $_SESSION['username'] = $username;
                header('Location:index.php');
                break;
            }
            else {

                $error = TRUE;
            }
        }

        if ($error == TRUE) {

            echo 'Невалидни данни!';
        }
    }

    if ($_SESSION) {
        if ($_SESSION['logged'] == true) {
            header('Location:index.php');
        }
    }
    ?>
</div>
<?php
require 'include/footer.php';
?>
