<?php

class Members extends DB
{
    function getMembers()
    {
        $query = "SELECT * FROM members";
        return $this->execute($query);
    }

    function getMemberById($id)
    {
        $query = "SELECT * FROM members WHERE id_member = $id";
        return $this->execute($query);
    }

    function add($data)
    {
        $name = $data['name'];
        $email = $data['email'];
        $phone = $data['phone'];

        $query = "INSERT INTO members(name,email,phone) values ('$name','$email','$phone')";
        return $this->execute($query);
    }

    function edit($data)
    {
        $id = $data['id_member'];
        $name = $data['name'];
        $email = $data['email'];
        $phone = $data['phone'];

        $query = "UPDATE members SET name = '$name', email = '$email', phone = '$phone' WHERE id_member = $id";
        return $this->execute($query);
    }

    function delete($id)
    {
        $query = "DELETE FROM members WHERE id_member = '$id'";
        return $this->execute($query);
    }
}
