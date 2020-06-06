<?php
require_once("includes/header.php");
require_once("includes/config.php");
require_once("includes/classes/TrendingProvider.php");
$username=$_SESSION["userLoggedIn"];
$articles=array();
$query=$con->prepare("SELECT id FROM articles WHERE uploadedBy=:username");
$query->bindParam(":username", $username);
$query->execute();

while($row=$query->fetch(PDO::FETCH_ASSOC)) {
    $articles[]=new Article($con, $row["id"], $userLoggedInObj);
}

$articleGrid = new ArticleGrid($con, $userLoggedInObj);
?>
<div class="largeArticleGridContainer">
<?php 
if(sizeof($articles)>0) {
    echo $articleGrid->createLarge($articles, "Your Articles", false);
}
else {
    echo "No published articles";
}
?>
</div>