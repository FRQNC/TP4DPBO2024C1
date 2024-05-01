<?php
class PostsView
{
    public function renderIndex($data)
    {
        $dataCreateNewLink = "createPosts.php";
        $dataTableHeader = "
        <th>ID</th>
        <th>Post Title</th>
        <th>Author</th>
        <th>Content</th>
        <th>Post Time</th>
        <th>ACTIONS</th>
        ";
        $dataPosts = null;
        foreach ($data as $row) {
            $dataPosts .= "<tr>
        <th>$row[id_post]</th>
        <td>$row[title]</td>
        <th>$row[name]</th>
        <td>$row[post_content]</td>
        <td>$row[post_time]</td>
        <td>
                  <a class='btn btn-success' href='editPosts.php?id_edit=$row[id_post]'>Edit</a>
                  <a class='btn btn-danger' href='deletePosts.php?id_delete=$row[id_post]'>Delete</a>
                </td>
      </tr>";
        }

        $tpl = new Template("templates/index.html");
        $tpl->replace("DATA_CREATE_NEW_LINK", $dataCreateNewLink);
        $tpl->replace("DATA_TABLE_HEADER", $dataTableHeader);
        $tpl->replace("DATA_TABLE", $dataPosts);
        $tpl->write();
    }

    public function renderCreateEdit($data)
    {
        $dataInputField = null;
        $dataTableName = "Post";
        $dataMember = null;
        $dataFormAction = "";
        $dataButtonType = "";
        if ($data['posts'] != null) {
            $postData = $data['posts'];
            $dataInputField = "
                <input type='hidden' name='id_post' value='" . $postData['id_post'] . "'>
                <label> Title: </label>
                <input type='text' name='title' class='form-control' value = '$postData[title]'> <br>
                
                <label> Author: </label>
                <select name='id_member' class='form-select'>";

                foreach ($data['members'] as $member) {
                    if($postData['id_member'] != $member['id_member']){
                        $dataInputField .= "
                        <option value='$member[id_member]'>$member[name]</option>";
                    }
                    else{
                        $dataInputField .= "
                        <option value='$member[id_member]' selected>$member[name]</option>";
                    }
                }

                $dataInputField .= "
                </select>
                
                <label> Post Content: </label>
                <textarea name='post_content' class='form-control'>$postData[post_content]</textarea><br> 
    ";
            $dataButtonType = "edit";
            $dataFormAction = "edit.php";
        } else {
            if ($data['members'] != null) {
                $dataInputField = "
                <label> Title: </label>
                <input type='text' name='title' class='form-control'> <br>
                
                <label> Author: </label>
                <select name='id_member' class='form-select'>";

                foreach ($data['members'] as $member) {
                    $dataInputField .= "
                    <option value='$member[id_member]'>$member[name]</option>";
                }

                $dataInputField .= "
                </select>
                
                <label> Post Content: </label>
                <textarea name='post_content' class='form-control'> </textarea><br> 
    ";
                $dataButtonType = "add";
                $dataFormAction = "create.php";
            }
        }

        $tpl = new Template("templates/createEdit.html");
        $tpl->replace("DATA_TABLE_NAME", $dataTableName);
        $tpl->replace("DATA_INPUT_FIELD", $dataInputField);
        $tpl->replace("DATA_BUTTON_TYPE", $dataButtonType);
        $tpl->replace("DATA_FORM_ACTION", $dataFormAction);
        $tpl->write();
    }
}
