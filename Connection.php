<?php
class Connection
{
    public $pdo;
    public function __construct()
    {
        $this->pdo = new PDO('mysql:server=localhost;dbname=crud', 'root', '');
    }
    public function read()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM crud");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function create($title, $description)
    {
        $stmt = $this->pdo->prepare("INSERT INTO crud (title, description, datetime) VALUES (:title, :description, :datetime)");
        $stmt->bindValue('title', $title, PDO::PARAM_STR);
        $stmt->bindValue('description', $description, PDO::PARAM_STR);
        $stmt->bindValue('datetime', date('Y-m-d H-i-s'));
        return $stmt->execute();
    }
    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM crud WHERE id=:id");
        $stmt->bindValue('id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function getNoteById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM crud WHERE id=:id");
        $stmt->bindValue('id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function update($id, $title, $description)
    {
        $stmt = $this->pdo->prepare("UPDATE crud SET title=:title, description=:description, datetime=:datetime WHERE id=:id");
        $stmt->bindValue('title', $title, PDO::PARAM_STR);
        $stmt->bindValue('description', $description, PDO::PARAM_STR);
        $stmt->bindValue('datetime', date('Y-m-d H-i-s'));
        $stmt->bindValue('id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
return new Connection();
