<?php include 'function.php';?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>.:Ô Tô Bình Lâm:.</title>
	<link rel="icon" type="image/png" href="<?=selfPath?>logo-small.png"/>  
    <?=common::basic_css()?>      
    <?=common::basic_js()?>
</head><!--/head-->

<body>
<div class="wsmenucontainer clearfix">
<div class="overlapblackbg"></div>

<?=menu($db,$view)?> 
<div class="wrapper">
<?php
    switch($view){
        case 'gioi-thieu':
            echo about($db,$view);
            break;  
        case 'san-pham':
            echo product($db,$view);
            break;
        case 'dich-vu':
            echo serv($db,$view);
            break;
        case 'tin-tuc':
            echo news($db,$view);
            break;
        case 'lien-he':
            echo contact($db,$view);
            break;
        default:
            echo home($db,$view);
            break;
    }
?>

<section id="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <?=common::qtext($db,3)?>
                <div class="fb-page" 
                  data-href="https://www.facebook.com/congtyotobinhlam"
                  data-width="380" 
                  data-hide-cover="false"
                  data-show-facepile="false" 
                  data-show-posts="false"></div>
            
            </div>
            <div class="col-md-6 footer-map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3917.7986876860687!2d106.76812413851945!3d10.902898675846235!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f3277fe404f%3A0x103f6f6f4f78b0b0!2zVHLhuqduIFF14buRYyBUb-G6o24sIERpIEFuLCBCw6xuaCBExrDGoW5nLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1473051453768" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
        </div>
        <hr />
        <div class="row copyright">
            <div class="col-md-6">
                <span class="copy">
                    Copyright © 2016 OTO BINH LAM. Designed &amp; developed by <a href="http://www.psmedia.vn">PSMedia.vn</a>
                </span>
            </div>
            <div class="col-md-6 text-right">
                <span>
                    <?php
                    common::load('class.visitors');
                    $vs=new visitors($db);
                    ?>
                    Online: <?=$vs->getOnlineVisitors();?> / Lượt truy cập: <?=$vs->getCounter();?>
                </span>
            </div>
        </div>
    </div>
</section>
</div>
</div>


<div class="coccoc-alo-phone coccoc-alo-green coccoc-alo-show" id="coccoc-alo-phoneIcon" style="left: 0px; bottom: 0px;">
	<div class="coccoc-alo-ph-circle"></div>
	<div class="coccoc-alo-ph-circle-fill"></div>
	<div class="coccoc-alo-ph-img-circle">
        <a href="tel:0982 056 888"><img src="<?=selfPath?>phone-ring.png" alt=""/></a>
    </div>
</div>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.7&appId=1526299550957309";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


<script type="text/javascript">
(function(d,s,id){var z=d.createElement(s);z.type="text/javascript";z.id=id;z.async=true;z.src="//static.zotabox.com/0/1/01b83dab966a3f12ef7260fd46d62e53/widgets.js";var sz=d.getElementsByTagName(s)[0];sz.parentNode.insertBefore(z,sz)}(document,"script","zb-embed-code"));
</script>
</body>
</html>