<div id="orders__management">
    <div class="grid">
        <div class="order__management--container">
            <input type="submit" value="Thống kê đơn hàng" readonly>
            <p>Ngày hoàn thành đơn hàng <?php echo $completedOrders[0]['order_completed'] ?></p>
            <table>
                <tr>
                    <th>Mã đơn hàng</th>
                    <th>Mã khách</th>
                    <th>Thông tin</th>
                    <th>Ngày đặt</th>
                    <th>Mã sản phẩm</th>
                    <th>Tên sản phẩm</th>
                    <th>Màu</th>
                    <th>Kích thước</th>
                    <th>Số lượng</th>
                    <th>Tổng tiền</th>
                </tr>
                <?php
                foreach($completedOrders as $completedOrder_item) {
                ?>
                    <tr>
                        <!-- id -->
                        <td><?php echo $completedOrder_item['order_id'] ?></td>

                        <!-- id user -->
                        <td><?php echo $completedOrder_item['user_id'] ?></td>

                        <!-- customer info -->
                        <td>
                            <p><?php echo $completedOrder_item['order_customer'] ?></p>
                            <p>-</p>
                            <p><?php echo $completedOrder_item['order_phone'] ?></p>
                            <p>-</p>
                            <p><?php echo $completedOrder_item['order_address'] ?></p>
                        </td>

                        <!-- date -->
                        <th style="font-weight: 400; width: 100px;"><?php echo $completedOrder_item['order_date'] ?></th>

                        <!-- id product -->
                        <td><?php echo $completedOrder_item['product_id'] ?></td>

                        <!-- product name -->
                        <td>
                            <?php
                            foreach($products as $product_item) {
                                if($product_item['product_id'] == $completedOrder_item['product_id']) {
                                    echo $product_item['product_name'];
                                    break;
                                }
                            }
                            ?>
                        </td>

                        <!-- color -->
                        <td><?php echo $completedOrder_item['order_color'] ?></td>

                        <!-- size -->
                        <td><?php echo $completedOrder_item['order_size'] ?></td>

                        <!-- quantity -->
                        <td><?php echo $completedOrder_item['order_quantity'] ?></td>

                        <!-- Total -->
                        <td><?php echo $completedOrder_item['order_total'] ?></td>
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