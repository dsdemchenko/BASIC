<?php

require_once "pdo.php";

if ( isset($_POST['f_code'])&&isset($_POST['f_name'])){
    
    $sql="INSERT INTO items (code,name)
            VALUES (:v_code, :v_name)";
    echo("<pre>\n".$sql."\n</pre>\n");

    $new_item = $pdo->prepare($sql);
    $new_item->execute(array(
        ':v_code'=>$_POST['f_code'],
        ':v_name'=>$_POST['f_name']));
    }

if (isset($_POST['Delete'])&&isset($_POST['item_id'])) {
    $sql = "DELETE FROM items WHERE item_id= :zip";
    echo "<pre>\n$sql\n</pre>\n";
    $kill_it = $pdo->prepare($sql);
    $kill_it->execute(array(':zip'=>$_POST['item_id']));
} 


$glance = $pdo->query("SELECT * FROM items");
echo '<table border="1">'."\n";
while ($row=$glance->fetch(PDO::FETCH_ASSOC)){
    echo "<tr><td>";
    echo($row['code']);
    echo ("</td><td>");
    echo($row['name']);
    echo ("</td><td>");
    echo($row['item_id']);
    echo ("</td><td>");
    echo('<form method="post">');
    echo('<input type = "hidden" name="item_id" value="'.$row['item_id'].'">'."\n");
    echo('<input type="submit" value="Del" name="Delete"> ');  
    echo("\n</form>\n");
    echo("</td></tr>\n");
}
echo "</table>\n";?>

<html><head></head><body>
<p>Add new item</p>
<form method="post">
<p>Code:<input type="text" name="f_code" size="40"/></p>
<p>Name:<input type="text" name="f_name" size="45"/></p>
<p><input type ="submit" value = "Add new"/></p>
</form>
</body>