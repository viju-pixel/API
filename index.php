<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>PHP Stripe Payment Gateway Integration </title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<style>
.container{
padding: 0.5%;
} 
</style>
</head>
<body>
<div class="container">
<div class="row">
<div class="col-md-12"><pre id="token_response"></pre></div>
</div>
<div class="row">
<div class="col-md-4">
<button class="btn btn-info btn-block" onclick="pay(10)">Pay $10</button>
</div>
</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://checkout.stripe.com/checkout.js"></script>
<script type="text/javascript">
function pay(amount){
var handler = StripeCheckout.configure({
key: 'pk_test_51LaCWfSDChRBwbLf660qQW7OjZMgImZfT0S8d4zUEzxQ2cSoA1Jp1gDKKU3IPhAT51NHFAeiQ1KuOtw3zwT6j1T500lD2APZM0', // your publisher key id
locale: 'auto',
token: function (token) {
// You can access the token ID with `token.id`.
// Get the token ID to your server-side code for use.
console.log('Token Created!!');
console.log(token);
$('#token_response').html(JSON.stringify(token));
$.ajax({
url:"payment.php",
method: 'post',
data: { tokenId: token.id, amount: amount },
dataType: "json",
success: function( response ) {
console.log(response.data);
$('#token_response').append( '<br />' + JSON.stringify(response.data));
}
})
}
});
handler.open({
name: 'book',
description: '2 widgets',
amount: amount*100
});
}
</script>
</body>
</html> 