<?php
include("includes/php/config.php");
$view=isset($_GET["view"])?$_GET["view"]:"trang-chu";
function menu($db,$view){
    $tab=mysql_query("select * from menu where active=1 order by ind asc,id desc");
    $str='    
      <div class="overlapblackbg"></div>
      <div class="wsmobileheader clearfix"> 
      <a id="wsnavtoggle" class="animated-arrow"><span></span></a> 
      <a class="smallogo"><img src="'.myWeb.'images/content/logo_small.png" width="120" alt="" /></a> 
      <a class="callusicon" href="tel:123456789"><span class="fa fa-phone"></span></a> </div>
      <div class="header">
        <div class="container clearfix bigmegamenu">
          <div class="logo clearfix"><a href="index.html" title="Responsive Slide Menus">
            <img src="'.myWeb.'images/content/logo_small.png" alt=""/></a></div>          
          <!--Main Menu HTML Code-->
          
          <nav class="wsmenu clearfix">
            <ul class="mobile-sub wsmenu-list">';
    while($row=mysql_fetch_object($tab)){
        switch($row->view){
            case 'san-pham':
                $caret='<span class="arrow"></span>';
                $lnk='#';
                $title=$row->name;
                break;
            case 'trang-chu':
                $title='<i class="fa fa-home"></i><span class="hometext">&nbsp;&nbsp;Home</span>';
                break;
            default:
                $lnk=myWeb.$row->view;
                $caret='';
                $title=$row->name;
                break;
        }
        if($row->view==$view) $active=' class="active"';
        else $active='';
        
        $str.='
        <li><a href="'.$lnk.'"'.$active.'>'.$title.'</a>';
        if($row->view=='san-pham'){
            $cate_1=mysql_query("select * from groups where active=1 order by ind asc,id desc");
            $str.='
            <ul class="wsmenu-submenu arrowleft">';
            while($row_1=mysql_fetch_object($cate_1)){
                $str.='
                <li><a href="#">'.$row_1->name.' </a>';
                $cate_2=mysql_query("select * from brand where pId=$row_1->id and active=1 order by ind asc,id desc");
                if(mysql_num_rows($cate_2)>0){
                    $str.='
                    <ul class="wsmenu-submenu-sub arrowleftright dropleft">';
                    while($row_2=mysql_fetch_object($cate_2)){
                        $str.='
                        <li><a href="#">'.$row_2->name.'</a>';
                        $cate_3=mysql_query("select * from kind where pId=$row_2->id and active=1 order by ind asc,id desc");
                        if(mysql_num_rows($cate_3)>0){
                            $str.='
                            <ul class="wsmenu-submenu-sub-sub dropleft">';
                            while($row_3=mysql_fetch_object($cate_3)){
                                $str.='
                                <li><a href="#">'.$row_3->name.'</a></li>';
                            }
                            $str.='
                            </ul>';
                        }
                        $str.='
                        </li>';
                    }
                    $str.='
                    </ul>';
                }
                $str.='</li>';
            }
            $str.='
            </ul>';
        }
        $str.='</li>';
    }
    $str.='
            </ul>
          </nav>      
          <!--Menu HTML Code-->       
        </div>
      </div>';
    return $str;
}
function slide()
{
    $tab=mysql_query("select * from slider");
    $str='
    <section id="layerslider"> 
    <div id="layerslider_1" class="ls-wp-container" style="max-width:100%;height:600px;margin:0 auto;margin-bottom: 0px;">';
    while($row=mysql_fetch_object($tab)){
        $str.='
        <div class="ls-slide" data-ls="slidedelay:10000;transition2d:11;">
        <img src="" data-src="'.webPath.$row->img.'" class="ls-bg" alt="Slide background" />';
        if(trim($row->title)!=''){
            $str.='
            <p class="ls-l" style="top:100px;left:60px;font-weight: 500;font-size:30px;color:#f00;white-space: nowrap;" data-ls="offsetxin:0;durationin:2500;delayin:2000;rotateyin:90;transformoriginin:left 50% 0;offsetxout:0;rotateyout:-90;transformoriginout:left 50% 0;">
            '.$row->title.'
            </p>';
        }
        if(trim($row->sum)!=''){
            $str.='
            <p class="ls-l" style="max-width:600px;top:170px;left:60px;font-size:16px;line-height:20px;color:#fff;background:rgba(0,0,0,0.5);padding:10px" data-ls="offsetxin:0;durationin:2000;delayin:3500;">
            '.nl2br(strcut($row->sum,300)).'
            </p>';
        }
        if(trim($row->sum)!=''){
            $str.='
            <p class="ls-l" style="top:350px;left:60px; border-radius: 3px; color: #fff; cursor: pointer; display: inline-block; line-height: 50px; outline: medium none; position: relative; text-transform: capitalize; transition: all 0.3s ease 0s; z-index: 1; background: none repeat scroll 0 0 #263944; padding: 0 20px; font-size:16px; font-weight:300;white-space: nowrap;" data-ls="offsetxin:0;durationin:400;delayin:4500;easingin:linear;rotateyin:90;transformoriginin:left 50% 0;offsetxout:0;durationout:100;showuntil:5400;easingout:linear;rotateyout:90;transformoriginout:left 50% 0;">
            <a href="http://'.$row->sum.'" target="_blank" style="color:#fff">
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
function home($view){
    $str.=slide();
    $str.=ind_product();    
    $str.=ind_news();
    return $str;
}
function ind_product(){
    $tab=mysql_query("select * from product where active=1 and hot=1 order by id desc");
    $str='
    <div class="white">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="title-white heading-font">Sản Phẩm Mới<span></span></h2>
                </div>';
    while($row=mysql_fetch_object($tab)){
        $str.='
        <div class="col-md-4 col-xs-12 col-sm-12 product-item">
        <a href="">
            <img src="'.webPath.$row->img.'" class="img-responsive" alt="" title=""/>
            <div>
                <h2>'.strcut($row->name,30).'</h2>
                <hr class="device"/>
                <ul class="clearfix">
                    <li><i class="fa fa-info"></i> Chi Tiết</li>
                    <li><i class="fa fa-shopping-cart"></i> Mua Hàng</li>
                </ul>
            </div>';
        if($row->pd_new==1){
            $str.='
            <img src="'.myWeb.'images/content/new-blink.gif" alt="" title=""/>';
        }
        $str.='
        </a>
        </div>';
    }
    $str.='
            </div>
        </div>
    </div>';    
    return $str;
}
function get_first_image($id){
    /*$tab=mysql_query("select * from pimage where pId=$id and active=1 order by id asc limit 1");
    $row=mysql_fetch_object($tab);
    return $row->img;*/
}
function ind_news(){
    $tab=mysql_query("select * from news where active=1 order by id desc limit 6");
    $str='
    <div class="white">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="title-white heading-font">Tin Tức<span></span></h2>
                </div>
            </div>';
    $i=1;
    while($row=mysql_fetch_object($tab)){
        if($i%4==1){
            $str.='
            <div class="row">';
        }
        $str.='
        <div class="col-md-3 ind-news">
            <img src="'.webPath.$row->img.'" class="img-responsive" alt="" title="" style="margin:auto"/>
            <h2 class="heading">'.$row->title.'</h2>
            <p>'.$row->sum.'</p>
            <p><a class="btn btn-default" href="#" role="button">Chi Tiết &raquo;</a></p>            
        </div>';
        if($i%4==0){
            $str.='
            </div>';
        }
        $i++;
    }
    if($i%5!=0){
        $str.='
        </div>';
    }
    $str.='
            </div>
        </div>
    </div>';    
    return $str;
}
function qText($id)
{
	$tab=mysql_query("select * from qtext where id=$id");
	$row=mysql_fetch_object($tab);		
	return $row->content;
}
?>