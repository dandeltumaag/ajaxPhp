<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Save and load data without leaving the page using PHP and Ajax</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
 
<script type="text/javascript">
$(document).ready(function() {
 
	//##### Add record when Add Record Button is click #########
	$("#content-form").submit(function (e) {
			e.preventDefault();
			if($("#contentText").val()==='')
			{
				alert("Please enter some text!");
				return false;
			}
		 	var myData = 'content_txt='+ $("#contentText").val(); //build a post data structure
			jQuery.ajax({
			type: "POST", // Post / Get method
			url: "response.php", //Where form data is sent on submission
			dataType:"text", // Data type, HTML, json etc.
			data:myData, //Form variables
			success:function(response){
				$("#responds").append(response);
        $('#contentText').val("")
			},
			error:function (xhr, ajaxOptions, thrownError){
				alert(thrownError);
			}
			});
	});
 
});
</script>
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
</div>
</body>
</html>
