<?php
class ArticleProcessor{
    private $con;

    public function __construct($con){
        $this->con=$con;
    }
    
    public function upload($articleUploadData){
        $targetdir="uploads/articles/thumbnails/";
        $articleData=$articleUploadData->articleDataArray;

        $tempFilePath=$targetdir.uniqid().basename($articleData["name"]);
        $tempFilePath=str_replace(" ","_",$tempFilePath);

        if(move_uploaded_file($articleData["tmp_name"],$tempFilePath)){
            
            if(!$this->insertArticleData($articleUploadData,$tempFilePath)){
                echo "Insert query failed";
                return false;
            }
            return true;

        }
    }

    private function insertArticleData($uploadData, $filePath){
        $text=$uploadData->content;
        $spaceString = str_replace( '<', ' <', $text);
        $doubleSpace = strip_tags($spaceString);
        $textContent = preg_replace('/[\s]+/mu', ' ', trim($doubleSpace));
        $length=str_word_count($textContent);
        $length=$length." words";
        $query=$this->con->prepare("INSERT INTO articles(title,uploadedBy,description, content, privacy,category,length)
                                    VALUES(:title, :uploadedBy, :description, :content, :privacy, :category, :length)");

        $query->bindParam(":title", $uploadData->title);
        $query->bindParam(":uploadedBy", $uploadData->uploadedBy);
        $query->bindParam(":length", $length);
        $query->bindParam(":content", $uploadData->content);
        $query->bindParam(":description", $uploadData->description);
        $query->bindParam(":privacy", $uploadData->privacy);
        $query->bindParam(":category", $uploadData->category);
        $query->execute();
        $articleId=$this->con->lastInsertId();
            $query=$this->con->prepare("INSERT INTO thumbnails(articleId, filePath)
                                        VALUES(:articleId,:filePath)");
            $query->bindParam(":articleId",$articleId);
            $query->bindParam(":filePath",$filePath);
        return $query->execute();
    }
}
?>