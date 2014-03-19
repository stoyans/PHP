<?php
session_start();
$title = "Добавяне на автор";
require 'include/header.php';
require 'include/config.php';
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
    <div id="author">
        <form method="post">
            Нов автор: <input type="text" name="addauthor"/>
            <input type="submit" value="Добави">

        </form>
    </div><br>


    <?php
    $validauthor = array();
    $validauthor ['error'] = TRUE;

    if ($_POST) {

        $validauthor = validateauthor($_POST, $database_link);

        if ($validauthor['error'] == FALSE) {

            $author_sql = ('INSERT INTO authors (author_name) VALUES ("' . $validauthor['authorName'] . '")');
            if (mysqli_query($database_link, $author_sql)) {
                echo 'Авторът е добавен успешно!';
            }
            else {
                echo 'Грешка при добавянето!';
            }
        }
    }
    echo '<table>
        <thead>
            <tr>
                <td>
                    Автор
                </td>
            </tr>
        </thead>';

    $authors_sql = mysqli_query($database_link, 'SELECT * FROM authors ORDER BY author_id');
    while ($info = $authors_sql->fetch_assoc()) {
        echo '<tr>
                <td>
                   <a href = "fromauthor.php?name=' . $info['author_name'] . '">' . $info['author_name'] . '</a>
                </td>
            </tr>';
    }

    include 'include/footer.php';
    ?>
</div>