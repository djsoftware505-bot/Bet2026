$consumer_key = getenv('MPESA_CONSUMER_KEY');
$consumer_secret = getenv('MPESA_CONSUMER_SECRET');
$shortcode = getenv('MPESA_SHORTCODE');
$passkey = getenv('MPESA_PASSKEY');

if(!$consumer_key){
  $consumer_key = 'mnDJrjgW7iXfRFDxBDtk9tEn2dNGxwythyGvHHBORXhccG4';
  $consumer_secret = 'd3OfEnDWZUh5nWxdRYMWIs1hGNBUDtssZ2AysCA3GpsHTcZj5ZVsmhHhLO1HBuvo';
  $shortcode = '174379';
  $passkey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';
}
