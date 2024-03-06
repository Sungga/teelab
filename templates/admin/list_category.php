<div class="admin__right">
                    <table>
                        <tr>
                            <th>Mã danh mục</th>
                            <th>Tên danh mục</th>
                            <th>Hành động</th>
                        </tr>
                        <?php 
                            $index = 0;
                            while($index < count($categories)) { 
                                $category = $categories[$index];
                        ?>
                            <tr>
                                <td><?php echo $category['category_id']; ?></td>
                                <td><?php echo $category['category_name']; ?></td>
                                <td><a href="./index.php?controller=admin&page=edit_category&category_id=<?php echo $category['category_id'] ?>">Sửa</a> | <a href="./index.php?controller=admin&page=delete_category&category_id=<?php echo $category['category_id'] ?>">Xóa</a></td>
                            </tr>
                        <?php 
                            $index++;
                            } 
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>