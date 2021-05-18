<?php require 'db.php'; 
$sql = 'SELECT * from people';
$statement = $connection->prepare($sql);
$statement->excute();
$people = $statement->fetchAll(PDO::FETCH_OBJ);
?>
<?php require 'header.php';?>
    <div class="container">
    	<div class="card mt-5">
    		<div class="card-header">
    			<h2>ALL People</h2>
    		</div>
    		<div class="card-body">
    			<table class="table table-bordered">
    				<tr>
    					<th>ID</th>
    					<th>NAME</th>
    					<th>EMAIL</th>
    					<th>ACTION</th>
    				</tr>
    				<?php foreach($people as $person ):?>
    				<tr>
    					<td><?= $person->id; ?></td>
    					<td><?= $person->name; ?></td>
    					<td><?php echo $person->email; ?></td>
    					<td>
    						<a href="edit.php?id=<?= $person->id; ?>" class="btn btn-info">Edit</a>
    						<a onclick="return confirm('Are you sure want to delete this data?')" href="delete.php?id=<?= $person->id ?>" class="btn btn-danger">Delete</a>
    					</td>
    				</tr>
    			<?php endforeach; ?>
    			</table>
    		</div>
    	</div>
    </div>
<?php require 'footer.php';?>