    <!-- BEGIN LIST PRODUCT -->
    <section id="list-product">
        <div class="grid">
            <div class="path">
                <a href="./index.php">Trang chủ</a>
                <span>&#8594;</span>
                <a href="#">Tất cả sản phẩm</a>
            </div>
            
            <div class="list-product__container">
                <div class="list-product__left" style="user-select: none;">
                    <form action="" method="POST">
                        <!-- size -->
                        <div class="list-product__left--item">
                            <div class="list-product__left--item-top">
                                <p>SIZE</p>
                                <p>+</p>
                                <p style="display: none;">-</p>
                            </div>
                            <?php
                            // checked cac mau da duoc chon khi loc o luc truoc
                            if(isset($_GET['f']) && $_GET['f'] == 't') {
                                $arraySize = isset($_SESSION['filterSize']) && $_SESSION['filterSize'] > 0 ? $_SESSION['filterSize'] : array();
                            } else {
                                $arraySize = array();
                            }
                            // ham kiem tra 
                            function isCheckedSize($size, $selectedSizes) {
                                if(count($selectedSizes) != 0) {
                                    if(in_array($size, $selectedSizes)) echo "checked";
                                }
                            }
                            ?>
                            <div class="list-product__left--item-bottom list-product__size">
                                <div class="list-product__size--item">
                                    <input type="checkbox" name="filterSize[]" value="s" id="" <?php isCheckedSize('s', $arraySize) ?>>
                                    <span>S</span>
                                </div>
                                <div class="list-product__size--item">
                                    <input type="checkbox" name="filterSize[]" value="m" id="" <?php isCheckedSize('m', $arraySize) ?>>
                                    <span>M</span>
                                </div>
                                <div class="list-product__size--item">
                                    <input type="checkbox" name="filterSize[]" value="l" id="" <?php isCheckedSize('l', $arraySize) ?>>
                                    <span>L</span>
                                </div>
                                <div class="list-product__size--item">
                                    <input type="checkbox" name="filterSize[]" value="xl" id="" <?php isCheckedSize('xl', $arraySize) ?>>
                                    <span>XL</span>
                                </div>
                                <div class="list-product__size--item">
                                    <input type="checkbox" name="filterSize[]" value="xxl" id="" <?php isCheckedSize('xxl', $arraySize) ?>>
                                    <span>XXL</span>
                                </div>
                            </div>
                        </div>
                        <!-- color -->
                        <div class="list-product__left--item">
                            <div class="list-product__left--item-top">
                                <p>Màu sắc</p>
                                <p>+</p>
                                <p style="display: none;">-</p>
                            </div>
                            <?php
                            // checked cac mau da duoc chon khi loc o luc truoc
                            if(isset($_GET['f']) && $_GET['f'] == 't') {
                                $arrayColor = isset($_SESSION['filterColor']) && $_SESSION['filterColor'] > 0 ? $_SESSION['filterColor'] : array();
                            } else {
                                $arrayColor = array();
                            }
                            // ham kiem tra 
                            function isCheckedColor($color, $selectedColors) {
                                if(count($selectedColors) != 0) {
                                    if(in_array($color, $selectedColors)) echo "checked";
                                }
                            }
                            ?>
                            <div class="list-product__left--item-bottom list-product__color">
                                <div class="list-product__color--item">
                                    <input type="checkbox" name="filterColor[]" value="yellow" id="" <?php isCheckedColor('yellow', $arrayColor)?>>
                                    <p style="background-color: yellow;"></p>
                                </div>
                                <div class="list-product__color--item">
                                    <input type="checkbox" name="filterColor[]" value="green" id="" <?php isCheckedColor('green', $arrayColor)?>>
                                    <p style="background-color: green;"></p>
                                </div>
                                <div class="list-product__color--item">
                                    <input type="checkbox" name="filterColor[]" value="pink" id="" <?php isCheckedColor('pink', $arrayColor)?>>
                                    <p style="background-color: pink;"></p>
                                </div>
                                <div class="list-product__color--item">
                                    <input type="checkbox" name="filterColor[]" value="red" id="" <?php isCheckedColor('red', $arrayColor)?>>
                                    <p style="background-color: red;"></p>
                                </div>
                                <div class="list-product__color--item">
                                    <input type="checkbox" name="filterColor[]" value="gray" id="" <?php isCheckedColor('gray', $arrayColor)?>>
                                    <p style="background-color: gray;"></p>
                                </div>
                                <div class="list-product__color--item">
                                    <input type="checkbox" name="filterColor[]" value="white" id="" <?php isCheckedColor('white', $arrayColor)?>>
                                    <p style="background-color: white;"></p>
                                </div>
                                <div class="list-product__color--item">
                                    <input type="checkbox" name="filterColor[]" value="brown" id="" <?php isCheckedColor('brown', $arrayColor)?>>
                                    <p style="background-color: brown;"></p>
                                </div>
                                <div class="list-product__color--item">
                                    <input type="checkbox" name="filterColor[]" value="brown" id="" <?php isCheckedColor('brown', $arrayColor)?>>
                                    <p style="background-color: black;"></p>
                                </div>
                            </div>
                        </div>
                        <!-- range -->
                        <div class="list-product__left--item">
                            <div class="list-product__left--item-top">
                                <p>Mức giá</p>
                                <p>+</p>
                                <p style="display: none;">-</p>
                            </div>
                            <div class="list-product__left--item-bottom list-product__range">
                                <!-- <input type="range" name="" id=""> -->
                                <?php
                                if(isset($_GET['f']) && $_GET['f'] == 't') {
                                    $valueRange = isset($_SESSION['filterRange']) ? intval($_SESSION['filterRange']) : 0;
                                } else {
                                    $valueRange = 0;
                                }
                                // chuyen thanh dang tien vnd
                                $valueRangeVND = number_format($valueRange, 0, ',', '.');
                                ?>
                                <p id="rangeValue" style="width: 100%; text-align: center;"><?php echo $valueRangeVND ?>₫</p>
                                <input type="range" id="myRange" min="0" max="10000000" step="1" value="<?php echo $valueRange ?>" style="width: 100%;" name="filterRange">
                            </div>
                        </div>
                        <!-- filter -->
                        <div class="list-product__left--filter">
                            <input type="submit" value="Lọc" name="filter">
                        </div>
                    </form>
                </div>
                <div class="list-product__right">
                    <div class="list-product__right--top">
                        <h3>Áo</h3>
                        <div class="list-product__select">
                            <div>
                                <?php
                                    $arrange = '';
                                    if(isset($_GET['arrange'])) {
                                        switch($_GET['arrange']) {
                                            case 'Latest':{
                                                $arrange = 'Latest';
                                                echo "<p>Mới nhất</p>";
                                                break;
                                            }
                                            case 'Oldest':{
                                                $arrange = 'Oldest';
                                                echo "<p>Cũ nhất</p>";
                                                break;
                                            }
                                            case 'LowToHigh':{
                                                $arrange = 'LowToHigh';
                                                echo "<p>Giá thấp đến cao</p>";
                                                break;
                                            }
                                            case 'HighToLow':{
                                                $arrange = 'HighToLow';
                                                echo "<p>Giá cao đến thấp</p>";
                                                break;
                                            }
                                            default:{
                                                $arrange = 'Latest';
                                                echo "<p>Mới nhất</p>";
                                                break;
                                            }
                                        }
                                    }
                                    else {
                                        echo "<p>Mới nhất</p>";
                                    }
                                    ?>
                            </div>
                            <form action="" method="POST">
                                <div class="list-product__option">
                                    <input type="submit" name="arrange" value="Mới nhất" class="<?php echo $arrange == 'Latest' || $arrange == '' ? 'bold' : '' ?>">
                                    <input type="submit" name="arrange" value="Cũ nhất" class="<?php echo $arrange == 'Oldest' ? 'bold' : '' ?>">
                                    <input type="submit" name="arrange" value="Giá thấp đến cao" class="<?php echo $arrange == 'LowToHigh' ? 'bold' : '' ?>">
                                    <input type="submit" name="arrange" value="Giá cao đến thấp" class="<?php echo $arrange == 'HighToLow' ? 'bold' : '' ?>">
                                </div>
                            </form>
                        </div>
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
                            <?php
                            for($i = 1; $i <= $numberOfPage; $i++) {
                                $product_type_id = isset($_GET['product_type_id']) ? $_GET['product_type_id'] : 0;
                                $product_type_name = isset($_GET['product_type_name']) ? $_GET['product_type_name'] : 0;
                                $arrange = isset($_GET['arrange']) ? $_GET['arrange'] : '';
                                $p = $i;
                                $f = isset($_GET['f']) ? $_GET['f'] : 'f';
                                if($_GET['p'] == $i) {
                                    echo "<a href='./index.php?controller=website&page=all_product_type&p=$p&f=$f&arrange=$arrange' class='focus'>$i</a>";
                                }
                                else {
                                    echo "<a href='./index.php?controller=website&page=all_product_type&p=$p&f=$f&arrange=$arrange'>$i</a>";
                                }
                            }
                            ?>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <script src="./templates/access/js/js_list_product.js"></script>