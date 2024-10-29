<?php
require_once __DIR__ . '/../DAL/UserRepository.php'; 

class UserService {
    private $userRepository;

    public function __construct() {
        $this->userRepository = new UserRepository();
    }

    public function login($email, $password) {
        $user = $this->userRepository->findUserByEmail($email);
        if ($user && $password == $user['password']) {
            return $user;
        }
        return null;
    }

     public function getUserById($id) {
        return $this->userRepository->findUserById($id);
    }
    public function updateUser($id, $name, $password, $phone, $email, $address) {
        return $this->userRepository->updateUser($id, $name, $password, $phone, $email, $address);
    }

    public function getAllUsers() {
    return $this->userRepository->findAllUsers();
}

    public function deleteUser($id) {
        return $this->userRepository->deleteUser($id);
    }

    public function findNameType($id){
        return $this->userRepository->findNameTypebyId($id);
    }

    public function addUser($name, $email, $password, $phone, $address, $type) {
        return $this->userRepository->addUser($name, $email, $password, $phone, $address, $type);
    }

    public function isEmailExist($email){
        return $this->userRepository->isEmailExist($email);
    }
    
    public function updatePassword($email, $newPassword) {
        $userRepository = new UserRepository();
        $hashedPassword = md5($newPassword); // hoặc sử dụng một phương pháp băm mật khẩu mạnh hơn
        return $userRepository->updatePassword($email, $hashedPassword);
    }
    
    function validatePhoneNumber($phone) {
        $pattern = '/^[0-9]{10}$/';

        if (preg_match($pattern, $phone)) {
            return true;
        } else {
            return false;
        }
    }
}