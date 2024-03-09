<?php
session_start();
include "./model/class/class_website.php";
include "./view/website/index.php";

class controllerWebsite {
    var $model, $view;

    public function __construct() {
        $this->model = new website();
        $this->view = new viewWebsite();
        $this->searchProduct();
    }

    public function productType() {
        if((isset($_GET['product_type_id']) && $_GET['product_type_id'] != '') && (isset($_GET['p']) && $_GET['p'] != '') && (isset($_GET['f']) && $_GET['f'] != '')) {
            $categories = $this->model->getCategories();
            $product_types = $this->model->getProductTypes();

            $product_type = $this->model->getProductType($_GET['product_type_id']);
            $category = $this->model->getCategory($product_type['category_id']);
            $colors = $this->model->getColors();

            // loc san pham in ra
            if($_GET['f'] == 't') {
                $filterSize = isset($_SESSION['filterSize']) && $_SESSION['filterSize'] != '' ? $_SESSION['filterSize'] : array();
                $filterColor = isset($_SESSION['filterColor']) && $_SESSION['filterColor'] != '' ? $_SESSION['filterColor'] : array();
                $filterRange = isset($_SESSION['filterRange']) && $_SESSION['filterRange'] != '' ? $_SESSION['filterRange'] : '';
                $arr = $this->model->getProducts_w_productTypeId_filter($_GET['product_type_id'], $filterSize, $filterColor, $filterRange);
            }
            else {
                $arr = $this->model->getProducts_w_productTypeId($_GET['product_type_id']);
            }
            
            if(isset($_GET['arrange'])) {
                $products = $this->changeSortMethod($_GET['arrange'], $arr);
            }
            else {
                $products = $this->model->getProducts_w_productTypeId($_GET['product_type_id']);
            }

            $this->view->productType($categories, $product_types, $product_type, $category, $products, $colors);
            $this->searchProduct();

            if ($_SERVER["REQUEST_METHOD"] == 'POST') {
                // them san pham vao gio hang
                if(isset($_POST["size"])) {
                    if(isset($_SESSION['user_id'])) {
                        $cart_user_id = $_SESSION['user_id'];
                        $cart_product_id = $_POST['product_id'];
                        $cart_size = $_POST["size"];
                        $cart_color = $_POST["color_product_" . $cart_product_id];
                        $cart_number = 1;

                        if($this->model->addCart($cart_user_id, $cart_product_id, $cart_size, $cart_color, $cart_number)) {
                            echo "<script>alert('Thêm vào giỏ thành công');</script>";
                        }
                        else {
                            echo "<script>alert('Thêm vào giỏ không thành công');</script>";
                        }
                    }
                    else {
                        echo "<script>alert('Bạn cần đăng nhập trước khi thêm giỏ hàng!');</script>";
                    }
                }

                // loc san pham hien thi
                if(isset($_POST['filter'])) {
                    $_SESSION['filterSize'] = isset($_POST['filterSize']) ? $_POST['filterSize'] : '';
                    $_SESSION['filterColor'] = isset($_POST['filterColor']) ? $_POST['filterColor'] : '';
                    $_SESSION['filterRange'] = isset($_POST['filterRange']) ? $_POST['filterRange'] : '';

                    $product_type_id = isset($_GET['product_type_id']) ? $_GET['product_type_id'] : 0;
                    $product_type_name = isset($_GET['product_type_name']) ? $_GET['product_type_name'] : 0;
                    $arrange = isset($_GET['arrange']) ? $_GET['arrange'] : '';
                    $p = isset($_GET['p']) ? $_GET['p'] : 1;
                    $f = 't';
                    
                    echo "<script>window.location.href = './index.php?controller=website&page=product_type&product_type_id=$product_type_id&p=$p&f=$f&arrange=$arrange';</script>";
                }

                // doi cach sap xep san pham
                $this->selectSortMethod();
            }
        }
        else {
            header('location: .');
        }
    }

