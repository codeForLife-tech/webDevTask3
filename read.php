<?php
require_once("includes/header.php");
require_once("includes/classes/ArticleRead.php");
require_once("includes/classes/ArticleInfoSection.php");
require_once("includes/classes/Comment.php");
require_once("includes/classes/CommentSection.php");

if(!isset($_GET["id"])) {
    echo "No url passed into page";
    exit();
}

$article=new Article($con, $_GET["id"], $userLoggedInObj);
$article->incrementViews();
$username=$userLoggedInObj->getUsername();
$query=$con->prepare("SELECT statusPaused FROM users WHERE username=:user");
$query->bindParam(":user", $username);
$query->execute();
$status=$query->fetchColumn();
$query=$con->prepare("SELECT * FROM history WHERE user=:user AND articleId=:articleId AND statusPaused=:status");
$query->bindParam(":user", $username);
$query->bindParam(":articleId", $_GET["id"]);
$query->bindParam(":status", $status);
$query->execute();
if($query->rowCount()==0) {
    $query=$con->prepare("INSERT INTO history(user, articleId, statusPaused) VALUES(:user, :articleId, :status)");
    $query->bindParam(":user", $username);
    $query->bindParam(":articleId", $_GET["id"]);
    $query->bindParam(":status", $status);
    $query->execute();
    if($status==0) {
      $action="has seen";
      $query=$con->prepare("INSERT INTO notifications(postedBy, article_commentId, action) VALUES(:user, :article_commentId, :action)");
      $query->bindParam(":user", $username);
      $query->bindParam(":article_commentId", $_GET["id"]);
      $query->bindParam(":action", $action);
      $query->execute();
    }
}
?>
<script src="assets/js/articleReadActions.js"></script>

<script src="assets/js/commentActions.js"></script>

<div class="readLeftColumn">

<?php
    $articleInfo = new ArticleInfoSection($con, $article, $userLoggedInObj);
    echo $articleInfo->create();

    $articleRead = new ArticleRead($article);
    echo $articleRead->create();

    $commentSection = new CommentSection($con, $article, $userLoggedInObj);
    echo $commentSection->create();
?>

</div>

<div class="suggestions">
    <?php
    $articleGrid=new ArticleGrid($con, $userLoggedInObj);
    echo $articleGrid->create(1, null, false);
    ?>
</div>
<?php $text=$_SERVER['PHP_SELF'];
$protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === 0 ? 'https://' : '';
$url=$protocol.$_SERVER["HTTP_HOST"].$text."?id=".$_GET["id"]; ?>
<!-- Trigger/Open The Modal -->
<!-- The Modal -->
<div id="myModal" class="modal1">

  <!-- Modal content -->
  <div class="modal-content1">
    <div class="modal-header1">
      <span class="close1">&times;</span>
      <h2>Share article through</h2>
    </div>
    <div class="modal-body1" id='bodyMargin'>
      <a id='blue' href="https://twitter.com/intent/tweet?text=<?php echo $url; ?>">
      <i class="fab fa-twitter fa-3x" aria-hidden="true"></i>
      <span>Twitter</span>
      </a>
      <a href="https://web.whatsapp.com/send?text=<?php echo $url; ?>" data-action="share/whatsapp/share">
      <i class="fab fa-whatsapp-square green fa-3x"></i>
      <span id='whats'>Whatsapp</span>
      </a>
      <a href="mailto:?subject=I wanted you to see this site&amp;body=Check out this article <?php echo $url; ?> ."
        title="Share by Email">
        <i class="fas fa-envelope fa-3x red" id='marginLeft1' aria-hidden="true"></i>
        <span id='marginLeft2'>Email</span>
      </a>
    </div>
    <div class="modal-footer1">
      <h5>Made by BlogNow</h5>
    </div>
  </div>

</div>
<script src="assets/js/speech.js"></script>
<?php require_once("includes/footer.php"); ?>