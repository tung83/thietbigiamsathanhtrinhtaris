<?php
class news{
    private $db,$view,$lang,$title;
    function __construct($db,$lang='vi'){
        $this->db=$db;
        $this->db->reset();
        $this->lang=$lang;
        $db->where('id',4);
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
            $item=$this->db->getOne('news','id,title');
            //$cate=$this->db->where('id',$item['pId'])->getOne('news_cate','id,title');
            $str.='
            <li><a href="#">'.$item['title'].'</a></li>';
        }elseif(isset($_GET['pId'])){
            $cate=$this->db->where('id',intval($_GET['pId']))->getOne('news_cate','id,title');
            $str.='
            <li><a href="#">'.$cate['title'].'</a></li>';
        }
        $str.='
        </ul>
        </div>';
        return $str;
    }
    function news_item($item){
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
    function news_cate($pId=0){
        $page=isset($_GET['page'])?intval($_GET['page']):1;
        $this->db->reset();
        $this->db->where('active',1);
        if($pId!=0) $this->db->where('pId',$pId);
        $this->db->orderBy('id');
        $this->db->pageLimit=limit;
        $list=$this->db->paginate('news',$page);
        $count=$this->db->totalCount;
        $str='
        <div class="container">
        <div class="row">';
        if($count>0){
            foreach($list as $item){
                $str.=$this->one_ind_news($item);
            }
        }        
        $str.='
        </div>';
        
        $pg=new Pagination(array('limit'=>limit,'count'=>$count,'page'=>$page,'type'=>0));        
        if($pId==0){
            $pg->set_url(array('def'=>myWeb.$this->view,'url'=>myWeb.'[p]/'.$this->view));
        }else{
            $cate=$this->db->where('id',$pId)->getOne('news_cate','id,title');       
            $pg->defaultUrl = myWeb.$this->view.'/'.common::slug($cate['title']).'-p'.$cate['id'];
            $pg->paginationUrl = myWeb.$this->view.'/[p]/'.common::slug($cate['title']).'-p'.$cate['id'];
        }
        $str.= '
            <div class="pagination-centered">'.$pg->process().'</div>
        </div>';
        return $str;
    }
    function news_one(){
        $id=intval($_GET['id']);
        $item=$this->db->where('id',$id)->getOne('news');
        $str='
        <div class="container">
        <div class="row">
        <article class="article">
            <h1 class="article">'.$item['title'].'</h1>
            <p>'.$item['content'].'</p>
        </article>
        </div>
        </div>';
        return $str;
    }
    function ind_news(){
        $this->db->reset();
        $this->db->where('active',1)->orderBy('id');
        $list=$this->db->get('news',4);
        $str='
        <section id="news">
        <div class="container">
            <div class="center wow fadeInDown">
                <h2 class="title">TIN TỨC TIÊU BIỂU</h2>
            </div>';
        if(count($list)>0){
            $i=1;
            foreach($list as $item){
                if($i%4==1){
                    $str.='
                    <div class="row">';
                }
                $str.=$this->one_ind_news($item);
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
        <p class="text-right">
            <a href="'.myWeb.$this->view.'">'.all.'</a>
        </p>
        </div>
        </section>';
        return $str;
    }
    function one_ind_news($item){
        $lnk=myWeb.$this->view.'/'.common::slug($item['title']).'-i'.$item['id'];
        $str.='
        <div class="col-md-3 ind-news wow fadeInRight" data-wow-duration="2s">
            <img src="'.webPath.$item['img'].'" class="img-responsive" alt="" title="" style="margin:auto"/>
            <h2 class="heading">'.$item['title'].'</h2>
            <p>'.common::str_cut($item['sum'],100).'</p>
            <p><a class="btn btn-default" href="'.$lnk.'" role="button">Chi Tiết &raquo;</a></p>            
        </div>';
        return $str;
    }
    function product_image_first($db,$pId){
        $db->where('active',1)->where('pId',$pId);
        $item=$db->getOne('product_image','img');
        return $item['img'];
    }

}
?>
