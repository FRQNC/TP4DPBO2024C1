<?php
class CommentsView
{
    public function renderIndex($data)
    {
        $dataCreateNewLink = "createComments.php";
        $dataTableHeader = "
        <th>ID</th>
        <th>Post Title</th>
        <th>Author</th>
        <th>Content</th>
        <th>Comment Time</th>
        <th>ACTIONS</th>
        ";
        $dataComments = null;
        foreach ($data as $row) {
            $dataComments .= "<tr>
        <th>$row[id_comment]</th>
        <td>$row[title]</td>
        <th>$row[name]</th>
        <td>$row[comment_content]</td>
        <td>$row[comment_time]</td>
        <td>
                  <a class='btn btn-success' href='editComments.php?id_edit=$row[id_comment]'>Edit</a>
                  <a class='btn btn-danger' href='deleteComments.php?id_delete=$row[id_comment]'>Delete</a>
                </td>
      </tr>";
        }

        $tpl = new Template("templates/index.html");
        $tpl->replace("DATA_CREATE_NEW_LINK", $dataCreateNewLink);
        $tpl->replace("DATA_TABLE_HEADER", $dataTableHeader);
        $tpl->replace("DATA_TABLE", $dataComments);
        $tpl->write();
    }

    public function renderCreateEdit($data)
    {
        $dataInputField = null;
        $dataTableName = "comment";
        $dataMember = null;
        $dataFormAction = "";
        $dataButtonType = "";
        if ($data['comments'] != null) {
            $commentData = $data['comments'];
            $dataInputField = "
                <input type='hidden' name='id_comment' value='" . $commentData['id_comment'] . "'>
                
                <label> Author: </label>
                <select name='id_member' class='form-select'>";

                foreach ($data['members'] as $member) {
                    if($commentData['id_member'] != $member['id_member']){
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
                
                <label> Post: </label>
                <select name='id_post' class='form-select'>";

                foreach ($data['posts'] as $post) {
                    if($commentData['id_post'] != $post['id_post']){
                        $dataInputField .= "
                        <option value='$post[id_post]'>$post[title]</option>";
                    }
                    else{
                        $dataInputField .= "
                        <option value='$post[id_post]' selected>$post[title]</option>";
                    }
                }

                $dataInputField .= "
                </select>
                
                <label> Comment Content: </label>
                <textarea name='comment_content' class='form-control'>$commentData[comment_content]</textarea><br> 
    ";
            $dataButtonType = "edit";
            $dataFormAction = "edit.php";
        } else {
            if ($data['members'] != null && $data['posts'] != null) {
                $dataInputField = "
                
                <label> Author: </label>
                <select name='id_member' class='form-select'>";

                foreach ($data['members'] as $member) {
                    $dataInputField .= "
                    <option value='$member[id_member]'>$member[name]</option>";
                }

                $dataInputField .= "
                </select>
                
                <label> Post: </label>
                <select name='id_post' class='form-select'>";

                foreach ($data['posts'] as $post) {
                    $dataInputField .= "
                    <option value='$post[id_post]'>$post[title]</option>";
                }

                $dataInputField .= "
                </select>
                
                <label> Comment Content: </label>
                <textarea name='comment_content' class='form-control'> </textarea><br> 
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
