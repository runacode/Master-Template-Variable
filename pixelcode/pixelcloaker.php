<?php

$qs='';
$qr= parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
if(strlen($qr)>0){
    $qs='?'.$qr;
}



include_once('pixelconstants.php');

?>
<script>
  window.location= "<?php echo $ActualPixelUrl; ?><?php echo $qs;?>";
</script>

