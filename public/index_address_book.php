<?

require '../include/dbconnect.php';

$addresses = $dbc->query("SELECT * FROM people LEFT JOIN address ON address.people_id = people.id");


?>

<html>
<head>
    <title>Address Book</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

<link rel="stylesheet" type="text/css" href="css/addressbook_mysql.css">

</head>
<body class='container'>

    <h1>Address Book</h1>

    <table class='table table-bordered'>
        <? foreach($addresses as $address):?>
            <tr>
                <th>Person</th>
                <th>Address</th>
            </tr>
            <tr>
                <td>
                    <?= $address['first_name'] ?>
                </td>
                <td>
                    <?= $address['last_name'] ?>
                </td>
                <td>
                    <?= $address['phone'] ?>
                </td>
                <td>
                    <?= $address['Street'] ?>
                </td>
                <td>
                    <?= $address['City'] ?>
                </td>
                <td>
                    <?= $address['State'] ?>
                </td>
                <td>
                    <?= $address['Zip'] ?>
                </td>
            </tr>
        <? endforeach ?>
    </table>

    <div class='row'>
        <form role="form">
            <div class="form-group col-md-3">
                <label for='first_name'>First Name</label>
                <input type='text' id='first_name' class="form-control">
            </div>
        
            <div class="form-group col-md-3">
                <label for='last_name'>Last Name</label>
                <input type='text' id='last_name' class="form-control">
            </div>

            <div class="form-group col-md-3">
                <label for='phone_number'>Phone Number</label>
                <input type='text' id='phone_number' class="form-control">
            </div>
            <button id='addperson' type='submit' class="btn btn-success">Add</button>
        </form>
    </div>
</body>
</html>
