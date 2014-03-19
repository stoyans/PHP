<?php
session_start();
$title = "Информация";
require_once 'include/header.php';
require 'include/config.php';
require 'include/functions.php';
?>
<body>
    <div id="head">
        <a href="newbook.php">Добавете книга</a>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="addauthor.php">Добавете автор</a>
    </div>
    <table>
        <thead>
            <tr>
                <td>
                    Книга
                </td>
                <td>
                    Автори
                </td>
            </tr>
        </thead>

        <?php
        $extract = mysqli_query($database_link, 'SELECT * FROM books LEFT JOIN books_authors 
        ON books.book_id=books_authors.book_id LEFT JOIN authors ON books_authors.author_id = authors.author_id
        ORDER BY books.book_id DESC');

        printdata($extract, $database_link);
        
        ?>
    </table>
    <?php
    require_once 'include/footer.php';
    ?>