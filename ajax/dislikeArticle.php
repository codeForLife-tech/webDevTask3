<?php
require_once("../includes/config.php");
require_once("../includes/classes/Article.php");
require_once("../includes/classes/User.php");

$articleId = $_POST["articleId"];
$username=$_SESSION["userLoggedIn"];

$userLoggedInObj = new User($con, $username);
$article = new Article($con, $articleId, $userLoggedInObj);
if(!($article->wasDislikedBy())) {
    $action="disliked";
}
else {
    $action="removed the dislike on";
}
$query=$con->prepare("INSERT INTO notifications(postedBy, article_commentId, action) VALUES(:user, :article_commentId, :action)");
    $query->bindParam(":user", $username);
    $query->bindParam(":article_commentId", $articleId);
    $query->bindParam(":action", $action);
    $query->execute();
echo $article->dislike();
?>