<?php
$sort = array(1=>'Възходящо', 2=>'Низходящо');
$dbconnect = mysqli_connect('localhost', 'root', '', 'sql_messages');
mysqli_set_charset($dbconnect, 'utf8');


function deletemgs($idmsg, $database_link) {
    $deletefrom = 'DELETE FROM msg WHERE msg_id=' . $idmsg . '';
    if (mysqli_query($database_link, $deletefrom)) {
        echo 'успешно';
        header('Location:messages.php');
    }
    else {
        echo 'грешка';
    }
}
?>
