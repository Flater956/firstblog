<?php


namespace application\controllers;

use application\lib\Db;
use application\lib\Pagination;
use application\core\Controller;
use application\controllers\AdminController;
use application\models\Admin;

class MainController extends Controller
{
    public function indexAction(){

        $pagin= new Pagination($this->route,$this->model->postsCount(),3);
        $vars=[
            'pagination'=>$pagin->get(),
            'list'=>$this->model->postsList($this->getId())
        ];

        $this->view->render('главная страница',$vars);

    }
    public function aboutAction(){
        $this->view->render('о сайте');

    }
    public function contactAction(){
       if (!empty($_POST)) {
           if (!$this->model->contactValidate($_POST)) {
               $this->view->message('error', $this->model->error);
           }else{

               mail('lokixo6335@mailfile.org',
                   'Сообщение ',$_POST['name'].','.$_POST['email'].','.$_POST['text']);
               $this->view->message('sucsess', 'сообщение отправлено админу');
           }
       }

        $this->view->render('контакты');


    }
    public function postAction(){
        $admimModel=new Admin();
        if(!$admimModel->isPostExist($this->postId)){
            $this->view->errorCode(404);
        }
        $vars=[
            'list'=>$admimModel->postData($this->postId)[0]
        ];
        $this->view->render('публикации',$vars);

    }
}