<?php
$Title = 'Нов Разход';
require 'include/constants.php';
require 'include/header.php';
?>
    <body>
        <form method="POST">
        <table>
            <thead>
                <tr>
                    <td>
                        <a href="index.php">СПИСЪК</a>
                    </td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td id="menu2">
                        Име на разхода
                    </td>
                    <td>
                        <input type="text" name="expense" placeholder="Name" />
                    </td>
                </tr>
                <tr>
                    <td id="menu2">
                        Сума
                    </td>
                    <td>
                        <input type="text" name="price" pattern="[0-9]{1,10}[.][0-9]{1,10}" placeholder="00.00"/>
                    </td>
                </tr>
                <tr>
                    <td id="menu2">
                        Вид
                    </td>
                    <td>
                        <select name="type" id="menu">
                            <?php
                            foreach ($type as $key => $value) 
                            {
                                echo '<option value="'.$key.'">' . $value .
                                '</option>';
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                    </td>
                    <td id="add">
                        <input type="submit" value="Добави" id="submit"/>
                    </td>
                </tr>
            </tbody>
        </table>
        </form>        
    </body>
</html>

<?php
if ($_POST)
{
    $expense = trim($_POST['expense']);
    $expense=  str_replace('!', ' ', $expense);
    $price = trim($_POST['price']);
    $price=  str_replace(',', '.', $price);
    $selectedGroup=(int)$_POST['type'];

    $error=false;
    if(mb_strlen($expense)<4){
        echo '<p>Името е прекалено късо</p>';
        $error=true;
    }
    
    if($price <= 0){
        echo '<p>Цената трябва да е по-голяма от 0 или e в невалиден формат</p>';
        $error=true;
    }    
    if(!array_key_exists($selectedGroup, $type)){
        echo '<p>невалидна група</p>';
        $error=true;
    }
    $date = date ("d.m.y");
    if(!$error){
        $result=$date.'!'.$expense.'!'.$price.'!'.$selectedGroup.'!'."\n";
        if(file_put_contents('data.txt', $result,FILE_APPEND))
        {
            echo 'Записът е успешен';
        }
    }

}
?>