    <!-- BEGIN SLIDER -->
    <div id="product">
        <div class="grid">
            <div class="path">
                <a href="./index.php">Trang chủ</a>
                <span>&#8594;</span>
                <a href="#"><?php echo $category['category_name'] ?></a>
                <span>&#8594;</span>
                <a href="./index.php?controller=website&page=product_type&product_type_id=<?php echo $product_type['product_type_id'] ?>&p=1&f=f"><?php echo $product_type['product_type_name'] ?></a>
                <span>&#8594;</span>
                <a href="#"><?php echo $product['product_name'] ?></a>
            </div>

            <div class="product__container">
                <div class="product__left">
                    <div class="product__img--big">
                        <img src="./model/uploads/<?php echo $product['product_img']?>" alt="">
                        <div id="result__zoom--img"></div>
                    </div>
                    <div class="product__img--small">
                        <span class="product__btn--up">&#8743;</span>
                        <div class="product__img--small-img">
                            <img src="./model/uploads/<?php echo $product['product_img']?>" alt="">
                            <?php
                            foreach($product_img_desc as $img_item) {
                            ?>
                                <img src="./model/uploads/<?php echo $img_item['product_img_desc'] ?>" alt="">
                            <?php
                            }
                            ?>
                        </div>
                        <span class="product__btn--down">&#8744;</span>
                    </div>
                </div>
                <div class="product__right">
                    <form action="" method="POST">
                        <div class="product__right--top">
                            <div class="product__name">
                                <h1><?php echo $product['product_name'] ?></h1>
                            </div>
                            <div class="product__price">
                                <strong><?php echo $product['product_price_new'] ?>₫</strong>
                                <span><?php echo $product['product_price'] ?>₫</span>
                            </div>
                            <div class="product__color">
                                <p>Màu sắc: </p>
                                <div class="product__color--item">
                                    <?php
                                    $count = 0;
                                    foreach($product_color as $color_item) {
                                        if($count == 0) {
                                            $count++;
                                    ?>
                                            <input type="radio" id="<?php echo $color_item['product_color'] ?>" name="color" value="<?php echo $color_item['product_color'] ?>" checked>
                                            <label class="<?php echo $color_item['product_color'] ?>" for="<?php echo $color_item['product_color'] ?>"></label>
                                    <?php
                                            continue;
                                        }
                                    ?>
                                            <input type="radio" id="<?php echo $color_item['product_color'] ?>" name="color" value="<?php echo $color_item['product_color'] ?>">
                                            <label class="<?php echo $color_item['product_color'] ?>" for="<?php echo $color_item['product_color'] ?>"></label>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="product__size">
                                <input type="radio" name="size" id="s" value="s" checked>
                                <label for="s">S</label>
        
                                <input type="radio" name="size" id="m" value="m">
                                <label for="m">M</label>
        
                                <input type="radio" name="size" id="l" value="l">
                                <label for="l">L</label>
        
                                <input type="radio" name="size" id="xl" value="xl">
                                <label for="xl">XL</label>
        
                                <input type="radio" name="size" id="xxl" value="xxl">
                                <label for="xxl">XXL</label>
                            </div>
                            <div class="product__quantity">
                                <label for="numberInput">Số lượng:</label>
                                <div class="product__quantity--input">
                                    <input type="number" id="numberInput" name="numberInput" value="1" min="1" max="<?php echo $product['product_quantity'] ?>" step="1" readonly>
        
                                    <span class="decrement" onclick="decrement()">-</span>
                                    <span class="increment" onclick="increment()">+</span>
                                </div>
                            </div>
                            <div class="product__action">
                                <input type="submit" value="Thêm vào giỏ" class="product__action--cart" name="cart">
                                <input type="submit" value="Mua hàng" class="product__action--buy" name="buy">
                            </div>
                        </div>
                    </form>
                    <div class="product__right--bottom">
                        <div class="product__right--bottom-title"><h1>Giới thiệu</h1></div>
                        <?php echo $product['product_desc'] ?>
                    </div>
                    <div class="product__right--collapsible">
                        <i class="fas fa-solid fa-chevron-down" onclick="toggleDescriptionExpansion()"></i>
                    </div>
                    <!--  -->
                </div>
            </div>
        </div>
    </div>

    <!-- <script src="./templates/access/js/js_product.js"></script> -->


    <style>
        .product__img--big {
            width: 80%;
            height: 826px;

            position: relative;
            overflow: hidden;
        }

        .product__img--big img {
            width: 100%;

            transition: transform 0.3s ease;
            transform-origin: 50% 50%;
            cursor: none;
            /* cursor: zoom-in; */
        }

        /* .product__img--big:hover img {
            transform: scale(1.2);
        } */

        #result__zoom--img {
            z-index: 99;
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 1px solid #ccc;
            position: fixed;
            transform: translate(-50%, -50%);
            pointer-events: none;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
        }

        .hide {
            display: none;
        }

        .product__img--big:hover img {
            transform: scale(1);
        }
    </style>

    <script>
        let imgSmall = document.querySelectorAll('.product__img--small-img img');


        // setting vi tri ban dau cho cac anh mo ta
        imgSmall.forEach(function(img, index) {
            img.style.top = `${index * 188}px`;
        });


        let btnUp = document.querySelector('.product__btn--up');
        let btnDown = document.querySelector('.product__btn--down');


        // bat su kien nut len de di chuyen anh len
        btnDown.addEventListener("click", function() {
            let lastImageTop = parseInt(imgSmall[imgSmall.length - 1].style.top);
            if (lastImageTop !== 564) {
                imgSmall.forEach(function(img) {
                    let topOld = parseInt(img.style.top);
                    img.style.top = `${topOld - 188}px`;
                });
            }
        });


        // bat su kien nut xuong de di chuyen anh xuong
        btnUp.addEventListener("click", function() {
            let firstImageTop = parseInt(imgSmall[0].style.top);
            if (firstImageTop !== 0) {
                imgSmall.forEach(function(img) {
                    let topOld = parseInt(img.style.top);
                    img.style.top = `${topOld + 188}px`;
                });
            }
        });


        // bat su kien click vao anh de doi anh chinh
        imgSmall.forEach(function(img, index) {
            img.addEventListener("click", function() {
                let imgSrc = img.getAttribute('src');

                let bigImg = document.querySelector('.product__img--big img');

                bigImg.setAttribute('src', `${imgSrc}`);
            })
        });


        // hàm tăng số lượng áo mua
        function increment() {
            let numberInput = document.getElementById('numberInput');
            let currentValue = parseInt(numberInput.value);
            
            // Kiểm tra điều kiện max trước khi tăng giá trị
            if (currentValue != parseInt(numberInput.max)) {
                let newValue = currentValue + 1;
                numberInput.value = newValue;
            }
        }

        // hàm giảm số lượng áo mua
        function decrement() {
            let numberInput = document.getElementById('numberInput');
            let currentValue = parseInt(numberInput.value);

            // Kiểm tra điều kiện min trước khi giảm giá trị
            if (currentValue != parseInt(numberInput.min)) {
                let newValue = currentValue - 1;
                numberInput.value = newValue;
            }
        }

        // hàm bật/tắt mở rộng mô tả
        function toggleDescriptionExpansion() {
            let description = document.querySelector('.product__right--bottom');
            let expansionIcon = document.querySelector('.product__right--collapsible .fas.fa-chevron-down');

            // lay do dai cua phan mo ta da duoc css ben file style.css
            let computedHeight = window.getComputedStyle(description).maxHeight;

            if(computedHeight == '180px') {
                description.style.maxHeight = '1000px';
                expansionIcon.style.transform = 'rotate(180deg)';
            } else {
                description.style.maxHeight = '180px';
                expansionIcon.style.transform = 'rotate(0deg)';
            }
        }

        // Hiện thị tên màu đâu tiên khi mở trang đã được checked
        let inputColor = document.querySelectorAll('input[name="color"]');
        let colorName = document.querySelector('.product__color p');

        switch (inputColor[0].id) {
            case 'yellow':
                colorName.textContent = 'Màu sắc: Vàng';
                break;
            case 'green':
                colorName.textContent = 'Màu sắc: Xanh';
                break;
            case 'pink':
                colorName.textContent = 'Màu sắc: Hồng';
                break;
            case 'red':
                colorName.textContent = 'Màu sắc: Đỏ';
                break;
            case 'gray':
                colorName.textContent = 'Màu sắc: Xám';
                break;
            case 'white':
                colorName.textContent = 'Màu sắc: Trắng';
                break;
            case 'brown':
                colorName.textContent = 'Màu sắc: Nâu';
                break;
            case 'black':
                colorName.textContent = 'Màu sắc: Đen';
                break;
            default:
                colorName.textContent = '';
                break;
        }


        // Thay đổi tên màu khi lick vào các loại màu khác nhau
        inputColor.forEach(function(color, index) {
            color.addEventListener("click", function() {
                switch (color.id) {
                    case 'yellow':
                        colorName.textContent = 'Màu sắc: Vàng';
                        break;
                    case 'green':
                        colorName.textContent = 'Màu sắc: Xanh';
                        break;
                    case 'pink':
                        colorName.textContent = 'Màu sắc: Hồng';
                        break;
                    case 'red':
                        colorName.textContent = 'Màu sắc: Đỏ';
                        break;
                    case 'gray':
                        colorName.textContent = 'Màu sắc: Xám';
                        break;
                    case 'white':
                        colorName.textContent = 'Màu sắc: Trắng';
                        break;
                    case 'brown':
                        colorName.textContent = 'Màu sắc: Nâu';
                        break;
                    case 'black':
                        colorName.textContent = 'Màu sắc: Đen';
                        break;
                    default:
                        colorName.textContent = '';
                        break;
                }
            });
        });

        // Hiện thị tiền sản phẩm theo kiểu vnđ
        let productPriceNew = document.querySelectorAll('.product__price strong');
        let productPrice = document.querySelectorAll('.product__price span');

        productPriceNew.forEach(function(item, index) {
            let productPriceNewValue = parseInt(item.textContent);
            let formattedPriceNew = new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(productPriceNewValue);
            item.textContent = formattedPriceNew;

            let productPriceValue = parseInt(productPrice[index].textContent);
            let formattedPrice = new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(productPriceValue);
            productPrice[index].textContent = formattedPrice;
        });

        // Zoom ảnh to của sản phẩm
        let imgZoom = document.querySelector('.product__img--big img');
        let zoom = document.getElementById('result__zoom--img');
        let scope = 4;

        imgZoom.addEventListener('mousemove', function (e) {
            zoom.classList.remove('hide');

            zoom.style.top = `${e.clientY}px`;
            zoom.style.left = `${e.clientX}px`;

            zoom.style.backgroundSize = `1000px 1000px`;

            var percentMouseOfWidth = (e.offsetX / this.offsetWidth) * 100;
            var percentMouseOfHeight = (e.offsetY / this.offsetHeight) * 100;

            zoom.style.backgroundPosition = `${percentMouseOfWidth}% ${percentMouseOfHeight}%`;

            let imgZoomSource = e.target.getAttribute('src');
            zoom.style.backgroundImage = `url('${imgZoomSource}')`;
        })

        imgZoom.addEventListener('mouseleave', function (e) {
            zoom.classList.add('hide');
        })
    </script>