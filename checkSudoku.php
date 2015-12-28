<?php
/**
 * 
 * Sudoku  class 
 * @author Pankaj kumar
 *
 */
class Sudoku{
	
	private $_dirName;
	private $_fileName;
	private $_fileLocation = 'files/';
	
	/**
	 * 
	 * This is used to initalise private variable $_dirName
	 * @param String $dirName
	 * @author Pankaj Kumar
	 */
	public function __construct($dirName)
	{
		$this->_dirName = $dirName;
	}
	
	/**
	 * 
	 * This function read all files from given location $_fileLocation and then call private function
	 * checkSuokuPattern to check file contain 9x9 pattarn or not.
	 * @author Pankaj kumar
	 */
	public function checkSudoku()
	{
		if (is_dir($this->_dirName)) {
		    if ($directorContents = opendir($this->_dirName)) {
		        while (($file = readdir($directorContents))) {
		        	if ($file!='.' && $file!='..' && !is_dir($file)) {
				        // echo "filename: ".$file."<br />";
				         $this->_fileName = $this->_fileLocation.$file;
				         $this->checkSuokuPattern();
				     }  
		            
		        }
		        closedir($directorContents);
		    }
		}
	}
	
	/**
	 * 
	 * This function has core logic to check Suduko board is valid or not.
	 * This function validate number of rows should be 9 and number of coloum should be 9
	 * @author Pankaj Kumar
	 */
	private function checkSuokuPattern()
	{
		$file = fopen($this->_fileName,"r");
		$noOfRows = 0;
		$noOfCols = 0;
		$colArr = array();
		while($c = fgetc($file)){
			if(in_array($c, array( "\n"))){ // To check new line
				$noOfRows++;
				$colArr[] = $noOfCols; // Store all numbers of columns 
				$noOfCols = 0;
			}else{
				$noOfCols++ ;
			}
		}
		if($noOfRows==9 && count(array_unique($colArr))==1 && $colArr[0]==9){ // Possible condition to check  Suduko board is valid or not
			echo $this->_fileName .': 1<br>';
		}else{
			echo $this->_fileName .': 0<br>';
		}
		fclose($file);
	}
}

$objSudoku = new Sudoku('files');
$objSudoku->checkSudoku();