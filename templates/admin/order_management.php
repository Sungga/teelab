<div id="orders__management">
    <div class="grid">
        <div class="order__management--container">
            <input type="submit" value="Quản lý đơn hàng" readonly>
            <a style="padding-bottom: 12px;" href="./index.php?controller=admin&page=tick">Đánh dấu đã đọc tất cả các đơn</a>
            <table>
                <tr>
                    <th>Mã đơn hàng</th>
                    <th>Mã khách</th>
                    <th>Thông tin</th>
                    <th>Mã sản phẩm</th>
                    <th>Tên sản phẩm</th>
                    <th>Màu</th>
                    <th>Kích thước</th>
                    <th>Số lượng</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                    <th>Hủy</th>
                </tr>
                <?php
                foreach($orders as $order_item) {
                ?>
                    <tr>
                        <!-- id -->
                        <td><?php echo $order_item['order_id'] ?></td>

                        <!-- id user -->
                        <td><?php echo $order_item['user_id'] ?></td>

                        <!-- customer info -->
                        <td>
                            <p><?php echo $order_item['order_customer'] ?></p>
                            <p>-</p>
                            <p><?php echo $order_item['order_phone'] ?></p>
                            <p>-</p>
                            <p><?php echo $order_item['order_address'] ?></p>
                        </td>

                        <!-- id product -->
                        <td><?php echo $order_item['product_id'] ?></td>

                        <!-- product name -->
                        <td>
                            <?php
                            foreach($products as $product_item) {
                                if($product_item['product_id'] == $order_item['product_id']) {
                                    echo $product_item['product_name'];
                                    break;
                                }
                            }
                            ?>
                        </td>

                        <!-- color -->
                        <td><?php echo $order_item['order_color'] ?></td>

                        <!-- size -->
                        <td><?php echo $order_item['order_size'] ?></td>

                        <!-- quantity -->
                        <td><?php echo $order_item['order_quantity'] ?></td>

                        <!-- status -->
                        <td>
                            <?php
                            if($order_item['order_check'] == 0) {
                                echo "<p>Đang chờ duyệt</p>";
                            }
                            elseif($order_item['order_check'] == 1) {
                                echo "<p>Đang chuẩn bị hàng</p>";
                            }
                            elseif($order_item['order_check'] == 2) {
                                echo "<p>Đang gửi</p>";
                            }
                            elseif($order_item['order_check'] == 3) {
                                echo "<p>Giao thành công</p>";
                            }
                            else {
                                echo "<p>Đã hủy</p>";
                            }
                            ?>
                        </td>

                        <!-- action -->
                        <td>
                            <?php
                            $order_id = $order_item['order_id'];
                            $product_id = $order_item['product_id'];
                            $product_quantity = $order_item['order_quantity'];

                            if($order_item['order_check'] == 0) {
                                echo "<a href='./index.php?controller=admin&page=processing&order_id=$order_id'>Duyệt</a>";
                            }
                            elseif($order_item['order_check'] == 1) {
                                echo "<a href='./index.php?controller=admin&page=ship&order_id=$order_id'>Gửi</a>";
                            }
                            elseif($order_item['order_check'] == 2) {
                                echo "<a href='./index.php?controller=admin&page=success&order_id=$order_id&product_id=$product_id&product_quantity=$product_quantity'>Xong</a>";
                            }
                            elseif($order_item['order_check'] == 3) {
                                echo "<a href='./index.php?controller=admin&page=delete_order&order_id=$order_id'>Đã đọc</a>";
                            }
                            else {
                                echo "<a href='./index.php?controller=admin&page=delete_order&order_id=$order_id'>Đã đọc</a>";
                            }
                            ?>
                        </td>

                        <!-- cancel -->
                        <td>
                            <?php
                            if($order_item['order_check'] == 3 || $order_item['order_check'] == 4) {
                                echo "-";
                            }
                            else {
                                echo "<a href='./index.php?controller=admin&page=cancel&order_id=$order_id'>Hủy</a>";
                            }
                            ?>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
    </div>
</div>

<style>
    th, td {
        padding: 8px;
        text-align: center;
    }
</style>