<?php 
require_once("includes/header.php");
require_once("includes/classes/ArticleUploadData.php");
require_once("includes/classes/ArticleProcessor.php");
if(!isset($_POST["uploadButton"])){
    echo "No file sent to page.";
    exit();
}

$articleUploadData= new ArticleUploadData(
                            $_FILES["fileInput"],
                            $_POST["articleText"],
                            $_POST["titleInput"],
                            $_POST["descriptionInput"],
                            $_POST["privacyInput"],
                            $_POST["categoryInput"],
                            $userLoggedInObj->getUsername()
                        );
$articleProcessor= new ArticleProcessor($con);
$wasSuccessful=$articleProcessor->upload($articleUploadData);

if($wasSuccessful){
    echo "Upload successful";
}
 ?>