    public function productTypeSearch() {
        if((isset($_GET['product_type_name']) && $_GET['product_type_name'] != '') && (isset($_GET['p']) && $_GET['p'] != '') && (isset($_GET['f']) && $_GET['f'] != '')) {
            $categories = $this->model->getCategories();
            $product_types = $this->model->getProductTypes();

            $product_type['product_type_name'] = $_GET['product_type_name'];
            $category['category_name'] = '(Search)';
            // $products = $this->model->searchProduct($_GET['product_type_name']);
            $colors = $this->model->getColors();

            if(isset($_GET['arrange'])) {
                $arr = $this->model->searchProduct($_GET['product_type_name']);
                $products = $this->changeSortMethod($_GET['arrange'], $arr);
            }
            else {
                $products = $this->model->searchProduct($_GET['product_type_name']);
            }

            $this->view->productType($categories, $product_types, $product_type, $category, $products, $colors);
            $this->searchProduct();

            if ($_SERVER["REQUEST_METHOD"] == 'POST') {
                if(isset($_POST["size"])) {
                    if(isset($_SESSION['user_id'])) {
                        $cart_user_id = $_SESSION['user_id'];
                        $cart_product_id = $_POST['product_id'];
                        $cart_size = $_POST["size"];
                        $cart_color = $_POST["color_product_" . $cart_product_id];
                        $cart_number = 1;

                        if($this->model->addCart($cart_user_id, $cart_product_id, $cart_size, $cart_color, $cart_number)) {
                            echo "<script>alert('Thêm vào giỏ thành công');</script>";
                        }
                        else {
                            echo "<script>alert('Thêm vào giỏ không thành công');</script>";
                        }
                    }
                    else {
                        echo "<script>alert('Bạn cần đăng nhập trước khi thêm giỏ hàng!');</script>";
                    }
                }

                if(isset($_POST['filter'])) {
                    $_SESSION['filterSize'] = isset($_POST['filterSize']) ? $_POST['filterSize'] : '';
                    $_SESSION['filterColor'] = isset($_POST['filterColor']) ? $_POST['filterColor'] : '';
                    $_SESSION['filterRange'] = isset($_POST['filterRange']) ? $_POST['filterRange'] : '';

                    $product_type_id = isset($_GET['product_type_id']) ? $_GET['product_type_id'] : 0;
                    $product_type_name = isset($_GET['product_type_name']) ? $_GET['product_type_name'] : 0;
                    $arrange = isset($_GET['arrange']) ? $_GET['arrange'] : '';
                    $p = isset($_GET['p']) ? $_GET['p'] : 1;
                    $f = 't';

                    echo "<script>window.location.href = './index.php?controller=website&page=product_type_search&product_type_name=$product_type_name&p=$p&f=$f&arrange=$arrange';</script>";
                }

                $this->selectSortMethod();
            }
        }
        else {
            header('location: .');
        }
    }

