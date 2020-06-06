<?php
require_once("includes/header.php");
if($userLoggedInObj->getUsername()=="") {
  echo "You must be logged in to upload an article";
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Draft</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <script src="https://kit.fontawesome.com/d1766da268.js" crossorigin="anonymous"></script>
</head>
<body onload="enableEditMode();">
<div>
    <div id='tools'>
      <button onclick="execCmd('bold');"><i class="fa fa-bold"></i></button>
<button onclick="execCmd('italic');"><i class="fa fa-italic"></i></button>
<button onclick="execCmd('underline');"><i class="fa fa-underline"></i></button>
<button onclick="execCmd('strikeThrough');"><i class="fa fa-strikethrough"></i></button>
<button onclick="execCmd('justifyLeft');"><i class="fa fa-align-left"></i></button>
<button onclick="execCmd('justifyCenter');"><i class="fa fa-align-center"></i></button>
<button onclick="execCmd('justifyRight');"><i class="fa fa-align-right"></i></button>
<button onclick="execCmd('justifyFull');"><i class="fa fa-align-justify"></i></button>
<button onclick="execCmd('cut');"><i class="fa fa-cut"></i></button>
<button onclick="execCmd('copy');"><i class="fa fa-copy"></i></button>
<button onclick="execCmd('indent');"><i class="fa fa-indent"></i></button>
<button onclick="execCmd('outdent');"><i class="fa fa-dedent"></i></button>
<button onclick="execCmd('subscript');"><i class="fa fa-subscript"></i></button>
<button onclick="execCmd('superscript');"><i class="fa fa-superscript"></i></button>
<button onclick="execCmd('undo');"><i class="fa fa-undo"></i></button>
<button onclick="execCmd('redo');"><i class="fa fa-repeat"></i></button>
<button onclick="execCmd('insertUnorderedList');"><i class="fa fa-list-ul"></i></button>
<button onclick="execCmd('insertOrderedList');"><i class="fa fa-list-ol"></i></button>
<button onclick="execCmd('insertParagraph');"><i class="fa fa-paragraph"></i></button>
<select onchange="execCmd('formatBlock', this.value);">
<option value="H1">H1</option>
<option value="H2">H2</option>
<option value="H3">H3</option>
<option value="H4">H4</option>
<option value="H5">H5</option>
<option value="H6">H6</option>
</select>
<button onclick="execCmd('insertHorizontalRule');">HR</button>
<button onclick="execCmd('createLink', prompt('Enter a URL', 'http://'));"><i class="fa fa-link"></i></button>
<button onclick="execCmd('unlink');"><i class="fa fa-unlink"></i></button>
<button onclick="toggleSource();"><i class="fa fa-code"></i></button>
<button onclick="toggleEdit();">Toggle Edit</button>
<br>
<select onchange="execCmd('fontName', this.value);">
<option value="Arial">Arial</option>
<option value="Comic Sans MS">Comic Sans MS</option>
<option value="Courier">Courier</option>
<option value="Georgia">Georgia</option>
<option value="Tahoma">Tahoma</option>
<option value="Times New Roman">Times New Roman</option>
<option value="Verdana">Verdana</option>
</select>
<select onchange="execCmd('fontSize', this.value);">
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
</select>
Fore Color: <input type="color" onchange="execCmd('foreColor', this.value);">
Background: <input type="color" onchange="execCmd('hiliteColor', this.value);">
<label for='file'><i class="fa fa-file-image-o"></i></label>
   <input type="file" name="file" id="file"/>
<!-- <button onclick="execCmd('insertImage', prompt('Enter the image URL', 'https://'));"></button> -->
<button onclick="execCmd('selectAll');">Select All</button>
    </div>
    <iframe name="richTextField" width="1000px"; height="500px;"></iframe>
    <form action="upload.php" method='POST' id='draftPublish'>
      <input type="text" name='content' id='draftHtml' hidden>
      <button class="btn btn-primary" onclick='submitForm()'>DRAFT AND PUBLISH</button>
    </form>
    </div>
    <script type="text/javascript">
    var showingSourceCode=false;
    var isInEditMode=true;
    function enableEditMode() {
        richTextField.document.designMode='On';
        richTextField.focus();
        var cssLink = document.createElement("link");
        cssLink.href = "assets/css/style.css"; 
        cssLink.rel = "stylesheet"; 
        cssLink.type = "text/css"; 
        richTextField.document.head.appendChild(cssLink);
    }
    function execCmd(command, val=null) {
            console.log(command, val);
            richTextField.document.execCommand(command, false, val);
    }
    function toggleSource () {
				if(showingSourceCode){
					richTextField.document.getElementsByTagName('body')[0].innerHTML = richTextField.document.getElementsByTagName('body')[0].textContent;
					showingSourceCode = false;
				}else{
					richTextField.document.getElementsByTagName('body')[0].textContent = richTextField.document.getElementsByTagName('body')[0].innerHTML;
					showingSourceCode = true;
				}
			}

	function toggleEdit () {
		if(isInEditMode){
				richTextField.document.designMode = 'Off';
				isInEditMode = false;
		}else{
				richTextField.document.designMode = 'On';
				isInEditMode = true;
		}
	}
  function escapeHtml(unsafe) {
        return unsafe
            
    }
richTextField.document.body.addEventListener('click', (event) => {
  if (event.target.tagName === 'IMG') {
    console.log('image clicked');
    var tools=document.querySelector('#tools');
    width=event.target.width;
    height=event.target.height;
    event.target.classList.toggle('selected');
    if(event.target.classList.contains('selected')) {
        console.log(width);
        tools.innerHTML+="<label id='label1'>Width: </label><input onchange='setWidth(this.value)' id='dim1' type='number' min='1'>";
        tools.innerHTML+="<label id='label2'>Height: </label><input onchange='setHeight(this.value)' id='dim2' type='number' min='1'>";
        document.getElementById('dim1').value=width;
        document.getElementById('dim2').value=height;
    }
    else {
        toggleDimensions();
    }
  }
  else if(richTextField.document.querySelector('.selected')!=null) {
    richTextField.document.querySelector('.selected').classList.remove('selected');
    toggleDimensions();
  }
});
function toggleDimensions() {
  $('#dim1').remove();
    $('#dim2').remove();
    $('#label1').remove();
    $('#label2').remove();
}
function setWidth(val) {
  var selElement = richTextField.document.querySelector('.selected');
  selElement.style.width=val;
  document.querySelector('#dim2').value=selElement.clientHeight;
}
const replaceOnDocument = (pattern, string, {target = richTextField.document.body} = {}) => {
  [target,
    ...target.querySelectorAll("*:not(script):not(noscript):not(style)")
  ].forEach(({childNodes: [...nodes]}) => nodes
    .filter(({nodeType}) => nodeType === document.TEXT_NODE)
    .forEach((textNode) => textNode.textContent = textNode.textContent.replace(pattern, string)));
};


function submitForm() {
  event.preventDefault();
  replaceOnDocument(/"/g, "&quot;");
  replaceOnDocument(/'/g, "&#039;");
  replaceOnDocument(/>/g, "&gt;");
  replaceOnDocument(/</g, "&lt;");
  document.getElementById('draftHtml').value=richTextField.document.getElementsByTagName('body')[0].innerHTML;
  document.getElementById('draftPublish').submit();
}

function setHeight(val) {
  var selElement = richTextField.document.querySelector('.selected');
  selElement.style.height=val;
  document.querySelector('#dim1').value=selElement.clientWidth;
}

    $(document).ready(function(){
 $(document).on('change', '#file', function(){
     var property=document.getElementById("file").files[0];
  var image_name = property.name;
  var form_data = new FormData();
  var ext = image_name.split('.').pop().toLowerCase();
  var image_size = property.size;
  if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
  {
   alert("Invalid Image File");
  }
  else if(image_size > 2000000)
  {
   alert("Image File Size is very big");
  }
  else
  {
   var form_data=new FormData();
   form_data.append("file", property);
   $.ajax({
    url:"ajax/moveFile.php",
    method:"POST",
    data: form_data,
    contentType: false,
    cache: false,
    processData: false, 
    success:function(data)
    {
     execCmd('insertImage', data);
    }
   });
  }
 });
});
    </script>
</body>
</html>