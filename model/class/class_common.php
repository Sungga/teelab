<?php
include "./model/database.php";

class common {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // cho user
    public function addUser($userAccount, $userPassword, $userName, $userPhone, $userEmail, $userAddress) {
        $hashedPassword = password_hash($userPassword, PASSWORD_DEFAULT);

        $sql = "INSERT INTO tbl_user (user_account, user_password) values ('$userAccount', '$hashedPassword')";
        $result = $this->db->exec($sql);

        // lay id user vua moi them
        $sql = "SELECT * FROM tbl_user ORDER BY user_id DESC LIMIT 1";
        $user_new = $this->db->getRows($sql);
        $user_new_id = $user_new[0]['user_id'];

        // them thong tin nguoi dung
        $sql = "INSERT INTO tbl_user_info (user_id, user_name, user_phone, user_email, user_address) VALUES ('$user_new_id', '$userName', '$userPhone', '$userEmail', '$userAddress')";
        $result = $this->db->exec($sql);

        return $result;
    }

    function checkUserExists($userAccount) {
        $sql = "SELECT * FROM tbl_user";
        $listUser = $this->db->exec($sql);

        foreach($listUser as $user_item) {
            if($user_item['user_account'] == $userAccount) {
                return false;
            }
        }

        return true;
    }

    function checkAccount($userAccount, $userPassword) {
        $sql = "SELECT * FROM tbl_user";
        $listUser = $this->db->getRows($sql);

        foreach($listUser as $user_item) {
            if ($user_item['user_account'] == $userAccount && password_verify($userPassword, $user_item['user_password'])) {
                return true;
            }
        }

        return false;
    }

    function checkPassword($userId, $userPassword) {
        $sql = "SELECT * FROM tbl_user WHERE user_id = '$userId'";
        $user = $this->db->getRow($sql);
        
        if (password_verify($userPassword, $user['user_password'])) {
            return true;
        }

        return false;
    }
    
    public function getUserId($userAccount) {
        $sql = "SELECT * FROM tbl_user WHERE user_account = '$userAccount'";
        $result = $this->db->getRow($sql);

        return $result;
    }

    public function getUserInfo($userId) {
        $sql = "SELECT * FROM tbl_user_info WHERE user_id = '$userId'";
        $result = $this->db->getRow($sql);

        return $result;
    }

    public function getUserAcc($userId) {
        $sql = "SELECT * FROM tbl_user WHERE user_id = '$userId'";
        $result = $this->db->getRow($sql);

        return $result;
    }

    public function editInfo($userId, $userName, $userPhone, $userEmail, $userAddress) {
        $sql = "UPDATE tbl_user_info 
                SET user_name = '$userName', 
                    user_phone = '$userPhone', 
                    user_email = '$userEmail', 
                    user_address = '$userAddress' 
                WHERE user_id = '$userId'";

        $result = $this->db->exec($sql);

        return $result;
    }

    public function editPassword($userId, $userPassword) {
        $passwordNew = password_hash($userPassword, PASSWORD_DEFAULT);

        $sql = "UPDATE tbl_user
                SET user_password = '$passwordNew'
                WHERE user_id = '$userId'";

        $result = $this->db->exec($sql);

        return $result;
    }

    // cho header
    public function getProductTypes() {
        $sql = "SELECT * FROM tbl_product_type";
        $result = $this->db->getRows($sql);

        return $result;
    }

    public function getCategories() {
        $sql = "SELECT * FROM tbl_category";
        $result = array();
        $result = $this->db->getRows($sql);

        return $result;
    }

}