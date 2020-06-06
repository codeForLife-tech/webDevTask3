<?php
require_once("includes/header.php");
require_once("includes/classes/LikedArticlesProvider.php");

if(!User::isLoggedIn()) {
    header("Location:signIn.php");
}

$likedArticlesProvider = new LikedArticlesProvider($con, $userLoggedInObj);
$articles=$likedArticlesProvider->getArticles();

$articleGrid = new ArticleGrid($con, $userLoggedInObj);
?>
<div class="largeArticleGridContainer">
<?php 
if(sizeof($articles)>0) {
    echo $articleGrid->createLarge($articles, "Articles that you have liked", false);
}
else {
    echo "No articles to show";
}
?>
</div>