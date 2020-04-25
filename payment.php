
<?php
require(__DIR__.'/functions/functions.php');
     //insert into database
      $connect = openDatabase();
      $fname=$_POST['fname'];
      $lname=$_POST['lname'];
      $email=$_POST['email'];
      $status = "PAID";
      $fullname = $fname.$lname;
      $ip_add=get_client_ip();
      $event_id=$_SESSION['event_id'];
      $cart_id=$_SESSION['cart_id'];
        //payment
        $random_number = rand();
        $curl = curl_init();
        // If you are getting an error on the payment code, It may be due to the settings of your php
        //  download cacert.pem and uncomment the three lines of code under
          //Place  the cacert.pem in the right location 

        // $certificate = "C:\wamp64\cacert.pem";
        // curl_setopt($curl, CURLOPT_CAINFO, $certificate);
        // curl_setopt($curl, CURLOPT_CAPATH, $certificate);
        $amount = $_SESSION['price'];  
        $currency = "GHS";
        $txref = "rave-$random_number"; // ensure you generate unique references per transaction.
        $PBFPubKey = "FLWPUBK_TEST-5988862ba20025cadb9d1d3a3e31a98d-X"; // get your public key from the dashboard.
        $redirect_url = "https://localhost/e-events/success.php";

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/hosted/pay",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => json_encode([
              'amount'=>$amount,
              'customer_email'=>$email,
              'currency'=>$currency,
              'txref'=>$txref,
              'PBFPubKey'=>$PBFPubKey,
              'redirect_url'=>$redirect_url,
             
          ]),
          CURLOPT_HTTPHEADER => [
              "content-type: application/json",
              "cache-control: no-cache"
          ],
          ));
      
          $response = curl_exec($curl);
          $err = curl_error($curl);
      
          if($err){
          // there was an error contacting the rave API
          die('Curl returned error: ' . $err);
          }
      
          $transaction = json_decode($response);
      
          if(!$transaction->data && !$transaction->data->link){
          // there was an error from the API
          print_r('API returned error: ' . $transaction->message);
          }
      
          // uncomment out this line if you want to redirect the user to the payment page
          //print_r($transaction->data->message);
      
      
          // redirect to page so User can pay
          // uncomment this line to allow the user redirect to the payment page
          header('Location: ' . $transaction->data->link);
  
       
        //insert into payment table
          $sql = "INSERT into payment(status,event_id,name,email,ip_add)values('$status','$event_id','$fullname','$email','$ip_add')";
          $result=$connect->query($sql);
        //get the event ID
          $eventIdsql="select event.event_id from cart,event where cart.event_id=event.event_id";
          $eventIdquery=$connect->query($eventIdsql);
          while ($row = $eventIdquery->fetch_assoc()) {
            $eventId= $row['event_id'];
        //get the quantity
          $quantitysql = "select quantity from cart,event where event.event_id=cart.event_id";
          $quantityquery=$connect->query($quantitysql);
          while ($row1 = $quantityquery->fetch_assoc()) {
            $quantity= $row1['quantity'];
        //subtract
        $subtractsql = "UPDATE event,cart SET tickets_left = tickets_left - $quantity WHERE cart.event_id = event.event_id";
        $subtractquery=$connect->query($subtractsql);
        //remove items from cart
        $rmifcsql="DELETE from cart ";
        $rmifcquery=$connect->query($rmifcsql);

        
         
}
}

   /*    }
      else{
        echo'fail';
        echo $cart_id;
      } */

?>