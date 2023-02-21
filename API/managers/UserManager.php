<?php

class UserManager extends AbstractManager {

    public function getAllUsers() : array
    {
        // get all the users from the database
        $query=$this->db->prepare("SELECT * FROM users");
        $query->execute();
        $getAllUsers=$query->fetchAll(PDO::FETCH_ASSOC);
        
        $usersTab=[];
        foreach($getAllUsers as $user){
            $newUser=new User($user['id'], $user['username'],$user['first_name'],$user['last_name'],$user['email']);
            array_push($usersTab, $newUser);
        }
        return $usersTab;
    }

    public function getUserById(int $id) : User
    {
        // get the user with $id from the database
        $query=$this->db->prepare("SELECT * FROM users WHERE id= :id");
        $parameters = ['id'=>$id];
        $query->execute($parameters);
        $getAllUsers=$query->fetch(PDO::FETCH_ASSOC);
        $newUser=new User($getAllUsers['id'], $getAllUsers['username'],$getAllUsers['first_name'],$getAllUsers['last_name'],$getAllUsers['email']);
        return $newUser;
    }

    public function createUser(User $user) : User
    {
        // create the user from the database
        $query=$this->db->prepare("INSERT INTO users VALUES (null,:username, :first_name, :last_name, :email)");
        $parameters= [
        'username'=>$user->getUsername(),
        'first_name'=> $user->getFirstName(),
        'last_name' =>$user->getLastName(),
        'email' => $user->getEmail()
        ];
        $query->execute($parameters);
        
        
        $query=$this->db->prepare("SELECT * FROM users WHERE email= :email");
        $parameters= ['email'=>$user->getEmail()];
        $query->execute($parameters);
        $getAddUser=$query->fetch(PDO::FETCH_ASSOC);
        
        $getUser=new User($getAddUser['id'],$getAddUser['username'],$getAddUser['first_name'],$getAddUser['last_name'],$getAddUser['email']);
        // return it with its id
        return $getUser;
    }

    public function updateUser(User $user) : User
    {
        // update the user in the database
        $query=$this->db->prepare("UPDATE users SET username = :username, first_name = :first_name, last_name=:last_name, email=:email WHERE id=:id");
        $parameters= [
        'id' => $user->getId(),
        'username'=>$user->getUsername(),
        'first_name'=> $user->getFirstName(),
        'last_name' =>$user->getLastName(),
        'email' => $user->getEmail()
        ];
        $query->execute($parameters);
        
        $query=$this->db->prepare("SELECT * FROM users WHERE email= :email");
        $parameters= ['email'=>$user->getEmail()];
        $query->execute($parameters);
        $userToUpdate=$query->fetch(PDO::FETCH_ASSOC);
        
        $updatedUser=new User($userToUpdate['id'],$userToUpdate['username'],$userToUpdate['first_name'],$userToUpdate['last_name'],$userToUpdate['email']);
        // return it
        return $updatedUser;
    }

    public function deleteUser(User $user) : array
    {
        // delete the user from the database
        $query=$this->db->prepare("DELETE FROM users WHERE username = :username");
        $parameters= [
        'username'=> $user->getUsername()
        ];
        $query->execute($parameters);
        
        // return the full list of users
        return $this->getAllUsers();
    }
}