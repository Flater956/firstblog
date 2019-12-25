<?php
namespace application\models;
use application\core\Model;

class Main extends Model
{
    public $error;

    public function contactValidate($post){
        $lenghtname =iconv_strlen($post['name']);
        $lenghttext =iconv_strlen($post['text']);

        if(($lenghtname<=2)or($lenghtname>20)){
            $this->error='имя должно содержать от 3 до 20 символов';
            return false;

        }elseif (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)){
            $this->error='email не коректно указан';
            return false;
        } elseif (($lenghttext<=10)or($lenghttext>500)){
            $this->error='сообщение должно содержать от10 до 500 символов';
            return false;

        }

        return true;
    }
    public function postsCount(){
        return $this->db->colum('SELECT COUNT(id) FROM posts');
    }
    public function postsList($pag){
        if($pag==''){
            $page=1;
        }else{
            $page=$pag;
        }
        $max=3;
        $params= [
            'max'=>$max,
            'start'=>($page -1)*$max,
        ];
        return $this->db->row('SELECT * FROM posts ORDER BY id DESC LIMIT :start,:max',$params);

    }

}