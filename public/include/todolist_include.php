<?php
class TodoList {

		public $filename = '';

		public function __construct($filename = 'todo_list.txt') {
			$this->filename = $filename;
		}

		public function openFile($newfilename = '') {
		    // open file
		    // $filename = getInput();
			$newfilename = (!empty($newfilename)) ? $newfilename : $this->filename;

		    if(file_exists($newfilename) && filesize($newfilename) > 0) {
		    	$openFile = fopen($newfilename, 'r');
				// var_dump($openFile);
		    	$readFile = trim(fread($openFile, filesize($newfilename)));
		    	trim($readFile);
		    	//change items in .txt file to an array
		    	$fileArray = explode("\n", $readFile);
		    	//close the opened file
		    	fclose($openFile);
		    	// add file to exisiting list
		    	return $fileArray;
		    } 
		    else { 
		    	$fileArray = [];
		    	echo 'Please Enter Item';
		    	return $fileArray;
		    }

		}

		//this function saves items that are added to the list to the existing .txt file
		public function saveFile($items) {

				$items = $this->sanitize($items);
		        $openFile = fopen($this->filename, 'w');
		       	$string = implode("\n", $items);
		       	fwrite($openFile, $string);
		   		fclose($openFile);
			}

		//this function will sanitize all arrays from user input
		public function sanitize($items) {
			foreach($items as $key => $value) {
				$items[$key] = htmlspecialchars(strip_tags($value));
			}
			return $items;
		}

	}

	?>