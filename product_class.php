<?php
include "../database/database.php";
?>
<?php
class product
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }
    public function insert_product()
    {
        // Nhận dữ liệu từ POST
        $product_name = $_POST['product_name'];
        $brand_id = $_POST['brand_id'];
        $product_price = $_POST['product_price'];
        $product_desc = $_POST['product_description'];
        $product_color_name = $_POST['product_color_name']; // Lấy tên màu từ form
        // Xử lý ảnh màu sản phẩm
        $color_image = $_FILES['product_color_image']['name'];
        $tmp_name = $_FILES['product_color_image']['tmp_name'];
        move_uploaded_file($tmp_name, "../uploads/" . $color_image);
        // Xử lý ảnh sản phẩm chính
        $product_img = $_FILES['product_image']['name'];
        move_uploaded_file($_FILES['product_image']['tmp_name'], "../uploads/" . $product_img);

        // Thêm sản phẩm vào bảng products
        $query = "INSERT INTO products (
                product_name,
                brand_id,
                product_price,
                product_description,
                product_color_name,
                product_color_image,
                product_image
            ) VALUES (
                '$product_name',
                '$brand_id',
                '$product_price',
                '$product_desc',
                '$product_color_name',
                '$color_image',
                '$product_img'
            )";

        $result = $this->db->insert($query);

        if ($result) {
            // Lấy ID sản phẩm vừa thêm
            $query = "SELECT * FROM products ORDER BY product_id DESC LIMIT 1";
            $result = $this->db->select($query)->fetch_assoc();
            $product_id = $result['product_id'];

            // Xử lý kích thước sản phẩm
            if (isset($_POST['product_size'])) {
                foreach ($_POST['product_size'] as $size) {
                    $query_size = "INSERT INTO product_sizes (product_id, size_name) VALUES ('$product_id', '$size')";
                    $this->db->insert($query_size);
                }
            }

            // Xử lý ảnh mô tả
            $filename = $_FILES['product_img_desc']['name'];
            $file_tmp = $_FILES['product_img_desc']['tmp_name'];

            if (is_array($filename)) {
                foreach ($filename as $key => $value) {
                    // Đường dẫn nơi lưu file
                    $target_file = '../uploads/' . basename($value);

                    // Di chuyển file từ thư mục tạm tới thư mục đích
                    if (move_uploaded_file($file_tmp[$key], $target_file)) {
                        // Sau khi file được di chuyển thành công, chèn vào cơ sở dữ liệu
                        $query_img = "INSERT INTO product_img (product_id, img_url) VALUES ('$product_id', '$value')";
                        $result_img = $this->db->insert($query_img);

                        if (!$result_img) {
                            echo "Error inserting image: " . $this->db->error;
                        }
                    } else {
                        echo "Failed to upload file: $value";
                    }
                }
            }
            return true; // Hoặc có thể trả về $result
        } else {
            echo "Error inserting product: " . $this->db->error;
            return false;
        }
    }
    public function show_brand()
    {
        $query = "SELECT * FROM brands ORDER BY brand_id DESC";
        $result = $this->db->select($query);
        return $result;
    }
    public function show_product()
    {
        $query = "SELECT products.*, products.product_image, brands.brand_name 
                  FROM products
                  INNER JOIN brands ON products.brand_id = brands.brand_id
                  ORDER BY products.product_id DESC";
        $result = $this->db->select($query);
        return $result;
    }
    public function delete_product($product_id)
    {
        $query = "DELETE FROM products WHERE product_id = '$product_id'";
        $result = $this->db->delete($query);
        header('Location: productlist.php');
        return $result;
    }
    public function get_product($product_id){
        $query= "SELECT * FROM products WHERE product_id = '$product_id'";
        $result = $this ->db->select($query);
        return $result;
    }
    public function update_product($product_id,  $product_name) {
        $query = "UPDATE products SET  product_name = '$product_name' WHERE product_id = '$product_id'";
        $result = $this->db->update($query);
        return $result;
    }
}
