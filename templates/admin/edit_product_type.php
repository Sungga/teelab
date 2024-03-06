<div class="admin__right">
                    <form action="" method="post">
                        <select name="category_id" id="" style="padding: 8px;">
                            <!-- tìm category đang sở hữu product_type này -->
                            <?php
                            foreach($categories as $category) {
                                if($category['category_id'] == $product_type['category_id']) {
                            ?>
                                    <option value="<?php echo $category['category_id'] ?>"><?php echo $category['category_name'] ?></option>
                            <?php
                                }
                            }
                            ?>

                            <!-- in ra các category còn lại -->
                            <?php
                            foreach($categories as $category) {
                                if(!($category['category_id'] == $product_type['category_id'])) {
                            ?>
                                    <option value="<?php echo $category['category_id'] ?>"><?php echo $category['category_name'] ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>

                        <input type="text" name="product_type_name" id="" value="<?php echo $product_type['product_type_name'] ?>">

                        <input type="submit" value="Sửa loại sản phẩm">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>