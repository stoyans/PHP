<?php
session_start();
$title = 'Книги от автора';
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
    <table>
        <thead>
            <tr>
                <td>
                    Книги
                </td>
                <td>
                    Автор
                </td>
            </tr>
        </thead>
        <?php
        if (!$_GET) {
            header('Location: index.php');
        }
        else {
            $corrret = false;
            $ifexist = mysqli_query($database_link, 'SELECT * FROM authors');
            while ($onrow = $ifexist->fetch_assoc()) {

                if ($_GET['id'] == $onrow['author_id']) {
                    $corrret = true;
                }
            }
            if ($corrret == false) {
                echo 'Този автор не съществува в системата!';
                exit;
            }
        }
        $extractData = mysqli_query($database_link, 'SELECT * FROM books_authors as ba JOIN books ON books.book_id = ba.book_id
        JOIN books_authors as bba ON bba.book_id = ba.book_id JOIN authors ON bba.author_id=authors.author_id
        WHERE ba.author_id= ' . $_GET['id'] . '');

        printdata($extractData, $database_link);

        echo '</table></div>';
        ?>
