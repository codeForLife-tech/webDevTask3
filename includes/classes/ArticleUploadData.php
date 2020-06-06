<?php
class ArticleUploadData{
    public $articleDataArray,$title,$description,$privacy,$category,$uploadedBy;

    public function __construct($articleDataArray, $content, $title,$description,$privacy,$category,$uploadedBy){
        $this->articleDataArray=$articleDataArray;
        $this->title=$title;
        $this->content=$content;
        $this->description=$description;
        $this->privacy=$privacy;
        $this->category=$category;
        $this->uploadedBy=$uploadedBy;
    }

    public function updateDetails($con, $articleId) {
        $query=$con->prepare("UPDATE articles SET title=:title, description=:description, content=:content, privacy=:privacy, category=:category WHERE id=:articleId");
        $query->bindParam(":title", $this->title);
        $query->bindParam(":description", $this->description);
        $query->bindParam(":privacy", $this->privacy);
        $query->bindParam(":category", $this->category);
        $query->bindParam(":articleId", $articleId);
        $query->bindParam(':content', $this->content);
        return $query->execute();
    }
}
?>