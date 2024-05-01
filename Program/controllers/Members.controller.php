<?php
include('conf.php');
include('models/Members.class.php');
include('views/Members.view.php');

class MembersController{

    private $members;

    function __construct()
    {
        $this->members = new Members(Conf::$db_host, Conf::$db_user, Conf::$db_pass, Conf::$db_name);
    }

    public function index() {
        $this->members->open();
        $this->members->getMembers();
        $data = array();
        while($row = $this->members->getResult()){
          array_push($data, $row);
        }
    
        $this->members->close();
    
        $view = new MembersView();
        $view->renderIndex($data);
      }

    public function addView(){
      $view = new MembersView();
      $view->renderCreateEdit(null);
    }

    public function editView($id){
      $this->members->open();
      $this->members->getMemberById($id);
      $data = $this->members->getResult();
      $this->members->close();
      $view = new MembersView();
      $view->renderCreateEdit($data);
    }
    
      function add($data){
        $this->members->open();
        $this->members->add($data);
        $this->members->close();
        
        header("location:index.php");
      }
    
      function confirmEdit($data){
        $this->members->open();
        $this->members->edit($data);
        $this->members->close();
        
        header("location:index.php");
      }
    
      function delete($id){
        $this->members->open();
        $this->members->delete($id);
        $this->members->close();
        
        header("location:index.php");
      }
}

?>