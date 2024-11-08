<?php
include 'header.php';
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
    <?php
    ?>
    <div class="container">
        <div class="cart-content" style="display: flex;">
            <div class="cart-content-left">
                <?php
                ?>
                 <table>
                    <tr>
                        <th>STT</th>
                        <th>Ảnh sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>Size</th>
                        <th>SL</th>
                        <th>Thành tiền</th>
                        <th>Thao tác</th>
                    </tr>
                    <?php
                    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                        $i = 0;
                        $total = 0; // Tổng giá trị giỏ hàng
                        foreach ($_SESSION['cart'] as $key => $item) {
                            $i++;
                            $id = isset($item['id']) ? $item['id'] : 0;
                            $price = isset($item['price']) ? $item['price'] : 0;
                            $quantity = isset($item['quantity']) ? $item['quantity'] : 1;
                            $name = isset($item['name']) ? $item['name'] : 'Sản phẩm không có tên';
                            $size = isset($item['size']) ? $item['size'] : 'Không có kích thước';
                            $image = isset($item['image']) ? $item['image'] : 'default_image.jpg';

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
                                    <!-- Nút giảm số lượng -->
                                    <!-- <a href="addcart.php?minus=<?php echo $id; ?>&size=<?php echo urlencode($size); ?>"><button>-</button></a> -->
                                    <?php echo $quantity; ?>
                                    <!-- Nút tăng số lượng -->
                                    <!-- <a href="addcart.php?plus=<?php echo $id; ?>&size=<?php echo urlencode($size); ?>"><button>+</button></a> -->
                                </td>
                                <td><?php echo number_format($thanhtien, 0, ',', '.'); ?> đ</td>
                                <td>
                                    <!-- Nút xóa sản phẩm -->
                                    <a href="addcart.php?delete=<?php echo $id; ?>&size=<?php echo urlencode($size); ?>">Xóa</a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                        <tr>
                            <td colspan="5"><strong>Tổng cộng:</strong></td>
                            <td><strong><?php echo number_format($total, 0, ',', '.'); ?> đ</strong></td>
                            <td>
                                <a href="addcart.php?deleteall=1"><button>Xóa tất cả</button></a>
                            </td>
                        </tr>
                    <?php
                    } else {
                        echo "<tr><td colspan='7'>Giỏ hàng của bạn đang trống.</td></tr>";
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
                    <?php if (isset($_SESSION['user'])): ?>
                        <button><a href="payment.php">Thanh toán</a></button>
                    <?php else: ?>
                        <button><a href="../login/signup.php?act=register">Đăng ký để thanh toán</a></button>
                    <?php endif; ?>
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