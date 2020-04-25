<?php
require ('database/database.php');
session_start();
// require ('../database/database.php');

// class displayProducts{
function displayProducts($limit){
		//open the connection
		$conn = openDatabase();
		//sql query to get all the products from the database
		$result = $conn->query("SELECT * FROM event");
		//if the number of rows is greater than 0
	    if($result->num_rows>0){
			$count = 0;
			
	    	//for each row, echo the following html code
	       while ($row=$result->fetch_assoc() and $count < $limit){
			   	$count = $count + 1;
		       	echo'
                <div class="col-md-6 col-lg-3 ftco-animate">
    				<div class="product">
    					<a href="product-single.php?event_id='.$row['event_id'].'" class="img-prod"><img class="img-fluid" src="images/'.$row['event_image'].'" alt="Colorlib Template">
    
    						<div class="overlay"></div>
    					</a>
    					<div class="text py-3 pb-4 px-3 text-center">
    						<h3><a href="#">'.$row['event_name'].'</a></h3>
    						<div class="d-flex">
    							<div class="pricing">
		    						<p class="price"><span class="price-sale">GH¢'.$row['event_price'].'.00</span></p>
		    					</div>
	    					</div>
	    					<div class="bottom-area d-flex px-3">
	    						<div class="m-auto d-flex">
	    							<a href="product-single.php?event_id='.$row['event_id'].'" class="add-to-cart d-flex justify-content-center align-items-center text-center">
	    								<span><i class="ion-ios-menu"></i></span>
	    							</a>
	    							<a href="add1tocart.php?event_id='.$row['event_id'].'" class="buy-now d-flex justify-content-center align-items-center mx-1">
	    								<span><i class="ion-ios-cart"></i></span>
	    							</a>
    							</div>
    						</div>
    					</div>
    				</div>
    			</div>
	  				  ';
	  				    	
	       }
	   }
	   
	}

function displayoneProduct($event_id){
//open the connection
$conn = openDatabase();
//sql query to get all the products from the database
$result = $conn->query("SELECT * FROM event where event_id=$event_id");
//if the number of rows is greater than 0
if($result->num_rows>0){
	//for each row, echo the following html code
	while ($row=$result->fetch_assoc()) {
	$_POST['id'] = $row['event_id'];
		echo '
<div class="col-lg-6 mb-5 ftco-animate">
			<a href="images/product-1.jpg" class="image-popup"><img src="images/'.$row['event_image'].' " class="img-fluid" alt="Colorlib Template"></a>
		</div>
		<div class="col-lg-6 product-details pl-md-5 ftco-animate">
			<h3>'.$row['event_name'].'</h3>
			<div class="rating d-flex">
				<p class="text-left mr-4">
					<a href="#" class="mr-2" style="color: #000;">'.$row['tickets_available'].' <span style="color: #bbb;">Tickets available</span></a>
				</p>
				<p class="text-left">
					<a href="#" class="mr-2" style="color: #000;">'.$row['tickets_left'].' <span style="color: #bbb;">left</span></a>
				</p>
			</div>
			<p class="price"><span>GH¢'.$row['event_price'].'.00</span></p>
			<p>'.$row['event_desc'].'
				</p>
		
				';
					
	}
}

}

