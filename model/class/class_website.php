<?php
include "./model/database.php";

class website {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Phương thức category

    public function getCategories() {
        $sql = "SELECT * FROM tbl_category";
        $result = array();
        $result = $this->db->getRows($sql);

        return $result;
    }

    public function getCategory($category_id) {
        $sql = "SELECT * FROM tbl_category WHERE category_id = '$category_id'";
        $result = $this->db->getRow($sql);

        return $result;
    }

    // Phương thức cho product type

    public function getProductTypes() {
        $sql = "SELECT * FROM tbl_product_type";
        $result = $this->db->getRows($sql);

        return $result;
    }

    public function getProductType($product_type_id) {
        $sql = "SELECT * FROM tbl_product_type WHERE product_type_id = '$product_type_id'";
        $result = $this->db->getRow($sql);

        return $result;
    }

    // Phương thức cho product
    public function getProduct($product_id) {
        $sql = "SELECT * FROM tbl_product WHERE product_id = '$product_id'";
        $result = $this->db->getRow($sql);

        return $result;
    }

    public function getProducts_w_productTypeId($product_type_id) {
        $sql = "SELECT * FROM tbl_product WHERE product_type_id = '$product_type_id' ORDER BY product_id DESC";
        // $sql = "SELECT * FROM tbl_product WHERE product_type_id = '$product_type_id' ORDER BY product_id ASC";
        $result = $this->db->getRows($sql);

        return $result;
    }

    public function getProducts_w_productTypeId_filter($product_type_id, $filterSize, $filterColor, $filterRange) {
        $sql = "SELECT DISTINCT tbl_product.* FROM tbl_product, tbl_product_color WHERE tbl_product.product_id = tbl_product_color.product_id and tbl_product.product_type_id = '$product_type_id'";
        // chua phat trien phan size san pham
        // if(count($filterSize) > 0) {
        //     foreach($filterSize as $index => $item) {
        //         if($index == 0) {

        //         }
        //     }
        // }

        // loc phan color
        if(count($filterColor) > 0) {
            foreach($filterColor as $index => $item) {
                if($index == 0) {
                    $sql .= " and (tbl_product_color.product_color = '$item'";
                }
                else {
                    $sql .= "or tbl_product_color.product_color = '$item'";
                }
            }
            $sql .= ")";
        }
        
        // phan gia tien
        if($filterRange != '' && $filterRange != 0) {
            $filterRange = intval($filterRange);
            $sql .= " and tbl_product.product_price_new <= $filterRange";
        }

        $sql .= ' ORDER BY product_id DESC';
        $result = $this->db->getRows($sql);

        return $result;
    }

    public function getColors() {
        $sql = "SELECT * FROM tbl_product_color";
        $result = $this->db->getRows($sql);

        return $result;
    }

    public function getColor($product_id) {
        $sql = "SELECT * FROM tbl_product_color WHERE product_id = '$product_id'";
        $result = $this->db->getRows($sql);

        return $result;
    }

    public function getImgDesc($product_id) {
        $sql = "SELECT * FROM tbl_product_img_desc WHERE product_id = '$product_id'";
        $result = $this->db->getRows($sql);

        return $result;
    }

    // Phương thức cho cart
    public function addCart($cart_user_id, $cart_product_id, $cart_size, $cart_color, $cart_number) {
        $sql = "INSERT INTO tbl_cart(cart_user_id, cart_product_id, cart_size, cart_color, cart_quantity) VALUES ('$cart_user_id', '$cart_product_id', '$cart_size', '$cart_color', '$cart_number')";

        $result = $this->db->exec($sql);

        return $result;
    }

    public function getCarts($user_id) {
        $sql = "SELECT * FROM tbl_cart WHERE cart_user_id = '$user_id'";

        $result = $this->db->getRows($sql);

        return $result;
    }

    public function deleteCart($cart_id) {
        $sql = "DELETE FROM tbl_cart WHERE cart_id = '$cart_id'";

        $result = $this->db->exec($sql);

        return $result;
    }

    public function getUserInfo($userId) {
        $sql = "SELECT * FROM tbl_user_info WHERE user_id = '$userId'";
        $result = $this->db->getRow($sql);

        return $result;
    }

    public function addOrder($index) {
        $product_id = $_SESSION['listBuy'][$index]['product_id'];
        $user_id = $_SESSION['user_id'];
        $color = $_SESSION['listBuy'][$index]['color'];
        $size = $_SESSION['listBuy'][$index]['size'];
        $quantity = $_SESSION['listBuy'][$index]['quantity'];
        $total = $_SESSION['listBuy'][$index]['total'];
        $name_user = $_SESSION['buy_user_info']['buy_name_user'];
        $phone_user = $_SESSION['buy_user_info']['buy_phone_user'];
        $address = $_SESSION['buy_user_info']['buy_address'];

        $sql = "INSERT INTO tbl_order
                (product_id,
                user_id,
                order_color,
                order_size,
                order_quantity,
                order_total,
                order_customer,
                order_phone,
                order_address)
                VALUES 
                ('$product_id',
                '$user_id',
                '$color',
                '$size',
                '$quantity',
                '$total',
                '$name_user',
                '$phone_user',
                '$address')";

        $result = $this->db->exec($sql);

        return $result;
    }

    public function getOrder($userId) {
        $sql = "SELECT * FROM tbl_order WHERE user_id = '$userId'";
        $result = $this->db->getRows($sql);

        return $result;
    }

    public function deleteOrder($order_id) {
        $sql = "DELETE FROM tbl_order WHERE order_id = '$order_id'";
        $result = $this->db->exec($sql);

        return $result;
    }

    // tìm kiếm sản phẩm
    public function searchProduct($product_type_name) {
        // $sql = "SELECT * FROM tbl_product WHERE product_type_name = %$product_type_name%";
        $product_type_name = '%' . $product_type_name . '%';
        $sql = "SELECT * FROM tbl_product_type WHERE product_type_name LIKE '$product_type_name'";
        $result = $this->db->getRows($sql);

        $product_types_id = array();
        foreach($result as $item) {
            $product_types_id[] = $item['product_type_id'];
        }

        $arr = array();
        foreach($product_types_id as $item) {
            $sql = "SELECT * FROM tbl_product WHERE product_type_id = '$item'";
            $result = $this->db->getRows($sql);
            $arr += $result;
        }

        // Hàm so sánh dựa trên product_id từ cao xuống thấp
        function compareByIdHighToLow($a, $b) {
            return $b['product_id'] - $a['product_id'];
        }
        
        // Sắp xếp mảng sử dụng hàm so sánh product_id từ cao xuống thấp
        usort($arr, 'compareByIdHighToLow');

        return $arr;
    }

    // Lay anh bia trang web
    public function getWebsiteCovers() {
        $sql = "SELECT * FROM tbl_website_cover";

        $result = $this->db->getRows($sql);

        return $result;
    }
}