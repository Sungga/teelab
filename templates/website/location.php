<section class="location-customer">
        <div class="grid">
            <div class="location">
                <i class="fa-solid fa-cart-shopping"></i>
                <i class="fa-solid fa-location-dot"></i>
                <i class="fa-solid fa-money-bill"></i>
                <i class="fa-solid fa-check"></i>
            </div>
            <form action="" method="POST">
                <div class="location-customer__container">
                    <h1>Điền thông tin nhận hàng</h1>
                    <div>
                        <p>Họ tên</p>
                        <input type="text" value="<?php echo $user_name ?>" name="name" required>
                    </div>
                    <div>
                        <p>Số điện thoại</p>
                        <input type="text" value="<?php echo $user_phone ?>" name="phone" required>
                    </div>
                    <div>
                        <p>Tỉnh / Thành phố</p>
                        <input type="text" name="city" required>
                    </div>
                    <div>
                        <p>Quận / Huyện</p>
                        <input type="text" name="district" required>
                    </div>
                    <div>
                        <p>Phường / Xã</p>
                        <input type="text" name="ward" required>
                    </div>
                    <div>
                        <p>Địa chỉ</p>
                        <input type="text" value="<?php echo $user_address ?>" name="address" required>
                    </div>
                    <div>
                        <input type="submit" value="Tiếp tục">
                    </div>
                </div>
            </form>
        </div>
    </section>