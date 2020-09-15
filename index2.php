 
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>index</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/bumper.css">
	<link rel="shortcut icon" href="images/Fevicon.png">
	<link href='https://fonts.googleapis.com/css?family=Roboto+Slab|Oswald|Lato' rel='stylesheet' type='text/css'>
	<script src="https://code.jquery.com/jquery-1.9.1.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<link rel="stylesheet" href="css/style.css">
 
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-109138999-9');
</script>

	<script>
	function checkInput(textbox) 
	{
		var price = document.getElementById(textbox).value;
		document.getElementById('ptotal').innerHTML = price;
		document.getElementById('total').innerHTML = price;
	}
	function validateForm() 
	{
		var x = document.forms["form1"]["price"].value;
		//alert(x);
	}
	</script>
	<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
	
		<script>
function OnButton1()
{
	var n=document.getElementById('name').value;
	var e=document.getElementById('email').value;
	var p=document.getElementById('phone').value;
	var a=document.getElementById('myamount').value;
	var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	if(n==null || n=="" ||e==null || e=="" ||p==null || p=="")
	{
		alert('Name , Email Id or Contact No field cannot be empty');
		return false;
	}
   	if (!filter.test(e))
	{
		alert('Please enter a valid Email Id');
		return false;
	}
	if(p.length<10)
	{
		alert('Mobile number should be 10 digit or more');
		return false;
	}
	if(a == 0)
	{
		alert('Please enter a valid Amount');
		return false;
	}
	
	abc(n,e,p,a);
}
function abc(n,e,p,a){
    alert('Please wait...Payment will be processing')
    $('#buttonid').hide();
    $(".preloader-1").show();
   $.ajax({
           "url": "online.php",
           "type": "POST",
           data: {name:n,email:e,phone:p,total:a},
           dataType: "text",  
            cache:false,
         complete: function (response) {
          
        },
        success :  function (result) {
            var amount = a * 100;
           
           var c = result.split("-");
           console.log(c);
           var orderid = c[0];
           var contactid = c[1];
           var options = {
            "key": "rzp_live_X84345345JJfj", // Enter the Key ID generated from the Dashboard
            "amount": amount, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise or INR 500.
            "currency": "USD",
            "name": "Coach To Fortune",
            // "recurring": '1',
           // "method": 'emandate',
            "description": "The coach to a fortune is a step by step process of becoming a transformation coach and at the same time making a fortune!",
            "image": "https://domain.com/razorpay1/bbrk_logo.png",
            "order_id": orderid,//This is a sample Order ID. Create an Order using Orders API. (https://razorpay.com/docs/payment-gateway/orders/integration/#step-1-create-an-order). Refer the Checkout form table given below
            "handler": function (response){
                alert("Please wait... Receipt will be generated");
                if(response.razorpay_payment_id != "")
                {
                    window.location.href="invoice.php?id="+contactid+"&price="+a;
                }else{
                    alert('failed');
                }
            },
            "prefill": {
                "name": n,
                "email": e,
                "contact": p
            },
            "notes": {
                "address": "note value"
            },
            "theme": {
                "color": "#0092D5"
            }
        };
         $('#buttonid').show();
        $(".preloader-1").hide();
        var rzp1 = new Razorpay(options);
        
            rzp1.open();
            e.preventDefault();
        },
        error: function () {
          
        },
    });
    return false;
}
</script>

	
</head>
<body>
    <!--<h1>hellllo bluehost</h1>-->
	<div class="wrapper">
		<div class="header">
				<h1> Heading </h1>
		</div>
		<div class="webinar-countdown cf" id="countdown-container">
				<!--<h4 style="align:center;" class="webinar-countdown__title" id="countdown-title">Pay Rs.30,000/- Right Now and Get Lifetime Membership @10.5Lacs Before The Timer Hits 0</h4>-->
				
                <!--<!-- TIMER -->
						<!--	<div id="countdown-container">
								
								<div id="timer">
									<ul id="countdown"><li>
											<span id="days"></span>
											<div class="count-holder">
												<p class="timeRefDays" data-lb="editable-text" data-lb-id="count-down-text-days" data-lb-name="Countdown Text Days">day</p>
											</div>
										</li>
										<li>
											<span id="hours"></span>
											<div class="count-holder">
												<p class="timeRefHours" data-lb="editable-text" data-lb-id="count-down-text-hours" data-lb-name="Countdown Text Hours">hour</p>
											</div>
										</li>
										<li>
											<span id="minutes"></span>
											<div class="count-holder">
												<p class="timeRefMinutes" data-lb="editable-text" data-lb-id="count-down-min" data-lb-name="Countdown Text Minutes">minute</p>
											</div>
										</li>
										<li>
											<span id="seconds"></span>
											<div class="count-holder">
												<p class="timeRefSeconds" data-lb="editable-text" data-lb-id="count-down-text-sec" data-lb-name="Countdown Text Seconds">second</p>
											</div>
										</li>
									</ul></div>
								<div class="clear"></div>						
							</div>-->
		
			</div>
		<div class="clearfix"></div>
		<div class="main">
			<div class="section-lft">
				<!--<form name="form1">-->
					<div class="stp-1">
						<h2>step 1 : contact information </h2>
						<div class="contact-info">
							<div class="form-input">
								<label>First Name:*</label> 
								<input type="text" placeholder = "Enter Full Name" pattern = "[a-zA-Z ]{3,}"  name = "name" id = "name" title="It must contain only letters and a length of minimum 3 characters!"  required autofocus>
								<div class="clearfix"></div>
							</div>	
							<div class="form-input">	
								<label>Email:*</label>
								<input type="email" placeholder = "Enter Email ID" pattern = "^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$"  name = "email" id = "email" title = "It must contain the email that you have chosen at registration."  required autofocus >
								<div class="clearfix"></div>
							</div>
							<div class="form-input">	
								<label>Phone:*</label>
								<input type="text" placeholder = "Enter Contact No" name = "phone" id = "phone" pattern = "[7-9]{1}[0-9]{9}" title = "It must contain a valid 10 digits mobile number! e.g.9836193498"  required autofocus >
								<div class="clearfix"></div>
							</div>	
						</div>

					</div>
					<div class="clearfix"></div>
					<!--<div class="stp-2">-->
					<!--	<h2>step 2 : billing details </h2>-->
					<!--		<div class="contact-info">-->
					<!--			<div class="form-input">-->
					<!--			<label>Address:*</label> -->
					<!--			<input type="text" name="address" placeholder="Please enter your address" title = "Enter full address with wing/flat if exist." required autofocus>-->
					<!--			<div class="clearfix"></div>-->
					<!--			</div>-->
					<!--			<div class="form-input">-->
					<!--			<label>City:*</label>-->
					<!--			<input type="text" name="city" placeholder="Please enter city name" pattern = "[a-zA-Z ]{3,}" title = "Enter valid city name" required autofocus>-->
					<!--			<div class="clearfix"></div>-->
					<!--			</div>-->
					<!--			<div class="form-input">-->
					<!--			<label>State:*</label>-->
					<!--			<input type="text" name="state" placeholder="Please enter state" pattern = "[a-zA-Z ]{3,}" title = "Enter valid state name" required autofocus >-->
					<!--			<div class="clearfix"></div>-->
					<!--			</div>-->
					<!--			<div class="form-input">-->
					<!--			<label>Zip:*</label>-->
					<!--			<input type="text" name="pin" placeholder="Enter zip/postal code" pattern = "[0-9]{6}" title = "Enter valid 6 digit pincode" required autofocus>-->
					<!--			<div class="clearfix"></div>-->
					<!--			</div>-->
					<!--		</div>				-->
					<!--</div>-->
					<div class="stp-2">
						<h2>Step 2 : Your payment Amount </h2>
							<div class="contact-info">
                                                              
								<div class="form-input">
								<label>Amount:*</label> 
								<input type="number" name="price1" placeholder="enter amount"  id="myamount" value="0" title="Enter amount." required="" autofocus="">
								<input type="hidden" name="price" placeholder="enter amount"  id="myamount123" value="" title="Enter amount." required="" autofocus="">
								<div class="clearfix"></div>
								</div>
								
							</div>				
					</div>
                    
					
					<div class="stp-4">
						<h2>Product Details </h2>
						<hr>
						<div class="product_name">MY product :</div>
						<div class="price" >USD.<label id="ptotal">0</label></div>
						<div class="clearfix"></div>
						
						<hr>
						<div class="product_name ">Total Price:</div>
						<div class="price">USD.<label id="total"><span class="rupe" id="pstotal">0</span></label></div>
						<div class="clearfix"></div>
					</div>
					
					<div class="button-section">
					<div class="clearfix"></div>
				</div>
					
					<div class="button-section">
						
							<input type="hidden" id="totalo1" name="totalo1" value="<?php echo $ototal;?>">
								<input type="submit" id="buttonid" class="pay-button" value="Pay Now" onclick="OnButton1();" >	
						        <div>
						            <div class="preloader-1" style="display:none;">
                                      <div style="width:100%">Loading
                                      <span class="line line-5"></span>
                                      <span class="line line-6"></span>
                                      <span class="line line-7"></span>
                                      </div>
                                    </div>
						        </div>
						<div class="clearfix"></div>
					</div>
				<!--</form>-->
			</div>

			<div class="section-rth">
					
						
				<div class="side-sec">
					<div clss="side-img"><img src="images/shil.png"></div>
					<div class="side-txt">
					<h3>your information is safe</h3>									
					<p>We will not sell or rent your personal contact information for any marketing purposes whatsoever.  </p>
					</div>
					<div class="clearfix"></div>
				</div>

				<div class="side-sec">
					<div clss="side-img"><img src="images/help.png"></div>
					<div class="side-txt">	
					<h3>secure checkout</h3>									
					<p>All information is encrypted and transmitted without risk using a Secure Sockets Layer protocol. </p>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="side-sec">
					<div clss="side-img"> <img src="images/lock.png"></div>
					<div class="side-txt">	
					<h3>need help?</h3>	
					<!--<p>Call Us @ (+91) 324234234234<br></p>-->
					<p>Email us Anytime:<br><a href="#">support@gmail.com</a></p>
					</div>
					<div class="clearfix"></div>
				</div>	
				<div class="images-wrap">	
					
						<img src="images/identity2.png">
						<img src="images/identity.png">
						<img src="images/identity1.png">									
				</div>	
			</div>
			<div class="clearfix"></div>
		</div>
		
	</div>
	<script type="text/javascript">
$("#myamount").keyup(function() {
//alert('aaaa');

    var amounts1= $('#myamount').val();
    var gst = 0;
    $('#gsttotal').html(gst);
    var amounts = parseInt(amounts1) + parseInt(gst);
    $("#myamount123").val(amounts);
    $('#totalo').html(amounts);
    $('#ptotal').html(amounts1);
$('#pstotal').html(amounts);

});
$( document ).ready(function() {
    var amounts1= $('#myamount').val();
    var gst = 0;
    $('#gsttotal').html(gst);
    var amounts = parseInt(amounts1) + parseInt(gst);
    $("#myamount123").val(amounts);
    $('#totalo').html(amounts);
    $('#ptotal').html(amounts1);
$('#pstotal').html(amounts);

});


</script>
<script src="js/html5shiv.js"></script>
	<script src="js/jquery-1.9.1.min.js"></script>
	<script src="js/a.js"></script> 
</body>
</html>
