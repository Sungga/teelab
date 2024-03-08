<?php
include "./model/database.php";

class admin {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Phương thức cho category

    public function addCategory($category_name) {
        $sql = "INSERT INTO tbl_category(category_name) VALUES ('$category_name')";
        $result = $this->db->exec($sql);

        return $result;
    }

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

    public function deleteCategory($category_id) {
        $sql = "DELETE FROM tbl_category WHERE category_id = '$category_id'";
        $result = $this->db->exec($sql);

        $product_type = $this->db->getRow('SELECT * FROM tbl_product_type');

        $sql = "DELETE FROM tbl_product_type WHERE category_id = '$category_id'";
        $result = $this->db->exec($sql);

        $product_type_id = $product_type['product_id'];
        $sql = "DELETE FROM tbl_product WHERE product_type_id = '$product_type_id'";
        $result = $this->db->exec($sql);

        return $result;
    }

    public function editCategory($category_id, $category_name) {
        $sql = "UPDATE tbl_category SET category_name = '$category_name' WHERE category_id = '$category_id'";
        $result = $this->db->exec($sql);

        return $result;
    }



    // Phương thức cho product type

    public function addProductType($product_type_name , $category_id) {
        $sql = "INSERT INTO tbl_product_type (product_type_name ,category_id) VALUES ('$product_type_name' ,'$category_id')";
        $result = $this->db->exec($sql);

        return $result;
    }

    public function getProductTypes() {
        $sql = "SELECT * FROM tbl_product_type";
        $result = $this->db->getRows($sql);

        return $result;
    }

    public function getProductTypes_w_categoryId($category_id) {
        $sql = "SELECT * FROM tbl_product_type WHERE category_id = '$category_id'";
        $result = $this->db->getRows($sql);

        return $result;
    }


    public function getProductType($product_type_id) {
        $sql = "SELECT * FROM tbl_product_type WHERE product_type_id = '$product_type_id'";
        $result = $this->db->getRow($sql);

        return $result;
    }

    public function editProductType($product_type_id, $product_type_name, $category_id) {
        $sql = "UPDATE tbl_product_type 
                SET category_id = '$category_id', product_type_name = '$product_type_name' 
                WHERE product_type_id = '$product_type_id'";
                
        $result = $this->db->exec($sql);

        return $result;
    }

    public function deleteProductType($product_type_id) {
        $sql = "DELETE FROM tbl_product_type WHERE product_type_id = '$product_type_id'";
        $result = $this->db->exec($sql);

        $sql = "DELETE FROM tbl_product WHERE product_type_id = '$product_type_id'";
        $result = $this->db->exec($sql);

        return $result;
    }

    // Phương thức cho product

    public function addProduct() {
        $product_name = $_POST['product_name'];
        $product_type_id = $_POST['product_type_id'];
        $product_price = $_POST['product_price'];
        $product_price_new = $_POST['product_price_new'];
        $product_desc = $_POST['product_desc'];
        $product_quantity = $_POST['product_quantity'];
        $product_img = $_FILES['product_img']['name'];

        // upload file ảnh vào trong dtb
        move_uploaded_file($_FILES['product_img']['tmp_name'],"model/uploads/".$_FILES['product_img']['name']);


        $sql = "INSERT INTO tbl_product (
                product_name,
                product_type_id,
                product_price,
                product_price_new,
                product_desc,
                product_quantity,
                product_img
                )
                VALUES (
                    '$product_name',
                    '$product_type_id',
                    '$product_price',
                    '$product_price_new',
                    '$product_desc',
                    '$product_quantity',
                    '$product_img'
                )";

        $result = $this->db->exec($sql);

        

