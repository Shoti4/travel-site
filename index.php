<?php

define('DB_NAME', "learning");
define('DB_USER', "root");
define('DB_PASS', "");
define('DB_SERV', "localhost");


try {
	
	$conn = new PDO("mysql:host=".DB_SERV.";dbname=".DB_NAME, DB_USER, DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
	
	// set the PDO error mode to exception
	$conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} 
catch(PDOException $e) {

	echo "Connection failed: " . $e->getMessage();

}







$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($action == 'delete') {

	$student_id = $_GET['student_id'];

	// $query = "DELETE FROM students WHERE id = " . $student_id;
	$query = "UPDATE students SET deleted = 1 WHERE id = " . $student_id;

	$stmt = $conn -> query($query);

}






// select all users
$query = "	SELECT 
				students.*,
			    gender.name AS gender_name
			FROM students
			INNER JOIN gender ON gender.id = students.gender_id
			WHERE deleted = 0";
$stmt = $conn -> query($query);

$students = $stmt -> fetchAll();

// echo '<pre>';
// print_r($_GET);
// echo '</pre>';


?><!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Students List</h2>
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Student ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Mobile</th>
        <th>Birth Date</th>
        <th>Gender</th>
        <th>DEL</th>
      </tr>
    </thead>
    <tbody>

    	<?php

    	foreach ($students as $student) {
    		?>
    		<tr>
				<td><?php echo $student['id'] ?></td>
				<td><?php echo $student['first_name'] ?></td>
				<td><?=$student['last_name']?></td>
				<td><?=$student['email']?></td>
				<td><?=$student['mobile']?></td>
				<td><?=$student['birth_date']?></td>
				<td><?=$student['gender_name']?></td>
				<td>
					<a href="?action=delete&student_id=<?=$student['id']?>">
						<img style="width: 25px; cursor: pointer;" src="icons/delete.png">
					</a>
				</td>
			</tr>
    		<?php
    	}

    	?>

    </tbody>
  </table>
</div>

</body>
</html>