function addtocart(){
        $connect = openDatabase();
        $my_ip_address = get_client_ip();
        $eventid = $_GET['event_id'];
		$quantity = intval($_POST['quantity']);
        $sql = "INSERT INTO cart(event_id,ip_add,quantity) values ('$eventid','$my_ip_address', '$quantity')";
        $sqlcheck ="Select event_id from cart where event_id = '$eventid'";
        $result = $connect->query($sqlcheck);
        if ($result){
        if($result->num_rows>0){
            echo "<script type='text/javascript'>
            alert('This event is already in your cart');
            window.location.replace(\"index.php\");
            </script>"
            ;
		}
	
    else if($connect->query($sql) === TRUE){
        echo "<script type='text/javascript'>
        window.location.replace(\"checkout.php\");
        </script>"
        ;
        
    }
    else{
        echo "<script type='text/javascript'>
            alert('Error Adding to cart');
            
    </script>";
    }
	}
}

 function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

function displayCartItems(){
	$conn = openDatabase();
	$result = $conn->query("SELECT * FROM 
	cart,event WHERE event.event_id = cart.event_id");
	closeDatabase($conn);
	echo "<option value='0'>Select One (Mandatory) </option>";
	if ($result->num_rows > 0) {
		$totalcost = 0;
		while ($row = $result->fetch_assoc()) {
			$totalcost = $totalcost + ($row['event_price'] * $row['quantity']);
			echo '
		<tr class="text-center">
			<td class="product-remove"><a href="productremove.php?id='.$row['cart_id'].'"><span class="ion-ios-close"></span></a></td>
			
			<td class="image-prod"><div class="img" style="background-image:url(images/'.$row['event_image'].');"></div></td>
			
			<td class="product-name">
				<h3>'.$row['event_name'].'</h3>
				<p>'.$row['event_desc'].'</p>
			</td>
			
			<td class="price">GH¢'.$row['event_price'].'.00</td>
			
			
			<td class="quantity">
				<div class="input-group mb-3">
				<input type="text" name="quantity" class="quantity form-control input-number" value="'.$row["quantity"].'" min="1" max="100">
			</div>
			</td>
			
			<td class="total">GH¢'.$row['event_price'] * $row['quantity'].'.00</td>
		</tr>

			';
		
		}
	}
	
}

function add1ToCart(){
	 $connect = openDatabase();
        $my_ip_address = get_client_ip();
        $eventid = $_GET['event_id'];
        $sql = "INSERT INTO cart(event_id,ip_add,quantity) values ('$eventid','$my_ip_address', 1)";
        $sqlcheck ="Select event_id from cart where event_id = '$eventid'";
        $result = $connect->query($sqlcheck);
        if ($result){
        if($result->num_rows>0){
            echo "<script type='text/javascript'>
            alert('This event is already in your cart');
            window.location.replace(\"index.php\");
            </script>"
            ;
		}
	
    else if($connect->query($sql) === TRUE){
        echo "<script type='text/javascript'>
        alert('Added to Cart');
        window.location.replace(\"checkout.php\");
        </script>"
        ;
        
    }
    else{
        echo "<script type='text/javascript'>
            alert('Error Adding to cart');
            
    </script>";
    }
	}

}

function subtotal(){
	$conn = openDatabase();
	$sql = "select cart_id,sum(event_price*quantity) from event,cart where event.event_id=cart.event_id";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	if ($result->num_rows > 0) {
		echo '
		<div class="col-lg-4 mt-5 cart-wrap ftco-animate">
    				<div class="cart-total mb-3">
    					<h3>Cart Totals</h3>
    					<p class="d-flex">
    						<span>Subtotal</span>
    						<span>¢'.$row['sum(event_price*quantity)'].'</span>
    					</p>
    					<p class="d-flex total-price">
    						<span>Total</span>
    						<span>¢'.$row['sum(event_price*quantity)'].'</span>
    					</p>
    				</div>
    				';
		$_SESSION['price']=$row['sum(event_price*quantity)'];
		$_SESSION['cart_id']=$row['cart_id'];
}
}

function displayConference($limit){
	//open the connection
	$conn = openDatabase();
	//sql query to get all the products from the database
	$result = $conn->query("SELECT * FROM conference");
	//if the number of rows is greater than 0
	if($result->num_rows>0){
		$count = 0;
		
		//for each row, echo the following html code
	   while ($row=$result->fetch_assoc() and $count < $limit){
			   $count = $count + 1;
			   echo'
			<div class="col-md-6 col-lg-3 ftco-animate">
				<div class="product">
					<a href="conf-single.php?conf_id='.$row['conf_id'].'" class="img-prod"><img class="img-fluid" src="images/'.$row['conf_image'].'" alt="Colorlib Template">

						<div class="overlay"></div>
					</a>
					<div class="text py-3 pb-4 px-3 text-center">
						<h3><a href="#">'.$row['conf_name'].'</a></h3>
						<div class="d-flex">
							<div class="pricing">
								
							</div>
						</div>
						<div class="bottom-area d-flex px-3">
							<div class="m-auto d-flex">
								<a href="conf-single.php?conf_id='.$row['conf_id'].'" class="add-to-cart d-flex justify-content-center align-items-center text-center">
									<span><i class="ion-ios-menu"></i></span>
								</a>
							
							</div>
						</div>
					</div>
				</div>
			</div>
					';
						  
	   }
   }
   
}

function displayoneConference($conf_id){
	//open the connection
	$conn = openDatabase();
	//sql query to get all the products from the database
	$result = $conn->query("SELECT * FROM conference where conf_id=$conf_id");
	//if the number of rows is greater than 0
	if($result->num_rows>0){
		//for each row, echo the following html code
		while ($row=$result->fetch_assoc()) {
		$_POST['id'] = $row['conf_id'];
			echo '
	<div class="col-lg-6 mb-5 ftco-animate">
				<a href="images/'.$row['conf_image'].'" class="image-popup"><img src="images/'.$row['conf_image'].' " class="img-fluid" alt="Colorlib Template"></a>
			</div>
			<div class="col-lg-6 product-details pl-md-5 ftco-animate">
				<h3>'.$row['conf_name'].'</h3>
				<div class="rating d-flex">
					<p class="text-left mr-4">
						<a href="#" class="mr-2" style="color: #000;">'.$row['conf_seats_available'].' <span style="color: #bbb;">Tickets available</span></a>
					</p>
					<p class="text-left">
						<a href="#" class="mr-2" style="color: #000;">'.$row['conf_seats_left'].' <span style="color: #bbb;">left</span></a>
					</p>
				</div>
				<p>'.$row['conf_desc'].'
					</p>
			
					';
						
		}
	}
	
	}

