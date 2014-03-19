<form method="post" action="authors.php">
    Име: <input type="text" name="author_name" />
    <input type="submit" value="Добави" />    
</form>
<table border='1'>
    <tr><th>Автор</th></tr>

    <?php
    foreach ($data['authors'] as $row) {
        echo '<tr><td>' . $row['author_name'] . '</td></tr>';
    }
    ?>
</table>
<?php
if (!empty($data['error'])) {
    foreach ($data['error'] as $value) {
        echo $value;
    }
}
?>
