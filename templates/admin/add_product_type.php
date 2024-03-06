<div class="admin__right">
                    <form action="" method="post">
                        <select name="category_id" id="">
                            <?php
                            foreach($categories as $category) {
                            ?>
                                <option value="<?php echo $category['category_id'] ?>"><?php echo $category['category_name'] ?></option>
                            <?php
                            }
                            ?>
                            ?>
                        </select>
                        <input type="text" name="product-type_name" id="">
                        <input type="submit" value="Thêm loại sản phẩm">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>