        if($result) {
            // lay product id vừa tạo để thực hiện thêm ảnh mô tả và màu
            $sql = "SELECT * FROM tbl_product
            ORDER BY product_id DESC
            LIMIT 1";
            $product = $this->db->getRow($sql);
            $product_id = $product['product_id'];

            // Thêm ảnh mô tả
            $filename = $_FILES['product_img_desc']['name'];
            $filetmp = $_FILES['product_img_desc']['tmp_name'];

            foreach($filename as $key => $value) {
                $sql = "INSERT INTO tbl_product_img_desc (product_id, product_img_desc) VALUES ('$product_id', '$value')";
                $result = $this->db->exec($sql);

                move_uploaded_file($filetmp[$key],"model/uploads/".$value);
            }


            // Thêm các màu
            $arr = array();

            echo '<pre>';
            print_r($_POST);

            if(isset($_POST['yellow'])) {
                $arr[] = 'yellow';
            }
            if(isset($_POST['green'])) {
                $arr[] = 'green';
            }
            if(isset($_POST['pink'])) {
                $arr[] = 'pink';
            }
            if(isset($_POST['red'])) {
                $arr[] = 'red';
            }
            if(isset($_POST['gray'])) {
                $arr[] = 'gray';
            }
            if(isset($_POST['white'])) {
                $arr[] = 'white';
            }
            if(isset($_POST['brown'])) {
                $arr[] = 'brown';
            }
            if(isset($_POST['black'])) {
                $arr[] = 'black';
            }

            foreach($arr as $key => $value) {
                $sql = "INSERT INTO tbl_product_color (product_id, product_color) VALUES ('$product_id', '$value')";
                $result = $this->db->exec($sql);
            }
        }

