<?php

class UserManager extends AbstractManager {
    public function __construct() {
        parent::__construct();
    }

    public function findAll() {
        $result = $this->db->query("SELECT * FROM users");
        $usersResult = $result->fetchAll(PDO::FETCH_ASSOC);

        $users = [];

        foreach ($usersResult as $userResult) {
            $user = new User(
                $userResult['email'],
                $userResult['first_name'],
                $userResult['last_name']
            );
            $user->setId($userResult['id']);
            $users[]=$users;
        }
        return $users;
    }
    public function findOne(int $id): ?User {
        $result = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $result->execute([':id' => $id]);
        $userResult = $result->fetch(PDO::FETCH_ASSOC);

        if($userResult) {
            $user = new User(
                $userResult['email'],
                $userResult['first_name'],
                $userResult['last_name']
            );
            $user->setId($userResult['id']);
            return $user;
        }
        return null;
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