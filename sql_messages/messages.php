<?php
session_start();
if ($_SESSION['logged'] == false) {
    header('Location:index.php');
}

$title = 'Съобщения';
require 'include/header.php';
require 'include/constants.php';
?>
<div class="info">
    <h3>
        <?php
        echo 'Здравeйте, ' . ucfirst($_SESSION['username']) . '!';
        ?>
    </h3>
    <div class="exit">
        <a href ="logout.php">Изход</a>
    </div>
</div>
<hr>
<div class="add">
    <a href ="addmessage.php">Добави съобщение</a>
</div>
<div class="bydate">
    <form method="get">
        <select name="sort">

            <?php
            foreach ($sort as $key => $value) {
                echo '<option ';

                if (isset($_GET['sort']) && (int) $_GET['sort'] == $key) {
                    echo 'selected="selected" ';
                }

                echo 'value="' . $key . '"> ' . $value . '</option>';
            }
            ?>

        </select>
        <input type="submit" value="Сортирай по дата"/>

</div>
<hr>
<table>
    <thead>
        <tr>
            <td id="mtitle">
                Заглавие
            </td>
            <td >
                Съобщение
            </td>
            <td id="published">
                Публикувано на
            </td>
            <td id="usr">
                От потребител
            </td>
        </tr>
    </thead>

    <?php
    if ($_GET && $_GET['sort'] == 2) {

        $sorted = "ASC";
    } else {
        $sorted = "DESC";
    }
    $extract = mysqli_query($dbconnect, 'SELECT * FROM msg ORDER BY msg_id ' . $sorted . '');

    if ($extract->num_rows > 0) {
        while ($info = $extract->fetch_assoc()) {

            $IDmgs = $info['msg_id'];

            echo '<tr>
        <td id="mtitle">
           <strong><u>' . $info['title'] . '</u></strong>
        </td>
        <td id="msg">
            ' . $info['msgbody'] . '
        </td>
        <td id="published">
            ' . $info['published'] . '
        </td>
        <td id="usr">
            ' . $info['author'] . '
        </td>
        <td>
            <button name="delete" value="' . $IDmgs . '" >X</button>
        </td>
        </tr>';
        }
    } else {
        echo 'Няма оставени съобщения!';
    }
    if ($_GET) {

        if (isset($_GET['delete'])) {
            deletemgs($_GET['delete'], $dbconnect);
        }
    }
    ?>
</form>
</table>
<?php
require 'include/footer.php';
?>