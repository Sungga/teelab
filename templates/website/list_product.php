    <!-- BEGIN LIST PRODUCT -->
    <section id="list-product">
        <div class="grid">
            <div class="path">
                <a href="./index.php">Trang chủ</a>
                <span>&#8594;</span>
                <a href="#"><?php echo $category['category_name'] ?></a>
                <span>&#8594;</span>
                <a href="#"><?php echo $product_type['product_type_name'] ?></a>
            </div>
            
            <div class="list-product__container">
                <div class="list-product__left">
                    <div class="list-product__left--item">
                        <div class="list-product__left--item-top">
                            <p>SIZE</p>
                            <p>+</p>
                            <p style="display: none;">-</p>
                        </div>
                        <div class="list-product__left--item-bottom list-product__size">
                            <div class="list-product__size--item">
                                <input type="checkbox" name="size-s" id="">
                                <span>S</span>
                            </div>
                            <div class="list-product__size--item">
                                <input type="checkbox" name="size-m" id="">
                                <span>M</span>
                            </div>
                            <div class="list-product__size--item">
                                <input type="checkbox" name="size-l" id="">
                                <span>L</span>
                            </div>
                            <div class="list-product__size--item">
                                <input type="checkbox" name="size-xl" id="">
                                <span>XL</span>
                            </div>
                            <div class="list-product__size--item">
                                <input type="checkbox" name="size-xxl" id="">
                                <span>XXL</span>
                            </div>
                        </div>
                    </div>

                    <div class="list-product__left--item">
                        <div class="list-product__left--item-top">
                            <p>Màu sắc</p>
                            <p>+</p>
                            <p style="display: none;">-</p>
                        </div>
                        <div class="list-product__left--item-bottom list-product__color">
                            <div class="list-product__color--item">
                                <input type="checkbox" name="color-yellow" id="">
                                <p style="background-color: yellow;"></p>
                            </div>
                            <div class="list-product__color--item">
                                <input type="checkbox" name="color-green" id="">
                                <p style="background-color: green;"></p>
                            </div>
                            <div class="list-product__color--item">
                                <input type="checkbox" name="color-pink" id="">
                                <p style="background-color: pink;"></p>
                            </div>
                            <div class="list-product__color--item">
                                <input type="checkbox" name="color-red" id="">
                                <p style="background-color: red;"></p>
                            </div>
                            <div class="list-product__color--item">
                                <input type="checkbox" name="color-gray" id="">
                                <p style="background-color: gray;"></p>
                            </div>
                            <div class="list-product__color--item">
                                <input type="checkbox" name="color-white" id="">
                                <p style="background-color: white;"></p>
                            </div>
                            <div class="list-product__color--item">
                                <input type="checkbox" name="color-brown" id="">
                                <p style="background-color: brown;"></p>
                            </div>
                            <div class="list-product__color--item">
                                <input type="checkbox" name="color-brown" id="">
                                <p style="background-color: black;"></p>
                            </div>
                        </div>
                    </div>

                    <div class="list-product__left--item">
                        <div class="list-product__left--item-top">
                            <p>Mức giá</p>
                            <p>+</p>
                            <p style="display: none;">-</p>
                        </div>
                        <div class="list-product__left--item-bottom list-product__range">
                            <!-- <input type="range" name="" id=""> -->
                            <p id="rangeValue" style="width: 100%; text-align: center;">0</p>
                            <input type="range" id="myRange" min="0" max="10000000" step="1" value="0" style="width: 100%;">
                        </div>
                    </div>
                    <div class="list-product__left--filter">
                        <input type="submit" value="Lọc">
                    </div>
                </div>
                <div class="list-product__right">
                    <div class="list-product__right--top">
                        <h3>Áo</h3>
                        <select>
                            <option value="moinhat">Mới nhất</option>
                            <option value="moinhat">Cũ nhất</option>
                            <option value="moinhat">Giá cao đến thấp</option>
                            <option value="moinhat">Giá thấp đến cao</option>
                        </select>
                    </div>
                    
                    <div class="list-product__right--center">
                        <?php
                        $numberOfProduct = count($products);
                        $productsPerPage = 16;
                        $numberOfPage = ceil($numberOfProduct / $productsPerPage);

                        if($_GET['p'] > $numberOfPage) {
                            echo "<script>alert('Không có dữ liệu ở trang này');</script>";
                        }
                        else {
                            $product_start = 16 * $_GET['p'] - 16; //tru 16 vi san pham sau tien bat dau tu 0
                            if($_GET['p'] == $numberOfPage) {
                                $product_end = $numberOfProduct % 16 + $product_start - 1;
                            }
                            else {
                                $product_end = 16 * $_GET['p'] - 1;
                            }
                            for($index = $product_start; $index <= $product_end; $index++) {
                        ?>
                                <div class="list-product__product">
                                    <div class="list-product__product--img">
                                        <a href="./index.php?controller=website&page=product&product_id=<?php echo $products[$index]['product_id'] ?>">
                                            <img src="./model/uploads/<?php echo $products[$index]['product_img'] ?>" alt="">
                                        </a>
                                    </div>
                                    <div class="list-product__product--name">
                                        <h4><?php echo $products[$index]['product_name'] ?></h4>
                                    </div>
                                    <form method="POST">
                                        <div class="list-product__product--color">
                                            <?php
                                            $arr = array(); 
                                            foreach($colors as $color_item) {
                                                if($color_item['product_id'] == $products[$index]['product_id']) $arr[] = $color_item;
                                            }

                                            if(count($arr) <= 4) {
                                            ?>
                                                <div class="list-product__product--left-color">
                                            <?php
                                                foreach($arr as $item) {
                                            ?>
                                                    <input type="radio" value="<?php echo $item['product_color'] ?>" class="list-product__color" id="<?php echo $item['product_color'] ?>_<?php echo $item['product_id'] ?>" name="color_product_<?php echo $item['product_id'] ?>" checked>
                                                    <label class="<?php echo $item['product_color'] ?>" for="<?php echo $item['product_color'] ?>_<?php echo $item['product_id'] ?>"></label>
                                            <?php
                                                }
                                            ?>
                                                </div>
                                            <?php
                                            ?>
                                                <div style="display: none;" class="list-product__product--right-color"></div>
                                                <p style="display: none;">&#8594;</p>
                                            <?php
                                            }
                                            else {
                                            ?>
                                                <div class="list-product__product--left-color">
                                            <?php
                                                for($i = 0; $i < 4; $i++) {
                                            ?>
                                                    <input type="radio" value="<?php echo $arr[$i]['product_color'] ?>" class="list-product__color" id="<?php echo $arr[$i]['product_color'] ?>_<?php echo $arr[$i]['product_id'] ?>" name="color_product_<?php echo $arr[$i]['product_id'] ?>" checked>
                                                    <label class="<?php echo $arr[$i]['product_color'] ?>" for="<?php echo $arr[$i]['product_color'] ?>_<?php echo $arr[$i]['product_id'] ?>"></label>
                                            <?php
                                                }
                                            ?>
                                                </div>
                                                <div class="list-product__product--right-color">
                                            <?php
                                                for($i = 4; $i < count($arr); $i++) {
                                            ?>
                                                    <input type="radio" value="<?php echo $arr[$i]['product_color'] ?>" class="list-product__color" id="<?php echo $arr[$i]['product_color'] ?>_<?php echo $arr[$i]['product_id'] ?>" name="color_product_<?php echo $arr[$i]['product_id'] ?>">
                                                    <label class="<?php echo $arr[$i]['product_color'] ?>" for="<?php echo $arr[$i]['product_color'] ?>_<?php echo $arr[$i]['product_id'] ?>"></label>
                                            <?php
                                                }
                                            ?>
                                                </div>
                                                <p>&#8594;</p>
                                            <?php
                                            }
                                            ?>
                                        </div>

                                        <div class="list-product__product--price">
                                            <strong><?php echo $products[$index]['product_price_new'] ?>₫</strong>
                                            <span><?php echo $products[$index]['product_price'] ?>₫</span>
                                        </div>
                                        <input type="text" name="product_id" id="" style="display: none;" value="<?php echo $products[$index]['product_id'] ?>">
                                        <div class="list-product__product--cart">
                                            <i class="fa-solid fa-cart-shopping"></i>
                                                <ul class="list-product__product--size">
                                                    <li><input type="submit" name="size" value="M"></li>
                                                    <li><input type="submit" name="size" value="S"></li>
                                                    <li><input type="submit" name="size" value="L"></li>
                                                    <li><input type="submit" name="size" value="XL"></li>
                                                    <li><input type="submit" name="size" value="XXL"></li>
                                                </ul>
                                        </div>
                                    </form>
                                </div>
                        <?php
                            }    
                        }
                        ?>
                    </div>
                    
                    
                    <div class="list-product__right--bottom">
                        <form action="" method="get">
                            <!-- <input type="submit" value="&#60;"> -->
                            <?php
                            if($_GET['page'] == 'product_type') {
                                for($i = 1; $i <= $numberOfPage; $i++) {
                                    if($_GET['p'] == $i) {
                            ?>
                                        <a href="./index.php?controller=website&page=product_type&product_type_id=<?php echo $product_type['product_type_id'] ?>&p=<?php echo $i ?>" class="focus"><?php echo $i ?></a>
                            <?php
                                    }
                                    else {
                            ?>
                                        <a href="./index.php?controller=website&page=product_type&product_type_id=<?php echo $product_type['product_type_id'] ?>&p=<?php echo $i ?>"><?php echo $i ?></a>
                            <?php
                                }
                                }
                            }
                            else {
                            $product_type_name = $_GET['product_type_name'];
                            for($i = 1; $i <= $numberOfPage; $i++) {
                                if($_GET['p'] == $i) {
                            ?>
                                    <a href="./index.php?controller=website&page=product_type_search&product_type_name=$product_type_name&p=<?php echo $i ?>" class="focus"><?php echo $i ?></a>
                            <?php
                                }
                                else {
                            ?>
                                    <a href="./index.php?controller=website&page=product_type_search&product_type_name=$product_type_name&p=<?php echo $i ?>"><?php echo $i ?></a>
                            <?php
                                }
                            }
                            }
                            ?>
                            <!-- <input type="submit" value="&#62;"> -->
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <script src="./templates/access/js/js_list_product.js"></script>