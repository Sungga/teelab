<section class="orders">
    <div class="grid">
        <table>
            <tr>
                <th>Mã đơn hàng</th>
                <th>Ảnh sản phẩm</th>
                <th>Tên sản phẩm</th>
                <th>Màu sắc</th>
                <th>Kích thước</th>
                <th>Số lượng</th>
                <th>Giá tiền</th>
                <th>Trạng thái đơn hàng</th>
                <th>Hủy đơn</th>
            </tr>
            <?php
            foreach($orders as $order_item) {
            ?>
            <tr>
                <!-- id -->
                <td><?php echo $order_item['order_id'] ?></td>

                <!-- img -->
                <td class="order_img">
                    <?php
                    foreach($products as $product_item) {
                        if($product_item['product_id'] == $order_item['product_id']) {
                    ?>
                            <img src="./model/uploads/<?php echo $product_item['product_img'] ?>" alt="">
                    <?php
                            break;
                        }
                    }
                    ?>
                </td>

                <!-- name -->
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
                <td class="orders__size"><?php echo $order_item['order_size'] ?></td>

                <!-- quantity -->
                <td><?php echo $order_item['order_quantity'] ?></td>

                <!-- total -->
                <td class="order_total"><?php echo $order_item['order_total'] ?></td>

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

                <!-- delete order -->
                <td>
                    <?php
                    if($order_item['order_check'] == 0 || $order_item['order_check'] == 1) {
                        $order_id = $order_item['order_id'];
                        echo "<a href='./index.php?controller=website&page=delete_order&order_id=$order_id' class='fa-solid fa-delete-left'></a>";
                    }
                    else {
                        echo '-';
                    }
                    ?>
                </td>
            </tr>
            <?php
            }
            ?>
        </table>
    </div>
</section>


<style>
    td, th {
        padding: 8px;
        text-align: center;
    }

    .order_img {
        width: 200px;
    }

    img {
        width: 100%;
    }

    .orders__size {
        text-transform: uppercase;
    }
</style>

<script>
    const currencyFormatter = new Intl.NumberFormat('vi-VN', {
        style: 'currency',
        currency: 'VND',
    });

    let totalElements = document.querySelectorAll('.order_total');

    totalElements.forEach(function(item) {
        let value = parseFloat(item.textContent.replace(/[^\d]/g, '')); // Lấy giá trị số từ nội dung phần tử
        let formattedValue = currencyFormatter.format(value);
        item.textContent = formattedValue; // Gán giá trị đã định dạng lại vào phần tử
    });
</script>