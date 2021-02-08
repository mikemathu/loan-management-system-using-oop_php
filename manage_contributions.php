<?php include 'db_connect.php' ?>
<?php 

if(isset($_GET['id'])){
	$qry = $conn->query("SELECT * FROM borrowers where id=".$_GET['id']);
	foreach($qry->fetch_array() as $k => $val){
		$$k = $val;
	}
}

?>
<div class="container-fluid">
	<div class="col-lg-12">
		<form id="manage-contributions">
		
		<input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>">
			<div class="row" >
				<div class="col-md-4">
					<div class="form-group">
						<input type="hidden" name="lastname" class="form-control" required="" value="<?php echo isset($lastname) ? $lastname : '' ?>">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<input type="hidden" name="firstname" class="form-control" required="" value="<?php echo isset($firstname) ? $firstname : '' ?>">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<input type="hidden" name="middlename" class="form-control" value="<?php echo isset($middlename) ? $middlename : '' ?>">
					</div>
				</div>
			</div>
			<div class="row form-group">
				<div class="col-md-6">
					<input type="hidden" name="address" class="form-control"value="<?php echo isset($address) ? $address : '' ?>" >
				</div>
				<div class="col-md-5">
					<div class="">
						<input type="hidden" type="text" class="form-control" name="contact_no" value="<?php echo isset($contact_no) ? $contact_no : '' ?>">
					</div>
				</div>
			</div>
			<div class="row form-group">
				<div class="col-md-6">
					<input type="hidden" type="email" class="form-control" name="email" value="<?php echo isset($email) ? $email : '' ?>">
				</div>
				<div class="col-md-5">
					<div class="">
						<input type="hidden" type="text" class="form-control" name="tax_id" value="<?php echo isset($tax_id) ? $tax_id : '' ?>">
					</div>
				</div>
			</div>
		
			<input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group style=size:100%">
							<?php 
								$qry = $conn->query("SELECT * FROM borrowers where id=".$_GET['id']. "  order by id desc");
								while($row = $qry->fetch_assoc()): ?>
									<label for="" class="control-label">Name</label>
									<input name="fullname" class="form-control" required="" value="<?php echo ucwords($row['lastname'].", ".$row['firstname'].' '.$row['middlename']) ?>" disabled>
							<?php endwhile; ?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="">Contibutions</label>
						<div class="form-group col-md-6">
							<input type="number" name="total_amount_contributed" class="form-control text-right" step="any" required="" value="<?php echo isset($total_amount_contributed) ? $total_amount_contributed : '' ?>">
						</div>						
					</div>
				</div>
			</div>
		</form>
	</div>
</div>

<script>
	 $('#manage-contributions').submit(function(e){
	 	e.preventDefault()
	 	start_load()
	 	$.ajax({
	 		url:'ajax.php?action=save_contributions',
	 		method:'POST',
	 		data:$(this).serialize(),
	 		success:function(resp){
	 			if(resp == 1){
	 				alert_toast("Contributions data successfully saved.","success");
	 				setTimeout(function(e){
	 					location.reload()
	 				},1500)
	 			}
	 		}
	 	})
	 })
</script>