<?php 
error_reporting(E_ERROR | E_WARNING | E_PARSE);
class Loan{

	private $errors = array();

	// National Code Validation
	public function nationalCodeisValid($code){
		$multiplier_1 = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 1);
		$multiplier_2 = array(3, 4, 5, 6, 7, 8, 9, 1, 2, 3);
		
		$control = intval(substr($code,-1));
		$retval  = false;
  
		$mod  = 0;
		$total = 0;
  
		/* Do first run. */
		for ($i=0; $i < 10; $i++) {
			$total += intval($code[$i]) * $multiplier_1[$i];
		}
		$mod = $total % 11;
		/* If modulus is ten we need second run. */
		$total = 0;
		if ($mod == 10) {
		  for ($i=0; $i < 10; $i++) {
			  $total += intval($code[$i]) * $multiplier_2[$i];
		  }
		  $mod = $total % 11;
  
		  /* If modulus is still ten revert to 0. */
		  if (10 == $mod) {
			  $mod = 0;
		  }
		}
		return $control = $mod;
	  }
  	  
	public function register($POST){
		//validate
		foreach ($POST as $key => $value) {
			
			/// Full Name
			if($key == "fullname"){

				if(trim($value) == ""){

					$this->errors[] = "Please enter Name";
				}

				if(is_numeric($value)){

					$this->errors[] = "Name can not be a number";
				}

				if(!preg_match("/^[a-zA-Z']+(?:\s[a-zA-Z']+)+$/", $value)){

					$this->errors[] = "Please enter First & Last name ";
				}
			}

			/// Personal Identification Number
			if($key == "pin"){
				if(trim($value) == "" || $this->nationalCodeisValid($value)===0)
				{
					$this->errors[] = "Please enter a valid personal identification number";
				}				
			}

			//Loan Amount
			if($key == "loan_amount"){
				if(trim($value) == "" || $value < 1000 || $value > 10000)
				{
					$this->errors[] = "Please enter amount between 1000 to 10,000";
				}

				if(!is_numeric($value)){

					$this->errors[] = "Amount cant not be character";
				}						
			}

			//Loan Period
			if($key == "loan_period"){
				if(trim($value) == "" || $value < 6 || $value > 24)
				{
					$this->errors[] = "Please enter loan period between 6 to 24 months";
				}

				if(!is_numeric($value)){

					$this->errors[] = "Loan period cant not be character";
				}						
			}

			//Purpose
			if($key == "purpose"){
				if(trim($value) == "")
				{
					$this->errors[] = "Please select Purpose of use";
				}				
			}
			
		}

		
		//save to database or file
		if(count($this->errors) == 0){
			$data = array(
				['Name','Personal Identification Number','Loan Amount','Loan Period','Purpose of Use'],
				[$POST['fullname'],$POST['pin'],$POST['loan_amount'],$POST['loan_period'],$POST['purpose']]
			);
			$path = __DIR__;
					
			$fp = fopen($path.'/uploads/'.str_replace(' ','_',$POST['fullname']).date('_Y_m_d_H_i_s').'.csv', 'w');
			
			foreach ($data as $fields) {
				fputcsv($fp, $fields);
			}
			
			fclose($fp);
			echo "Data saved in CSV file successfully";
			//save to the DB			
			//$DB = new Database();
			// $query = "insert into loan (name,pin,loanamount,loanperiod,purpose) values (:fullname,:pin,:loan_amount,:loan_period,purpose)";

			// $data = array();
			// $data['name'] = $POST['fullname'];
			// $data['pin'] = $POST['pin'];
			// $data['loanamount'] = $POST['loan_amount'];
			// $data['loanperiod'] =  $POST['loan_period'];
			// $data['purpose'] = $POST['purpose'];

			// $result = $DB->write($query,$data);
			// if(!$result){
			// 	$this->errors[] = "Your data could not be saved";
			// }
		}

		return $this->errors;
	}
}