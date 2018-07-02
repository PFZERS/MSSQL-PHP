<?php 
require_once('config/header.php'); 
?> 

<div class="container">
 
	<?php if(isset($_GET['ID'])){ ?>
	<?php
	
			
		$ID = $_GET['ID'];
		$tsql= "DELETE FROM TestTable WHERE ID = ".$ID;
		$getResults= sqlsrv_query($conn, $tsql);
		$rowsAffected = sqlsrv_rows_affected($getResults);
		if ($getResults == FALSE or $rowsAffected == FALSE){
			
			echo FormatErrors(sqlsrv_errors());
		 
		}
	?>
	<p>
	<?php	
		echo ($rowsAffected. " Record deleted: " . PHP_EOL);
		sqlsrv_free_stmt($getResults);	
	
	?>
		  <a href="/" >Go Back</a></p>
  
  <?php }else{ ?>
  
	 <p>Not Found <a href="/" >Go Back</a></p>
  
  <?php } ?>

</div>

<?php 
require_once('config/footer.php'); 
?>