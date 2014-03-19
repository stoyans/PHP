<?php

include 'inc/functions.php';
$error = [];
$result = [];


if ($_POST) {
    $author_name = trim($_POST['author_name']);
    if (mb_strlen($author_name) < 2) {
        $error[] = '<p>Невалидно име</p>';
    }
    else {
        $author_esc = mysqli_real_escape_string($db, $author_name);
        $q = mysqli_query($db, 'SELECT * FROM authors WHERE
        author_name="' . $author_esc . '"');
        if (mysqli_error($db)) {
            $error[] = 'Грешка';
        }

        if (mysqli_num_rows($q) > 0) {
            $error[] = 'Има такъв автор';
        }
        else {
            mysqli_query($db, 'INSERT INTO authors (author_name)
            VALUES("' . $author_esc . '")');
            if (mysqli_error($db)) {
                $error[] = 'Грешка';
            }
            else {
                $error[] = 'Успешен запис';
            }
        }
    }
}
if (count($error) > 0) {
    $result['error'] = $error;
}
$authors = getAuthors($db);
if ($authors === false) {
    $result['error'][] = 'Грешка при четене от DB';
}
else {
    foreach ($authors as $row) {
        $result['authors'][] = $row;
    }
}

$result['title'] = 'Нов автор';
$result['content'] = 'templates/public_authors.php';
render($result, 'layouts/main_layout.php');
?>


