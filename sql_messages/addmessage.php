<?php
session_start();
date_default_timezone_set('Europe/Sofia');
if ($_SESSION['logged'] == false) {
    header('Location:index.php');
}

$title = 'Ново съобщение';
require 'include/header.php';
require 'include/constants.php';
?>

<div id="formmsg">
    <form method="POST">
        <div class="data">
            <input type="text" name="msgtitle" class="field" placeholder="Заглавие на съобщението" accept-charset="UTF-8"/></br>
            <h5>(максимална дължина: 50 символа)</h5>
        </div>
        <div class="area"></br>
            <textarea name="msgbody" rows="7" cols="40" wrap="hard" placeholder="Въведете информация..."></textarea></br>
            <h5>(максимална дължина: 250 символа)</h5>
        </div>
        <div class="reg1">
            <input type="submit" value="Добави" class="button" />
        </div></br>
        <div class="listed">
            <a href="messages.php">Съобщения</a>
        </div>
    </form>
</div>

<?php
$format = date('y/m/d - H:i:s');

if ($_POST) {
    $messageHead = mysqli_real_escape_string($dbconnect, trim($_POST['msgtitle']));
    $messageBody = mysqli_real_escape_string($dbconnect, trim($_POST['msgbody']));

    $headlen = mb_strlen($messageHead, "UTF-8");
    $bodylen = mb_strlen($messageBody, "UTF-8");

    if ($headlen > 50 || $bodylen > 250) {

        echo 'Заглавието или символите в съобщението надвишават ограниченията';
    } else if (mb_strlen($messageHead) < 1) {

        echo 'Заглавието е останало непопълнено или сте въвели празни интервали!';
    } else if (mb_strlen($messageBody) < 1) {

        echo 'Съобщението е останало непопълнено или сте въвели празни интервали!';
    } else {

        $sqlmessage = 'INSERT INTO msg (title, msgbody, published, author) VALUES ("' . $messageHead . '","' . $messageBody . '", "' . $format . '",
            "' . $_SESSION['username'] . '")';

        if (mysqli_query($dbconnect, $sqlmessage)) {

            echo 'Съобщението е добавено успешно';
            header('Location:messages.php');
        } else {

            echo 'Грешка при добавяне на съобщение в базата!';
        }
    }
}
?>
<?php
require 'include/footer.php';
?>