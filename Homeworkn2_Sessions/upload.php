<?php
session_start();
$title = 'Добави нов файл';
require 'header.php';
?>

<div class="uform">
<html>
    <form method="POST" enctype="multipart/form-data">
        Избери файл
        <input type="file" name="upload" class=>
        <h4>(Максимален размер на файла 50MB)</h4>
        <h5>Не може да качвате файлове с разширения:
            exe, php, com, bat</h5>
        <input type="submit" value="Добави"></br>
    </form>
    <div class="uploaded">
        <a href ="files.php">Списък с файлове</a>
    </div>
    <div>
    </div>
</html>
</div>

<?php
if (file_exists('loggedName.txt')){
    
        $folder = file_get_contents('loggedName.txt');
}

if ($_FILES) {
    
    $ext = strtolower(pathinfo($_FILES['upload']['name'], PATHINFO_EXTENSION));
    if ($ext == "exe" || $ext == "php" || $ext == "com" || $ext == "bat") {

        echo 'Невалидно разширение на файла!';
    }
    else if (move_uploaded_file($_FILES['upload']['tmp_name'], "$folder.upload".DIRECTORY_SEPARATOR.$_FILES['upload']['name'])) {
        
        echo 'Файлът е качен успешно';
    }
    else {
        
        echo 'Не сте избрали файл';
    }
}

?>
