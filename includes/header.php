<?php 
require_once("includes/config.php");
require_once("includes/classes/ButtonProvider.php");
require_once("includes/classes/User.php");
require_once("includes/classes/Article.php");
require_once("includes/classes/ArticleGrid.php");
require_once("includes/classes/ArticleGridItem.php");
require_once("includes/classes/SubscriptionsProvider.php");
require_once("includes/classes/NavigationMenuProvider.php");

$usernameLoggedIn=User::isLoggedIn() ? $_SESSION["userLoggedIn"] : "";
$userLoggedInObj = new User($con, $usernameLoggedIn);
?>
<!DOCTYPE html>
<html>
<head>
<title>BlogNow</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="assets/css/all.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/style.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="assets/js/commonActions.js"></script>
<script src="https://kit.fontawesome.com/d1766da268.js" crossorigin="anonymous"></script>
<script src="assets/js/userActions.js"></script>

</head>
<body>
    <div id="pageContainer">
        
            <div id="mastHeadContainer">
            <button class="navShowHide">
            <img src="assets/images/icons/menu.png">
            </button>
            <a class="logoContainer" href="index.php">
                <img src="assets/images/icons/google.png" title="logo" alt="Site logo">
            </a>

            <div class="searchBarContainer">
                <form action="search.php" method="GET" autocomplete="off">
                    <div class="autocomplete" style="max-width:600px;width:100%;">
                        <input type="text" class="searchBar" id='searchInput' name="term" placeholder="Search...">
                    </div>
                    <button class="searchButton">
                    <img src="assets/images/icons/search.png">
                    </button>
                </form>
            </div>

            <div class="rightIcons">
            
            <?php
            if($usernameLoggedIn=="") {
                echo
                "<a onclick='notSignedIn()' class='uploadButton'>";
            }
            else {
                echo
                "<div class='notification_wrap'>
            <a href='#' class='notification'>
                <i class='fa fa-bell-o' id='bell'></i>
                <span class='badge'></span>
            </a>
            <div class='dropdown'>
                
            </div>
        </div><a href='editor.php' class='uploadButton'>";
            }
            ?>
                <img class='upload' src='assets/images/icons/upload.png'>
                </a>
                <?php echo ButtonProvider::createUserProfileNavigationButton($con, $usernameLoggedIn); ?>
            </div>
            </div>

        <div id="sideNavContainer" style="display:none;">
            <?php
            $navigationProvider=new NavigationMenuProvider($con, $userLoggedInObj);
            echo $navigationProvider->create();
            ?>
        </div>
            <script src="assets/js/syncSearch.js"></script>
            <script>
            
        document.addEventListener('click', function(event) {
            console.log(event.target);
            if(!(document.getElementsByClassName("notification_wrap")[0].contains(event.target))) {
                $(".dropdown").removeClass("active");
                clearNotifications();
            } 
            });
        $(document).ready(function(){
			$(".notification").on('click', function(){
                if($(".dropdown").hasClass("active")) {
                    $(".dropdown").toggleClass("active");
                    clearNotifications();
                    console.log(2);
                }
                else {
                    $(".dropdown").toggleClass("active");
                }
				    
            }) 
        });
        if(document.getElementsByClassName("dropdown")[0]) {
            setInterval(() => {
            $.post("ajax/notifications.php").done(function(htmlData) {
                document.getElementsByClassName("dropdown")[0].innerHTML=htmlData;
                var number=document.getElementsByClassName("dropdown")[0].childElementCount;
                console.log(number);
                if(number!=0)
                    document.getElementsByClassName("badge")[0].innerHTML=number;
                else 
                    document.getElementsByClassName("badge")[0].style.display="none";
            });
        }, 1000);
        }
        
        function clearNotifications() {
            var number=document.getElementsByClassName("dropdown")[0].childElementCount;
            var ids="";
            var items=document.getElementsByClassName("notify_item");
            for(var m=0;m<number;m++) {
                ids+=items[m].id;
                if(m!=number-1)
                    ids+=";";   
            }
            if(ids.length!=0) {
                $.post("ajax/clearNotify.php", {ids: ids}).done(function(data) {
                    console.log(data);
                });
            } 
        }
        </script>
        <div id="mainSectionContainer">
        <div id="mainContentContainer">
