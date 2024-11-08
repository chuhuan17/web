<?php
include 'header.php';
$db = new Database();
$conn = $db->conn;

$query_chitiet = "SELECT * FROM products, brands WHERE products.brand_id = brands.brand_id AND products.product_id = '$_GET[product_id]' LIMIT 1";
$result_chitiet = $db->conn->query($query_chitiet);
if ($result_chitiet->num_rows > 0) {
    while ($chitiet = $result_chitiet->fetch_assoc()) {
?>

        <div class="product">
            <div class="container">
                <?php
                $product_id = isset($_GET['product_id']) ? $_GET['product_id'] : null;
                if ($product_id) {
                    // Truy vấn sản phẩm và danh mục từ database
                    $query = "
                    SELECT products.product_name, brands.brand_name 
                    FROM products 
                    JOIN brands ON products.brand_id = brands.brand_id 
                    WHERE products.product_id = '$product_id'";

                    $result = $db->conn->query($query);

                    if ($result->num_rows > 0) {
                        $product = $result->fetch_assoc();
                        $brand_name = $product['brand_name'];
                        $product_name = $product['product_name'];
                    }
                }
                ?>
                <div class="product-top row" style="display: flex;">
                    <p>Trang chủ</p> <span>&#10230;</span>
                    <p><?php echo htmlspecialchars($brand_name); ?></p> <span>&#10230;</span>
                    <p><?php echo htmlspecialchars($product_name); ?></p>
                </div>
                <form action="addcart.php?product_id=<?php echo $chitiet['product_id'] ?>" method="post">
                    <div class="product-content row">
                        <div class="product-content-left row">
                            <div class="product-content-left-big-img">
                                <?php
                                $product_id = isset($_GET['product_id']) ? $_GET['product_id'] : null;
                                if ($product_id) {
                                    $query = "SELECT * FROM products WHERE product_id = '$product_id'";
                                    $result = $db->conn->query($query);
                                    if ($result->num_rows > 0) {
                                        $product = $result->fetch_assoc();
                                ?>
                                        <img src="../uploads/<?php echo $product['product_image']; ?>" alt="Product Image">
                                <?php
                                    }
                                }
                                ?>
                            </div>
                            <div class="product-content-left-small-img">
                                <?php
                                // Truy vấn để lấy các ảnh mô tả từ bảng hình ảnh
                                $query_images = "SELECT img_url FROM product_img WHERE product_id = '$product_id'";
                                $result_images = $db->conn->query($query_images);

                                if ($result_images->num_rows > 0) {
                                    while ($image = $result_images->fetch_assoc()) {
                                ?>
                                        <img src="../uploads/<?php echo $image['img_url']; ?>" alt="Product Description Image" style="max-width: 100%; height: auto; margin: 10px;">
                                <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>

                        <div class="product-content-right">
                            <div class="product-content-right-product-name">
                                <?php
                                $query_name = "SELECT * FROM products WHERE product_id = '$product_id'";
                                $result_name = $db->conn->query($query_name);
                                if ($result_name->num_rows > 0) {
                                    while ($product_name = $result_name->fetch_assoc()) {
                                ?>
                                        <h1><?php echo $product_name['product_name']; ?></h1>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                            <div class="product-content-right-product-price">
                                <?php
                                $query_price = "SELECT * FROM products WHERE product_id = '$product_id'";
                                $result_price = $db->conn->query($query_name);
                                if ($result_price->num_rows > 0) {
                                    while ($product_price = $result_price->fetch_assoc()) {
                                ?>
                                        <p><?php echo number_format($product_price['product_price'], 0, ',', '.') . " VND"; ?></p>

                                <?php
                                    }
                                }
                                ?>
                            </div>
                            <div class="product-content-right-product-color">
                                <?php
                                $query_color = "SELECT * FROM products WHERE product_id = '$product_id'";
                                $result_color = $db->conn->query($query_name);
                                if ($result_color->num_rows > 0) {
                                    while ($product_color = $result_color->fetch_assoc()) {
                                ?>
                                        <p><?php echo ($product_color['product_color_name']); ?></p>
                                <?php
                                    }
                                }
                                ?>
                                <div class="product-content-right-product-color-img">
                                    <?php
                                    // Truy vấn để lấy các ảnh mô tả từ bảng hình ảnh
                                    $query_color_img = "SELECT * FROM products WHERE product_id = '$product_id'";
                                    $result_color_img = $db->conn->query($query_color_img);

                                    if ($result_color_img->num_rows > 0) {
                                        while ($color_img = $result_color_img->fetch_assoc()) {
                                    ?>
                                            <img src="../uploads/<?php echo $color_img['product_color_image']; ?>" alt="Product Description Image" style="max-width: 100%; height: auto; margin: 10px;">
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="product-content-right-product-size">
                                <p style="font-weight: bold;">Size:</p>
                                <div class="product_sizes">
                                    <?php
                                    $query_size = "SELECT * FROM product_sizes WHERE product_id = '$product_id'";
                                    $result_size = $db->conn->query($query_size);
                                    if ($result_size->num_rows > 0) {
                                        while ($product_size = $result_size->fetch_assoc()) {
                                    ?>
                                            <!-- Radio button cho mỗi kích thước -->
                                            <label>
                                                <input type="radio" name="selected_size" value="<?php echo $product_size['size_name']; ?>" required>
                                                <?php echo $product_size['size_name']; ?>
                                            </label>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>


                            <div class="product-quantity">
    <label>Số lượng:</label>
    <div class="quantity-controls">
        <button type="button" class="quantity-btn minus">-</button>
        <input type="number" name="quantity" value="1" min="1" max="99" style="width: 50px; text-align: center;">
        <button type="button" class="quantity-btn plus">+</button>
    </div>
</div>


                            <div class="product-content-right-product-button">
                                <button name="addcart" type="submit"><i class="fas fa-shopping-cart"></i> THÊM VÀO GIỎ HÀNG</button>
                                <button>
                                    <p>TÌM TẠI CỬA HÀNG</p>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        </div>
        <script>
    const minusBtn = document.querySelector('.minus');
    const plusBtn = document.querySelector('.plus');
    const quantityInput = document.querySelector('input[name="quantity"]');

    minusBtn.addEventListener('click', () => {
        let currentValue = parseInt(quantityInput.value);
        if (currentValue > 1) {
            quantityInput.value = currentValue - 1;
        }
    });

    plusBtn.addEventListener('click', () => {
        let currentValue = parseInt(quantityInput.value);
        if (currentValue < 99) {
            quantityInput.value = currentValue + 1;
        }
    });
</script>
        </section>
        < <?php
        }
    }
    include 'footer.php';
            ?>