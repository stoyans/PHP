<?php
session_start();
$title = 'Вход';
require 'include/header.php';
require 'include/constants.php';
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
            <div class="reg">
                <a href="registration.php">Регистрация</a>
            </div>
        </div>
    </form>
</div>

<?php
$error = FALSE;

if ($_POST) {
    $username = mysqli_real_escape_string($dbconnect, strtolower(trim($_POST['user'])));
    $password = mysqli_real_escape_string($dbconnect, trim($_POST['pass']));

    $check = mysqli_query($dbconnect, 'SELECT * FROM users');

    while ($data = $check->fetch_assoc()) {

        if ($data['username'] == $username && $data['password'] == $password) {

            $_SESSION['logged'] = true;
            $_SESSION['username'] = $username;
            header('Location:messages.php');
            break;
        } else {

            $error = TRUE;
        }
    }

    if ($error == TRUE) {

        echo 'Невалидни данни!';
    }
}

if ($_SESSION) {
    if ($_SESSION['logged'] == true) {
        header('Location:messages.php');
    }
}
?>
<?php
require 'include/footer.php';
?>
