<?php
session_start();
if ($_SESSION['logged'] == false) {
    header('Location:index.php');
}

$title = 'Списък с файлове';
require 'header.php';

if (file_exists('loggedName.txt')) {
    $checkName = file_get_contents('loggedName.txt');
}
?>
<div class="hello">
    <div>
        <h3>Здравейте, <?php echo $checkName; ?>!</h3>
    </div>
    <div class="link">
        <a href="LogOut.php">Изход</a>
    </div>
</div>

<table>
    <thead>
        <tr>
            <td>
                Линк за сваляне
            </td>
            <td>
                Тип
            </td>
            <td>
                Размер
            </td>
        </tr>
    </thead>    

    <?php
    if (file_exists('loggedName.txt')) {
        $checkName = file_get_contents('loggedName.txt');
        $files = scandir("$checkName.upload");

        for ($i = 2; $i < count($files); $i++) {
            $ext = pathinfo("$checkName.upload" . '/' . $files[$i], PATHINFO_EXTENSION);
            echo '
            <tr>
                <td>
                    <a href="' . "$checkName.upload" . '/' . $files[$i] . '" target="_blank">' . $files[$i] . '</a>' . '</br>
                </td>
                <td>
                ' . $ext . '
                </td>
                <td>
                    ' . ($size = (filesize("$checkName.upload" . '/' . $files[$i])) / 1024) . ' KB
                </td>
            </tr>';
        }
    }
    ?>

</table>
</br>
<div class="link1">
    <a href="upload.php">Качи нов файл</a>
</div>
</html>

