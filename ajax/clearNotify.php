<?php
require_once("../includes/config.php");

    $ids=explode(";",$_POST["ids"]); 
    $condition="";
    $i=0;
    while($i<sizeof($ids)) {
            if($i==0) {
                $condition.= "WHERE id=?";
            }
            else {
                $condition.= " OR id=?";
            }
            $i++;
    }
        $articleSql="UPDATE notifications SET seen=? $condition";
        $articleQuery=$con->prepare($articleSql);
        $i=1;
        $seen=1;
        $articleQuery->bindValue(1, $seen);
        foreach($ids as $id) {
             $articleQuery->bindValue(($i+1), $id);
             $i++;
        }

        echo $articleQuery->execute();
?>