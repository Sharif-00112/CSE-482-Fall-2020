<?php

require('includes/config.php');
  
if (isset($_POST['stripeToken']) && !empty($_POST['stripeToken'])) {
 
    try {
        $token = $_POST['stripeToken'];
     
        $response = $gateway->purchase([
            'amount' => $_POST['amount'],
            'currency' => 'USD',
            'token' => $token,
        ])->send();
     
        if ($response->isSuccessful()) {
            // payment was successful: update database
            $arr_payment_data = $response->getData();
            $payment_id = $arr_payment_data['id'];
            $amount = $_POST['amount'];
 
            // Insert transaction data into the database
            $query = "SELECT * FROM payments WHERE payment_id = '".$payment_id."'";
            $isPaymentExist = $query;
     
            if($isPaymentExist->num_rows == 0) { 
                $query = "INSERT INTO payments(payment_id, amount, currency, payment_status) VALUES('$payment_id', '$amount', 'USD', 'Captured')";

                $res=mysqli_query($conn,$query) or die("Can't Execute Query...");
                
            }
 
            echo "Payment is successful. Your payment id is: ". $payment_id;
        } else {
            // payment failed: display message to customer
            echo $response->getMessage();
        }
    } catch(Exception $e) {
        echo $e->getMessage();
    }
}

?>