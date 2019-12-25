<?php


namespace application\controllers;
use application\core\Controller;
use application\lib\Pagination;
class AdminController extends Controller
{
    public function __construct($route)
    {
        parent::__construct($route);
        $this->view->layout='admin';
    }

    public function loginAction(){
        if (isset($_SESSION['admin'])){
            $this->view->redirect('/admin/add');
        }
        if (!empty($_POST)) {

            if ($this->model->loginValidate($_POST)==false) {
                $this->view->message('error', $this->model->error);
            }
            $_SESSION['admin'] = true;
            $this->view->location('admin/add');

        }


        $this->view->render('вход');

    }
    public function logoutAction(){

       unset($_SESSION['admin']);

       $this->view->redirect('/admin/login');

    }
    public function addAction(){
        if (!empty($_POST)) {

            if ($this->model->postValidate($_POST,'add')==false) {
                $this->view->message('error', $this->model->error);
            }
            $id=$this->model->addPost($_POST);
            $this->model->postUploadImg($_FILES['img']['tmp_name'],$id);

            $this->view->message('sucsess', 'пост опубликован');


        }


   $this->view->render('добавить публикацию');

    }
    public function editAction(){
        if(!$this->model->isPostExist($this->postId)){
            $this->view->errorCode(404);
        }
        if (!empty($_POST)) {

            if (!$this->model->postValidate($_POST,'edit')) {
                $this->view->message('error', $this->model->error);
            }

            $this->model->postEdit($_POST,$this->postId);
            if($_FILES['img']['tmp_name']){
                $this->model->postUploadImg($_FILES['img']['tmp_name'],$this->postId);
            }
            $this->view->message('sucsess', 'изменения сохранены');

        }
        $vars=[
          'data'=>$this->model->postData($this->postId)[0]
        ];
        $this->view->render('редактировать',$vars);

    }
    public function deleteAction(){
        if(!$this->model->isPostExist($this->postId)){
            $this->view->errorCode(404);
        }

        $this->model->deletePost($this->postId);

        $this->view->redirect('/admin/posts/1');




    }
    public function postsAction(){
        $pagin= new Pagination($this->route,$this->model->postsCount(),3);
        $vars=[
            'pagination'=>$pagin->get(),
            'list'=>$this->model->postsList($this->getId())
        ];
        $this->view->render('посты',$vars);

    }
}