<?php
class NavigationMenuProvider {

    private $con, $userLoggedInObj;
    
    public function __construct($con, $userLoggedInObj) {
        $this->con=$con;
        $this->userLoggedInObj=$userLoggedInObj;
    }

    public function create() {
        $menuHtml=$this->createNavItem("Feeds", "assets/images/icons/home.png", "index.php");
        $menuHtml.=$this->createNavItem("Trending", "assets/images/icons/trending.png", "trending.php");
        $menuHtml.=$this->createNavItem("Subscriptions", "assets/images/icons/subscriptions.png", "subscriptions.php");
        $menuHtml.=$this->createNavItem("Favourites", "assets/images/icons/thumb-up.png", "favourites.php");

        if(User::isLoggedIn()) {
            $menuHtml.=$this->createNavItem("Settings", "assets/images/icons/settings.png", "settings.php");
            $menuHtml.=$this->createNavItem("Your articles", "assets/images/icons/search.png", "editArticles.php");
            $menuHtml.=$this->createNavItem("History", "assets/images/icons/history.png", "history.php");
            $menuHtml.=$this->createNavItem("Search History", "assets/images/icons/history.png", "searchHistory.php");
            $menuHtml.=$this->createNavItem("Profilepic with webcam", "assets/images/profilePictures/default.png", "live.php");
            $menuHtml.=$this->createNavItem("Log Out", "assets/images/icons/logout.png", "logout.php");
            $menuHtml.=$this->createSubscriptionsSection();
        }

        

        return "<div class='navigationItems'>
                    $menuHtml
                </div>";
    }

    private function createNavItem($text, $icon, $link) {
        return "<div class='navigationItem'>
                    <a href='$link'>
                        <img src='$icon'>
                        <span>$text</span>
                    </a>
                </div>";
    }

    private function createSubscriptionsSection() {
        $subscriptions=$this->userLoggedInObj->getSubscriptions();

        $html="<span class='heading'>Subscriptions</span>";
        foreach($subscriptions as $sub) {
            $subUsername=$sub->getUsername();
            $html.=$this->createNavItem($subUsername, $sub->getProfilePic(), "profile.php?username=$subUsername");
        }

        return $html;
    }
}
?>