<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?= $data['title']; ?></title>
    </head>

    <body>
        <a href="index.php">Списък</a>
        <a href="authors.php">Автори</a>
        <a href="add_book.php">Нова книга</a>
        <?php
        include $data['content'];
        ?>
    </body>
</html>