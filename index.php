<?php 
// require_once 'db.php'; 
// $stmt = DB::run("SELECT * FROM people");
// while ($row = $stmt->fetch(PDO::FETCH_LAZY))
// {
    // echo $row['name'],",";
    // echo $row->name,",";
    // echo $row[1], PHP_EOL;
// }
// $sql_conn = 'SELECT * from people';
// $id = 1;
//$db= Config::getInstance();
// $row = $db->query("SELECT * FROM people WHERE id=?", [$id]);
// var_export($row);

require_once 'db.php';
//$id = 0;

$sql = 'SELECT * from people';
$statement = $conn->prepare($sql);
//$statement->execute([':id' => $id]);
$statement->execute();
$people = $statement->fetchAll(PDO::FETCH_ASSOC);
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
    					<td><?php echo $person['id']; ?></td>
    					<td><?= $person['name']; ?></td>
    					<td><?php echo $person['email']; ?></td>
    					<td>
    						<a href="edit.php?id=<?= $person['id']; ?>" class="btn btn-info">Edit</a>
    						<a onclick="return confirm('Are you sure want to delete this data?')" href="delete.php?id=<?= $person['id']; ?>" class="btn btn-danger">Delete</a>
    					</td>
    				</tr>
    			<?php endforeach; ?>
    			</table>
    		</div>
    	</div>
    </div>
<?php require 'footer.php';?>