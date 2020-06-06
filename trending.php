<?php
require_once("includes/header.php");
require_once("includes/classes/TrendingProvider.php");

$trendingProvider = new TrendingProvider($con, $userLoggedInObj);
$articles=$trendingProvider->getArticles();

$articleGrid = new ArticleGrid($con, $userLoggedInObj);
?>
<div class="largeArticleGridContainer">
<?php 
if(sizeof($articles)>0) {
    echo $articleGrid->createLarge($articles, "Trending articles uploaded in the last week", false);
}
else {
    echo "No trending articles to show";
}
?>
</div>