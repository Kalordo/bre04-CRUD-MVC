<?php

class UserManager extends AbstractManager {
    public function __construct() {
        parent::__construct();
    }

    public function findAll() {
        $result = $this->db->query("SELECT * FROM users");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    public function findOne(int $id) {
        $result = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $result->execute([':id' => $id]);
        return $result->fetch(PDO::FETCH_ASSOC);
    }
    public function create(User $user): void {
        $result = $this->db->prepare("
            INSERT INTO users (email, first_name, last_name)
            VALUES (:email, :first_name, :last_name)");
        $result->execute([
            ':email' => $user->getEmail(),
            ':first_name' => $user->getFirstName(),
            ':last_name' => $user->getLastName()
        ]);
    }
    public function update(User $user): void {
        $result = $this->db->prepare('
            UPDATE users 
            SET email = :email,
                first_name = :first_name,
                last_name = :last_name
            WHERE id = :id
        ');
        $result->execute([
            ':email' => $user->getEmail(),
            ':first_name' => $user->getFirstName(),
            ':last_name' => $user->getLastName()
        ]);
    }
    public function delete(User $user): void {
        $result = $this->db->prepare("DELETE FROM users WHERE id = :id");
        $result->execute([':id'=> $user->getId()]);
    }
}