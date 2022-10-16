<?php
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");

// following files need to be included
require_once("./lib/config_paytm.php");
require_once("./lib/encdec_paytm.php");
require_once("../config.php");
session_start();


$paytmChecksum = "";
$paramList = array();
$isValidChecksum = "FALSE";

$paramList = $_POST;

$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg

//Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application�s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.


if ($isValidChecksum == "TRUE") {
	// echo "<b>Checksum matched and following are the transaction details:</b>" . "<br/>";
	if ($_POST["STATUS"] == "TXN_SUCCESS") {
		echo "<b>Transaction status is success</b>" . "<br/>";
		//Process your transaction here as success transaction.
		//Verify amount & order id received from Payment gateway with your application's order id and amount.
	} else {
		echo (" <b>Transaction status is failure</b>" . "<br/> ");
	}

	echo (" click <a href = '../order.php'>here </a> to go home. ");
	
	if (isset($_POST) && count($_POST) > 0) {
		foreach ($_POST as $paramName => $paramValue) {
			if($paramName == 'TXNID') $transaction_id = $paramValue;
			else if($paramName == 'ORDERID') $order_id = $paramValue;
			else if($paramName == 'TXNDATE') $ordered_on = $paramValue;
			else if($paramName == 'STATUS') $status = $paramValue == 'TXN_SUCCESS' ? 'success' : 'failed';
			// echo($paramName . "---" . $paramValue. "<br>");
		}

		$query = "UPDATE ordered_items set transaction_id = '$transaction_id', ordered_on = '$ordered_on' , status = '$status' where order_id = '$order_id'";
		mysqli_query($conn, $query);		
	}
} else {
	echo "<b>Checksum mismatched.</b>";
	//Process transaction as suspicious.
}

if(!isset($_SESSION['email'])) {
	$query = "select * from ordered_items where order_id = '$order_id'";
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_assoc($result);
	$_SESSION['email'] = $row['email'];
	$email = $_SESSION['email'];

	$query = "select * from users where email = '$email'";
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_assoc($result);
	$_SESSION['name'] = $row['name'];
	$_SESSION['access'] = $row['access'];
}

?>