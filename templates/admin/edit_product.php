<div class="admin__right">
                    <form action="" method="post" enctype="multipart/form-data">
                        <label for="category_id">Tên danh mục</label>
                        <select name="category_id" id="category_id">
                            <option value="<?php echo $category_prd['category_id'] ?>"><?php echo $category_prd['category_name'] ?></option>
                            <?php
                            foreach($categories as $category) {
                                if($category['category_id'] != $category_prd['category_id']) {
                            ?>
                                <option value="<?php echo $category['category_id'] ?>"><?php echo $category['category_name'] ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>

                        <label for="product_type_id">Tên loại sản phẩm</label>
                        <select name="product_type_id" id="product_type_id">
                            <option value="<?php echo $product_type_prd['product_type_id'] ?>"><?php echo $product_type_prd['product_type_name'] ?></option>
                            <?php
                            foreach($product_type_ctg as $product_type) {
                                if(!($product_type['product_type_id'] == $product_type_prd['product_type_id'])) {
                            ?>
                                <option value="<?php echo $product_type['product_type_id'] ?>"><?php echo $product_type['product_type_name'] ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                        <label for="product_name">Tên sản phẩm</label>
                        <input type="text" name="product_name" id="" placeholder="Tên sản phẩm" value="<?php echo $product['product_name'] ?>">

                        <label for="product_price">Giá sản phẩm</label>
                        <input type="text" name="product_price" id="" placeholder="Giá sản phẩm" value="<?php echo $product['product_price'] ?>">

                        <label for="product_price_new">Giá mới</label>
                        <input type="text" name="product_price_new" id=""  value="<?php echo $product['product_price_new'] ?>">

                        <label for="product_desc">Mô tả</label>
                        <textarea name="product_desc" id="textarea" cols="30" rows="20"><?php echo $product['product_desc'] ?></textarea>

                        <!-- <input type="file" name="product_img" id=""> -->
                        <!-- Hiển thị đường dẫn hình ảnh hiện tại -->
                        <label for="">Ảnh đang sử dụng</label>
                        <img src="./model/uploads/<?php echo $product['product_img']; ?>" alt="Product Image">
                        <label for="product_img">Nếu muốn đổi ảnh hãy chọn ở đây</label>
                        <!-- Input type file để tải lên hình ảnh mới -->
                        <input type="file" name="product_img" id="">

                        <label for="">Ảnh mô tả đang sử dụng</label>
                        <div style="display: flex; flex-wrap: wrap; justify-content: space-between;">
                            <?php
                            foreach($product_img_desc as $img) {
                            ?>
                                <div style="width: 30%;">
                                    <img style="width: 100%;" src="./model/uploads/<?php echo $img['product_img_desc'] ?>" alt="">
                                    <label for="<?php echo $img['product_img_desc'] ?>">Xóa</label>
                                    <input style="display: block;" type="checkbox" name="<?php echo $img['product_img_desc'] ?>" id="">
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                        <label for="product_img_desc">Thêm ảnh mô tả</label>
                        <input type="file" name="product_img_desc[]" id="" multiple>

                        <label for="quantity">Số lượng sản phẩm</label>
                        <input type="number" name="product_quantity" id="" value="<?php echo $product['product_quantity'] ?>">

                        <div>
                            <?php 
                                $arr = array('yellow','green','pink','red','gray','white','brown','black');

                                foreach($arr as $a) {
                                    $kt = false;
                                    foreach($product_color as $color) {
                                        if($a == $color['product_color']) {
                            ?>
                                            <input type="checkbox" id="<?php echo $color['product_color'] ?>" name="<?php echo $color['product_color'] ?>" checked>
                                            <label class="<?php echo $color['product_color'] ?>" for="<?php echo $color['product_color'] ?>"></label>
                            <?php
                                            $kt = true;
                                            break;
                                        }
                                    }
                                    if($kt == false) {
                            ?>
                                        <input type="checkbox" id="<?php echo $a ?>" name="<?php echo $a ?>">
                                        <label class="<?php echo $a ?>" for="<?php echo $a ?>"></label>
                            <?php
                                    }
                                }
                            ?>
                        </div>
                        <input type="submit" value="Sửa sản phẩm">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<style>
    /* Ẩn nút radio mặc định */
    input[type="checkbox"] {
        display: none;
    }
    /* Thiết lập kiểu của label để tạo ra một giao diện tương tác như nút radio */
    input[type="checkbox"] + label {
        display: inline-block;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        cursor: pointer;
        border: 1px solid #ccc;
        /* margin-right: 4px; */
        transition: all 0.3s ease-in-out;
    }
    /* Khi nút radio được chọn, thay đổi màu nền của label */
    input[type="checkbox"]:checked + label {
        width: 30px;
        height: 30px;
    }
</style>
<script>
// Nhận dữ liệu từ PHP thông qua biến PHP
let phpData = <?php echo $jsonData; ?>;

document.getElementById("category_id").addEventListener("change", function() {
    // Lấy giá trị của option được chọn
    let selectedValue = this.value;

    let arr = [];
    phpData.forEach(function(value) {
        if (selectedValue == value['category_id']) {
            arr.push(value);
        }
    });

    let product_type_id = document.getElementById('product_type_id');

    let htmls = []; 

    htmls.push('<option value="#">--Vui lòng chọn--</option>');
    arr.forEach(function(value) { 
        let code = `<option value="${value['product_type_id']}">${value['product_type_name']}</option>`;
        htmls.push(code); 
    });

    let html = htmls.join('');

    product_type_id.innerHTML = html;
});
</script>
</html>

<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>

<script>
    ClassicEditor
        .create( document.querySelector( '#textarea' ) )
        .catch( error => {
            console.error( error );
    } );
</script>