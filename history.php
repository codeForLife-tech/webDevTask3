<?php
require_once("includes/header.php");
$articles=array();
$status=0;
$query=$con->prepare("SELECT articleId FROM history WHERE statusPaused=:status AND user=:username AND time > (NOW() - INTERVAL :days DAY) ORDER BY id DESC");
$query->bindParam(":status", $status);
$query->bindParam(":username", $username);
$query->bindParam(":days", $days);
if(isset($_GET["rangeValue"])) 
    $days=$_GET["rangeValue"];
else 
    $days=1826;
$username=$userLoggedInObj->getUsername();
$query->execute();

while($row=$query->fetch(PDO::FETCH_ASSOC)) {
    $articles[]=new Article($con, $row["articleId"], $userLoggedInObj);
}

$articleGrid = new ArticleGrid($con, $userLoggedInObj);
?>
<div class="largeArticleGridContainer">
<?php 
if(sizeof($articles)>0) {
    echo $articleGrid->createLarge($articles, "Articles that you have read", false, true, $days);
}
else {
    echo $articleGrid->createLarge($articles, "No articles to show", false, true, $days);;
}
?>
</div>