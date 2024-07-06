export function product_list(items) {
    // 選擇要顯示陣列內容的元素
    const product_list = document.getElementById('product-list');

    // 將陣列的每個元素新增到 arrayContainer 內
    items.forEach(item => {
        const item_container = document.createElement('div');
        const button_container = document.createElement('button');
        const info_container = document.createElement('div');
        const img_container = document.createElement('div');
        const item_infos = item.split(",");
        item_container.className  = 'col-6 col-lg-4 mb-3';
        info_container.className  = 'info-container';
        img_container.className  = 'img-container';
        const item_img1 = document.createElement('img');
        const item_img2 = document.createElement('img');
        const item_name = document.createElement('p');
        const price = document.createElement('p');
        item_img1.src = item_infos[0];
        item_img2.src = item_infos[0];
        item_name.textContent = item_infos[1];
        price.textContent = item_infos[2];
        price.className  = 'price';
        info_container.appendChild(item_name);
        info_container.appendChild(price);
        img_container.appendChild(item_img1);
        button_container.className = 'product-button';
        button_container.appendChild(img_container);
        button_container.appendChild(info_container);
        
        // 展開視窗
        const window_container = document.createElement('div');
        window_container.className  = 'info-window';
        window_container.appendChild(item_img2);
        button_container.appendChild(window_container);

        item_container.appendChild(button_container);
        product_list.appendChild(item_container);
    });

    $(document).ready(function() {
        $(".product-button").on("click", function() {
            $(this).find(".info-window").toggle();
        });
        $(".info-window").on("click", function() {
            $(this).find(".info-window").hide();
        });
    });
}