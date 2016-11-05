<?php
class serv{
    private $db,$view,$lang,$title;
    function __construct($db,$lang='vi'){
        $this->db=$db;
        $this->db->reset();
        $this->lang=$lang;
        $db->where('id',3);
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
            $item=$this->db->getOne('serv','id,title');
            //$cate=$this->db->where('id',$item['pId'])->getOne('serv_cate','id,title');
            $str.='
            <li><a href="#">'.$item['title'].'</a></li>';
        }elseif(isset($_GET['pId'])){
            $cate=$this->db->where('id',intval($_GET['pId']))->getOne('serv_cate','id,title');
            $str.='
            <li><a href="#">'.$cate['title'].'</a></li>';
        }
        $str.='
        </ul>
        </div>';
        return $str;
    }
    function serv_item($item){
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
    function serv_cate($pId=0){
        $page=isset($_GET['page'])?intval($_GET['page']):1;
        $this->db->reset();
        $this->db->where('active',1);
        if($pId!=0) $this->db->where('pId',$pId);
        $this->db->orderBy('id');
        $this->db->pageLimit=limit;
        $list=$this->db->paginate('serv',$page);
        $count=$this->db->totalCount;
        $str='
        <div class="container">
        <div class="row">';
        if($count>0){
            foreach($list as $item){
                $str.=$this->one_ind_serv($item);
            }
        }   
        $str.='
        </div>
        </div>';     
        $pg = new Pagination();
        $pg->pagenumber = $page;
        $pg->pagesize = limit;
        $pg->totalrecords = $count;
        $pg->showfirst = true;
        $pg->showlast = true;
        $pg->paginationcss = "pagination-large";
        $pg->paginationstyle = 1; // 1: advance, 0: normal
        if($pId==0){
            $pg->defaultUrl = myWeb.$this->view;
            $pg->paginationUrl = myWeb.'[p]/'.$this->view;    
        }else{
            $cate=$this->db->where('id',$pId)->getOne('serv_cate','id,title');            
            $pg->defaultUrl = myWeb.$this->view.'/'.common::slug($cate['title']).'-p'.$cate['id'];
            $pg->paginationUrl = myWeb.$this->view.'/[p]/'.common::slug($cate['title']).'-p'.$cate['id'];
        }
        $str.= '<div class="pagination pagination-centered">'.$pg->process().'</div>';
        return $str;
    }
    function serv_one(){
        $id=intval($_GET['id']);
        $item=$this->db->where('id',$id)->getOne('serv');
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
    function ind_serv(){
        $this->db->reset();
        $this->db->where('active',1)->orderBy('id');
        $list=$this->db->get('serv',6);
        $str='
        <section id="serv">
        <div class="container">
            <div class="center wow fadeInDown">
                <h2 class="title">'.$this->title.'</h2>
            </div>';
        if(count($list)>0){
            $i=1;
            foreach($list as $item){
                if($i%4==1){
                    $str.='
                    <div class="row">';
                }
                $str.=$this->one_ind_serv($item);
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
    function one_ind_serv($item){
        $lnk=myWeb.$this->view.'/'.common::slug($item['title']).'-i'.$item['id'];
        $str.='
        <div class="col-md-3 ind-serv wow bounceIn" data-wow-duration="2s">
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
