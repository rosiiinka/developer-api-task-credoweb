<?php

class User
{

    private $conn;
    private $table_name = "users";

    public $id;
    public $email;
    public $firstName;
    public $lastName;
    public $createdAt;

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {

        $sql = "select * from {$this->table_name}";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute();

        return $stmt;

    }

    public function create()
    {

        $sql = "INSERT INTO {$this->table_name} set 
                id = null, 
                email = '{$this->email}',
                firstName = '{$this->firstName}',
                lastName = '{$this->lastName}',
                createdAt = now() ";

        $stmt = $this->conn->prepare($sql);

        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->firstName = htmlspecialchars(strip_tags($this->firstName));
        $this->lastName = htmlspecialchars(strip_tags($this->lastName));

        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":firstName", $this->firstName);
        $stmt->bindParam(":lastName", $this->lastName);

        if ($stmt->execute()) {
            return true;
        }

        return false;

    }

    public function readOneUser()
    {

        $sql = "select * from {$this->table_name} where id = ? ";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(1, $this->id);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($num = $stmt->rowCount()) {
            $this->email = $row['email'];
            $this->firstName = $row['firstName'];
            $this->lastName = $row['lastName'];
            $this->createdAt = $row['createdAt'];

            return true;

        } else {
            return false;
        }

    }

    public function update()
    {

        $sql = "UPDATE
                {$this->table_name}
            SET
                email = :email,
                firstName = :firstName,
                lastName = :lastName
            WHERE
                id = :id";

        $stmt = $this->conn->prepare($sql);

        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->firstName=htmlspecialchars(strip_tags($this->firstName));
        $this->lastName=htmlspecialchars(strip_tags($this->lastName));
        $this->id=htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':firstName', $this->firstName);
        $stmt->bindParam(':lastName', $this->lastName);
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()){
            return true;
        }

        return false;

    }

    public function delete()
    {

        $sql = "DELETE FROM {$this->table_name} WHERE id = ?";

        $stmt = $this->conn->prepare($sql);

        $this->id=htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(1, $this->id);

        if($stmt->execute()){
            return true;
        }

        return false;

    }

    function search($keywords){

        $sql = "SELECT * FROM 
                {$this->table_name}
                WHERE
                    email LIKE ? OR firstName LIKE ? OR lastName LIKE ?
                ORDER BY
                    createdAt DESC";

        $stmt = $this->conn->prepare($sql);

        $keywords=htmlspecialchars(strip_tags($keywords));
        $keywords = "%{$keywords}%";

        $stmt->bindParam(1, $keywords);
        $stmt->bindParam(2, $keywords);
        $stmt->bindParam(3, $keywords);

        $stmt->execute();

        return $stmt;
    }
}
