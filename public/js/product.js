const getProductFromBack = async () => {
    let params = (new URLSearchParams(document.location.search));
    let id = params.get("id");
    const productResponse = await fetch(`http://localhost:8005/get/product?id=${id}`);
    const productJson = await productResponse.json();
    console.log(productJson)
    let product = document.getElementById('product');
    product.innerHTML =
        '<div class="product-name">\n' +
        `    <p class="h3">${productJson.title}</p>\n` +
        '</div>\n' +
        '    <div class="product-inner d-flex justify-content-between align-items-center">\n' +
        '        <div class="product-img">\n' +
        '            <img src="https://www.kstools.com/media/image/10/79/56/FOT_GES_ALG_917-0797-GB_SALL_AING_V15c91d4e3dd32e_600x600.jpg" alt="tools"/>\n' +
        '        </div>\n' +
        '        <div class="product-info">\n' +
        `            <p class="product-price" align="center">Price: $${productJson.price}</p>\n` +
        `            <p class="product-amount" align="center">In stock: ${productJson.amount}</p>\n` +
        '            <a class="btn btn-primary me-2" href="/order">Checkout</a>\n' +
        '            <a class="btn btn-primary" href="/cart/add">Add to Cart</a>\n' +
        '        </div>\n' +
        '    </div>\n' +
        '</section>\n' +
        '<section class="description">\n' +
        '    <div class="description-inner">\n' +
        '        <p class="fs-3 title">Description</p>\n' +
        `        <p class="description-title" align="justify">${productJson.description}</p>\n` +
        '    </div>'
}
getProductFromBack();