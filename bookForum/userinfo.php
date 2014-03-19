<?php

session_start();
$title = "Информация за потребител";
require_once 'include/header.php';
require 'include/config.php';
require 'include/functions.php';
?>
<?php

echo '<div id="whole">';
islogged();
echo '<div id="list">
        <a href="index.php">Книги</a>
    </div>
    <div id="head">
        <a href="newbook.php">Добавете книга</a> /
        <a href="addauthor.php">Добавете автор</a>
    </div><hr>';
echo '<div id="usr">Коментари от потребител: ' . $_GET['usname'] . '</div>';
echo'<dl>';
$extractuser = mysqli_query($database_link, 'SELECT * FROM msg LEFT JOIN users_msgs ON msg.msg_id = users_msgs.msg_id WHERE author="' . $_GET['usname'] . '"'
        . 'ORDER BY published DESC');

while ($usercomment = mysqli_fetch_assoc($extractuser)) {
    echo '<dt>Коментар: ' . $usercomment['msgbody'] . '</dt>'
    . '<dd>Към книга "<a href="bookinfo.php?title=' . $usercomment['book_name'] . '">' . $usercomment['book_name'] . '</a>" '
    . '/ добавен на (' . $usercomment['published'] . ') </dd>' . '</br>' . '<hr>';
}
echo '</dl></div>';
?>