    // ham de nguoi dung chon cach sap xep san pham
    public function selectSortMethod() {
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['arrange'])) {
            $arrange = '';
            switch ($_POST['arrange']) {
                case 'Mới nhất':
                    $arrange = 'Latest';
                    break;
                case 'Cũ nhất':
                    $arrange = 'Oldest';
                    break;
                case 'Giá thấp đến cao':
                    $arrange = 'LowToHigh';
                    break;
                case 'Giá cao đến thấp':
                    $arrange = 'HighToLow';
                    break;
                default:
                    $arrange = '';
            }

            $product_type_id = isset($_GET['product_type_id']) ? $_GET['product_type_id'] : 0;
            $product_type_name = isset($_GET['product_type_name']) ? $_GET['product_type_name'] : 0;
            $p = isset($_GET['p']) ? $_GET['p'] : 1;
            $f = isset($_GET['f']) ? $_GET['f'] : 'f';
            
            if(isset($_GET['product_type_id'])) {
                echo "<script>window.location.href = './index.php?controller=website&page=product_type&product_type_id=$product_type_id&p=$p&f=$f&arrange=$arrange';</script>";
            }
            elseif(isset($_GET['product_type_name'])) {
                echo "<script>window.location.href = './index.php?controller=website&page=product_type_search&product_type_name=$product_type_name&p=$p&f=$f&arrange=$arrange';</script>";
            }
            // echo "<script>alert('".$_POST['arrange']."');</script>";
        }
    }
    
    // ham chon sap xep cac san pham theo kieu ma ng dung chon
    public function changeSortMethod($method, $products) {
        switch ($method) {
            case 'Latest':
                break;
            case 'Oldest':
                return array_reverse($products);
            case 'LowToHigh':
                function compareByNewPriceLowToHigh($a, $b) {
                    return $a['product_price_new'] - $b['product_price_new'];
                }
                
                // Sắp xếp mảng sử dụng hàm so sánh giá mới (từ thấp đến cao)
                usort($products, 'compareByNewPriceLowToHigh');

                break;
            case 'HighToLow':
                // Hàm so sánh dựa trên giá mới
                function compareByNewPrice($a, $b) {
                    return $b['product_price_new'] - $a['product_price_new'];
                }

                // Sắp xếp mảng sử dụng hàm so sánh giá mới
                usort($products, 'compareByNewPrice');

                break;
            default:
                break;
        }

        // $products = $this->filterProduct($products);
        return $products;
    }

    public function product() {
        if(isset($_GET['product_id']) && $_GET['product_id'] != '') {
            $categories = $this->model->getCategories();
            $product_types = $this->model->getProductTypes();

            $product = $this->model->getProduct($_GET['product_id']);
            $product_type = $this->model->getProductType($product['product_type_id']);
            $category = $this->model->getCategory($product_type['category_id']);

            $product_img_desc = $this->model->getImgDesc($_GET['product_id']);
            $product_color = $this->model->getColor($_GET['product_id']);

            $this->view->product($categories, $product_types, $product, $product_type, $category, $product_img_desc, $product_color);
            $this->searchProduct();

            if ($_SERVER["REQUEST_METHOD"] == 'POST') {
                if(isset($_POST["cart"])) {
                    if(isset($_SESSION['user_id'])) {
                        $cart_user_id = $_SESSION['user_id'];
                        $cart_product_id = $_GET['product_id'];
                        $cart_size = $_POST["size"];
                        $cart_color = $_POST["color"];
                        $cart_number = $_POST['numberInput'];

                        if($this->model->addCart($cart_user_id, $cart_product_id, $cart_size, $cart_color, $cart_number)) {
                            echo "<script>alert('Thêm vào giỏ thành công');</script>";
                        }
                        else {
                            echo "<script>alert('Thêm vào giỏ không thành công');</script>";
                        }
                    }
                    else {
                        echo "<script>alert('Bạn cần đăng nhập trước khi thêm giỏ hàng!');</script>";
                    }
                }
                elseif(isset($_POST["buy"])) {
                    $cart_product_id = $_GET['product_id'];
                    $cart_size = $_POST["size"];
                    $cart_color = $_POST["color"];
                    $cart_number = $_POST['numberInput'];

                    if(isset($_SESSION['user_id'])) {
                        echo "<script>window.location.href = './index.php?controller=website&page=cart&product_id=$cart_product_id&size=$cart_size&color=$cart_color&numberInput=$cart_number'</script>";
                    }
                    else {
                        echo "<script>window.location.href = './index.php?controller=website&page=cart&product_id=$cart_product_id&size=$cart_size&color=$cart_color&numberInput=$cart_number'</script>";
                    }
                }
                else {
                    echo "<script>alert('hehe');</script>";
                }
            }
        }
        else {
            header('location: .');
        }

    }

    public function cart() {
        $categories = $this->model->getCategories();
        $product_types = $this->model->getProductTypes();

        // truong hop co tai khoan
        if(isset($_SESSION['user_id'])) {
            $list_cart = $this->model->getCarts($_SESSION['user_id']);

            // hien thi them don hang nguoi dung vua an mua neu co
            if(isset($_GET['product_id']) && isset($_GET['size']) && isset($_GET['color']) && isset($_GET['numberInput'])) {
                $list_cart_order = array(
                    'cart_id' => "k".$_SESSION['user_id'],
                    'cart_product_id' => $_GET['product_id'],
                    'cart_size' => $_GET['size'],
                    'cart_color' => $_GET['color'],
                    'cart_quantity' => $_GET['numberInput']
                );
                $list_cart[] = $list_cart_order;
            }

            $arr_product_cart = array();
            foreach($list_cart as $list_cart_item) {
                $arr_product_cart[] = $this->model->getProduct($list_cart_item['cart_product_id']);
            }

            // dao nguoc mang gio hang
            $arr_product_cart = array_reverse($arr_product_cart);

            $colors = $this->model->getColors();

            $sizes = array('S', 'M', 'L', 'XL', 'XXL');
        }
        // truong hop khong co tai khoan
        elseif(isset($_GET['product_id'], $_GET['size'], $_GET['color'], $_GET['numberInput'])) {
            $list_cart = array();
            $list_cart[0]['cart_id'] = 'KA';
            $list_cart[0]['cart_product_id'] = $_GET['product_id'];
            $list_cart[0]['cart_size'] = $_GET['size'];
            $list_cart[0]['cart_color'] = $_GET['color'];
            $list_cart[0]['cart_quantity'] = $_GET['numberInput'];

            $arr_product_cart = array();
            foreach($list_cart as $list_cart_item) {
                $arr_product_cart[] = $this->model->getProduct($list_cart_item['cart_product_id']);
            }

            $arr_product_cart = array();
            foreach($list_cart as $list_cart_item) {
                $arr_product_cart[] = $this->model->getProduct($list_cart_item['cart_product_id']);
            }
            
            $colors = $this->model->getColors();

            $sizes = array('S', 'M', 'L', 'XL', 'XXL');
        }
        else {
            echo '<script>window.location.href = "./index.php"</script>';
        }

        $this->view->cart($categories, $product_types, $list_cart, $arr_product_cart, $colors, $sizes);
        $this->searchProduct();

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            if(isset($_POST['next'])) {
                // truong hop nguoi mua co tai khoan
                if(isset($_SESSION['user_id'])) {
                    $listBuy = array();
                    foreach($list_cart as $list_cart_item) {
                        if(isset($_POST['check'.$list_cart_item['cart_id']])) {
                            // Loại bỏ các ký tự không phải số và chuyển đổi thành số nguyên
                            $total = (int) preg_replace('/[^0-9]/', '', $_POST['total'.$list_cart_item['cart_id']]);

                            $arr = array();
                            $arr['cart_id'] = $list_cart_item['cart_id'];
                            $arr['product_id'] = $_POST['product_id'.$list_cart_item['cart_id']];
                            $arr['color'] = $_POST['color'.$list_cart_item['cart_id']];
                            $arr['size'] = $_POST['size'.$list_cart_item['cart_id']];
                            $arr['quantity'] = $_POST['quantity'.$list_cart_item['cart_id']];
                            $arr['total'] = $total;

                            $listBuy[] = $arr;
                        }
                    }
                    $_SESSION['listBuy'] = $listBuy;

                    echo '<script>window.location.href = "./index.php?controller=website&page=location";</script>';
                }
                // truong hop khong co tai khoan
                else {
                    $listBuy = array();
                    if(isset($_POST['checkKA'])) {
                        // Loại bỏ các ký tự không phải số và chuyển đổi thành số nguyên
                        $total = (int) preg_replace('/[^0-9]/', '', $_POST['total']);

                        $arr = array();
                        $arr['cart_id'] = 'KA';
                        $arr['product_id'] = $_POST['product_idKA'];
                        $arr['color'] = $_POST['colorKA'];
                        $arr['size'] = $_POST['sizeKA'];
                        $arr['quantity'] = $_POST['quantityKA'];
                        $arr['total'] = $total;

                        $listBuy[] = $arr;
                    }
                    $_SESSION['listBuy'] = $listBuy;

                    echo '<script>window.location.href = "./index.php?controller=website&page=location";</script>';
                }
            }
        }

    }

    public function deleteCart() {
        if(isset($_GET['cart_id'])) {
            if(!($this->model->deleteCart($_GET['cart_id']))) {
                echo '<script>alert("Xóa đơn hàng thất bại!");</script>';
            }
        }

        echo '<script>window.location.href = "./index.php?controller=website&page=cart"</script>';

    }

    public function location() {
        $categories = $this->model->getCategories();
        $product_types = $this->model->getProductTypes();

        $user_name = '';
        $user_phone = '';
        $user_address = '';
        if(isset($_SESSION['user_id'])) {
            $user = $this->model->getUserInfo($_SESSION['user_id']);
            $user_name = $user['user_name'];
            $user_phone = $user['user_phone'];
            $user_address = $user['user_address'];
        }

        $this->view->location($categories, $product_types, $user_name, $user_phone, $user_address);
        $this->searchProduct();

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_SESSION['buy_user_info']['buy_name_user'] = $_POST['name'];
            $_SESSION['buy_user_info']['buy_phone_user'] = $_POST['phone'];
            $_SESSION['buy_user_info']['buy_address'] = $_POST['city']."-".$_POST['district']."-".$_POST['ward']."-".$_POST['address'];

            echo '<script>window.location.href = "./index.php?controller=website&page=pay_money";</script>';
        }

    }

    public function payMoney() {
        if(isset($_SESSION['listBuy']) && isset($_SESSION['buy_user_info'])) {
            $categories = $this->model->getCategories();
            $product_types = $this->model->getProductTypes();
    
            $this->view->payMoney($categories, $product_types);
            $this->searchProduct();

            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                if($_POST['pay_money'] == 'cod') {
                    $_SESSION['payment_method'] = 'cod';
                    echo '<script>window.location.href = "./index.php?controller=website&page=success";</script>';
                }
                elseif($_POST['pay_money'] == 'momo') {
                    // $_SESSION['payment_method'] = 'momo';
                    echo '<script>alert("Chức năng chưa được phát triển!");</script>';
                }
            }
        }
        else {
            header('Location: ./index.php');
        }

    }

    public function success() {
        if(isset($_SESSION['listBuy']) && isset($_SESSION['buy_user_info']) && isset($_SESSION['payment_method'])) {
            $status = 'Đặt hàng không thành công';
            foreach($_SESSION['listBuy'] as $listBuy_index => $listBuy) {
                if($_SESSION['payment_method'] != 'cod') {
                    $_SESSION['listBuy'][$listBuy_index]['total'] = 0;
                }
                if($this->model->addOrder($listBuy_index)) {
                    $this->model->deleteCart($_SESSION['listBuy'][$listBuy_index]['cart_id']);
                    $status = 'Đặt hàng thành công';
                }
                else {
                    $status = 'Đặt hàng không thành công';
                }
            }

            unset($_SESSION['listBuy']);
            unset($_SESSION['buy_user_info']);
            unset($_SESSION['payment_method']);

            $categories = $this->model->getCategories();
            $product_types = $this->model->getProductTypes();

            $this->view->success($categories, $product_types, $status);
            $this->searchProduct();
        }
        else {
            header('location: ./index.php');
        }

    }

    public function order() {
        if(isset($_SESSION['user_id'])) {
            $categories = $this->model->getCategories();
            $product_types = $this->model->getProductTypes();
    
            $orders = $this->model->getOrder($_SESSION['user_id']);

            $products = array();
            foreach($orders as $order_item) {
                $product = $this->model->getProduct($order_item['product_id']);
                $products[] = $product;
            }
    
            $this->view->order($categories, $product_types, $orders, $products);
            $this->searchProduct();
        }
        else {
            header('location: ./index.php');
        }

    }

    public function deleteOrder() {
        if(isset($_SESSION['user_id']) && isset($_GET['order_id'])) {
            $orders = $this->model->getOrder($_SESSION['user_id']);

            $kt = false;
            foreach($orders as $order_item) {
                if($order_item['order_id'] == $_GET['order_id']) {
                    $kt = true;
                }
            }

            if($kt) {
                $this->model->deleteOrder($_GET['order_id']);
                echo '<script>window.location.href = "./index.php?controller=website&page=order";</script>';
            }
            else {
                echo '<script>window.location.href = "./index.php";</script>';
            }
        }
        else {
            header('location: ./index.php');
        }

    }

    public function home() {
        $categories = $this->model->getCategories();
        $product_types = $this->model->getProductTypes();
        $website_covers = $this->model->getWebsiteCovers();

        $this->view->home($categories, $product_types, $website_covers);
        $this->searchProduct();
    }

    public function searchProduct() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            if(isset($_POST['search'])) {
                // $this->model->searchProduct($_POST['search']);
                $product_type_name = $_POST['search'];
                echo "<script>window.location.href = './index.php?controller=website&page=product_type_search&product_type_name=$product_type_name&p=1&f=f';</script>";
            }
        }
    }
}

?>