<?php
require('includes/config.php');

	if(!empty($_POST))
	
	{
		$msg=array();
		if(empty($_POST['name']) && empty($_POST['review']))
		{
			$msg[]="Please full fill all requirement";
		}
		
		if(!empty($msg))
		{
			echo '<b>Error:-</b><br>';
			
			foreach($msg as $k)
			{
				echo '<li>'.$k;
			}
		}
		
		else
		{
		
					
			$b_nm=$_POST['name'];
			$b_cat=$_POST['cat'];
			$b_rev=$_POST['review'];
			
			
		
			
			$query="insert into book(b_nm,b_subcat,b_rev)
			values('$b_nm','$b_cat','$b_rev')";
			
			mysqli_query($conn,$query) or die($query."Can't Connect to Query...");
			header("location:addreview.php");
		
	}

	}
	else
	{
		header("location:index.php");
	}
?>
	
	