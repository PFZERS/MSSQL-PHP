<?php 
require_once('config/header.php'); 

$status_message = "";
$status = "none";

if(isset($_POST['submit'])){
	
	
	$tsql= "
		UPDATE [dbo].[TestTable]
           SET [TT_Name] = ?
           ,[TT_Date] = ?
           ,[TT_Amount] = ?
		WHERE TT_ID = ?;";
	
	$params = array();
	$params[] = $_POST["TT_Name"];
	$params[] = $_POST["TT_Date"];
	$params[] = $_POST["TT_Amount"];
	$params[] = $_GET['ID'];
	
	$getResults= sqlsrv_query($conn, $tsql, $params);
	$rowsAffected = sqlsrv_rows_affected($getResults);
	if ($getResults == FALSE or $rowsAffected == FALSE){
		
		$status_message = FormatErrors(sqlsrv_errors());
		$status = "error";
			
	}else{
		
					
		$status_message = $rowsAffected. " record Updated: ";
		$status = "success";
		
	}
	sqlsrv_free_stmt($getResults);


	
	
}


?> 


<div class="container">
	<?php if($status != "none"){ ?>
		<?php if($status == "success"){ ?>
		
			<div class="alert alert-success alert-dismissible">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Success!</strong> <?php echo $status_message;?>
			</div>
		
		<?php }elseif($status == "error"){ ?>
		
			<div class="alert alert-danger alert-dismissible">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Error!</strong> <?php echo $status_message;?>
			</div>

		<?php } ?>
	<?php } ?>

  <h2>Edit Record</h2>
  <p><a href="/" >Records</a></p>
  <?php if(isset($_GET['ID'])){ ?>
	
	<?php 
		$tsql = "SELECT * FROM TestTable WHERE ID = ".$_GET['ID'];

		$getResults= sqlsrv_query($conn, $tsql);
		
		if ($getResults == FALSE)
			die(FormatErrors(sqlsrv_errors()));
		while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) {
	?>
  
		<form action="" method="post">
			<div class="row">
			 
				<div class="form-group col-sm-6">
					<label for="TT_Name">Name</label>
					<input type="text" value="<?php echo $row["TT_Name"]?>" required class="form-control" name="TT_Name" id="TT_Name" />
				</div>
				<div class="form-group col-sm-6">
					<label for="TT_Amount">Amount</label>
					<input type="number" value="<?php echo $row["TT_Amount"]?>" required class="form-control" name="TT_Amount" id="TT_Amount" />
				</div>
				<div class="form-group col-sm-6">
					<label for="TT_Date">Date</label>
					<input type="date" value="<?php $row["TT_Date"]->format('Y-m-d')?>" required class="form-control" name="TT_Date" id="TT_Date" />
				</div>
			</div>
			<div class="row">


		
			<button type="submit" name="submit" class="btn btn-default">Submit</button>
			</div>
		</form>
	
	<?php } ?>

	<?php }else{ ?>
  
	 <p>Not Found </p>
  
  <?php } ?>
  

</div>

<?php 
require_once('config/footer.php'); 
?>
