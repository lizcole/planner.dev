<?php

//call the todolist_inlude.php file and require it to run the following script
require_once '../include/todolist_include.php';
require_once '../include/file_store.php';


//call the method openFile inside the class TodoList
	$todolist = new TodoList($filename = 'todo_list.txt');
	$todo_array = $todolist->openFile();
	//assign the todo list array to the openFile function to add the preexisting items

	// var_dump($todo_array);

	//this unsets(deletes) an item from the array
	if(isset($_GET['id'])) {
		//assigning twice id because browser is complianing
		$id = ' ';
		$id = $_GET['id'];
		unset($todo_array[$id]);
		$todo_array = array_values($todo_array);
		$todolist->saveFile($todo_array);
	}

	if(isset($_POST['new_item'])) {
		// echo "add item: " . $_POST['new_item'];
		$additem = $_POST['new_item'];
		$todo_array[] = $additem;
		$todolist->saveFile($todo_array);
		}

	//create a way for files that are uploaded to be saved
		//this checks to make sure there is a file to upload and that there are no errors
	if(count($_FILES) > 0 && $_FILES['file1']['error'] == UPLOAD_ERR_OK && $_FILES['file1']['type'] == 'text/plain') {
		//if the file meets the above checks then...
		
		//set destination for uploads to specific to directory
		$uploadDir = '/vagrant/sites/planner.dev/public/uploads/';

		//set the uploaded file to a var for usability
		$uploadFile = basename($_FILES['file1']['name']);

		//create a new filename var for the saved upload combining the dir var and the uploadfile var
		$savedFile = $uploadDir . $uploadFile;

		//move the newly craated var containing the correct dir and the file name to the upload directory
		move_uploaded_file($_FILES['file1']['tmp_name'], $savedFile);

		// open new file return array
		$upload_todo = $todolist->openFile('uploads/' . $uploadFile);
		// var_dump($upload_todo);

		// merge with upload if exists
		$todo_array = array_merge($todo_array, $upload_todo);
		$todolist->saveFile($todo_array);
	}

	
	
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
		<link rel="stylesheet" type="text/css" href="css/style_sheet.css">

	</head>
	<div class='container'>
	<body>

			<h1 class="header jumbotron">ToDo List</h1>

			<!-- this form allows for new items to be added to the todo list -->
			<div class="newitem">
				<form method="POST" action="/todo_list.php">
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
					
				
					<? foreach($todo_array as $key => $value): ?>
					<li>
						<?= htmlspecialchars(strip_tags($value)); ?> | <a href="?id=<?= $key ?>">Complete</a>
					</li>
					<? endforeach ?>
				</ul>
			</div>

			<div id='upload'>
			<!-- this form allows for media to be uploaded -->
			<form method = 'POST' enctype="multipart/form-data" action='/todo_list.php'>
				<p>
					<label for='file1'> File to upload:</label>
					<input type='file' id='file1' name='file1'>
				</p>
				<!-- creat button to hit upload -->
				<p>
					<input type='submit' value='upload'>
				</p>
			</form>
		<?
			//run a check to see if the file was saved				
			//if savedFile was set then show a link to the uploaded file
	 		if(isset($savedFile)): ?>
				<p>
					You can download your file:
					<a href='/uploads/<?= $uploadFile ?>'>Here</a>
				</p>
			<? endif ?>
			</div>
			
<!-- JS script cdn and link to js sheet -->
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script type="text/javascript" src='js/todo_list.js'></script>

	</body>
	</div>
	</html>