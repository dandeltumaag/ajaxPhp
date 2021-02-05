<?php
//include db configuration file
include_once("config.php");
$value = $_GET['content_txt'];
if(isset($_GET["content_txt"]) && strlen($_GET["content_txt"])>0) 
{
  $array = array();	
	$contentToSave = filter_var($_GET["content_txt"],FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH); 
 
	if(mysqli_query($connecDB,"INSERT INTO add_delete_record(content) VALUES('$contentToSave')"))
	{
		  $my_id = mysqli_insert_id($connecDB);
		  // echo '<li id="item_'.$my_id.'" class="item-list">';
      // echo $contentToSave.'</li>';

      $array['id'] = "item_' .$my_id. '";
      $array['class'] = "item-list";
      $array['content'] = $contentToSave;
      $array['result'] = "success";

      //echode the response as an array using json_encode
      echo json_encode($array);

       
	}
 
} else {
  $array['result'] = "<p>something went wrong no data added, value " . $_GET['content_txt'] . "</p>" ;
  echo json_encode($array);
}
?>