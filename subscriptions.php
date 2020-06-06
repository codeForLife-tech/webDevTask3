<?php
require_once("includes/header.php");

if(!User::isLoggedIn()) {
    header("Location:signIn.php");
}

$subscriptionsProvider = new SubscriptionsProvider($con, $userLoggedInObj);
$articles=$subscriptionsProvider->getArticles();

$articleGrid = new ArticleGrid($con, $userLoggedInObj);
?>
<div class="largeArticleGridContainer">
<?php 
if(sizeof($articles)>0) {
    echo $articleGrid->createLarge($articles, "New from your subscriptions", false);
}
else {
    echo "No articles to show";
}
?>
</div>