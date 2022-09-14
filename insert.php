<?php
$connect = mysqli_connect("localhost", "root", "", "sistema");
$query = "INSERT INTO media(file_name) VALUES ('".$_POST["hidden_skills"]."')";
if(mysqli_query($connect, $query))
{
 echo 'Data Inserted';
}
?>
<p><iframe width="100%" height="515" src="https://www.youtube.com/embed/5eUwZPA0fRI" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe></p>
<div style="clear: both;"></div>