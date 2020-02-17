<?php
$FaceCon = json_decode( file_get_contents(sprintf("%s/../includes/config/Facebook.json", dirname(__FILE__))));
//fbq('track', 'AddToCart');

//DO NOT DELETE THIS HEADER OR ETHAN WILL SEND ME TO CUT YOU.
header('Content-Security-Policy: sandbox allow-scripts allow-same-origin   ;');

$Event='PageView';
$Value='';
$PixelValue ='';
if(isset($qs['Event'])){
    $Event = $qs['Event'];
}
if(isset($qs['Value'])){
    $Value  = ','.json_encode($qs['Value']);
    $obj = $qs['Value'];
    $PixelValue='&cd[value]='.$obj['value'] . 'cd[currency]='.$obj['currency'];

}
?>
<!-- Facebook Pixel Code -->
<script>


    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');

    fbq('init', <?= $FaceCon->pixel_id; ?>);
    fbq('track','<?php echo $Event; ?>'<?php echo $Value; ?>);

</script>
<noscript><img height="1" width="1" style="display:none"
               src="https://www.facebook.com/tr?id=<?= $FaceCon->pixel_id; ?>&ev=<?php echo $Event; ?><?php echo $PixelValue; ?>&noscript=1"
    /></noscript>
<!-- End Facebook Pixel Code -->


<script>
    function eventHandler(event){

        fbq.apply(null,event.data)

//        alert.apply(null,event.data);

    }
    window.addEventListener("message", eventHandler, false);


</script>
