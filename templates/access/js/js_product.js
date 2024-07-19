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