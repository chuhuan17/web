<?php
include 'header.php';
session_start();
?>

    <!---------------------- Cart  --------------------------->
    <section class="cart">
        <div class="container">
            <div class="cart-top-wrap">
                <div class="cart-top">
                    <div class="cart-top-cart">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="cart-top-cart">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="cart-top-cart">
                        <i class="fas fa-money-check-alt"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="cart-content" style="display: flex;">
                <div class="cart-content-left">

                    <table>
                        <tr>
                            <th>STT</th>
                            <th>Ảnh sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>Size</th>
                            <th>SL</th>
                            <th>Thành tiền</th>
                        </tr>
                        <?php
                        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                            $i = 0;
                            $total = 0;
                            foreach ($_SESSION['cart'] as $key => $item) {
                                $i++;
                                // Kiểm tra từng trường của item để đảm bảo không bị lỗi
                                $id = isset($item['id']) ? $item['id'] : 0;
                                $price = isset($item['price']) ? $item['price'] : 0;
                                $quantity = isset($item['quantity']) ? $item['quantity'] : 1;
                                $name = isset($item['name']) ? $item['name'] : 'Sản phẩm không có tên';
                                $size = isset($item['size']) ? $item['size'] : 'Không có kích thước';
                                $image = isset($item['image']) ? $item['image'] : 'default_image.jpg'; // Hình ảnh mặc định nếu không có

                                // Tính thành tiền cho từng sản phẩm
                                $thanhtien = $price * $quantity;
                                $total += $thanhtien;
                        ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><img src="../uploads/<?php echo $image; ?>" alt="Hình ảnh sản phẩm" style="width:50px;height:50px;"></td>
                                    <td><?php echo $name; ?></td>
                                    <td><?php echo $size; ?></td>
                                    <td>
                                        <a href="addcart.php?minus=<?php echo $id; ?>"><button class="quantity-btn minus">-</button></a>
                                        <?php echo $quantity; ?>
                                        <a href="addcart.php?plus=<?php echo $id; ?>"><button class="quantity-btn plus">+</button></a>:
                                    </td>
                                    <td><?php echo number_format($thanhtien, 0, ',', '.'); ?> đ</td>
                                    <td><a href="addcart.php?delete=<?php echo $id ?>">Xóa</a></td>
                                </tr>
                            <?php
                            }
                            ?>
                            <tr>
                                <td colspan="5">Tổng cộng:</td>
                                <td><?php echo number_format($total, 0, ',', '.'); ?> vnđ</td>
                                <td><a href="addcart.php?deleteall=1">Xóa tất cả</a></td>
                            </tr>
                        <?php
                        } else {
                            echo "<tr><td colspan='6'>Giỏ hàng của bạn đang trống.</td></tr>";
                        }
                        ?>
                    </table>
                </div>
                <div class="cart-content-right">

                    <div class="cart-content-right-text">
                        <p>Bạn sẽ được miễn phí ship khi đơn hàng có tổng giá trị 400000</p>
                        <p style="color: red; font-weight: bold;">Mua thêm 110000<sub>đ</sub> để được miễn phí ship</p>
                    </div>
                    <div class="cart-content-right-button">
                        <button><a href=""></a>Tiếp tục mua sắm</button>
                        <button><a href="delivery.php">Thanh toán</a></button>
                    </div>
                    <div class="cart-content-right-dangnhap">
                        <p>Tai khoan IVY</p>
                        <p>Hay <a href="">Dang nhap</a>tai khoan cua ban de tich diem thanh vien</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ------------------ Footer -------------------------->
</html>
<?php
include 'footer.php';
?>