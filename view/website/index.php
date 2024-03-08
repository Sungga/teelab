<?php
    class viewWebsite {
        public function productType($categories, $product_types, $product_type, $category, $products, $colors) {
            include "./templates/website/header_website.php";
            include "./templates/website/list_product.php";
            include "./templates/website/footer_website.php";
        }

        public function product($categories, $product_types, $product, $product_type, $category, $product_img_desc, $product_color) {
            include "./templates/website/header_website.php";
            include "./templates/website/product.php";
            include "./templates/website/footer_website.php";
        }

        public function cart($categories, $product_types, $list_cart, $arr_product_cart, $colors, $sizes) {
            include "./templates/website/header_website.php";
            include "./templates/website/cart.php";
            include "./templates/website/footer_website.php";
        }

        public function location($categories, $product_types, $user_name, $user_phone, $user_address) {
            include "./templates/website/header_website.php";
            include "./templates/website/location.php";
            include "./templates/website/footer_website.php";
        }

        public function payMoney($categories, $product_types) {
            include "./templates/website/header_website.php";
            include "./templates/website/pay_money.php";
            include "./templates/website/footer_website.php";
        }
        
        public function success($categories, $product_types, $status) {
            include "./templates/website/header_website.php";
            include "./templates/website/success.php";
            include "./templates/website/footer_website.php";
        }

        public function order($categories, $product_types, $orders, $products) {
            include "./templates/website/header_website.php";
            include "./templates/website/order.php";
            include "./templates/website/footer_website.php";
        }

        public function home($categories, $product_types, $website_covers) {
            include "./templates/website/header_website.php";
            include "./templates/website/home.php";
            include "./templates/website/footer_website.php";
        }
    }
?>