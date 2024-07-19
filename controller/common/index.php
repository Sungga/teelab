<?php
session_start();

?>
<?php
require_once "./model/class/class_common.php";
require_once "./view/common/index.php";

?>

<?php
    class controllerCommon {
        var $model, $view;

        public function __construct() {
            $this->model = new common();
            $this->view = new viewCommon();
            $this->searchProduct();
        }

        public function signup() {
            $categories = $this->model->getCategories();
            $product_types = $this->model->getProductTypes();
            
            $this->view->signup($categories, $product_types);
            $this->searchProduct();

            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                if($_POST['password1'] == $_POST['password2'] && $this->model->checkUserExists($_POST['account'])) {
                    $this->model->addUser($_POST['account'], $_POST['password1'], $_POST['name'], $_POST['phone'], $_POST['email'], $_POST['address']);

                    echo '<script>alert("Đăng ký thành công");</script>';
                    echo '<script>window.location.href = "./index.php?controller=common&page=signin";</script>';
                }
                else {
                    echo "<script>alert('Mật khẩu nhập không giống nhau hoặc tài khoản đã tồn tại!');</script>";
                }
            }
        }

        public function signin() {
            $categories = $this->model->getCategories();
            $product_types = $this->model->getProductTypes();
            
            $this->view->signin($categories, $product_types);
            $this->searchProduct();

            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                if($this->model->checkAccount($_POST['account'], $_POST['password'])) {
                    $user_now = $this->model->getUserId($_POST['account']);
                    $_SESSION['user_id'] = $user_now['user_id'];
                    $_SESSION['role'] = $user_now['role'];

                    echo "<script>alert('Đăng nhập thành công!')</script>";
                    echo '<script>window.location.href = "./index.php";</script>'; 
                }
                else {
                    echo "<script>alert('Thông tin mật khẩu hoặc tài khoản không chính xác!')</script>";
                }
            }
            

        }

        public function account() {
            $categories = $this->model->getCategories();
            $product_types = $this->model->getProductTypes();

            $user_account = $this->model->getUserAcc($_SESSION['user_id']);
            $user_info = $this->model->getUserInfo($_SESSION['user_id']);

            $this->view->account($categories, $product_types, $user_account, $user_info);
            $this->searchProduct();

            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                if($this->model->editInfo($_SESSION['user_id'], $_POST['name'], $_POST['phone'], $_POST['email'], $_POST['address'])) {
                    echo "<script>alert('Sửa thông tin thành công');</script>";
                    echo '<script>window.location.href = "./index.php?controller=common&page=account";</script>';
                }
                else {
                    echo "<script>alert('Sửa thông tin không thành công');</script>";
                }
            }
            

        }

        public function password() {
            $categories = $this->model->getCategories();
            $product_types = $this->model->getProductTypes();

            $user_info = $this->model->getUserInfo($_SESSION['user_id']);

            $this->view->password($categories, $product_types, $user_info);
            $this->searchProduct();

            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                if($this->model->checkPassword($_SESSION['user_id'], $_POST['passwordOld'])) {
                    if($_POST['passwordNew1'] == $_POST['passwordNew2']) {
                        if($this->model->editPassword($_SESSION['user_id'], $_POST['passwordNew1'])) {
                            echo "<script>alert('Sửa mật khẩu thành công');</script>";
                            echo '<script>window.location.href = "./index.php?controller=common&page=account";</script>';
                        }
                        else {
                            echo "<script>alert('Sửa mật khẩu không thành công!');</script>";
                        }
                    }
                    else {
                        echo "<script>alert('Mật khẩu nhập không giống nhau!');</script>";
                    }
                }
                else {
                    echo "<script>alert('Sai mật khẩu!');</script>";
                }
            }
            

        }

        public function logout() {
            unset($_SESSION['user_id']);
            unset($_SESSION['role']);
            
            echo '<script>window.location.href = "./index.php";</script>';
        }

        public function searchProduct() {
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                if(isset($_POST['search'])) {
                    // $this->model->searchProduct($_POST['search']);
                    $product_type_name = $_POST['search'];
                    echo "<script>window.location.href = './index.php?controller=website&page=product_type_search&product_type_name=$product_type_name&p=1';</script>";
                }
            }
        }
    }
?>