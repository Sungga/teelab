    <!-- BEGIN SLIDER -->
    <div id="product">
        <div class="grid">
            <div class="path">
                <a href="./index.php">Trang chủ</a>
                <span>&#8594;</span>
                <a href="#"><?php echo $category['category_name'] ?></a>
                <span>&#8594;</span>
                <a href="./index.php?controller=website&page=product_type&product_type_id=<?php echo $product_type['product_type_id'] ?>"><?php echo $product_type['product_type_name'] ?></a>
                <span>&#8594;</span>
                <a href="#"><?php echo $product['product_name'] ?></a>
            </div>

            <div class="product__container">
                <div class="product__left">
                    <div class="product__img--big">
                        <img src="./model/uploads/<?php echo $product['product_img']?>" alt="">
                    </div>
                    <div class="product__img--small">
                        <span class="product__btn--up">&#8743;</span>
                        <div class="product__img--small-img">
                            <img src="./model/uploads/<?php echo $product['product_img']?>" alt="">
                            <?php
                            foreach($product_img_desc as $img_item) {
                            ?>
                                <img src="./model/uploads/<?php echo $img_item['product_img_desc'] ?>" alt="">
                            <?php
                            }
                            ?>
                        </div>
                        <span class="product__btn--down">&#8744;</span>
                    </div>
                </div>
                <div class="product__right">
                    <form action="" method="POST">
                        <div class="product__right--top">
                            <div class="product__name">
                                <h1><?php echo $product['product_name'] ?></h1>
                            </div>
                            <div class="product__price">
                                <strong><?php echo $product['product_price_new'] ?>₫</strong>
                                <span><?php echo $product['product_price'] ?>₫</span>
                            </div>
                            <div class="product__color">
                                <p>Màu sắc: </p>
                                <div class="product__color--item">
                                    <?php
                                    $count = 0;
                                    foreach($product_color as $color_item) {
                                        if($count == 0) {
                                            $count++;
                                    ?>
                                            <input type="radio" id="<?php echo $color_item['product_color'] ?>" name="color" value="<?php echo $color_item['product_color'] ?>" checked>
                                            <label class="<?php echo $color_item['product_color'] ?>" for="<?php echo $color_item['product_color'] ?>"></label>
                                    <?php
                                            continue;
                                        }
                                    ?>
                                            <input type="radio" id="<?php echo $color_item['product_color'] ?>" name="color" value="<?php echo $color_item['product_color'] ?>">
                                            <label class="<?php echo $color_item['product_color'] ?>" for="<?php echo $color_item['product_color'] ?>"></label>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="product__size">
                                <input type="radio" name="size" id="s" value="s" checked>
                                <label for="s">S</label>
        
                                <input type="radio" name="size" id="m" value="m">
                                <label for="m">M</label>
        
                                <input type="radio" name="size" id="l" value="l">
                                <label for="l">L</label>
        
                                <input type="radio" name="size" id="xl" value="xl">
                                <label for="xl">XL</label>
        
                                <input type="radio" name="size" id="xxl" value="xxl">
                                <label for="xxl">XXL</label>
                            </div>
                            <div class="product__quantity">
                                <label for="numberInput">Số lượng:</label>
                                <div class="product__quantity--input">
                                    <input type="number" id="numberInput" name="numberInput" value="1" min="1" max="<?php echo $product['product_quantity'] ?>" step="1" readonly>
        
                                    <span class="decrement" onclick="decrement()">-</span>
                                    <span class="increment" onclick="increment()">+</span>
                                </div>
                            </div>
                            <div class="product__action">
                                <input type="submit" value="Thêm vào giỏ" class="product__action--cart" name="cart">
                                <input type="submit" value="Mua hàng" class="product__action--buy" name="buy">
                            </div>
                        </div>
                    </form>
                    <div class="product__right--bottom">
                        <div class="product__right--bottom-title"><h1>Giới thiệu</h1></div>
                        <?php echo $product['product_desc'] ?>
                    </div>
                    <div class="product__right--collapsible">
                        <i class="fas fa-solid fa-chevron-down" onclick="toggleDescriptionExpansion()"></i>
                    </div>
                    <!--  -->
                </div>
            </div>
        </div>
    </div>

    <script src="./templates/access/js/js_product.js"></script>