<section class="signin">
        <div class="grid">
            <form action="" method="POST">
                <div class="sign__container">
                    <h1>Tài khoản "<?php echo $user_account['user_account'] ?>"</h1>
                    <div class="sign__input">
                        <p>Họ tên</p>
                        <input type="text" name="name" id="" placeholder="Họ tên" value="<?php echo $user_info['user_name'] ?>" required>
                    </div>
                    <div class="sign__input">
                        <p>Số điện thoại</p>
                        <input type="text" name="phone" id="" placeholder="Sđt" value="<?php echo $user_info['user_phone'] ?>">
                    </div>
                    <div class="sign__input">
                        <p>Email</p>
                        <input type="email" name="email" id="" placeholder="Email" value="<?php echo $user_info['user_email'] ?>">
                    </div>
                    <div class="sign__input">
                        <p>Địa chỉ</p>
                        <input type="text" name="address" id="" placeholder="Địa chỉ" value="<?php echo $user_info['user_address'] ?>">
                    </div>
                    <div class="sign__input">
                        <span>Nếu thấy không an toàn, hãy <a href="./index.php?controller=common&page=password">đổi mật khẩu!</a></span>
                        <input type="submit" value="Chỉnh sửa">                    
                    </div>
                </div>
            </form>
        </div>
    </section>