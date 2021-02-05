 <html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Save and load data without leaving the page using PHP and Ajax</title>
<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script> -->
 
<style>
.form_style #textarea {
	border: 1px solid #CCCCCC;
}
 
.form_style #FormSubmit {
	display: block;
	background: #003366;
	border: 1px solid #000066;
	color: #FFFFFF;
	margin-top: 5px;
}

.form_style #formSubmit:disabled,
.form_style #formSubmit[disabled]{
  background: red;
}

#responds{
	margin: 0px;
	padding: 0px;
	list-style: none;
	width:100%;
}
#responds li{
	list-style: none;
	padding: 10px;
	background: #D1CFCE;
	margin-bottom: 5px;
	border-radius: 5px;
	font-family: arial;
	font-size: 13px;
}
.del_wrapper{float:right;}.content_wrapper {
	width: 500px;
	margin-right: auto;
	margin-left: auto;
}
.item-list{
	text-align: left;
}
#contentText{
	width: 100%;
}
</style>
</head>
<body align="middle">
	<h3><strong>Save and Load Data without leaving the page using PHP and Ajax</strong></h3>
	<hr>
<div class="content_wrapper">
<div class="form_style">
 
	<form id="content-form">
	    <textarea name="content_txt" id="contentText" cols="45" rows="5"></textarea>
	    <br>
	    <button id="FormSubmit">Add record</button>
    </form>
<br>
</div>
<ul id="responds">
<?php
//include db configuration file
include_once("config.php");
 
//MySQL query
$Result = mysqli_query($connecDB,"SELECT id,content FROM add_delete_record");
 
//get all records from add_delete_record table
while($row = mysqli_fetch_array($Result))
{
  echo '<li id="item_'.$row["id"].'" class="item-list">';
  echo $row["content"].'</li>';
}
 
//close db connection
?>
</ul>
<div id="respondStatus"></div>  
</div>
<script type="text/javascript">
const formtoSubmit = document.getElementById("content-form");

if (formtoSubmit.addEventListener) {
  formtoSubmit.addEventListener("submit", function(e) {
    const dataToAdd = document.getElementById("contentText").value;
    e.preventDefault();
    if (dataToAdd === ''){
      alert ("please add data to add");
      return false
    }
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        //parse JSON response from the php file
        var obj = JSON.parse(this.responseText);

        var node = document.createElement('li');
        node.setAttribute('class',obj['class']);
        node.setAttribute('id',obj['id']);
        node.appendChild(document.createTextNode(obj['content']));
        document.getElementById("responds").appendChild(node);
        document.getElementById("contentText").value = "";

        document.getElementById("respondStatus").innerHTML = obj['result'];
      }
    };
    xhttp.open("GET", "response01.php?content_txt="+dataToAdd, true);
    xhttp.send();

  }, true  );
} else {
  formtoSubmit.attachEvent('onsubmit', function(e) {
    e.preventDefault();
  });
}
</script>

</body>
</html>
