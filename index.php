<?php require_once("includes/header.php"); ?>

<div class="articleSection">
    <?php

    $subscriptionsProvider=new SubscriptionsProvider($con, $userLoggedInObj);
    $subscriptionArticles=$subscriptionsProvider->getArticles();

    $articleGrid=new ArticleGrid($con, $userLoggedInObj);

    if(User::isLoggedIn() && sizeof($subscriptionArticles)>0) {
        echo $articleGrid->create($subscriptionArticles, "Subscriptions", false);
    }

    echo $articleGrid->create(null, "Recommended", false);


    ?>

</div>

<?php require_once("includes/footer.php"); ?>