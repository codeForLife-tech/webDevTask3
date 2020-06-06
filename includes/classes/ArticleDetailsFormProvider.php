<?php
class ArticleDetailsFormProvider{
    private $con, $content;

    public function __construct($con, $content){
        $this->con=$con;
        $this->content=$content;
    }
    public function createUploadForm(){
        $fileInput=$this->createFileInput();
        $titleInput=$this->createTitleInput(null);
        $descriptionInput=$this->createDescriptionInput(null);
        $privacyInput=$this->createPrivacyInput(null);
        $categoriesInput=$this->createCategoriesInput(null);
        $uploadButton=$this->createUploadButton();
        $action="processing.php";
        $text=$this->content;
        
        return "<form action='$action' method='POST' enctype='multipart/form-data'>
                    <input type='text' name='articleText' value='$text' hidden>
                    $fileInput
                    $titleInput
                    $descriptionInput
                    $privacyInput
                    $categoriesInput
                    $uploadButton
                </form>";
    }

    public function createEditDetailsForm($article){
        $titleInput=$this->createTitleInput($article->getTitle());
        $descriptionInput=$this->createDescriptionInput($article->getDescription());
        $privacyInput=$this->createPrivacyInput($article->getPrivacy());
        $categoriesInput=$this->createCategoriesInput($article->getCategory());
        $saveButton=$this->createSaveButton();
        $text=$this->content;
        return "<form method='POST' id='draftPublish'>
                    <input type='text' id='draftHtml' name='articleText' hidden>
                    $titleInput
                    $descriptionInput
                    $privacyInput
                    $categoriesInput
                    $saveButton
                </form>";
    }

    private function createFileInput(){

    return "<div class='form-group'>
                <label for='exampleFormControlFile1'>Your thumbnail</label>
                <input type='file' class='form-control-file' id='exampleFormControlFile1' name='fileInput' required>
            </div>";
    }
    private function createTitleInput($value){
        if($value==null) $value="";
        return "<div class='form-group'>
                    <input class='form-control' type='text' placeholder='Title(max 60 characters)' name='titleInput' value='$value'>
                </div>";
    }
    private function createDescriptionInput($value){
        if($value==null) $value="";
        return "<div class='form-group'>
                    <textarea  class='form-control' placeholder='Description' name='descriptionInput' style='resize:none;' rows='3'>$value</textarea>
                </div>";
    }
    private function createPrivacyInput($value){
        if($value==null) $value="";

        $privateSelected=($value==0) ? "selected='selected'" : "";
        $publicSelected=($value==1) ? "selected='selected'" : "";

        return "<div class='form-group'>
                    <select class='form-control' name='privacyInput'>
                        <option value='0' $privateSelected>Private</option>
                        <option value='1' $publicSelected>Public</option>
                    </select>
                </div>
                ";
        
    }
    private function createCategoriesInput($value) {
        if($value==null) $value="";
        $query=$this->con->prepare("SELECT * FROM CATEGORIES");
        $query->execute();
        $html="<div class='form-group'>
        <select class='form-control' name='categoryInput'>";

        while($row=$query->fetch(PDO::FETCH_ASSOC)){
            $id=$row["id"];
            $name=$row["name"];
            $selected=($id==$value) ? "selected='selected'" : "";

            $html.="<option value='$id' $selected>$name</option>";
        }

        $html.="</select>
            </div>";
        
        return $html;
    }
    private function createUploadButton(){
        return "<button type='submit' class='btn btn-primary' name='uploadButton'>Upload</button>";
    }

    private function createSaveButton(){
        return "<button onclick='submitForm()' id='saveButton' class='btn btn-primary' name='saveButton'>Save</button>";
    }
}
?>