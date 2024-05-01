<?php

class Posts extends DB
{
    function getPosts()
    {
        $query = "SELECT * FROM posts
        INNER JOIN members
        ON posts.id_member = members.id_member
        ORDER BY posts.id_post
        ";
        return $this->execute($query);
    }

    function getPostById($id)
    {
        $query = "SELECT * FROM Posts WHERE id_post = $id";
        return $this->execute($query);
    }

    function add($data)
    {
        $title = $data['title'];
        $id_member = $data['id_member'];
        $post_content = $data['post_content'];

        $query = "INSERT INTO Posts(title,id_member,post_content) values ('$title','$id_member','$post_content')";
        return $this->execute($query);
    }

    function edit($data)
    {
        $id = $data['id_post'];
        $title = $data['title'];
        $id_member = $data['id_member'];
        $post_content = $data['post_content'];

        $query = "UPDATE Posts SET title = '$title', id_member=$id_member, post_content = '$post_content' WHERE id_post = $id";
        return $this->execute($query);
    }

    function delete($id)
    {
        $query = "DELETE FROM Posts WHERE id_post = '$id'";
        return $this->execute($query);
    }
}
