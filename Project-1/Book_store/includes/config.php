<?php 

require_once "vendor/autoload.php";
 
use Omnipay\Omnipay;


$conn=mysqli_connect("localhost","root","","book_store")or die("Can't Connect...");
	
$gateway = Omnipay::create('Stripe');
$gateway->setApiKey('sk_test_XcdFPX77RbWdtgNtPg4n5Ror00tc9bYjcq');

?>