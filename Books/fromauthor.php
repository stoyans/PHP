<?php
$title = 'Книги от автора';
require 'include/header.php';
require 'include/config.php';
require 'include/functions.php';
?>
<div id="head">
<a href="index.php">Списък</a>
</div>
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
    } else {
        $corrret = false;
        $ifexist = mysqli_query($database_link, 'SELECT * FROM authors');
        while ($onrow = $ifexist->fetch_assoc()) {

            if ($_GET['name'] == $onrow['author_id']) {
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
             WHERE ba.author_id= '. $_GET['name'] . '');

    printdata($extractData, $database_link);
    
    echo '</table>';
    /*SELECT books.book_title, authors.author_name, authors.author_id
             FROM books LEFT JOIN books_authors ON books.book_id = books_authors.book_id
             LEFT JOIN authors ON authors.author_id = books_authors.author_id
             WHERE books.book_title in (SELECT books.book_title FROM books
             LEFT JOIN books_authors ON books.book_id = books_authors.book_id
             LEFT JOIN authors ON authors.author_id = books_authors.author_id*/
    ?>
