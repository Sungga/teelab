<div class="admin__right">
                    <table>
                        <tr>
                            <th>Mã loại sản phẩm</th>
                            <th>Tên loại sản phẩm</th>
                            <th>Tên danh mục</th>
                            <th>Hành động</th>
                        </tr>
                        <?php
                        foreach($categories as $category) {
                            foreach($product_types as $product_type) {
                                if($category['category_id'] == $product_type['category_id']) {
                        ?>
                                    <tr>
                                        <td><?php echo $product_type['product_type_id'] ?></td>
                                        <td><?php echo $product_type['product_type_name'] ?></td>
                                        <td><?php echo $category['category_name'] ?></td>
                                        <td><a href="./index.php?controller=admin&page=edit_product_type&product_type_id=<?php echo $product_type['product_type_id'] ?>">Sửa</a> | <a href="./index.php?controller=admin&page=delete_product_type&product_type_id=<?php echo $product_type['product_type_id'] ?>">Xóa</a></td>
                                    </tr>
                        <?php
                                }
                            }
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

