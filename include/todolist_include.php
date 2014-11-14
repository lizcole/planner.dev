<?php

require_once 'file_store.php';


class TodoList extends Filestore {


		public function openFile($newfilename = '') {

			return $this->readLines();
		   
		}

		//this function saves items that are added to the list to the existing .txt file
		public function saveFile($array) {

			return $this->writeLines($array);

			}

	}

	?>