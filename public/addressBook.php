<html>
<head>
	<title>Adress Book</title>
<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

<!-- Google fonts -->
	<link href='http://fonts.googleapis.com/css?family=Old+Standard+TT:400,400italic,700|Special+Elite' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Shadows+Into+Light' rel='stylesheet' type='text/css'>

<!-- CSS stylesheet -->
	<link rel="stylesheet" type="text/css" href="css/addressbook.css">
<?

require_once 'include/addressbook_include.php';

//call the method openCsv inside the class AddressBook
	$addressbk = new AddressBook();
	$contactList = $addressbk->openCsv();
			

// if any of the fields are empty respond with isNotValid function, if all requirments met then
	// push the $contactList array created with the replacePost function to an
	// empty array $contactList to create and array within an array to provid the
	// functionality to have mutiple contacts as their own array all read within
	// one array. Then save the arrays with one array to a .csv file.

	if(!empty($_POST)){
		//var_dump($_POST);
		if($addressbk->isNotValid($_POST)) {
			$error = "Please fill out all fields";
		}
		else {
			$contactList[] = $addressbk->replacePost($_POST);
			$addressbk->saveCsv($contactList);	
		} 
	}
	

	if(isset($_GET['id'])) {
		$id = $_GET['id'];
		unset($contactList[$id]);
		$contactList = array_values($contactList);
		$addressbk->saveCsv($contactList);
	}

	if(count($_FILES) > 0 && $_FILES['addressFile']['error'] == UPLOAD_ERR_OK) {
		// var_dump($_FILES);
		//if the file meets the above checks then...
		
		//set destination for uploads to specific to directory
		$uploadDir = '/vagrant/sites/planner.dev/public/uploads/';

		//set the uploaded file to a var for usability
		$uploadFile = basename($_FILES['addressFile']['name']);
		// echo $uploadFile;

		//create a new filename var for the saved upload combining the dir var and the uploadfile var
		$savedFile = $uploadDir . $uploadFile;
		echo $savedFile;

		//move the newly craated var containing the correct dir and the file name to the upload directory
		move_uploaded_file($_FILES['addressFile']['tmp_name'], $savedFile);

		// open new file return array
		$upload_contacts = $addressbk->openCsv('uploads/' . $uploadFile);
		var_dump($upload_contacts);

		// merge with upload if exists
		$contactList = array_merge($contactList, $upload_contacts);
		$addressbk->saveCsv($contactList);
	}
?>
</head>
<div class='container'>
<body>

	<h1 id='header'>- - - - - - Contacts - - - - - - </h1>

	<img id='rolodex' src="../images/rolodex.png">	

	<form method='POST' enctype = 'multipart/form-data' action = '/addressBook.php'>
		<p>
			<label for='addressFile'> Upload Existing Address Book </label>
			<input id='addressFile' type ='file' name= 'addressFile'> 
		</p>
		<p>
			<input type='submit' value='upload'>
		</p>
	</form>	
	<?if (isset($savedFile)): ?>
		<p>
			<a href="/uploads/<?= $uploadFile ?>">Download me</a>
		</p>
	<? endif ?>
			<!-- Create forms for user to input information for table -->
	<form role='form' method= "POST" action="addressBook.php" id='border' class='img-rounded'>
		<div class ='row'>
			<div class="form-group">
				<label class="col-md-5" for='name'>
					Name:
					<input type='text' class="form-control" id='name' name='name'>
				</label>
			</div>
		</div>

		<div class = 'row'>
			<div class="form-group">
				<label class="col-md-5" for='address'>
					Address:
					<input  type='text' class="form-control" id='address' name='address'>
				</label>
			</div>
		</div>

		<div class = 'row'>
			<div class="form-group">
				<label class="col-md-3" for='city'>
					City:
					<input  type='text' class="form-control" id='city' name='city'>
				</label>
			 <div class="col-lg-1 col-md-1 col-sm-1 col-xs-6">
				<label>
				    State: 
				</label>
				    <br/>
				        <select name="state" class="form-control">
				            <option value="AL">AL</option>
				            <option value="AK">AK</option>
				            <option value="AZ">AZ</option>
				            <option value="AR">AR</option>
				            <option value="CA">CA</option>
				            <option value="CO">CO</option>
				            <option value="CT">CT</option>
				            <option value="DE">DE</option>
				            <option value="DC">DC</option>
				            <option value="FL">FL</option>
				            <option value="GA">GA</option>
				            <option value="HI">HI</option>
				            <option value="ID">ID</option>
				            <option value="IL">IL</option>
				            <option value="IN">IN</option>
				            <option value="IA">IA</option>
				            <option value="KS">KS</option>
				            <option value="KY">KY</option>
				            <option value="LA">LA</option>
				            <option value="ME">ME</option>
				            <option value="MD">MD</option>
				            <option value="MA">MA</option>
				            <option value="MI">MI</option>
				            <option value="MN">MN</option>
				            <option value="MS">MS</option>
				            <option value="MO">MO</option>
				            <option value="MT">MT</option>
				            <option value="NE">NE</option>
				            <option value="NV">NV</option>
				            <option value="NH">NH</option>
				            <option value="NJ">NJ</option>
				            <option value="NM">NM</option>
				            <option value="NY">NY</option>
				            <option value="NC">NC</option>
				            <option value="ND">ND</option>
				            <option value="OH">OH</option>
				            <option value="OK">OK</option>
				            <option value="OR">OR</option>
				            <option value="PA">PA</option>
				            <option value="RI">RI</option>
				            <option value="SC">SC</option>
				            <option value="SD">SD</option>
				            <option value="TN">TN</option>
				            <option value="TX">TX</option>
				            <option value="UT">UT</option>
				            <option value="VT">VT</option>
				            <option value="VA">VA</option>
				            <option value="WA">WA</option>
				            <option value="WV">WV</option>
				            <option value="WI">WI</option>
				            <option value="WY">WY</option>
				        </select>
			 </div>
				<label class="col-md-2" for='zip'>
					Zip:
					<input type='number' class="form-control" id='zip' name='zip' >
				</label>
			</div>
		</div>

		<div class = 'row'>
			<div class="form-group">
				<label class="col-md-4" for='phoneNumber'>
					Phone Number:
					<input type='tel' class="form-control" id='phoneNumber' name='phoneNumber'>
				</label>
			</div>
		</div>

		<div class = 'row'>
			<div class="form-group">
				<label class="col-md-4" for='email'>
					Email Address:
					<input type="email" class="form-control" id='email' name='email'>
				</label>
			</div>
		</div>
			
		<div class = 'row'>
			<button class='col-md-offset-1' type='submit' class="btn btn-default">Add New Contact</button>
		</div>

		</form>

		<table class="table table-responsive table-striped" >
			<!-- Create Table for input to be placed -->
			
				<tr>	
					<th>- Name -</th>
					<th>- Home Address -</th>
					<th>- City -</th>
					<th>- State -</th>
					<th>- Zip -</th>
					<th>- Phone Number -</th>
					<th>- Email Address -</th>
					<th></th>
				</tr>
				<!-- loop through each array item and print each in a table row  -->
				<? foreach($contactList as $key => $contact): ?>
					<tr>
						<?php foreach ($contact as $value): ?>						
							<td><?= htmlspecialchars(strip_tags($value)) ?></td>
						<?php endforeach ?>
							<td> <a href="?id=<?= $key ?>" class="glyphicon glyphicon-remove"></a> </td>
					</tr>		
				<? endforeach ?>
				
		</table>

		<?if(isset($error)){
			echo $error;
			} 
		?>
</body>
</div>
</html>