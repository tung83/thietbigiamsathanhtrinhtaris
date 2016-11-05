<?php
common::load('base','page');
class about{
    private $db;
    private $lang;
    private $view,$title;
    function __construct($db,$lang='vi'){
        $this->db=$db;
        $this->db->reset();
        $this->lang=$lang;
        $db->where('id',5);
        $item=$db->getOne('menu');
        if($lang=='en'){
            $this->title=$item['e_name'];
            $this->view=$item['e_view'];
        }else{
            $this->view=$item['view'];
            $this->title=$item['name'];
        }
    }
    function ind_about(){
        $this->db->where('active',1);
        $this->db->orderBy('id','ASC');
        $item=$this->db->getOne('aboutus');
        $lnk=myWeb.$this->view;
        $str='
        <section id="feature">
            <div class="container">
               <div class="wow fadeInUp">
                    <h2 class="text-center" style="text-transform:uppercase;margin-top:0px">'.$item['title'].'</h2>
                    <p class="lead">'.$item['sum'].'</p>                    
                </div>    
                <div class="row">
                    <div class="features">
                        <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                            <div class="feature-wrap">
                                <i class="fa fa-bullhorn"></i>
                                <h2>Sản phẩm chính hãng</h2>
                                <h3>Lorem ipsum dolor sit amet, consectetur adipisicing elit</h3>
                            </div>
                        </div><!--/.col-md-4-->
    
                        <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                            <div class="feature-wrap">
                                <i class="fa fa-comments"></i>
                                <h2>Luôn tiếp nhận ý kiến</h2>
                                <h3>Lorem ipsum dolor sit amet, consectetur adipisicing elit</h3>
                            </div>
                        </div><!--/.col-md-4-->
    
                        <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                            <div class="feature-wrap">
                                <i class="fa fa-cloud-download"></i>
                                <h2>Easy to customize</h2>
                                <h3>Lorem ipsum dolor sit amet, consectetur adipisicing elit</h3>
                            </div>
                        </div><!--/.col-md-4-->
                    
                        <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                            <div class="feature-wrap">
                                <i class="fa fa-leaf"></i>
                                <h2>Bảo vệ môi trường</h2>
                                <h3>Lorem ipsum dolor sit amet, consectetur adipisicing elit</h3>
                            </div>
                        </div><!--/.col-md-4-->
    
                        <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                            <div class="feature-wrap">
                                <i class="fa fa-cogs"></i>
                                <h2>Hệ thống phân phối rộng lớn</h2>
                                <h3>Lorem ipsum dolor sit amet, consectetur adipisicing elit</h3>
                            </div>
                        </div><!--/.col-md-4-->
    
                        <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                            <div class="feature-wrap">
                                <i class="fa fa-heart"></i>
                                <h2>Bảo vệ sức khoẻ cộng đồng</h2>
                                <h3>Lorem ipsum dolor sit amet, consectetur adipisicing elit</h3>
                            </div>
                        </div><!--/.col-md-4-->
                    </div><!--/.services-->
                </div><!--/.row-->    
            </div><!--/.container-->
        </section><!--/#feature-->';
        return $str;
    }
    function breadcrumb(){
        $this->db->reset();
        $str.='
        <ul class="breadcrumb clearfix">
        	<li><a href="'.myWeb.'"><i class="fa fa-home"></i></a></li>
            <li><a href="'.myWeb.$this->view.'">'.$this->title.'</a></li>';
        /*if(isset($_GET['id'])){
            $this->db->where('id',intval($_GET['id']));
            $item=$this->db->getOne('aboutus','id,name');
            $str.='
            <li><a href="#">'.$item['name'].'</a></li>';
        }*/
        $str.='
        </ul>';
        return $str;
    }
    
    function about_all(){
        $page=isset($_GET['page'])?intval($_GET['page']):1;
        $this->db->where('active',1);
        $this->db->orderBy('id');
        $this->db->pageLimit=10;
        $list=$this->db->paginate('aboutus',$page);
        $count=$this->db->totalCount;
        foreach($list as $item){
            $str.=$this->about_item($item);
        }
        
        $pg=new Pagination(array('limit'=>limit,'count'=>$count,'page'=>$page,'type'=>0));
        $pg->set_url(array('def'=>myWeb.$this->view,'url'=>myWeb.'[p]/'.$this->view));

        $str.= '<div class="pagination-centered">'.$pg->process().'</div>';
        return $str;
    }
    function about_item($item){
        $lnk=myWeb.$this->view.'/'.common::slug($item['title']).'-i'.$item['id'];
        $str.='
        <a href="'.$lnk.'" class="about-item clearfix">
            <img src="'.webPath.$item['img'].'" class="img-responsive" alt="" title=""/>
            <div>
                <h2>'.$item['title'].'</h2>
                <span>'.nl2br(common::str_cut($item['sum'],620)).'</span>
            </div>
        </a>';
        return $str;
    }
    
    function about_one(){
        $item=$this->db->orderBy('id')->getOne('aboutus');
        $str.='  
        <section id="about-us">
        <div class="container all-i-know">';
        $str.=$this->breadcrumb();
        $str.='
			<div class="wow fadeInDown row">
            <div class="col-md-12">
                <article>
                    <!--h1 class="center">'.$item['sum'].'</h1-->
                    <p>'.$item['content'].'</p>
                </article>
			</div>
            </div>
        </div>
        </section>';
        return $str;
    }
}


?>
