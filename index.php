<?php require_once 'new_db.php'; 
//$sql_conn = 'SELECT * from people';
$id = 0;
$sql_conn = Config::getInstance()->query("SELECT * FROM people");

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
    				<?php foreach($sql_conn as $person ):?>
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