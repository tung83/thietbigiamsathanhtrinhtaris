<?php
include_once 'front.php';
function menu($db,$view){
    $db->reset();
    $list=$db->where('active',1)->orderBy('ind','ASC')->orderBy('id')->get('menu');
    $str.='
    <div class="wsmobileheader clearfix">
        <a id="wsnavtoggle" class="animated-arrow"><span></span></a>
        <a class="smallogo"><img src="'.selfPath.'logo.png" height="35" alt="" /></a>
        <a class="callusicon" href="tel:0982 056 888"><span class="fa fa-phone"></span></a>
    </div>            
    <div class="header">
    <div class="nav hidden-xs">
    	<div class="container">
    		<div class="row">
                <div class="col-lg-4 comp-name">
                    <span></span><b>Ô TÔ BÌNH LÂM</b>
                </div>
    			<div class="col-lg-5">    				
    				<span class="shop-contact first">
    					<i class="fa fa-phone"></i>Hotline: 0982 056 888
    				</span>
    				<span class="shop-contact">
    					<i class="fa fa-envelope-o"></i>E-mail: info@otobinhlam.com.vn
    				</span>
    				
    			</div>
    			<div class="col-lg-3">
    				<div id="social_block">    					
    					<a class="_blank" href="https://www.facebook.com/congtyotobinhlam" target="_blank">
                            <i class="fa fa-facebook"></i>
                        </a>
    					<a class="_blank" href="#" target="_blank"><i class="fa fa-twitter"></i></a>    										
    					<a class="_blank" href="#" target="_blank"><i class="fa fa-rss"></i></a>
    					<a class="_blank" href="#" target="_blank">
                            <i class="fa fa-youtube"></i>
                        </a>
    					<a class="_blank" href="#" target="_blank">
                            <i class="fa fa-google-plus"></i>
                        </a>
    					<a class="_blank" href="#" target="_blank"><i class="fa fa-pinterest"></i></a>
    					<a class="_blank" href="#" target="_blank"><i class="fa fa-vimeo-square"></i></a>
    					<a class="_blank" href="#" target="_blank"><i class="fa fa-instagram"></i></a>    								
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
    <div class="menu-ground">
    <div class="container clearfix bigmegamenu">
    <div class="logo clearfix">
        <a href="'.myWeb.'" title="Responsive Slide Menus"><img src="'.selfPath.'logo.png" alt="" style=""/></a>
    </div>
    
    <!--Main Menu HTML Code-->
    <nav class="wsmenu clearfix">
        <ul class="mobile-sub wsmenu-list">';
    foreach($list as $item){
        $active=($view==$item['view'])?' class="active"':'';
        /*if($item['view']=='trang-chu'){
            $title='<i class="fa fa-home"></i><span class="hometext">'.$item['name'].'</span>';
        }else{*/
            $title=$item['name'];
        //}
        switch($item['view']){
            case 'san-pham':
                $caret='<span class="arrow"></span>';
                break;
            default:
                $caret='';
                break;
        }
        $lnk=myWeb.$item['view'];
        $str.='
        <li>
            <a href="'.$lnk.'"'.$active.'>'.$title.$caret.'</a>';
        switch($item['view']){
            case 'san-pham':
                $str.='
                <div class="megamenu clearfix">';
                $cate=$db->where('active',1)->orderBy('ind','ASC')->get('brand',null,'id,name');
                foreach($cate as $cate_item){
                    $lnk=myWeb.$item['view'].'/'.common::slug($cate_item['name']).'-b'.$item['id'];
                    $str.='
                    <ul class="col-lg-3 col-md-3 col-xs-12 link-list">
                    <li class="title" onclick="location.href=\''.$lnk.'\'">'.$cate_item['name'].'</li>';
                    $cate_sub=$db->where('active',1)->where('pId',$cate_item['id'])->get('kind',null,'id,name');
                    foreach($cate_sub as $cate_sub_item){
                        $lnk=myWeb.$item['view'].'/'.common::slug($cate_sub_item['name']).'-k'.$cate_sub_item['id'];
                        $str.='
                        <li><a href="'.$lnk.'"><i class="fa fa-arrow-circle-right"></i>'.$cate_sub_item['name'].'</a></li>';
                    }
                    $str.='
                    </ul>';
                }
                $str.='
                </div>';
                break;
            default:                
                break;
        }
        $str.='
        </li>';
    }
    $str.='
            <li>
                <form>
                <div class="input-group search">
                  <input type="text" class="form-control" placeholder="Tìm kiếm..." aria-describedby="basic-addon2">
                  <span class="input-group-btn">
                    <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
                  </span>
                </div>
                </form>
            </li>
        </ul>
    </nav>
    <!--Menu HTML Code-->     
    </div>   
    </div>    
    </div>';
    return $str;
}
function foot_menu($db,$view){
    $db->reset();
    $list=$db->where('active',1)->orderBy('ind','ASC')->orderBy('id')->get('menu');
    $str.='
    <ul class="pull-right">';
    foreach($list as $item){
        $str.='
        <li><a href="'.myWeb.$item['view'].'">'.$item['title'].'</a></li>';   
    }
    $str.='
    </ul>';
    return $str;
}
function home($db,$view){
    $str=slide($db);
    
    common::page('serv');
    $serv=new serv($db);
    $str.=$serv->ind_serv();
    
    common::page('product');
    $product=new product($db);
    $str.=$product->ind_product();    
    
    common::page('news');
    $news=new news($db);
    $str.=$news->ind_news();    
    
    $str.=partner($db);
    /*common::widget('layer_slider');
    $layer_slider=new layer_slider($db);
    $str=$layer_slider->output();
    
    common::page('about');
    $about=new about($db);
    $str.=$about->ind_about();
    
    
    
    $str.='
    <section id="partner">
        <div class="container">
            <div class="center wow fadeInDown">
                <h2>Chi Nhánh Phân Phối</h2>
                <p class="lead">
                    Đại diện chính thức của công ty L&rsquo;avoine Việt Nam
                </p>
            </div>    

            <div class="partners">
                <ul>
                    <li> <a href="#">
                    <img class="img-responsive wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms" src="images/partners/partner1.png"></a></li>
                    <li> <a href="#"><img class="img-responsive wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms" src="images/partners/partner2.png"></a></li>
                    <li> <a href="#"><img class="img-responsive wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="900ms" src="images/partners/partner3.png"></a></li>
                    <li> <a href="#"><img class="img-responsive wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="1200ms" src="images/partners/partner4.png"></a></li>
                    <li> <a href="#"><img class="img-responsive wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="1500ms" src="images/partners/partner5.png"></a></li>
                </ul>
            </div>        
        </div><!--/.container-->
    </section><!--/#partner-->';*/
    return $str;
}
function slide($db){
    $list=$db->where('active',1)->orderBy('ind','ASC')->get('slider');
    $str='
    <section id="layerslider"> 
    <div id="layerslider_1" class="ls-wp-container" style="max-width:100%;height:450px;margin:0 auto;margin-bottom: 0px;">';
    foreach($list as $item){
        $str.='
        <div class="ls-slide" data-ls="slidedelay:10000;transition2d:11;">
        <img src="" data-src="'.webPath.$item['img'].'" class="ls-bg" alt="Slide background" />';
        if(trim($item['title'])!=''){
            $str.='
            <p class="ls-l" style="top:100px;left:60px;font-weight: 500;font-size:30px;color:#f00;white-space: nowrap;" data-ls="offsetxin:0;durationin:2500;delayin:2000;rotateyin:90;transformoriginin:left 50% 0;offsetxout:0;rotateyout:-90;transformoriginout:left 50% 0;">
            '.$item['title'].'
            </p>';
        }
        if(trim($item['sum'])!=''){
            $str.='
            <p class="ls-l" style="max-width:600px;top:170px;left:60px;font-size:16px;line-height:20px;color:#fff;background:rgba(0,0,0,0.5);padding:10px" data-ls="offsetxin:0;durationin:2000;delayin:3500;">
            '.nl2br(common::str_cut($item['sum'],300)).'
            </p>';
        }
        if(trim($item['lnk'])!=''){
            $str.='
            <p class="ls-l" style="top:350px;left:60px; border-radius: 3px; color: #fff; cursor: pointer; display: inline-block; line-height: 50px; outline: medium none; position: relative; text-transform: capitalize; transition: all 0.3s ease 0s; z-index: 1; background: none repeat scroll 0 0 #263944; padding: 0 20px; font-size:16px; font-weight:300;white-space: nowrap;" data-ls="offsetxin:0;durationin:400;delayin:4500;easingin:linear;rotateyin:90;transformoriginin:left 50% 0;offsetxout:0;durationout:100;showuntil:5400;easingout:linear;rotateyout:90;transformoriginout:left 50% 0;">
            <a href="http://'.$item['lnk'].'" target="_blank" style="color:#fff">
            Xem Thêm...
            </a>
            </p>';
        }
        $str.='
        </div>';
    }
    $str.='
    </div>
    </section>';
    return $str;
}
function contact($db,$view){
    common::page('contact');
    $contact=new contact($db);
    //$str=$contact->breadcrumb();
    $str.=$contact->contact();
    return $str;
}
function about($db,$view){
    common::page('about');
    $about=new about($db);
    //$str=$about->breadcrumb();
    $str.=$about->about_one();
    return $str;
}
function news($db,$view){
    common::page('news');
    $news=new news($db);
    $str=$news->breadcrumb();
    if(!isset($_GET['id'])){
        $str.=$news->news_cate();   
    }else{
        $str.=$news->news_one();    
    }    
    return $str;
}
function serv($db,$view){
    common::page('serv');
    $serv=new serv($db);
    $str=$serv->breadcrumb();
    if(!isset($_GET['id'])){
        $str.=$serv->serv_cate();   
    }else{
        $str.=$serv->serv_one();    
    }    
    return $str;
}
function product($db,$view){
    common::page('product');
    $pd=new product($db);
    $str=$pd->breadcrumb();
    if(isset($_GET['id'])){
        $str.=$pd->product_one();   
    }elseif(isset($_GET['kind'])){
        $str.=$pd->product_cate('kind');
    }elseif(isset($_GET['brand'])){
        $str.=$pd->product_cate('brand');
    }else{
        $str.=$pd->product_all();
    }
    return $str;
}
function partner($db){
    $str.='
    <script type="text/javascript" src="/js/jssor.slider-21.1.5.min.js"></script>
    <!-- use jssor.slider-21.1.5.debug.js instead for debug -->
    <script>
        jssor_1_slider_init = function() {
            
            var jssor_1_options = {
              $AutoPlay: true,
              $Idle: 0,
              $AutoPlaySteps: 4,
              $SlideDuration: 1600,
              $SlideEasing: $Jease$.$Linear,
              $PauseOnHover: 4,
              $SlideWidth: 140,
              $Cols: 7
            };
            
            var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);
        
            function ScaleSlider() {
                var refSize = jssor_1_slider.$Elmt.parentNode.clientWidth;
                if (refSize) {
                    refSize = Math.min(refSize, 1200);
                    jssor_1_slider.$ScaleWidth(refSize);
                }
                else {
                    window.setTimeout(ScaleSlider, 30);
                }
            }
            ScaleSlider();
            $Jssor$.$AddEvent(window, "load", ScaleSlider);
            $Jssor$.$AddEvent(window, "resize", ScaleSlider);
            $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
            //responsive code end
        };
    </script>';
    $str.='
    <section id="partner">
    <div id="jssor_1" style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 1027px; height: 100px; overflow: hidden; visibility: hidden;">
        <div data-u="slides" style="cursor: default; position: relative; top: 0px; left: 0px; width: 1027px; height: 100px; overflow: hidden;">';
    $list=$db->where('active',1)->orderBy('ind','ASC')->get('partner');
    foreach($list as $item){
        $str.='
        <div style="display: none;">
            <img data-u="image" src="'.webPath.$item['img'].'" />
        </div>';
    }
    foreach($list as $item){
        $str.='
        <div style="display: none;">
            <img data-u="image" src="'.webPath.$item['img'].'" />
        </div>';
    }
    $str.='
            <a data-u="add" href="http://www.jssor.com/demos/scrolling-logo-thumbnail-slider.slider" style="display:none">Scrolling Logo Thumbnail Slider</a>        
        </div>
    </div>
    </section>';
    
    $str.='
    <script>
        jssor_1_slider_init();
    </script>';
    return $str;
}
?>
