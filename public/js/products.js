const getProducts = async () => {
    const productResponse = await fetch('http://localhost:8005/get/products');
    const productJson = await productResponse.json();
    console.log(productJson.id);
    for (let i = 1; i < productJson.length; i++) {
       let product = document.getElementById('product' + i);
       product.innerHTML =
           '<div class="card">\n' +
           '   <img width="200px" height="200px" src="https://inlnk.ru/WRppd"/>\n' +
           '   <div class="card-body">\n' +
           '       <p class="card-text">' + productJson[i].title + '</p>\n' +
           '       <p class="card-text">' + 'Price: $' + productJson[i].price + '</p>\n' +
           '       <div class="card-btn d-flex justify-content-center align-items-center">\n' +
           '           <a class="btn btn-primary me-2"' + 'href="/product?id=' + productJson[i].id + '"' + '>View product</a>\n' +
           '           <a class="btn btn-primary px-4">Add to cart</a>\n' +
           '       </div>\n' +
           '   </div>\n' +
           '</div>\n'
    }
}
getProducts();