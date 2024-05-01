<?php

class Comments extends DB
{
    function getComments()
    {
        $query = "SELECT * FROM comments
        INNER JOIN members
        ON comments.id_member = members.id_member
        INNER JOIN posts
        ON comments.id_post = posts.id_post
        ORDER BY comments.id_comment
        ";
        return $this->execute($query);
    }

    function getCommentById($id)
    {
        $query = "SELECT * FROM comments WHERE id_comment = $id";
        return $this->execute($query);
    }

    function add($data)
    {
        $id_member = $data['id_member'];
        $id_post = $data['id_post'];
        $comment_content = $data['comment_content'];

        $query = "INSERT INTO comments(id_member,id_post,comment_content) values ('$id_member','$id_post','$comment_content')";
        return $this->execute($query);
    }

    function edit($data)
    {
        $id = $data['id_comment'];
        $id_post = $data['id_post'];
        $id_member = $data['id_member'];
        $comment_content = $data['comment_content'];

        $query = "UPDATE comments SET id_member = $id_member, id_post=$id_post, comment_content = '$comment_content' WHERE id_comment = $id";
        return $this->execute($query);
    }

    function delete($id)
    {
        $query = "DELETE FROM comments WHERE id_comment = '$id'";
        return $this->execute($query);
    }
}
