<?php
	require "./src/autoload.php";

//namespace validation\src;

use PHPUnit\Framework\TestCase;
class LoanTest extends TestCase{

	public function testRegisterOk()
	{	  
		$this->assertSame('John', 'John');
		$this->assertSame(18,18);
	}

	public function testValidationOk()
	{		
		$input = array('fullname' => 'Rais Manasiya', 'pin' => '3900210276', 'loan_amount'=>5000,'loan_period'=>10,'purpose'=>'holiday');
		$loan = new Loan();
		$errorsArray = $loan->register($input);
		$this->assertCount(0, $errorsArray);
	}

	public function testValidationWithoutName()
	{		
		$input = array('fullname' => '', 'pin' => '3900210276', 'loan_amount'=>5000,'loan_period'=>10,'purpose'=>'holiday');
		$loan = new Loan();
		$errorsArray = $loan->register($input);
		$this->assertCount(0, $errorsArray);
	}

	public function testValidationWithInvalidPin()
	{		
		$input = array('fullname' => 'Rais Manasiya', 'pin' => '75477', 'loan_amount'=>5000,'loan_period'=>10,'purpose'=>'holiday');
		$loan = new Loan();
		$errorsArray = $loan->register($input);
		$this->assertCount(0, $errorsArray);
	}

	public function testValidationWithLessLoanAmount()
	{		
		$input = array('fullname' => 'Rais Manasiya', 'pin' => '3900210276', 'loan_amount'=>500,'loan_period'=>10,'purpose'=>'holiday');
		$loan = new Loan();
		$errorsArray = $loan->register($input);
		$this->assertCount(0, $errorsArray);
	}

	public function testValidationWithLessLoanPeriod()
	{		
		$input = array('fullname' => 'Rais Manasiya', 'pin' => '3900210276', 'loan_amount'=>5000,'loan_period'=>5,'purpose'=>'holiday');
		$loan = new Loan();
		$errorsArray = $loan->register($input);
		$this->assertCount(0, $errorsArray);
	}

	public function testValidationWithoutPurpose()
	{		
		$input = array('fullname' => 'Rais Manasiya', 'pin' => '3900210276', 'loan_amount'=>5000,'loan_period'=>5,'purpose'=>'');
		$loan = new Loan();
		$errorsArray = $loan->register($input);
		$this->assertCount(0, $errorsArray);
	}

	public function testValidationNotOk()
	{		
		$input = array('fullname' => 'Rais ', 'pin' => '123', 'loan_amount'=>15000,'loan_period'=>45,'purpose'=>'');
		$loan = new Loan();
		$errorsArray = $loan->register($input);
		$this->assertCount(0, $errorsArray);
	}
}