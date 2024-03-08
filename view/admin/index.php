<?php
    class viewAdmin {
        public function addCategory() {
            include "./templates/admin/header_admin.php";
            include "./templates/admin/admin_left.php";
            include "./templates/admin/add_category.php";
        }
        
        public function listCategory($categories) {
            include "./templates/admin/header_admin.php";
            include "./templates/admin/admin_left.php";
            include "./templates/admin/list_category.php";
        }

        public function editCategory($category) {
            include "./templates/admin/header_admin.php";
            include "./templates/admin/admin_left.php";
            include "./templates/admin/edit_category.php";
        }

        public function addProductType($categories) {
            include "./templates/admin/header_admin.php";
            include "./templates/admin/admin_left.php";
            include "./templates/admin/add_product_type.php";
        }

        public function listProductType($categories, $product_types) {
            include "./templates/admin/header_admin.php";
            include "./templates/admin/admin_left.php";
            include "./templates/admin/list_product_type.php";
        }

        public function editProductType($categories, $product_type) {
            include "./templates/admin/header_admin.php";
            include "./templates/admin/admin_left.php";
            include "./templates/admin/edit_product_type.php";
        }

        public function addProduct($categories, $product_types, $jsonData) {
            include "./templates/admin/header_admin.php";
            include "./templates/admin/admin_left.php";
            include "./templates/admin/add_product.php";
        }

        public function listProduct($categories, $product_types, $products, $product_imgs_desc, $product_color) {
            include "./templates/admin/header_admin.php";
            include "./templates/admin/admin_left.php";
            include "./templates/admin/list_product.php";
        }

        public function editProduct($categories, $product_types, $product, $product_img_desc, $product_color, $product_type_prd, $category_prd, $product_type_ctg, $jsonData) {
            include "./templates/admin/header_admin.php";
            include "./templates/admin/admin_left.php";
            include "./templates/admin/edit_product.php";
        }

        public function addWebsiteCover() {
            include "./templates/admin/header_admin.php";
            include "./templates/admin/admin_left.php";
            include "./templates/admin/add_website_cover.php";
        }

        public function listWebsiteCover($website_covers) {
            include "./templates/admin/header_admin.php";
            include "./templates/admin/admin_left.php";
            include "./templates/admin/list_website_cover.php";
        }

        public function order($orders, $products) {
            include "./templates/admin/header_admin.php";
            include "./templates/admin/order_management.php";
        }
    }

?>