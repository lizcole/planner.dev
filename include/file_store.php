<?php

class Filestore
{
    protected $filename = '';
    protected $isCSV = false;

    public function __construct($filename = '')
    {
        $this->filename = $filename;

        if (substr($filename, -3) == 'csv') {
            $this->isCSV = true;
        }
    }

    public function read()
    {

       if ($this->isCSV == true) {
            return $this->readCSV();
        } else {
            return $this->readLines();
        }
    }

    public function write($array) 
    {
        if ($this->isCSV == true) {
            return $this->writeCSV($array);
        } else {
            return $this->writeLines($array);
        }
    }

    /**
     * Returns array of lines in $this->filename
     */
    private function readLines()
    {
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

    /**
     * Writes each element in $array to a new line in $this->filename
     */
    private function writeLines($array)
    {
         $array = $this->sanitize($array);

         $openFile = fopen($this->filename, 'w');

         $string = implode("\n", $array);

         fwrite($openFile, $string);

         fclose($openFile);
    }


     //this function will sanitize all arrays from user input
    public function sanitize($items) 
    {
        foreach($items as $key => $value) {
            $items[$key] = htmlspecialchars(strip_tags($value));
        }
            return $items;  
    }

    /**
     * Reads contents of csv $this->filename, returns an array
     */
    private function readCSV()
    {       
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

    /**
     * Writes contents of $array to csv $this->filename
     */
    private function writeCSV($array)
    {
        $handle = fopen($this->filename, 'w');

        foreach($array as $row) {
            fputcsv($handle, $row);
        }

       fclose($handle);

    }
}