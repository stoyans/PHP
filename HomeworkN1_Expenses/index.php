<?php
$Title = 'Списък';
require 'include/constants.php';
require 'include/header.php';
?>

    <body>
        <table>
            <thead>
                <form method="GET">
                <tr>
                    <td>
                    <a href="Expense.php">ДОБАВИ РАЗХОД</a> 
                    </td>
                    <td>
                        <input type="submit" value="Филтрирай" id="filter">
                        
                    </td>
                    <td>
                        <select name="menu" id="menu">
                            <?php
                            foreach ($menu as $key => $value) 
                                {
                                    echo '<option value="'.$key.'">' . $value .
                                    '</option>';
                                }
                                
                            ?>
                        </select>
                    </td>
                </tr>
                </form>
                <tr>
                    <td>
                        Дата
                    </td>
                    <td>
                        Разход
                    </td>
                    <td>
                        Сума
                    </td>
                    <td>
                        Вид
                    </td>
                    </tr>
                </thead>
                <tbody>
 
<?php
$sum = 0;
$counter = 1;        
    if (file_exists('data.txt'))
        {
            $database =  file('data.txt');
            foreach ($database as $value) 
                {
                    $splittedData =  explode('!', $value);  
            if ($_GET)
                {
                if ($_GET['menu'] == (int)$splittedData[3])
                    {
                        echo '<tr>
                        
                        <td>'.$splittedData[0].'</td>
                        <td>'.$splittedData[1].'</td>
                        <td>'.$splittedData[2].'</td>
                        <td>'.$menu[trim($splittedData[3])].'</td>
                            <td>'.$counter.'</td>
                        </tr>';
                        $sum += $splittedData[2];
                        
                    }
                
                if ($_GET['menu'] == 0)
                    {
                        echo '<tr>
                        
                        <td>'.$splittedData[0].'</td>
                        <td>'.$splittedData[1].'</td>
                        <td>'.$splittedData[2].'</td>
                        <td>'.$menu[trim($splittedData[3])].'</td>
                            <td>'.$counter.'</td>
                        </tr>';
                        $sum += $splittedData[2];
                    }
                }
            else
                {
                    echo '<tr>
                    
                    <td>'.$splittedData[0].'</td>
                    <td>'.$splittedData[1].'</td>
                    <td>'.$splittedData[2].'</td>
                    <td>'.$menu[trim($splittedData[3])].'</td>
                        <td>'.$counter.'</td>
                    </tr>';
                    $sum += $splittedData[2];
                }
                $counter++;
            }
        }   
?>
                    <tr>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td id="sum">
                            <?php
                                echo $sum;
                            ?>
                        </td>
                        <td>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>       
    </body>
</html>
