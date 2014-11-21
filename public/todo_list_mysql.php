
<?php
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'denali_todo_db');
define('DB_USER', 'todouser');
define('DB_PASS', 'todopassword');

require '../include/dbconnect.php';

if(empty($_GET['page'])) {
	$page_num = 1;
	$offset_num = 0;
} else {
	$page_num = $_GET['page'];
	$offset_num = ($page_num - 1) * 4;
}

$count = $dbc->query('SELECT COUNT(*) FROM items')->fetchColumn();

if(isset($_GET['id'])){

	$deleted = $dbc->prepare("DELETE FROM items WHERE id = :id");

	$deleted->bindValue(':id', $_GET['id'], PDO::PARAM_INT);

	$deleted->execute();

}

if(!empty($_POST['new_item'])) {

	$newtodo = $dbc->prepare("INSERT INTO items(content) VALUES (:content)");

	$newtodo->bindValue(':content', $_POST['new_item'], PDO::PARAM_STR);

	$newtodo->execute();

} else if(empty($_POST['new_item'])){

	$error = 'Please Enter All Fields';
}

$object = $dbc->prepare("SELECT id, content FROM items LIMIT 4 OFFSET :offset_num");

$object->bindValue(':offset_num', $offset_num, PDO::PARAM_INT);

$object->execute();

$todo_list = $object->fetchAll(PDO::FETCH_ASSOC);

?>
<html>
	<head>
		<meta charset = "utf-8">
			<title>TODO List</title>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	
	<!-- Google Fonts -->
	<link href="http://fonts.googleapis.com/css?family=Oleo+Script" rel="stylesheet" type="text/css">
	<link href='http://fonts.googleapis.com/css?family=Shadows+Into+Light' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Old+Standard+TT:400,400italic,700|Special+Elite' rel='stylesheet' type='text/css'>
	
	<!-- CSS Sheet -->
	<link rel="stylesheet" type="text/css" href="css/stylesheet_mysql.css">

	</head>
	
	<div class='container'>
		<body>

			<h1 class="header jumbotron">ToDo List</h1>

			<!-- this form allows for new items to be added to the todo list -->
			<div class="newitem">
				<form method="POST" action="todo_list_mysql.php">
					<label for="newitem">
						New Item
						<input id="new_item" class='form-control input-sm' name="new_item" type="text">
					</label>
					<button type="submit" class="btn btn-success btn-xs">Add</button>
				</form>
			</div>

			<div id="list">
				<ul id="scribble">
					<!-- creating a foreach loop in php within the html so php is actually in control
					of the list items being added -->			
					<? foreach($todo_list as $value): ?>
					<li>
						<?= htmlspecialchars(strip_tags($value['content'])); ?> | <a href="?id=<?= $value['id'] ?>">Complete</a>
					</li>
					<? endforeach ?>
				</ul>
			</div>

			<button type="button" class="btn btn-default btn-sm">
				<a href="?page=<?= $page_num - 1 ?>">Previous</a>
			</button>

			<button type="button" class="btn btn-default btn-sm">
				<a href="?page=<?= $page_num + 1 ?>">Next</a>
			</button>
				
		<!-- JS script cdn and link to js sheet -->
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script type="text/javascript" src='js/todo_list.js'></script>

		</body>
	</div>

</html>
