<?php
session_start();
$title = 'Информация за книга';
require 'include/config.php';
require 'include/header.php';
require 'include/functions.php';
?>
<div id="whole">
    <?php islogged(); ?>
    <div id="list">
        <a href="index.php">Книги</a>
    </div>
    <div id="head">
        <a href="newbook.php">Добавете книга</a> /
        <a href="addauthor.php">Добавете автор</a>
    </div>
    <hr>
    <table>
        <thead>
            <tr>
                <td>
                    Книга
                </td>
                <td>
                    Автор(и)
                </td>
            </tr>
        </thead>

        <?php
        $extract = mysqli_query($database_link, 'SELECT * FROM books LEFT JOIN books_authors 
        ON books.book_id=books_authors.book_id LEFT JOIN authors ON books_authors.author_id = authors.author_id
        WHERE books.book_title="' . $_GET['title'] . '"');
        printdata($extract, $database_link);
        ?>
    </table>
    <?php
    if ($_SESSION && $_SESSION['logged'] === TRUE) {

        echo '<div id="formmsg">
        <form method="POST">
            <div class="area"></br>
                <textarea name="msgbody" rows="7" cols="40" wrap="hard" placeholder="Може да добавите коментар за книгата..."></textarea></br>
            </div>
            <div class="reg1">
                <input type="submit" value="Добави" class="button" />
            </div></br>
        </form>
    </div>';

        $format = date('y/m/d - H:i:s');

        if ($_POST) {
            $messageBody = mysqli_real_escape_string($database_link, trim($_POST['msgbody']));
            $bodylen = mb_strlen($messageBody, "UTF-8");

            if (mb_strlen($messageBody) < 1) {

                echo 'Не сте написали коментар или сте въвели само празни интервали!';
            }
            else {
                $sqlmessage = mysqli_query($database_link, 'INSERT INTO msg (msgbody, published, author, book_name) VALUES ("' . $messageBody . '", "' . $format . '",'
                        . '"' . $_SESSION['username'] . '", "' . $_GET['title'] . '")');
                $msg_id = mysqli_insert_id($database_link);
                $msgs_users = 'INSERT INTO users_msgs (user_id, msg_id) VALUES (' . (int) $_SESSION['user_id'] . ', ' . (int) $msg_id . ')';

                if (mysqli_query($database_link, $msgs_users) && $sqlmessage) {
                    echo 'Коментарът е добавен успешно!';
                }
                else {
                    echo 'Грешка при добавяне на коментар!';
                }
            }
        }
    }
    echo'<dl><hr>';

    $extractcom = mysqli_query($database_link, 'SELECT * FROM msg WHERE book_name="' . $_GET['title'] . '" ORDER BY published DESC');
    if (mysqli_num_rows($extractcom) > 0) {
        while ($comment = mysqli_fetch_assoc($extractcom)) {

            echo '<dt>Коментар: ' . $comment['msgbody'] . '</dt>'
            . '<dd>От потребител <a href="userinfo.php?usname=' . $comment['author'] . '">' . $comment['author'] . '</a> '
            . '/ добавен на: ' . $comment['published'] . '</dd>' . '</br>';
        }
        echo '</dl></div>';
    }
    else {
        echo 'Все още няма коментари за книгата.';
    }
    require 'include/footer.php';
    ?>