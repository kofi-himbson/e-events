
<?php
require(__DIR__.'/functions/functions.php');
    
     //insert into database
      $connect = openDatabase();
      $name=$_POST['name'];
      $number=$_POST['number'];
      $email=$_POST['email'];
      $conf_id=$_SESSION['conf_id'];
      $ip_add=get_client_ip();
        //insert into register table
          $sql = "INSERT into conference_registration(conf_id,name,email,number,ip_add)values('$conf_id','$name','$email',$number,'$ip_add')";
          $result=$connect->query($sql);
        //get the event ID
          $confIdsql="select conference.conf_id from conference where conf_id=$conf_id";
          $confIdquery=$connect->query($confIdsql);
          while ($row = $confIdquery->fetch_assoc()) {
            $confId= $row['conf_id'];
        //subtract
        $subtractsql = "UPDATE conference SET conf_seats_left = conf_seats_left - 1 WHERE conf_id = $conf_id";
        $subtractquery=$connect->query($subtractsql);

        echo'<script>alert("Registration Successful")
        window.location.href = "index.php";
        </script>';
         
}



?>