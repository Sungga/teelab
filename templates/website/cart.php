    <!-- BEGIN CART -->
    <section class="cart">
        <div class="grid">
            <div class="location">
                <i class="fa-solid fa-cart-shopping"></i>
                <i class="fa-solid fa-location-dot"></i>
                <i class="fa-solid fa-money-bill"></i>
                <i class="fa-solid fa-check"></i>
            </div>
            <form action="" method="POST">
                <div class="cart__container">
                    <table class="cart__left">
                        <tr>
                            <th>Ảnh sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>Màu sắc</th>
                            <th>Kích thước</th>
                            <th>Số lượng</th>
                            <th>Giá tiền</th>
                            <th>Tổng tiền</th>
                            <th>Chọn</th>
                            <?php
                            if(isset($_SESSION['user_id'])) {
                            ?>
                                <th>Xóa</th>
                            <?php
                            }
                            ?>
                        </tr>
                        <?php
                        foreach($arr_product_cart as $arr_product_cart_index => $arr_product_cart_item) {
                        ?>
                            <tr>
                            <!-- anh -->
                            <td>
                                <img src="./model/uploads/<?php echo $arr_product_cart_item['product_img'] ?>" alt="">
                            </td>
                            <!-- ten -->
                            <td>
                                <?php echo $arr_product_cart_item['product_name'] ?>
                                <input type="text" name="cart_id" id="" style="display: none;" value="<?php echo $list_cart[$arr_product_cart_index]['cart_id'] ?>">
                                <input type="text" name="product_id<?php echo $list_cart[$arr_product_cart_index]['cart_id'] ?>" id="" style="display: none;" value="<?php echo $arr_product_cart_item['product_id'] ?>">
                            </td>
                            <!-- mau -->
                            <td>
                                <select name="color<?php echo $list_cart[$arr_product_cart_index]['cart_id'] ?>" id="">
                                    <?php
                                    foreach($list_cart as $list_cart_item) {
                                        if($list_cart_item['cart_product_id'] == $arr_product_cart_item['product_id']) {
                                            $color_of_product = $list_cart_item['cart_color'];
                                    ?>
                                            <option value="<?php echo $list_cart_item['cart_color'] ?>"><?php echo $list_cart_item['cart_color'] ?></option>
                                    <?php
                                            break;
                                        }
                                    }
                                    foreach($colors as $color_item) {
                                        if($color_item['product_id'] == $arr_product_cart_item['product_id'] && $color_item['product_color'] != $color_of_product) {
                                    ?>
                                        <option value="<?php echo $color_item['product_color'] ?>"><?php echo $color_item['product_color'] ?></option>
                                    <?php
                                            
                                        }
                                    }
                                    ?>
                                </select>
                            </td>
                            <!-- size -->
                            <td>
                                <select name="size<?php echo $list_cart[$arr_product_cart_index]['cart_id'] ?>" id="">
                                    <?php
                                    foreach($list_cart as $list_cart_item) {
                                        if($list_cart_item['cart_product_id'] == $arr_product_cart_item['product_id']) {
                                            $size_of_product = $list_cart_item['cart_size'];
                                    ?>
                                            <option value="<?php echo $list_cart_item['cart_size'] ?>"><?php echo $list_cart_item['cart_size'] ?></option>
                                    <?php
                                            break;
                                        }
                                    }
                                    foreach($sizes as $size_item) {
                                        if($size_item != $size_of_product) {
                                    ?>
                                        <option value="<?php echo $size_item ?>"><?php echo $size_item ?></option>
                                    <?php
                                            
                                        }
                                    }
                                    ?>
                                </select>
                            </td>
                            <!-- so luong -->
                            <td>
                                <?php
                                foreach($list_cart as $list_cart_item) {
                                    if($list_cart_item['cart_product_id'] == $arr_product_cart_item['product_id']) {
                                ?>
                                        <input type="number" name="quantity<?php echo $list_cart[$arr_product_cart_index]['cart_id'] ?>" id="" value="<?php echo $list_cart_item['cart_quantity'] ?>" max="33" min="0">
                                <?php
                                        break;
                                    }
                                }
                                ?>
                                
                            </td>
                            <!-- gia -->
                            <td>
                                <?php echo $arr_product_cart_item['product_price_new']?>
                            </td>
                            <!-- tong tien -->
                            <td>
                                <input type="text" name="total<?php echo $list_cart[$arr_product_cart_index]['cart_id'] ?>" style="border:none; outline:none; width: 100%; text-align:center;" readonly>
                            </td>
                            <!-- lua chon -->
                            <td><input type="checkbox" name="check<?php echo $list_cart[$arr_product_cart_index]['cart_id'] ?>" id=""></td>
                            <!-- xoa -->
                            <?php
                            if(isset($_SESSION['user_id'])) {
                            ?>
                                <td><a href="./index.php?controller=website&page=delete_cart&cart_id=<?php echo $list_cart[$arr_product_cart_index]['cart_id'] ?>" class="fa-solid fa-trash"></a></td>
                            <?php
                            }
                            ?>
                        </tr>
                        <?php
                        }
                        ?>
                    </table>
                    <div class="cart__right">
                        <h1>Tổng tiền giỏ hàng</h1>
                        <div>
                            <p>Tổng sản phẩm</p>
                            <p class="tongsanpham">0</p>
                        </div>
                        <div>
                            <p>Tổng tiền hàng</p>
                            <p class="tongtienhang">0₫</p>
                        </div>
                        <div>
                            <p>Thành tiền (bao gồm phí vận chuyển)</p>
                            <p class="thanhtien">0₫</p>
                        </div>
                        <div class="cart__right--input">
                            <input type="submit" value="Tiếp tục" name="next">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>


    <script src="./templates/access/js/js_cart.js"></script>