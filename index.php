<?php 
require_once('config/header.php'); 
?> 

<div class="container">
  <h2>Records</h2>
  <p>
	<a href="/" >Home</a> | 
	<a href="/add.php" >Add ECIB Record</a>
  </p>
  <table class="table" id="datatable_app">
    <thead>
      <tr>
	  <th>Action</th>
		<th>TT_ID</th>
		<th>TT_Name</th>
		<th>TT_Date</th>
		<th>TT_Amount</th>
      </tr>
    </thead>
    <tbody>
	<?php 
		$tsql = "SELECT * FROM TestTable";

		$getResults= sqlsrv_query($conn, $tsql);

		if ($getResults == FALSE)
			die(FormatErrors(sqlsrv_errors()));
		while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) {
	
	?>
			<tr>
			<td>
				<a href="/edit.php?ID=<?php echo $row['TT_ID']?>" >Edit</a> | 
				<a href="/delete.php?ID=<?php echo $row['TT_ID']?>" >Delete</a>
			</td>  
				<td><?php echo $row["TT_ID"];?></td>
				<td><?php echo $row["TT_Name"]?></td>
				<td><?php echo $row["TT_Date"]->format('Y-m-d')?></td>
				<td><?php echo $row["TT_Amount"]?></td>
			</tr>

	

<?php	
	}
sqlsrv_free_stmt($getResults);

?>
	
        
    </tbody>
  </table>
</div>

<script>
$(document).ready(function() {
    var table = $('#datatable_app').DataTable( {
        "scrollX": true
    });
     
});

</script>

<?php 
require_once('config/footer.php'); 
?>