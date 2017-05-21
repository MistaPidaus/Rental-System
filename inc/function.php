<?php
/*
*	Funtion to check empty fields
*/
function checkMenu($Title)
{
 if($Title == 'Home')
	  { 
		$active = "<li class='active'>";
		echo $active; 
		} else { 
		$active = "<li>";
		echo $active;
			} 
		return $active;
}
?>
