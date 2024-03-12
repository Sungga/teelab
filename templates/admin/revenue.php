<div id="orders__management">
    <div class="grid">
        <div class="order__management--container">
            <input type="submit" value="Thống kê doanh thu" readonly>
            <a style="padding-bottom: 12px;" href="./index.php?controller=admin&page=tick">Đánh dấu đã đọc tất cả các đơn</a>
            <table>
                <tr>
                    <th>Ngày</th>
                    <th>Tổng doanh thu</th>
                </tr>
                <?php foreach($revenues as $revenue) {?>
                <tr>
                    <td><a href="./index.php?controller=admin&page=completedOrder&date=<?php echo $revenue['revenue_date'] ?>"><?php echo $revenue['revenue_date'] ?></a></td>
                    <td><?php echo $revenue['revenue'] ?></td>
                </tr>
                <?php } ?>
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