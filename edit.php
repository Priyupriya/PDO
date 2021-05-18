<?php
require 'db.php';
$id = $_GET['id'];
$sql = 'SELECT * from people where id=:id';
$statement = $connection->prepare($sql);
$statement->execute([':id' => $id]);
$person = $statement->fetch(PDO::FETCH_OBJ);

$message = '';
if(isset ($_POST['name']) && isset($_POST['email'])){
//echo 'submitted';
$name = $_POST['name'];
$email = $_POST['email'];
$sql = 'UPDATE people SET  name=:name, email=:email WHERE id=:id';
$statement = $connection->prepare($sql);
if($statement->execute([':name' => $name, ':email' => $email, 'id:'=> $id])){
header('location:index.php');	
}
}
?>
<?php require 'header.php';?>
<div class="container">
	<div class="card mt-5">
		<div class="card-header">
			<h2>Update person</h2>
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
				<input type="text" value="<?= $person->name; ?>" name="name" id="name" class="form-control">
			</div>
			<div class="form-group">
				<label for="email">Email</label>
				<input type="email" value="<?= $person->email; ?>" name="email" id="email" class="form-control">
			</div>
			<div class="form-group">
				<button type="submit" class="btn-btn-info">Submit</button>
			</div>
		</form>
	</div>
	</div>
</div>
<?php require 'footer.php';?>