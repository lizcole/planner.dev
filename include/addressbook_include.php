<?php 

require_once 'file_store.php';

class AddressBook extends Filestore{


	// function to save to csv file
		public function saveCsv($array) {

			return $this->writeCSV($array);
		
		}

	// function to open the csv file
		public function openCsv() {

			return $this->readCSV();
		}

	// function to loop through array and validates if a field is left empty
		public function isNotValid($array) {
			foreach($array as $value) {
				if(empty($value)) {
					return true;
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