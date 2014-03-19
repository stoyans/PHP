<?php

require 'config.php';

function validatebook($input, $data_link) {

    $resultValid = array();
    $resultValid['error'] = FALSE;
    $resultValid['bookName'] = mysqli_real_escape_string($data_link, trim($input['addbook']));

    $booklen = mb_strlen($resultValid['bookName'], "UTF-8");

    if ($booklen <= 3) {
        echo 'Името е прекалено кратко или не сте го попълнили!';
        $resultValid['error'] = TRUE;
    }

    $checkbook = mysqli_query($data_link, 'SELECT * FROM books');

    while ($isbook = $checkbook->fetch_assoc()) {
        if ($isbook['book_title'] == $resultValid['bookName']) {

            $resultValid['error'] = TRUE;
            echo 'Книгата вече е добавена!';
            break;
        }
    }
    return $resultValid;
}

function validateauthor($inputdata, $data_link) {

    $resultauthor = array();
    $resultauthor['error'] = FALSE;
    $resultauthor['authorName'] = mysqli_real_escape_string($data_link, trim($inputdata['addauthor']));

    $authorlen = mb_strlen($resultauthor['authorName'], "UTF-8");
    if ($authorlen < 3) {
        echo 'Името е прекалено кратко или не сте го попълнили!';
        $resultauthor['error'] = TRUE;
    }

    $chekName = mysqli_query($data_link, 'SELECT * FROM authors');

    while ($info = $chekName->fetch_assoc()) {

        if ($info['author_name'] == $resultauthor['authorName']) {

            $resultauthor['error'] = TRUE;
            echo 'Този автор вече е въведен!';
            break;
        }
    }
    return $resultauthor;
}

function validateInputAuthors($authorsNames, $db) {
    $count = 0;

    $q = mysqli_query($db, 'SELECT * FROM authors');
    while ($row = mysqli_fetch_assoc($q)) {
        foreach ($authorsNames as $author) {
            if ($author == $row['author_name']) {
                $count++;
            }
        }
    }

    if (($count) == count($authorsNames)) {
        return FALSE;
    }
    else {
        echo "</br>" . 'Един или повече от избраните автори не съществува в базата данни!';
        return TRUE;
    }
}

function printdata($extracted, $db) {
    $result = array();

    while ($row = mysqli_fetch_assoc($extracted)) {
        $result[$row['book_title']]['book_title'] = $row['book_title'];
        $result[$row['book_title']]['authors'][$row['author_id']] = $row['author_name'];
    }
    //echo '<pre>' . print_r($result, true) . '<pre>';

    foreach ($result as $bookName) {
        echo '<tr><td id="title">
        <a href="bookinfo.php?title='. $bookName['book_title'] .'">'.$bookName['book_title'].'</a>
        </td><td>';
        $data = array();
        foreach ($bookName['authors'] as $k => $entry) {
            $data[] = '<a href="fromauthor.php?id=' . $k . '">' . $entry . '</a>';
        }
        echo implode(', ', $data);
        echo '</td></tr>';
    }
}
function islogged (){
    
    if ($_SESSION && $_SESSION['logged'] == TRUE) {
        echo '<div>Логнат като ' . ucfirst($_SESSION['username']) . '.<br>
         <a href="logout.php">Изход</a></div>';
    }
    else
        {
    echo '<div id="rg"><a href = "login.php">Вход</a> /
        <a href="registration.php">Регистрация</a></div>';
    }

}

?>
