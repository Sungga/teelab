<div class="admin__right">
                    <table>
                        <tr>
                            <th>Mã ảnh bìa</th>
                            <th>Ảnh</th>
                            <th>Hành động</th>
                        </tr>
                        <?php
                        foreach($website_covers as $website_cover_item) {
                        ?>
                            <tr>
                                <td><?php echo $website_cover_item['website_cover_id']; ?></td>
                                <td><img src="./model/uploads/<?php echo $website_cover_item['website_cover_name']; ?>" alt=""></td>
                                <td><a href="./index.php?controller=admin&page=edit_website_cover&website_cover_id=<?php echo $website_cover_item['website_cover_id'] ?>">Sửa</a> | <a href="./index.php?controller=admin&page=delete_website_cover&website_cover_id=<?php echo $website_cover_item['website_cover_id'] ?>">Xóa</a></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<style>
    img {
        width: 500px;
    }

    td {
        text-align: center;
    }
</style>