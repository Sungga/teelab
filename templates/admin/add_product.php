


<div class="admin__right">
                    <form action="" method="post" enctype="multipart/form-data">
                        <label for="category_id">Tên danh mục</label>
                        <select name="category_id" id="category_id">
                            <option value="#">--Vui lòng chọn--</option>
                            <?php
                            foreach($categories as $category) {
                            ?>
                                <option value="<?php echo $category['category_id'] ?>"><?php echo $category['category_name'] ?></option>
                            <?php
                            }
                            ?>
                        </select>

                        <label for="product_type_id">Tên loại sản phẩm</label>
                        <select name="product_type_id" id="product_type_id">
                            
                        </select>
                        <label for="product_name">Tên sản phẩm</label>
                        <input type="text" name="product_name" id="" placeholder="Tên sản phẩm">

                        <label for="product_price">Giá sản phẩm</label>
                        <input type="text" name="product_price" id="" placeholder="Giá sản phẩm">

                        <label for="product_price_new">Giá mới</label>
                        <input type="text" name="product_price_new" id="">

                        <label for="product_desc">Mô tả</label>
                        <textarea name="product_desc" id="textarea" cols="30" rows="20"></textarea>

                        <label for="product_img">Ảnh sản phẩm</label>
                        <input type="file" name="product_img" id="">

                        <label for="product_img_desc">Ảnh mô tả</label>
                        <input type="file" name="product_img_desc[]" id="" multiple>
                        
                        <label for="quantity">Số lượng sản phẩm</label>
                        <input type="number" name="product_quantity" id="">

                        <div>
                                <input type="checkbox" id="yellow" name="yellow" checked>
                                <label class="yellow" for="yellow"></label>
    
                                <input type="checkbox" id="green" name="green">
                                <label class="green" for="green"></label>
    
                                <input type="checkbox" id="pink" name="pink">
                                <label class="pink" for="pink"></label>
    
                                <input type="checkbox" id="red" name="red">
                                <label class="red" for="red"></label>
    
                                <input type="checkbox" id="gray" name="gray">
                                <label class="gray" for="gray"></label>
    
                                <input type="checkbox" id="white" name="white">
                                <label class="white" for="white"></label>
    
                                <input type="checkbox" id="brown" name="brown">
                                <label class="brown" for="brown"></label>
    
                                <input type="checkbox" id="black" name="black">
                                <label class="black" for="black"></label>
                        </div>
                        <input type="submit" value="Thêm sản phẩm">
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

    // Hiển thị giá trị trong console
    // console.log("Selected option value: " + selectedValue);

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