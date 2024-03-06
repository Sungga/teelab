<?php
$controller = '';

if(isset($_GET['controller'])) {
    $controller = $_GET['controller'];
}

$page = '';

if(isset($_GET['page'])) {
    $page = $_GET['page'];
}

switch($controller) {
    case 'admin': {
        include "./controller/admin/index.php";
        $CtrlAdmin = new controllerAdmin();
        
        switch($page) {
            // category
            case 'add_category': {
                $CtrlAdmin->addCategory();
                break;
            }

            case 'list_category': {
                $CtrlAdmin->listCategory();
                break;
            }

            case 'delete_category': {
                $CtrlAdmin->deleteCategory();
                break;
            }

            case 'edit_category': {
                $CtrlAdmin->editCategory();
                break;
            }

            // product type

            case 'add_product_type': {
                $CtrlAdmin->addProductType();
                break;
            }

            case 'list_product_type': {
                $CtrlAdmin->listProductType();
                break;
            }

            case 'edit_product_type': {
                $CtrlAdmin->editProductType();
                break;
            }

            case 'delete_product_type': {
                $CtrlAdmin->deleteProductType();
                break;
            }

            // product

            case 'add_product': {
                $CtrlAdmin->addProduct();
                break;
            }

            case 'list_product': {
                $CtrlAdmin->listProduct();
                break;
            }

            case 'edit_product': {
                $CtrlAdmin->editProduct();
                break;
            }

            case 'delete_product': {
                $CtrlAdmin->deleteProduct();
                break;
            }

            // order
            case 'order': {
                $CtrlAdmin->order();
                break;
            }

            case 'processing': {
                $CtrlAdmin->processing();
                break;
            }

            case 'ship': {
                $CtrlAdmin->ship();
                break;
            }

            case 'success': {
                $CtrlAdmin->success();
                break;
            }

            case 'cancel': {
                $CtrlAdmin->cancel();
                break;
            }
            
            case 'delete_order': {
                $CtrlAdmin->delete_order();
                break;
            }

            case 'tick': {
                $CtrlAdmin->tick();
                break;
            }

            default: {
                header('Location: ./index.php');
            }
        }

        break;
    }

    case 'common': {
        include "./controller/common/index.php";

        $CtrlCommon = new controllerCommon();

        switch($page) {
            case 'signup': {
                $CtrlCommon->signup();
                break;
            }
        
            case 'signin': {
                $CtrlCommon->signin();
                break;
            }
        
            case 'account': {
                $CtrlCommon->account();
                break;
            }
        
            case 'password': {
                $CtrlCommon->password();
                break;
            }
        
            case 'logout': {
                $CtrlCommon->logout();
                break;
            }
        
            default: {
                header('Location: ./index.php');
            }
        }

        break;
    }
    
    default: {
        include "./controller/website/index.php";

        $CtrlWebsite = new controllerWebsite();

        switch($page) {
            case 'product_type': {
                $CtrlWebsite->productType();
                break;
            }

            case 'product_type_search': {
                $CtrlWebsite->productTypeSearch();
                break;
            }
        
            case 'product': {
                $CtrlWebsite->product();
                break;
            }
        
            case 'cart': {
                $CtrlWebsite->cart();
                break;
            }
        
            case 'delete_cart': {
                $CtrlWebsite->deleteCart();
                break;
            }
        
            case 'location': {
                $CtrlWebsite->location();
                break;
            }
        
            case 'pay_money': {
                $CtrlWebsite->payMoney();
                break;
            }
        
            case 'success': {
                $CtrlWebsite->success();
                break;
            }
        
            case 'order': {
                $CtrlWebsite->order();
                break;
            }
        
            case 'delete_order': {
                $CtrlWebsite->deleteOrder();
                break;
            }
        
            default: {
                $CtrlWebsite->home();
            }
        }

        
    }
}

?>