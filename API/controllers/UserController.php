<?php

class UserController extends AbstractController {
    private UserManager $um;

    public function __construct()
    {
        $this->um = new UserManager();
    }

    public function getUsers()
    {
        // get all the users from the manager
        $users=$this->um->getAllUsers();
        // render
        
        $usersTab = [];
        foreach($users as $user){
            $userTab=$user->toArray();
            $usersTab[]=$userTab;
        }
        $this->render($usersTab);
    }

    public function getUser(string $get)
    {
        $id = intval($get);
         // get the user from the manager
        $user = $this->um->getUserById($id);
        // either by email or by id
        
        $userTab = $user->toArray();

        // render
        $this->render($userTab);
    }

    public function createUser(array $post)
    {
        // // create the user in the manager
        // $createUser = $this->um->createUser();
        // // render the created user
        // $createUserTab = $createUser->toArray();
        
        // $this->render($createUserTab);
    }

    public function updateUser(array $post)
    {
        // update the user in the manager

        // render the updated user
    }

    public function deleteUser(array $post)
    {
        // delete the user in the manager

        // render the list of all users
    }
}