<form method="post" action="add_book.php">
    Име: <input type="text" name="book_name" />
    <div>Автори:<select name="authors[]" multiple style="width: 200px">
            <?php
            foreach ($data['authors'] as $row) {
                echo '<option value="' . $row['author_id'] . '">
                    ' . $row['author_name'] . '</option>';
            }
            ?>

        </select></div>
    <input type="submit" value="Добави" />    

</form>
<?php
if (!empty($data['error'])) {
    foreach ($data['error'] as $value) {
        echo $value;
    }
}
?>