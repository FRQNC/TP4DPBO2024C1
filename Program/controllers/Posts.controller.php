<?php
include('conf.php');
include('models/Posts.class.php');
include('models/Members.class.php');
include('views/Posts.view.php');

class PostsController
{

    private $posts, $members;

    function __construct()
    {
        $this->posts = new Posts(Conf::$db_host, Conf::$db_user, Conf::$db_pass, Conf::$db_name);
        $this->members = new Members(Conf::$db_host, Conf::$db_user, Conf::$db_pass, Conf::$db_name);
    }

    public function index()
    {
        $this->posts->open();
        $this->posts->getPosts();
        $data = array();
        while ($row = $this->posts->getResult()) {
            array_push($data, $row);
        }

        $this->posts->close();

        $view = new postsView();
        $view->renderIndex($data);
    }

    public function addView()
    {
        $view = new postsView();
        $this->members->open();
        $this->members->getMembers();
        $data = array(
            'posts' => null,
            'members' => array()
        );
        while ($row = $this->members->getResult()) {
            array_push($data['members'], $row);
        }
        $this->members->close();
        $view->renderCreateEdit($data);
    }

    public function editView($id)
    {
        $this->posts->open();
        $this->posts->getPostById($id);
        $this->members->open();
        $this->members->getMembers();
        $data = array(
            'posts' => array(),
            'members' => array()
        );
        while ($row = $this->members->getResult()) {
            array_push($data['members'], $row);
        }
        $this->members->close();
        $data['posts'] = $this->posts->getResult();
        $this->posts->close();
        $view = new postsView();
        $view->renderCreateEdit($data);
    }

    function add($data)
    {
        $this->posts->open();
        $this->posts->add($data);
        $this->posts->close();

        header("location:posts.php");
    }

    function confirmEdit($data)
    {
        $this->posts->open();
        $this->posts->edit($data);
        $this->posts->close();

        header("location:posts.php");
    }

    function delete($id)
    {
        $this->posts->open();
        $this->posts->delete($id);
        $this->posts->close();

        header("location:posts.php");
    }
}
