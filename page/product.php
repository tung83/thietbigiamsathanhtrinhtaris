<?php
class product{
    private $db,$view,$lang,$title;
    function __construct($db,$lang='vi'){
        $this->db=$db;
        $this->db->reset();
        $this->lang=$lang;
        $db->where('id',2);
        $item=$db->getOne('menu');
        if($lang=='en'){
            $this->view=$item['e_view'];
            $this->title=$item['e_name'];
        }else{
            $this->view=$item['view'];
            $this->title=$item['name'];
        }
    }
    function breadcrumb(){
        $this->db->reset();
        $str.='
        <div class="container all-i-know">
        <ul class="breadcrumb clearfix">
        	<li><a href="'.myWeb.'"><i class="fa fa-home"></i></a></li>
            <li><a href="'.myWeb.$this->view.'">'.$this->title.'</a></li>';
        if(isset($_GET['id'])){
            $this->db->where('id',intval($_GET['id']));
            $item=$this->db->getOne('product','id,name,pId');
            $cate_sub=$this->db->where('id',$item['pId'])->getOne('kind','id,name,pId');
            $cate=$this->db->where('id',$cate_sub['pId'])->getOne('brand','id,name,pId');
            $str.='
            <li><a href="'.myWeb.$this->view.'/'.common::slug($cate['name']).'-b'.$cate['id'].'">'.$cate['name'].'</a></li>
            <li><a href="'.myWeb.$this->view.'/'.common::slug($cate_sub['name']).'-k'.$cate_sub['id'].'">'.$cate_sub['name'].'</a></li>
            <li><a href="#">'.$item['name'].'</a></li>';
        }elseif(isset($_GET['kind'])){
            $cate_sub=$this->db->where('id',intval($_GET['kind']))->getOne('kind','id,name,pId');
            $cate=$this->db->where('id',$cate_sub['pId'])->getOne('brand','id,name,pId');
            $str.='
            <li><a href="'.myWeb.$this->view.'/'.common::slug($cate['name']).'-b'.$cate['id'].'">'.$cate['name'].'</a></li>
            <li><a href="#">'.$cate_sub['name'].'</a></li>';
        }elseif(isset($_GET['brand'])){
            $cate=$this->db->where('id',intval($_GET['brand']))->getOne('brand','id,name');
            $str.='             
            <li><a href="#">'.$cate['name'].'</a></li>';
        }
        $str.='
        </ul>
        </div>';
        return $str;
    }
    function ind_product(){
        $str='
        <section id="recent-works">
            <div class="container">
                <div class="center">
                    <h2 class="title">SẢN PHẨM TIÊU BIỂU</h2>
                </div>';
        $list=$this->db->where('hot',1)->where('active',1)->orderBy('id')->get('product',8);
        if(count($list)>0){
            $i=1;
            foreach($list as $item){
                if($i%4==1){
                    $str.='
                    <div class="row">';
                }
                $str.=$this->product_item($item);
                if($i%4==0){
                    $str.='
                    </div>';
                }
                $i++;
            }   
            if($i%4!=1){
                $str.='
                </div>';
            }
        }        
        $str.='   
                </div><!--/.row-->
            </div><!--/.container-->
        </section><!--/#recent-works-->';
        return $str;
    }
    function hot_product(){
        $this->db->reset();
        $this->db->where('active',1)->where('home',1);
        $list=$this->db->get('product',null);
        $i=1;
        foreach($list as $item){
            if($i%4==1){
                $str.='
                <div class="row">';
            }
            $str.=$this->product_item($item);
            if($i%4==0){
                $str.='
                </div>';
            }
            $i++;
        }   
        if($i%4!=1){
            $str.='
            </div>';
        }
        
        return $str;
    }
    function product_item($item){
        $lnk=myWeb.$this->view.'/'.common::slug($item['name']).'-i'.$item['id'];
        $img=$this->first_image($item['id']);
        if(trim($img)==='') $img='holder.js/400x300';else $img=webPath.$img;
        $str='        
        <div class="col-md-3 product-item wow fadeInLeft" data-wow-duration="2s">
        <a href="'.$lnk.'">
            <img src="'.$img.'" class="img-responsive" alt="" title=""/>
            <div>
                <h2>'.common::str_cut($item['name'],30).'</h2>
                <hr class="device"/>
                <ul class="clearfix">
                    <li>
                    <form method="link" action="'.$lnk.'">
                        <button>
                            <i class="fa fa-info"></i> '.more.'
                        </button>
                    </form>
                    </li>
                    <li>
                    <form>
                        <button>
                            <i class="fa fa-shopping-cart"></i> '.contact.'
                        </button>
                    </form>
                    </li>
                </ul>
            </div>';
        $str.=($item['pd_new']==1)?'<img src="'.selfPath.'new-blink.gif" alt="" title=""/>':'';
        $str.='
        </a>
        </div>';
        return $str;
    }
    function product_list_item($item,$type=1){
        $lnk=myWeb.$this->view.'/'.common::slug($item['title']).'-i'.$item['id'];
        $img=$this->first_image($item['id']);
        if(trim($img)==='') $img='holder.js/400x300';else $img=webPath.$img;
        if($type==1){
            $str='
            <div class="col-xs-12 col-sm-6 col-md-3 product-item">';    
        }else{
            $str='
            <div class="col-xs-12 col-sm-6 col-md-4 product-item">';
        }        
        $str.='
        <a href="'.$lnk.'">
            <div>
                <p>'.($item['price']==0?contact:number_format($item['price'],0,',','.').' VNĐ').'</p>
                <img src="'.$img.'" class="img-responsive" />
                <p>
                    <h2>'.$item['title'].'</h2>
                    <button class="btn btn-default">'.more.'</button>
                </p>
            </div>
        </a>
        </div>';
        return $str;
    }
    function category($pId){
        $this->db->reset();
        $cate=$this->db->where('id',$pId)->getOne('product_cate','id,pId,lev');
        if($cate['lev']==1) $pId=$cate['id'];
        else $pId=$cate['pId'];
        $this->db->where('active',1)->where('lev',1)->orderBy('ind','ASC')->orderBy('id');
        $list=$this->db->get('product_cate',null,'id,title,lev,pId');
        $str='
        <span class="box-title">Danh Mục</span>
        <ul id="accordion" class="accordion">';
        foreach($list as $item){
            $dimension=($pId==$item['id'])?' id="active"':'';
            $this->db->reset();
            $sub_list=$this->db->where('pId',$item['id'])->where('active',1)->orderBy('ind','ASC')->get('product_cate',null,'id,title');
            $str.='
            <li'.$dimension.'>
                <div class="link"><i class="fa fa-cube"></i>'.$item['title'].'<i class="fa fa-chevron-right"></i></div>
                <ul class="submenu">';
            foreach($sub_list as $sub_item){
                $str.='
                <li><a href="'.myWeb.$this->view.'/'.common::slug($sub_item['title']).'-p'.$sub_item['id'].'">
                    '.$sub_item['title'].'
                </a></li>';
            }
            $str.='
                    <li><a href="'.myWeb.$this->view.'/'.common::slug($item['title']).'-cate'.$item['id'].'"> Xem tất cả</a></li>
                </ul>
            </li>';
        }
        $str.='
        </ul>
        <script>
        $(function() {
        	var Accordion = function(el, multiple) {
        		this.el = el || {};
        		this.multiple = multiple || false;

        		// Variables privadas
        		var links = this.el.find(".link");
        		// Evento
        		links.on("click", {el: this.el, multiple: this.multiple}, this.dropdown)
        	}

        	Accordion.prototype.dropdown = function(e) {
        		var $el = e.data.el;
        			$this = $(this),
        			$next = $this.next();

        		$next.slideToggle();
        		$this.parent().toggleClass("open");

        		if (!e.data.multiple) {
        			$el.find(".submenu").not($next).slideUp().parent().removeClass("open");
        		};
        	}

        	var accordion = new Accordion($("#accordion"), false);
        });
        $("#active").toggleClass("open");
        $("#active").find(".submenu").slideToggle();
        </script>';
        return $str;
    }
    function product_all(){
        $this->db->where('active',1)->orderBy('id');
        $this->db->pageLimit=pd_lim;
        $page=isset($_GET['page'])?intval($_GET['page']):1;
        $list=$this->db->paginate('product',$page);
        $count=$this->db->totalCount;
        $str.='
        <div class="container">';
        $i=1;
        foreach($list as $item){
            if($i%4==1){
                $str.='
                <div class="row">';
            }
            $str.=$this->product_item($item);
            if($i%4==0){
                $str.='
                </div>';
            }
            $i++;
        }   
        if($i%4!=1){
            $str.='
            </div>';
        }
        $pg=new Pagination(array('limit'=>pd_lim,'count'=>$count,'page'=>$page,'type'=>1));       
        $pg->set_url(array('def'=>myWeb.$this->view,'url'=>myWeb.'[p]/'.$this->view));
        $str.='
        <div class="text-center">'.$pg->process().'</div>';
        $str.='
        </div>';
        return $str; 
    }
    function product_cate($type){
        $this->db->reset();
        $pId=intval($_GET[$type]);
        if($type=='brand'){            
            $cate_sub=$this->db->where('pId',$pId)->where('active',1)->get('kind',null,'id');
            foreach($cate_sub as $cate_sub_item){
                $arr[]=$cate_sub_item['id'];
            }
            $this->db->where('pId',$arr,'in');
        }else $this->db->where('pId',$pId);
        $this->db->where('active',1)->orderBy('id');
        $this->db->pageLimit=pd_lim;
        $page=isset($_GET['page'])?intval($_GET['page']):1;
        $list=$this->db->paginate('product',$page);
        $count=$this->db->totalCount;
        $str.='
        <div class="container">';
        $i=1;
        foreach($list as $item){
            if($i%4==1){
                $str.='
                <div class="row">';
            }
            $str.=$this->product_item($item);
            if($i%4==0){
                $str.='
                </div>';
            }
            $i++;
        }   
        if($i%4!=1){
            $str.='
            </div>';
        }
        $str.='
        </div>';
        return $str; 
    }
    function product_list($pId,$type=1){
        $page=isset($_GET['page'])?intval($_GET['page']):1;
        $this->db->reset();
        if($pId!=0) $this->db->where('pId',$pId);
        $this->db->where('active',1)->orderBy('id');
        $this->db->pageLimit=limit;
        $list=$this->db->paginate('product',$page,'id,title,price,price_reduce');
        $str='
        <div class="row">';
        foreach($list as $item){
            $str.=$this->product_list_item($item,$type);
        }
        $str.='
        </div>';
        return $str;
    }
    function product_one($id=0){
        $id=intval($_GET['id']);
        $this->db->where('id',$id);
        $item=$this->db->getOne('product');
        $this->db->where('id',$item['id'],'<>')->where('pId',$item['pId'])->where('active',1)->orderBy('id');
        $list=$this->db->get('product',5);
        $lnk=domain.'/'.$this->view.'/'.common::slug($item['title']).'-i'.$item['id'];
        $str.='
        <div class="container">
        <div class="row product-detail clearfix">
            <div class="col-md-5">
                '.$this->product_image_show($item['id']).'
            </div>
            <div class="col-md-7">
                <article class="product-one">
                <h1>'.$item['name'].'</h1>
                <form action="'.myWeb.'lien-he">
                    <button class="btn btn-default">
                        <i class="fa fa-info"></i> Liên Hệ</button>
                </form>
                <p>'.$item['feature'].'</p>
                </article>
            </div>
        </div>                   
        <div>
            <div id="tabs" class="tabs">
            <ul>
                <li><a href="#tabs-1">MÔ TẢ CHI TIẾT</a></li>
                <li><a href="#tabs-4">BÌNH LUẬN</a></li>
            </ul>
            <div id="tabs-1">
                <article>
                    <p>'.$item['content'].'</p>
                </article>
            </div>
            <div id="tabs-4">
                <div class="fb-comments" data-width="100%" data-href="'.$lnk.'" data-numposts="5"></div>
            </div>
            </div>       
        </div>       ';
        if(count($list)>0){
            $str.='
            <div class="row" style="margin-top:20px">
                <div class="col-md-12">
                    <article>
                    <h1 style="margin-bottom:20px;text-transform:uppercase">Sản Phẩm Cùng Loại</h1>
                    </article>
                 </div>
            </div>';    
            $i=1;
            foreach($list as $item){
                if($i%4==1){
                    $str.='
                    <div class="row">';
                }
                $str.=$this->product_item($item);
                if($i%4==0){
                    $str.='
                    </div>';
                }
                $i++;
            }   
            if($i%4!=1){
                $str.='
                </div>';
            }
        }    
        $str.='
        </div>';        
        return $str;
    }
    function product_image_show($id){
        $this->db->reset();
        $list=$this->db->where('active',1)->where('pId',$id)->orderBy('ind','ASC')->orderBy('id')->get('pimage');
        $temp=$tmp='';
        foreach($list as $item){
            $temp.='
            <li>
                <a href="'.webPath.$item['img'].'" >
                    <img src="'.webPath.$item['img'].'" alt="" title="" class=""/>
                </a>
            </li>';
            $tmp.='
            <li>
                <img src="'.webPath.$item['img'].'" alt="" title=""/>
            </li>';
        }
        $str.='
        <!-- Place somewhere in the <body> of your page -->
        <div id="image-slider" class="flexslider">
          <ul class="slides popup-gallery">
            '.$temp.'
          </ul>
        </div>
        <div id="carousel" class="flexslider" style="margin-top:-50px;margin-bottom:10px">
          <ul class="slides">
            '.$tmp.'
          </ul>
        </div>
        <script>
        $(window).load(function() {
          // The slider being synced must be initialized first
          $("#carousel").flexslider({
            animation: "slide",
            controlNav: false,
            animationLoop: false,
            slideshow: false,
            itemWidth: 80,
            itemMargin: 5,
            asNavFor: "#image-slider"
          });
         
          $("#image-slider").flexslider({
            animation: "slide",
            controlNav: false,
            animationLoop: false,
            slideshow: false,
            sync: "#carousel"
          });
        });
        </script>';
        return $str;
    }
    function first_image($id){
        $this->db->reset();
        $this->db->where('active',1)->where('pId',$id)->orderBy('ind','ASC')->orderBy('id');
        $img=$this->db->getOne('pimage','img');
        return $img['img'];
    }
}
?>