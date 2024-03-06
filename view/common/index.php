<?php
    class viewCommon {
        public function signup($categories, $product_types) {
            include "./templates/website/header_website.php";
            include "./templates/common/signup.php";
            include "./templates/website/footer_website.php";
        }

        public function signin($categories, $product_types) {
            include "./templates/website/header_website.php";
            include "./templates/common/signin.php";
            include "./templates/website/footer_website.php";
        }

        public function account($categories, $product_types, $user_account, $user_info) {
            include "./templates/website/header_website.php";
            include "./templates/common/account.php";
            include "./templates/website/footer_website.php";
        }

        public function password($categories, $product_types, $user_info) {
            include "./templates/website/header_website.php";
            include "./templates/common/password.php";
            include "./templates/website/footer_website.php";
        }
    }

?>