<?php

include 'inc/functions.php';

$er = [];
$result = [];
$authors = getAuthors($db);
if ($authors === false) {
    $result['error'][] = 'Грешка при четене от DB';
}
else {
    foreach ($authors as $row) {
        $result['authors'][] = $row;
    }
}

if ($_POST) {

    $book_name = trim($_POST['book_name']);
    if (!isset($_POST['authors'])) {
        $_POST['authors'] = '';
    }
    $authors = $_POST['authors'];

    if (mb_strlen($book_name) < 2) {
        $er[] = '<p>Невалидно име</p>';
    }
    if (!is_array($authors) || count($authors) == 0) {
        $er[] = '<p>Грешка</p>';
    }
    if (!isAuthorIdExists($db, $authors)) {
        $er[] = 'невалиден автор';
    }

    if (count($er) > 0) {
        $result['error'] = $er;
    }
    else {
        mysqli_query($db, 'INSERT INTO books (book_title) VALUES("' .
                mysqli_real_escape_string($db, $book_name) . '")');
        if (mysqli_error($db)) {
            $result['error'][] = 'Error';
            exit;
        }
        $id = mysqli_insert_id($db);
        foreach ($authors as $authorId) {
            mysqli_query($db, 'INSERT INTO books_authors (book_id,author_id)
                VALUES (' . $id . ',' . $authorId . ')');
            if (mysqli_error($db)) {
                $result['error'][] = 'Error';
                $result['error'][] =  mysqli_error($db);
                exit;
            }
        }
        $result['error'][] = 'Книгата е добавена успешно';
    }
}
//echo '<pre>' . print_r($result['error'], true) . '</pre>';
$result['title'] = 'Нова книга';
$result ['content'] = 'templates/public_books.php';
render($result, 'layouts/main_layout.php');