        return $result;
    }

    public function getProducts() {
        $sql = "SELECT * FROM tbl_product ORDER BY product_id DESC";
        $result = $this->db->getRows($sql);

        return $result;
    }

    public function getProduct($product_id) {
        $sql = "SELECT * FROM tbl_product WHERE product_id = '$product_id'";
        $result = $this->db->getRow($sql);

        return $result;
    }

    public function getImgsDesc() {
        $sql = "SELECT * FROM tbl_product_img_desc";
        $result = $this->db->getRows($sql);

        return $result;
    }

    public function getImgDesc($product_id) {
        $sql = "SELECT * FROM tbl_product_img_desc WHERE product_id = '$product_id'";
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

    public function editProduct() {
        $product_id = $_GET['product_id'];
        $product_name = $_POST['product_name'];
        $product_type_id = $_POST['product_type_id'];
        $product_price = $_POST['product_price'];
        $product_price_new = $_POST['product_price_new'];
        $product_desc = $_POST['product_desc'];
        $product_quantity = $_POST['product_quantity'];
        $product_img = $_FILES['product_img']['name'];

        
        if($_FILES['product_img']['size'] == 0) {
            $sql = "UPDATE tbl_product 
                SET product_name = '$product_name',
                    product_type_id = '$product_type_id',
                    product_price = '$product_price',
                    product_price_new = '$product_price_new',
                    product_desc = '$product_desc',
                    product_quantity = '$product_quantity'
                WHERE product_id = '$product_id'";
        }
        else {
            // upload file ảnh vào trong dtb
            move_uploaded_file($_FILES['product_img']['tmp_name'],"model/uploads/".$_FILES['product_img']['name']);
            $sql = "UPDATE tbl_product 
                SET product_name = '$product_name',
                    product_type_id = '$product_type_id',
                    product_price = '$product_price',
                    product_price_new = '$product_price_new',
                    product_desc = '$product_desc',
                    product_quantity = '$product_quantity',
                    product_img = '$product_img'
                WHERE product_id = '$product_id'";
        }


        $result = $this->db->exec($sql);

        // Ảnh mô tả
        if($result) {
            // Xóa các ảnh mô tả đã chọn để xóa
            $sql = "SELECT * FROM tbl_product_img_desc WHERE product_id = '$product_id'";
            $result = $this->db->exec($sql);
            $arr = array();
            foreach($result as $item) {
                if(isset($_POST[$item['product_img_desc']])) {
                    $arr[] = $item['product_img_desc'];
                }
            }
            foreach($arr as $item) {
                $sql = "DELETE FROM tbl_product_img_desc WHERE product_id = '$product_id' AND product_img_desc = '$item'";
                $result = $this->db->exec($sql);
            }
            
            

            // Thêm ảnh mô tả mới
            if ($_FILES['product_img_desc']['size'][0] > 0) {
                $filename = $_FILES['product_img_desc']['name'];
                $filetmp = $_FILES['product_img_desc']['tmp_name'];
    
                foreach($filename as $key => $value) {
                    $sql = "INSERT INTO tbl_product_img_desc (product_id, product_img_desc) VALUES ('$product_id', '$value')";
                    $result = $this->db->exec($sql);
    
                    move_uploaded_file($filetmp[$key],"model/uploads/".$value);
                }
            }



            // Xóa danh sách màu cũ
            $sql = "DELETE FROM tbl_product_color WHERE product_id = '$product_id'";
            $result = $this->db->exec($sql);

            // Thêm lại danh sách màu
            if(isset($_POST['yellow'])) {
                $arr[] = 'yellow';
            }
            if(isset($_POST['green'])) {
                $arr[] = 'green';
            }
            if(isset($_POST['pink'])) {
                $arr[] = 'pink';
            }
            if(isset($_POST['red'])) {
                $arr[] = 'red';
            }
            if(isset($_POST['gray'])) {
                $arr[] = 'gray';
            }
            if(isset($_POST['white'])) {
                $arr[] = 'white';
            }
            if(isset($_POST['brown'])) {
                $arr[] = 'brown';
            }
            if(isset($_POST['black'])) {
                $arr[] = 'black';
            }

            foreach($arr as $key => $value) {
                $sql = "INSERT INTO tbl_product_color (product_id, product_color) VALUES ('$product_id', '$value')";
                $result = $this->db->exec($sql);
            }
        }

        return $result;
    }

    public function deleteProduct($product_id) {
        $sql = "DELETE FROM tbl_product WHERE product_id = '$product_id'";
        $result = $this->db->exec($sql);

        $sql = "DELETE FROM tbl_product_color WHERE product_id = '$product_id'";
        $result = $this->db->exec($sql);

        $sql = "DELETE FROM tbl_product_img_desc WHERE product_id = '$product_id'";
        $result = $this->db->exec($sql);

        return $result;
    }

    // website cover
    public function addWebsiteCover() {
        $website_cover = $_FILES['website_cover']['name'];

        // upload file ảnh vào trong dtb
        move_uploaded_file($_FILES['website_cover']['tmp_name'],"model/uploads/".$_FILES['website_cover']['name']);

        $sql = "INSERT INTO tbl_website_cover (`website_cover_name`) VALUES ('$website_cover')";

        $result = $this->db->exec($sql);

        return $result;
    }

    public function getWebsiteCovers() {
        $sql = "SELECT * FROM tbl_website_cover";

        $result = $this->db->getRows($sql);

        return $result;
    }

    // cho order
    public function getOrders() {
        $sql = "SELECT * FROM tbl_order";

        $result = $this->db->getRows($sql);

        return $result;
    }

    public function processing($order_id) {
        $sql = "UPDATE tbl_order
                SET order_check = '1'
                WHERE order_id='$order_id'";

        $result = $this->db->exec($sql);

        return $result;
    }

    public function ship($order_id) {
        $sql = "UPDATE tbl_order
                SET order_check = '2'
                WHERE order_id='$order_id'";

        $result = $this->db->exec($sql);

        return $result;
    }

    public function success($order_id) {
        $sql = "UPDATE tbl_order
                SET order_check = '3'
                WHERE order_id='$order_id'";

        $result = $this->db->exec($sql);

        return $result;
    }

    public function cancel($order_id) {
        $sql = "UPDATE tbl_order
                SET order_check = '4'
                WHERE order_id='$order_id'";

        $result = $this->db->exec($sql);

        return $result;
    }

    public function delete_order($order_id) {
        $sql = "DELETE FROM tbl_order WHERE order_id = '$order_id'";

        $result = $this->db->exec($sql);

        return $result;
    }

    public function delete_orders() {
        $sql = "DELETE FROM tbl_order WHERE order_check = '4' or order_check = '3'";

        $result = $this->db->exec($sql);

        return $result;
    }

    public function reduceQuantity($product_id, $product_quantity) {
        $sql = "UPDATE tbl_product
                SET product_quantity = product_quantity - $product_quantity
                WHERE product_id='$product_id'";

        $result = $this->db->exec($sql);

        return $result;
    }
}

?>