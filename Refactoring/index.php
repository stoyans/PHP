<?php

include 'inc/functions.php';

if (isset($_GET['author_id'])) {
    $author_id = (int) $_GET['author_id'];
    $q = mysqli_query($db, 'SELECT * FROM books_authors as ba JOIN books ON books.book_id = ba.book_id
        JOIN books_authors as bba ON bba.book_id = ba.book_id JOIN authors ON bba.author_id=authors.author_id
        WHERE ba.author_id= ' . $author_id . '');
}
else {
    $q = mysqli_query($db, 'SELECT * FROM books as b INNER JOIN 
    books_authors as ba ON b.book_id=ba.book_id INNER JOIN authors as a
     ON a.author_id=ba.author_id');
}

$result = [];
while ($row = mysqli_fetch_assoc($q)) {
    //echo '<pre>'.print_r($row, true).'</pre>';
    $result['data'][$row['book_id']]['book_title'] = $row['book_title'];
    $result['data'][$row['book_id']]['authors'][$row['author_id']] = $row['author_name'];
}

$result['title'] = 'Списък';
$result['content'] = 'templates/public_list.php';
render($result, 'layouts/main_layout.php');

//echo '<pre>' . print_r($result, true) . '</pre>';


