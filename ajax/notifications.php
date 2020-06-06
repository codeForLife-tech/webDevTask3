<?php
require_once("../includes/config.php");
require_once("../includes/classes/User.php");
$seen=0;
$query=$con->prepare("SELECT * FROM notifications WHERE seen=:seen");
$query->bindParam(":seen", $seen);
$query->execute();
$username=$_SESSION["userLoggedIn"];
$verb="";
while($row=$query->fetch(PDO::FETCH_ASSOC)) {
    if($row["action"]=="commented on") {
        $query1=$con->prepare("SELECT uploadedBy,title FROM articles WHERE id=:articleId");
        $query1->bindParam(":articleId", $row["article_commentId"]);
        $query1->execute();
        $user=$query1->fetchColumn();
        $url="read.php?id=".$row["article_commentId"];
        $sentence=$row["postedBy"]." commented on your <a href='$url' target='_blank'>article</a>";
    }
    elseif($row["action"]=="replied to your comment on"){
        $query2=$con->prepare("SELECT postedBy FROM comments WHERE id=:commentId");
        $query2->bindParam(":commentId", $row["article_commentId"]);
        $query2->execute();
        $user=$query2->fetchColumn();
        $sentence=$row["postedBy"]." replied to your comment.";
    }
    elseif($row["action"]=="has seen"){
        $query3=$con->prepare("SELECT uploadedBy,title FROM articles WHERE id=:articleId");
        $query3->bindParam(":articleId", $row["article_commentId"]);
        $query3->execute();
        $user=$query3->fetchColumn();
        $url="read.php?id=".$row["article_commentId"];
        $sentence=$row["postedBy"]." has seen your <a href='$url' target='_blank'>article</a>";
    }
    elseif($row["action"]=="subscribed"){
        $sentence=$row["postedBy"]." subscribed to your newsletter";
        $user=$row["subscribedTo"];
    }
    elseif($row["action"]=="liked"){
        $query4=$con->prepare("SELECT uploadedBy,title FROM articles WHERE id=:articleId");
        $query4->bindParam(":articleId", $row["article_commentId"]);
        $query4->execute();
        $user=$query4->fetchColumn();
        $url="read.php?id=".$row["article_commentId"];
        $sentence=$row["postedBy"]." liked your <a href='$url' target='_blank'>article</a>";
    }
    elseif($row["action"]=="disliked"){
        $query5=$con->prepare("SELECT uploadedBy,title FROM articles WHERE id=:articleId");
        $query5->bindParam(":articleId", $row["article_commentId"]);
        $query5->execute();
        $user=$query5->fetchColumn();
        $url="read.php?id=".$row["article_commentId"];
        $sentence=$row["postedBy"]." disliked your <a href='$url' target='_blank'>article</a>";
    }
    elseif($row["action"]=="removed the like on"){
        $query6=$con->prepare("SELECT uploadedBy,title FROM articles WHERE id=:articleId");
        $query6->bindParam(":articleId", $row["article_commentId"]);
        $query6->execute();
        $user=$query6->fetchColumn();
        $url="read.php?id=".$row["article_commentId"];
        $sentence=$row["postedBy"]." removed the like on the <a href='$url' target='_blank'>article</a>";
    }
    elseif($row["action"]=="removed the dislike on"){
        $query7=$con->prepare("SELECT uploadedBy,title FROM articles WHERE id=:articleId");
        $query7->bindParam(":articleId", $row["article_commentId"]);
        $query7->execute();
        $user=$query7->fetchColumn();
        $url="read.php?id=".$row["article_commentId"];
        $sentence=$row["postedBy"]." removed the dislike on the <a href='$url' target='_blank'>article</a>";
    }
    if($user==$username && $user!=$row["postedBy"] && $row["postedBy"]!="") {
        $postedBy=$row["postedBy"];
        $time=$row["datePosted"];
        $idVal=$row["id"];
        $notifyTime=time_elapsed_string($time);
        $userLoggedInObj = new User($con, $postedBy);
        $src=$userLoggedInObj->getProfilePic();
        $verb.="<div id='$idVal' class='notify_item'><div class='notify_img'><img src='$src' alt='profile_pic' style='width: 50px'></div><div class='notify_info'><p>$sentence</p><span class='notify_time'>$notifyTime</span></div></div>";
    }
}
echo $verb;

function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}
?>