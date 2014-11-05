<?php 

class AddressBook{

	 public $filename = '';

	 public function __construct($filename='address_book.csv') {
	 	$this->filename = $filename;
	 }


	// function to save to csv file
		public function saveCsv($array) {
			
			$handle = fopen($this->filename, 'w');

			foreach($array as $row) {
				fputcsv($handle, $row);
			}

			fclose($handle);
		}

	// function to open the csv file
		public function openCsv($newfilename = '') {
			$addressBook = [];
			$newfilename = (!empty($newfilename)) ? $newfilename : $this->filename;
			$handle = fopen($newfilename, 'r');

			while(!feof($handle)) {
				$row = fgetcsv($handle);

				if(!empty($row)) {
					$addressBook[] = $row;
				}
			}
			fclose($handle);
			return $addressBook;
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