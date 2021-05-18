<?php
require 'db.php';
$message = '';
if(isset ($_POST['name']) && isset($_POST['email'])){
//echo 'submitted';
$name = $_POST['name'];
$email = $_POST['email'];
$sql = 'INSERT into people(name,email) values(:name, :email)';
$statement = $connection->prepare($sql);
if($statement->execute([':name' => $name, ':email' => $email])){
$message = 'Date inserted successfully';	
}
}
?>
<?php require 'header.php';?>
<div class="container">
	<div class="card mt-5">
		<div class="card-header">
			<h2>Çreate a person</h2>
		</div>
	<div class="card-body">
		<?php if(!empty($message)):?>
			<div class="alert alert-success">
				<?= $message; ?>
			</div>
		<?php endif; ?>
		<form method="post">
			<div class="form-group">
				<label for="name">Name</label>
				<input type="text" name="name" id="name" class="form-control">
			</div>
			<div class="form-group">
				<label for="email">Email</label>
				<input type="email" name="email" id="email" class="form-control">
			</div>
			<div class="form-group">
				<button type="submit" class="btn-btn-info">Submit</button>
			</div>
		</form>
	</div>
	</div>
</div>
<?php require 'footer.php';?>