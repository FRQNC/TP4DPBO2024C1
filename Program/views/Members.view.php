<?php
  class MembersView{
    public function renderIndex($data){
      $dataCreateNewLink = "create.php";
      $dataTableHeader = "
      <th>ID</th>
      <th>NAME</th>
      <th>EMAIL</th>
      <th>PHONE</th>
      <th>JOINING DATE</th>
      <th>ACTIONS</th>
      ";
      $dataMember = null;
      foreach($data as $row){
        $dataMember .= "<tr>
        <th>$row[id_member]</th>
        <td>$row[name]</td>
        <td>$row[email]</td>
        <td>$row[phone]</td>
        <td>$row[join_date]</td>
        <td>
                  <a class='btn btn-success' href='edit.php?id_edit=$row[id_member]'>Edit</a>
                  <a class='btn btn-danger' href='delete.php?id_delete=$row[id_member]'>Delete</a>
                </td>
      </tr>";
      }

      $tpl = new Template("templates/index.html");
      $tpl->replace("DATA_CREATE_NEW_LINK", $dataCreateNewLink);
      $tpl->replace("DATA_TABLE_HEADER", $dataTableHeader);
      $tpl->replace("DATA_TABLE", $dataMember);
      $tpl->write();
    }

    public function renderCreateEdit($data){
      $dataTableName = "Member";
      $dataInputField = null;
      $dataFormAction = "";
      $dataButtonType = "";
      if($data != null){
        $dataInputField .= "
        <input type='hidden' name='id_member' value='$data[id_member]' >
        <label> NAME: </label>
        <input type='text' name='name' class='form-control' value='$data[name]'> <br>
        
        <label> EMAIL: </label>
        <input type='text' name='email' class='form-control' value='$data[email]'> <br>
        
        <label> PHONE: </label>
        <input type='number' name='phone' class='form-control' value='$data[phone]'> <br>
        ";
        $dataButtonType = "edit";
        $dataFormAction = "edit.php";
      }
      else{
        $dataInputField .= '
        <label> NAME: </label>
        <input type="text" name="name" class="form-control"> <br>

        <label> EMAIL: </label>
        <input type="text" name="email" class="form-control"> <br>

        <label> PHONE: </label>
        <input type="number" name="phone" class="form-control"> <br>
        ';
        $dataButtonType = "add";
        $dataFormAction = "create.php";
      }

      $tpl = new Template("templates/createEdit.html");
      $tpl->replace("DATA_TABLE_NAME", $dataTableName);
      $tpl->replace("DATA_INPUT_FIELD", $dataInputField);
      $tpl->replace("DATA_BUTTON_TYPE",$dataButtonType);
      $tpl->replace("DATA_FORM_ACTION",$dataFormAction);
      $tpl->write();
    }
  }