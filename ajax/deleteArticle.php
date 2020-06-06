<?php
require_once("../includes/config.php");
$id=$_POST["id"];
$username=$_SESSION["userLoggedIn"];
$query=$con->prepare("DELETE FROM articles WHERE id=:id");
$query->bindParam(":id", $id);
$query->execute();
$query=$con->prepare("SELECT count(*) as'count' FROM articles WHERE uploadedBy=:username");
$query->bindParam(":username", $username);
$query->execute();
$data=$query->fetch(PDO::FETCH_ASSOC);
echo $data["count"];
?>