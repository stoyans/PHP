<?php
session_start();
$title = "Добавяне на книга";
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
    <form method="post">
        <p>
        <div id="submit">
            Добавете книга: </br><input type="text" name="addbook" class="enter"/>
        </div>

        <?php
        echo '<div>';
        echo '<select multiple name="authors[]">';
        while ($extracAuthors = $author_sql->fetch_assoc()) {

            echo '<option>' . $extracAuthors['author_name'] . '</option>';
        }
        echo '</select>' . '</br>';
        echo '<br>' . '<input type="submit" value="Добави">
    </form></div>';

        $error = false;
        $errorInput = array();
        $errorInput['error'] = FALSE;

        if ($_POST) {

            $errorInput = validatebook($_POST, $database_link);

            if (empty($_POST['authors'])) {
                echo 'Не сте избрали автор';
                $error = TRUE;
            }
            else {
                $is_author = validateInputAuthors($_POST['authors'], $database_link);
            }

            if ($error == FALSE && $errorInput['error'] == false && $is_author == false) {

                $book_sql = mysqli_query($database_link, 'INSERT INTO books (book_title) VALUES ("' . $errorInput['bookName'] . '")');
                $book_id = mysqli_insert_id($database_link);

                foreach ($_POST['authors'] as $author_name) {

                    $check = mysqli_query($database_link, 'SELECT author_id FROM authors WHERE author_name = "' . $author_name . '" ');
                    $id = $check->fetch_assoc();
                    $fill = mysqli_query($database_link, 'INSERT INTO books_authors (book_id, author_id) VALUES("' . (int) $book_id . '", "' . (int) $id['author_id'] . '")');
                    if (mysqli_query($database_link, $fill)) {
                        $error = FALSE;
                    }
                }
                if ($error == FALSE) {
                    echo 'Kнигата е е добавена успешно!';
                }
                else {
                    echo 'Грешка при добавяне на данните!';
                }
            }
        }

        include 'include/footer.php';
        ?>
</div>