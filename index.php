<?php

define('DB_NAME', "learning");
define('DB_USER', "root");
define('DB_PASS', "");
define('DB_SERV', "localhost");


try {
	
	$conn = new PDO("mysql:host=".DB_SERV.";dbname=".DB_NAME, DB_USER, DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
	
	// set the PDO error mode to exception
	$conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


	// select all users
	$query = "	SELECT 
					students.*,
				    gender.name AS gender_name
				FROM students
				INNER JOIN gender ON gender.id = students.gender_id";
	$stmt = $conn -> query($query);

	$students = $stmt -> fetchAll();

} 
catch(PDOException $e) {

	echo "Connection failed: " . $e->getMessage();

}

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
			</tr>
    		<?php
    	}

    	?>

    </tbody>
  </table>
</div>

</body>
</html>