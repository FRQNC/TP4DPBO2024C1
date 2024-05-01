<?php
include('conf.php');
include('models/Comments.class.php');
include('models/Posts.class.php');
include('models/Members.class.php');
include('views/Comments.view.php');

class CommentsController
{

    private $comments, $members, $posts;

    function __construct()
    {
        $this->comments = new Comments(Conf::$db_host, Conf::$db_user, Conf::$db_pass, Conf::$db_name);
        $this->members = new Members(Conf::$db_host, Conf::$db_user, Conf::$db_pass, Conf::$db_name);
        $this->posts = new Posts(Conf::$db_host, Conf::$db_user, Conf::$db_pass, Conf::$db_name);
    }

    public function index()
    {
        $this->comments->open();
        $this->comments->getComments();
        $data = array();
        while ($row = $this->comments->getResult()) {
            array_push($data, $row);
        }

        $this->comments->close();

        $view = new commentsView();
        $view->renderIndex($data);
    }

    public function addView()
    {
        $view = new commentsView();
        $data = array(
            'comments' => null,
            'posts' => array(),
            'members' => array()
        );

        $this->members->open();
        $this->members->getMembers();
        while ($row = $this->members->getResult()) {
            array_push($data['members'], $row);
        }
        $this->members->close();

        $this->posts->open();
        $this->posts->getPosts();
        while ($row = $this->posts->getResult()) {
            array_push($data['posts'], $row);
        }
        $this->posts->close();
        $view->renderCreateEdit($data);
    }

    public function editView($id)
    {
        $this->comments->open();
        $this->comments->getCommentById($id);
        $this->members->open();
        $this->members->getMembers();
        $data = array(
            'comments' => array(),
            'posts' => array(),
            'members' => array()
        );
        while ($row = $this->members->getResult()) {
            array_push($data['members'], $row);
        }
        $this->members->close();

        $this->posts->open();
        $this->posts->getPosts();
        while ($row = $this->posts->getResult()) {
            array_push($data['posts'], $row);
        }
        $this->posts->close();

        $data['comments'] = $this->comments->getResult();
        $this->comments->close();
        $view = new commentsView();
        $view->renderCreateEdit($data);
    }

    function add($data)
    {
        $this->comments->open();
        $this->comments->add($data);
        $this->comments->close();

        header("location:comments.php");
    }

    function confirmEdit($data)
    {
        $this->comments->open();
        $this->comments->edit($data);
        $this->comments->close();

        header("location:comments.php");
    }

    function delete($id)
    {
        $this->comments->open();
        $this->comments->delete($id);
        $this->comments->close();

        header("location:comments.php");
    }
}
