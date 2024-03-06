<?php
session_start();

if (!(isset($_SESSION['role']) && $_SESSION['role'] == 1)) {
    header('Location: ./index.php');
    exit(); // Đảm bảo kết thúc quá trình thực thi sau khi chuyển hướng
}

require_once "./model/class/class_admin.php";
require_once "./view/admin/index.php";

class controllerAdmin {
    var $model, $view;

    public function __construct() {
        $this->model = new admin();
        $this->view = new viewAdmin();
    }

    // category
    public function addCategory() {
        $this->view->addCategory();

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['category_name'])) {
            if($this->model->addCategory($_POST['category_name'])) {
                echo "<script>alert('Thêm thành công!')</script>";
            }
            else {
                echo "<script>alert('Thêm không thành công!')</script>";
            }
        }

        
    }

    public function listCategory() {
        $categories = $this->model->getCategories();
        
        $this->view->listCategory($categories);
        
    }

    public function deleteCategory() {
        if(isset($_GET['category_id'])) {
            if($this->model->deleteCategory($_GET['category_id'])) {
                echo "<script>alert('Xóa thành công!')</script>";
            }
            else {
                echo "<script>alert('Xóa không thành công!')</script>";
            }
        }

        header('Location: ./index.php?controller=admin&page=list_category');
        
    }

    public function editCategory() {
        if(isset($_GET['category_id'])) {
            $category = $this->model->getCategory($_GET['category_id']);

            $this->view->editCategory($category);

            if(isset($_POST['category_name'])) {
                if($this->model->editCategory($_GET['category_id'], $_POST['category_name'])) {
                    echo "<script>alert('Sửa thành công!')</script>";

                    header('Location: ./index.php?controller=admin&page=list_category');
                }
                else {
                    echo "<script>alert('Sửa không thành công!')</script>";

                    header('Location: ./index.php?controller=admin&page=list_category');
                }
            }
        }
        else {
            header('Location: ./index.php?controller=admin&page=list_category');
        }

        
    }

    // product type

    public function addProductType() {
        $categories = $this->model->getCategories();

        $this->view->addProductType($categories);

        if(isset($_POST['product-type_name'])) {
            if($this->model->addProductType($_POST['product-type_name'], $_POST['category_id'])) {
                echo "<script>alert('Thêm thành công!')</script>";
            }
            else {
                echo "<script>alert('Thêm không thành công!')</script>";
            }
        }
        
    }

    public function listProductType() {
        $categories = $this->model->getCategories();
        $product_types = $this->model->getProductTypes();
        
        $this->view->listProductType($categories, $product_types);

        
    }

    public function editProductType() {
        
        if(isset($_GET['product_type_id'])) {
            $categories = $this->model->getCategories();
            $product_type = $this->model->getProductType($_GET['product_type_id']);

            $this->view->editProductType($categories, $product_type);
        }
        else {
            header('location: ./index.php?controller=admin&page=list_product_type');
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if($this->model->editProductType($_GET['product_type_id'], $_POST['product_type_name'], $_POST['category_id'])) {
                echo "<script>alert('Sửa thành công!')</script>";

                header('location: ./index.php?controller=admin&page=list_product_type');
            }
            else {
                echo "<script>alert('Sửa thành công!')</script>";
            }
        }

        
    }

    public function deleteProductType() {
        if(isset($_GET['product_type_id'])) {
            if($this->model->deleteProductType($_GET['product_type_id'])) {
                echo "<script>alert('Xóa thành công!')</script>";
            }
            else {
                echo "<script>alert('Xóa không thành công!')</script>";
            }
        }

        header('Location: ./index.php?controller=admin&page=list_product_type');
        
    }

    // product

    public function addProduct() {
        $categories = $this->model->getCategories();
        $product_types = $this->model->getProductTypes();

        // Chuyển đổi mảng thành chuỗi JSON
        $jsonData = json_encode($product_types);

        $this->view->addProduct($categories, $product_types, $jsonData);

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if($this->model->addProduct($_POST, $_FILES)) {
                echo "<script>alert('Thêm dữ liệu thành công!')</script>";
                echo '<script>window.location.href = "./index.php?controller=admin&page=list_product";</script>';
            }
            else {
                echo '<script>window.location.href = "./index.php?controller=admin&page=list_product";</script>';   
            }
        }

        
    }

    public function listProduct() {
        $categories = $this->model->getCategories();
        $product_types = $this->model->getProductTypes();
        $products = $this->model->getProducts();
        $product_imgs_desc = $this->model->getImgsDesc();
        $product_color = $this->model->getColors();

        $this->view->listProduct($categories, $product_types, $products, $product_imgs_desc, $product_color);

        
    }

    public function editProduct() {
        $categories = $this->model->getCategories();
        $product_types = $this->model->getProductTypes();

        if(!isset($_GET['product_id']) || $_GET['product_id'] == '') {
            header('location: ./index.php?controller=admin&page=list_product');
        }
        $product = $this->model->getProduct($_GET['product_id']);

        $product_img_desc = $this->model->getImgDesc($_GET['product_id']);

        $product_color = $this->model->getColor($_GET['product_id']);

        // Lấy category và product type của product hiện tại
        $product_type_prd = $this->model->getProductType($product['product_type_id']);
        $category_prd = $this->model->getCategory($product_type_prd['category_id']);

        $product_type_ctg = $this->model->getProductTypes_w_categoryId($category_prd['category_id']);

        // Chuyển đổi mảng thành chuỗi JSON
        $jsonData = json_encode($product_types);

        $this->view->editProduct($categories, $product_types, $product, $product_img_desc, $product_color, $product_type_prd, $category_prd, $product_type_ctg, $jsonData);

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if($this->model->editProduct($_POST, $_FILES)) {
                echo "<script>alert('Sửa dữ liệu thành công!')</script>";
                echo '<script>window.location.href = "./index.php?controller=admin&page=list_product";</script>';
            }
            else {
                echo "<script>alert('Sửa dữ liệu không thành công!')</script>";
            }
        }

        
    }

    public function deleteProduct() {
        if(isset($_GET['product_id'])) {
            if($this->model->deleteProduct($_GET['product_id'])) {
                echo "<script>alert('Xóa thành công!')</script>";
            }
            else {
                echo "<script>alert('Xóa không thành công!')</script>";
            }
        }

        header('Location: ./index.php?controller=admin&page=list_product');
        
    }

    // order
    public function order() {
        $orders = $this->model->getOrders();

        $products = array();
        foreach($orders as $order_item) {
            $product = $this->model->getProduct($order_item['product_id']);
            $products[] = $product;
        }

        $this->view->order($orders, $products);
    }

    public function processing() {
        if(isset($_GET['order_id'])) {
            $this->model->processing($_GET['order_id']);
        }

        header('location: ./index.php?controller=admin&page=order');

        
    }

    public function ship() {
        if(isset($_GET['order_id'])) {
            $this->model->ship($_GET['order_id']);
        }

        header('location: ./index.php?controller=admin&page=order');

        
    }

    public function success() {
        if(isset($_GET['order_id'], $_GET['product_quantity'], $_GET['product_id'])) {
            $this->model->success($_GET['order_id']);
            $this->model->reduceQuantity($_GET['product_id'], $_GET['product_quantity']);
        }
        else {
            echo "<script>alert('Có lỗi xảy ra!');</script>";
        }

        header('location: ./index.php?controller=admin&page=order');

    }

    public function cancel() {
        if(isset($_GET['order_id'])) {
            $this->model->cancel($_GET['order_id']);
        }

        header('location: ./index.php?controller=admin&page=order');

        
    }
    
    public function delete_order() {
        if(isset($_GET['order_id'])) {
            $this->model->delete_order($_GET['order_id']);
        }

        header('location: ./index.php?controller=admin&page=order');

        
    }

    public function tick() {
        $this->model->delete_orders();

        header('location: ./index.php?controller=admin&page=order');

        
    }
}

?>