<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teelab</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="./templates/access/css/style.css">
    <link rel="stylesheet" href="./templates/access/css/base.css">
</head>
<body>
    <!-- BEGIN HEADER -->
    <section id="header">
        <div class="grid">
            <div class="header__container">
                <div class="header__left">
                    <?php
                    foreach ($categories as $category_item) {
                    ?>
                        <div class="header__left--category">
                            <p><?php echo $category_item['category_name'] ?></p>
                            <ul>
                                <?php
                                $arr = array();
                                foreach ($product_types as $product_type_item) {
                                    if ($category_item['category_id'] == $product_type_item['category_id']) $arr[] = $product_type_item;
                                }
                                $count = 0;
                                for($j = 0; $j < count($arr);) {
                                    $i = 0;
                                ?>
                                    <li>
                                <?php
                                    while($i < 4 && $j < count($arr)) {
                                ?>
                                        <a href="./index.php?controller=website&page=product_type&product_type_id=<?php echo $arr[$j]['product_type_id'] ?>&p=1"><?php echo $arr[$j]['product_type_name'] ?></a>
                                <?php
                                        $j++;
                                        $i++;
                                    }
                                ?>
                                    </li>
                                <?php
                                }
                                ?>
                            </ul>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <div class="header__center">
                    <a href="./index.php" class="header__center--logo">
                        <div class="header__center--logo">
                            <img src="./templates/access/img/logo.webp" alt="">
                        </div>
                    </a>
                </div>
                <div class="header__right">
                    <div class="header__right--search">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <form action="" method="POST">
                            <input type="text" name="search" id="" placeholder="Tìm kiếm sản phẩm">
                        </form>
                    </div>
                    <div class="header__right--icon">
                        <a href="https://www.messenger.com/t/VU170" class="fa-solid fa-envelope"></a>
                    </div>
                    <div class="header__right--icon header__right--user">
                        <a src="#" class="fa-solid fa-user"></a>
                        <div class="header__right--func">
                            <?php
                            if(isset($_SESSION['user_id'])) {
                                if($_SESSION['role'] == 1) {
                            ?>
                                    <a href="./index.php?controller=admin&page=order">Quản lý</a>
                            <?php
                                }
                            ?>
                                <a href="./index.php?controller=common&page=account">Tài khoản</a>
                                <a href="./index.php?controller=common&page=logout">Đăng xuất</a>
                            <?php
                            }
                            else {
                            ?>
                                <a href="./index.php?controller=common&page=signin">Đăng nhập</a>
                                <a href="./index.php?controller=common&page=signup">Đăng ký</a>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="header__right--icon header__right--user">
                        <a href="#" class="fa-solid fa-cart-shopping"></a>
                        <div class="header__right--func">
                            <a href="./index.php?controller=website&page=cart">Giỏ hàng</a>
                            <?php
                            if(isset($_SESSION['user_id'])) {
                            ?>    
                                <a href="./index.php?controller=website&page=order">Đơn mua</a>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </section>
    <div class="header__footer"></div>

