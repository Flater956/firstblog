<?php


namespace application\models;


use application\core\Model;


class Admin extends Model
{

    public $error;

    public function loginValidate($post){
        $config=require 'application/config/admin.php';
        if (($config['login']!=$post['login']) or ($config['password']!=$post['password']) ){
            $this->error='логин или пароль введен не верно';
            return false;
        }
            return true;




    }
    public function postValidate($post,$type){
        $lenghtname =iconv_strlen($post['name']);
        $lenghttext =iconv_strlen($post['text']);
        $lenghtdes =iconv_strlen($post['description']);

        if ($lenghtname <=2 or $lenghtname>=100 ){
            $this->error='назвние должно содержать от 3 до 100 символов';
            return false;
        }elseif ( $lenghtdes>=100){
            $this->error='описание должно содержать менее 100 символов  ';
            return false;
        }elseif ($lenghttext>5000 or $lenghttext<10){
            $this->error='текст должен содержать от 10 до 5000 символов ';
            return false;
        }
        return true;




    }
    public function addPost($post){
      $params = [

           'name'=> $post['name'],
            'description'=> $post['description'],
             'text'=>$post['text'],
        ];


        $this->db->query('INSERT INTO posts(name,description,text) VALUES (:name,:description,:text)',$params);
        return $this->db->lastId();
    }
    public function postUploadImg($fname,$id){

       move_uploaded_file($fname,'public/materials/'.$id.'.jpg');

    }
    public function isPostExist($id){
        $params=['id'=>$id];
        return $this->db->colum('SELECT id FROM posts WHERE id=:id',$params);
    }
    public function deletePost($id){
        $params=['id'=>$id];
        $this->db->query('DELETE FROM posts WHERE id=:id',$params);

        if(file_exists('public/materials/'.$id.'.jpg')) {

            unlink('public/materials/' . $id . '.jpg');

        }
    }
    public function postData($id){
        $params=['id'=>$id];
       return $this->db->row('SELECT * FROM posts WHERE id=:id',$params);
    }
    public function postEdit($post,$id){
        $params = [
              'id'=>$id,
            'name'=> $post['name'],
            'description'=> $post['description'],
            'text'=>$post['text'],
        ];


        return $this->db->query('UPDATE posts SET name=:name,description=:description,text=:text WHERE id=:id',$params);
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
