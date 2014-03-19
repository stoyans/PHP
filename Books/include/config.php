<?php
$database_link = mysqli_connect('localhost', 'root', '', 'books');
if (!$database_link) {
    echo 'Грешка при връзката с базата даанни!';
    exit;
}
mysqli_set_charset($database_link, 'utf8');

$author_sql = mysqli_query($database_link, 'SELECT * FROM authors ORDER BY author_id');

?>
