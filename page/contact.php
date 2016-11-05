<?php
class contact{
    private $db,$view,$lang;
    function __construct($db,$lang='vi'){
        $this->db=$db;
        $this->db->reset();
        $this->lang=$lang;
        $db->where('id',9);
        $item=$db->getOne('menu');
        if($lang=='en'){
            $this->view=$item['e_view'];
        }else{
            $this->view=$item['view'];
        }
    }
    function breadcrumb(){
        $this->db->reset();
        $str.='
        <ul class="breadcrumb clearfix">
        	<li><a href="'.myWeb.'"><i class="fa fa-home"></i></a></li>
            <li><a href="'.myWeb.$this->view.'">Liên Hệ</a></li>';
        $str.='
        </ul>';
        return $str;
    }
    function contact_insert(){
        $this->db->reset();
        if(isset($_POST['contact_send'])){
            $name=htmlspecialchars($_POST['name']);
            $adds=htmlspecialchars($_POST['adds']);
            $phone=htmlspecialchars($_POST['phone']);
            $email=htmlspecialchars($_POST['email']);
            $subject=htmlspecialchars($_POST['subject']);
            $content=htmlspecialchars($_POST['content']);
            $insert=array(
                'name'=>$name,'adds'=>$adds,'phone'=>$phone,
                'email'=>$email,'fax'=>$subject,'content'=>$content,
                'dates'=>date("Y-m-d H:i:s")
            );
            try{
                //$this->send_mail($insert);
                $this->db->insert('contact',$insert);                
               // header('Location:'.$_SERVER['REQUEST_URI']);
               echo '<script>alert("Thông tin của bạn đã được gửi đi, BQT sẽ phản hồi sớm nhất có thể, Xin cám ơn!");
                    location.href="'.$_SERVER['REQUEST_URI'].'"
               </script>';
            }catch(Exception $e){
                echo $e->errorInfo();
            }
        }
    }
    function contact(){
        $this->contact_insert();
        $this->db->reset();
        $item=$this->db->where('id',3)->getOne('qtext','content');
        $this->contact_insert();
        $this->db->reset();
        $item=$this->db->where('id',3)->getOne('qtext','content');
        $str.='
        <div class="container all-i-know">
        '.$this->breadcrumb().'
        <div class="row">
            <div class="col-md-6 contact-info">
                <p><i>Cảm ơn Quý khách ghé thăm website của chúng tôi.<br /> 
                Mọi thông tin chi tiết xin vui lòng liên hệ:</i></p> 
                <img src="'.selfPath.'contact.jpg" alt="Liên hệ" title="Liên Hệ"/>
                <p class="qtext">
                    '.common::qtext($this->db,3).'
                </p>
            </div>
            <div class="col-md-6 clearfix">
                <p><i>Hoặc vui lòng gởi thông tin liên hệ cho chúng tôi theo form dưới đây: </i></p>
                <form role="form" data-toggle="validator" method="post">
                    <div class="form-group">
                        <input type="text" name="name" placeholder="Họ tên..." class="form-control" data-error="Vui lòng nhập họ tên" required/>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <input type="text" name="adds" placeholder="Địa chỉ..." class="form-control" data-error="Vui lòng nhập địa chỉ của bạn" required/>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <input type="text" name="phone" placeholder="Điện thoại..." class="form-control" data-error="Vui lòng nhập số phone của bạn" required/>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Email..." class="form-control" data-error="Định dạng email không đúng" required/>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <input type="text" name="subject" placeholder="Tiêu đề..." class="form-control" data-error="Vui lòng nhập tiêu đề" required/>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <textarea name="content" placeholder="Nội dung..." class="form-control" rows="3" data-error="Vui lòng nhập nội dung" required></textarea>
                        <div class="help-block with-errors"></div>
                    </div>
                    <button type="submit" name="contact_send" class="btn btn-default">Gửi</button> 
                    <button type="reset" class="btn btn-default">Xoá</button>
                </form>';
        $str.='
            </div>
        </div>';
        $str.='
        <div class="row">
            <div class="map col-md-12">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3917.7986876860687!2d106.76812413851945!3d10.902898675846235!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f3277fe404f%3A0x103f6f6f4f78b0b0!2zVHLhuqduIFF14buRYyBUb-G6o24sIERpIEFuLCBCw6xuaCBExrDGoW5nLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1473051453768" width="1300" height="500" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
        </div>';
        $str.='
        </div>';
        return $str;
    }
    function send_mail($item){
        //Create a new PHPMailer instance
        $mail = new PHPMailer;
        $mail->setFrom('info@quangdung.com.vn', 'Website administrator');
        //Set an alternative reply-to address
        $mail->addReplyTo($item['email'], $item['name']);
        //Set who the message is to be sent to
        $mail->addAddress('czanubis@gmail.com');
        //Set the subject line
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject =  'Contact sent from website';
        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        //$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
        //Replace the plain text body with one created manually
        $mail->Body = '
        <html>
        <head>
        	<title>'.$mail->Subject.'</title>
        </head>
        <body>
        	<p>Full Name: '.$item['name'].'</p>
        	
        	<p>Address: '.$item['adds'].'</p>
        	<p>Phone: '.$item['phone'].'</p>
        	
        	<p>Email: '.$item['email'].'</p>
            <p>Tiêu Đề: '.$item['fax'].'</p>
        	<p>Content: '.nl2br($item['content']).'</p>
        </body>
        </html>
        ';
        //Attach an image file
        //$mail->addAttachment('images/phpmailer_mini.png');
        
        //send the message, check for errors
        //$mail->send();
        if ($mail->send()) {
            echo "Message sent!";
        } else {
            echo "Mailer Error: " . $mail->ErrorInfo;
        }
    }
}
?>
