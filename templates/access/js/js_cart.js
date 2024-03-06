let quantities = document.querySelectorAll('.cart__left tr td:nth-child(5) input');
let prices = document.querySelectorAll('.cart__left tr td:nth-child(6)');
let totalSums = document.querySelectorAll('.cart__left tr td:nth-child(7) input');
let select = document.querySelectorAll('.cart__left tr td:nth-child(8) input');

let tongsanpham = document.querySelector('.tongsanpham');
let tongtienhang = document.querySelector('.tongtienhang');
let thanhtien = document.querySelector('.thanhtien');

const currencyFormatter = new Intl.NumberFormat('vi-VN', {
    style: 'currency',
    currency: 'VND',
});

// thay doi tong tien hang cho tung san pham
prices.forEach(function(priceElement) {
    let price = parseFloat(priceElement.textContent.replace(/[^\d]/g, '')); // Loại bỏ tất cả các ký tự không phải số
    priceElement.textContent = currencyFormatter.format(price);
});

// kiem tra xem san pham day co duoc tick hay khong
function checkOk(index) {
    if(select[index].checked) {
        return true;
    }
    return false;
}

// ham update tong tien hang cho toan bo don hang
function updateTotal(index) {
    let quantity = parseInt(quantities[index].value);
    let price = parseFloat(prices[index].textContent.replace(/[^\d]/g, '')); // Loại bỏ tất cả các ký tự không phải số
    let totalAmount = quantity * price;
    totalSums[index].value = currencyFormatter.format(totalAmount);

    // tong san pham cho ben right
    let tong1 = 0;
    quantities.forEach(function(quantity, indexS) {
        if(checkOk(indexS)) {
            tong1 += parseInt(quantity.value);   
        }
    })
    tongsanpham.innerHTML = tong1;

    // tong tien hang cho ben right
    let tong2 = 0;
    totalSums.forEach(function(totalSum, indexS) {
        if(checkOk(indexS)) {
            let total = parseFloat(totalSum.value.replace(/[^\d]/g, ''));
            tong2 += total;
        }
    });
    tongtienhang.innerHTML = currencyFormatter.format(tong2);

    // thanh tien cho ben right
    let tong3 = tong1 * 30000 + tong2;
    thanhtien.innerHTML = currencyFormatter.format(tong3);
}


// dung` ham update tong tien hang cho toan bo don hang
totalSums.forEach(function(total, index) {
    updateTotal(index);

    quantities[index].addEventListener('input', function() {
        updateTotal(index);
    });

    select[index].addEventListener('input', function() {
        if(checkOk(index)) {
            updateTotal(index);
        }
        else {
            updateTotal(index);
        }
    });
});

console.log(select);