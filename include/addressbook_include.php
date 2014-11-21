<?php 

require_once 'file_store.php';

class AddressBook extends Filestore {
 
	public function __construct($filename) {
		$newFile = strtolower($filename);
		parent::__construct($newFile);
	}


	// function to loop through array and validates if a field is left empty
		public function validate($array) {
			foreach($array as $value) {
				if(empty($value)) {
					throw new UnexpectedException('All items must be filled out');
				} else if (strlen($value) >= 125) {
					throw new UnexpectedException('Items cannot be longer than 125 characters');
					}
			}
		}
	// This function will run through all of the $_POST input from the from and input it into
		// an array called $contactList.
		public function replacePost($array) {
			$contactList = [];
			if(isset($array['name'])){
					$contactList[] = $array['name'];
				}
				if(isset($array['address'])){
					$address = $array['address'];
					$contactList[] = $address;
				}
				if(isset($array['city'])){
					$city = $array['city'];
					$contactList[] = $city;
				}
				if(isset($array['state'])){
					$state = $array['state'];
					$contactList[] = $state;
				}
				if(isset($array['zip'])){
					$zip = $array['zip'];
					$contactList[] = $zip;
				}
				if(isset($array['phoneNumber'])){
					$phoneNumber = $array['phoneNumber'];
					$contactList[] = $phoneNumber;
				}
				if(isset($array['email'])){
					$email = $array['email'];
					$contactList[] = $email;
				}

				return $contactList;
		}

}

?>