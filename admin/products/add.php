<div class="contentManager contentManager--product">
            <div class="contentManager--product__header">
                <div class="contentManager--product__header--title">
                    <h2 style="color: #ffffff;">Thêm sản phẩm mới</h2>
                </div>
                <div class="contentManager--product__header--control">
                    <span><i class="fa-solid fa-house"></i>Trang chủ</span> <span style="padding: 0 10px; font-size: 22px;">></span> <span><i class="fa-brands fa-product-hunt"></i>Quản lý sản phẩm</span><span style="padding: 0 10px; font-size: 22px;">></span>                    <span>Thêm sản phẩm mới</span>
                </div>
            </div>
            <?php if(isset($notification)): ?>
                <div class="alert alert-success">
                    <?= $notification ?>
                </div>
            <?php endif ?>
            <div class="contentManager--product__footer contentManager--product__footer--addProduct">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form--left">
                        <div class="name">
                            <p>Tên sản phẩm:</p>
                            <input class="name" name="nameProduct" value="<?= $name ?? "" ?>" style=" background-color: #000000;" type="text" placeholder="Nhập tên sản phẩm...">
                            <p style="color: red; padding: 8px 0 0 8px; font-size: 14px;"><?= $errors['name'] ?? "" ?></p>
                        </div>
                        <div class="image">
                            <p>Ảnh sản phẩm:</p>
                            <input type="file" name="image" style="background-color: #0F172A;">
                            <!-- <img width="150px" src="src/image/iphone14.jpg" alt=""> -->
                            <p style="color: red; padding: 8px 0 0 8px; font-size: 14px;"><?= $errors['image'] ?? "" ?></p>
                        </div>
                        <div class="imgaes">
                            <p>Ảnh mô tả sản phẩm:</p>
                            <input type="file" name="images[]" multiple="multiple" style="background-color: #0F172A;">
                            <p style="color: red; padding: 8px 0 0 8px; font-size: 14px;"><?= $errors['images'] ?? "" ?></p>
                        </div>
                        <div class="description">
                            <p>Mô tả sản phẩm:</p>
                            <textarea name="description" id="" cols="30" rows="10"><?= $description ?? "" ?></textarea>
                        </div>
                    </div>
                    <div class="form--right">
                        <div class="category">
                            <p>Danh mục sản phẩm:</p>
                            
                            <select name="category" id="">
                                <option value="" hidden>-- Chọn danh mục sản phẩm --</option>
                                <?php foreach($listCategories as $value): ?>
                                    <option value="<?= $value['id'] ?>" <?= (isset($category)&&$category==$value['id']) ? "selected" : ""  ?> ><?= $value['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <p style="color: red; padding: 8px 0 0 8px; font-size: 14px;"><?= $errors['category'] ?? "" ?></p>
                            
                        </div>
                        <div class="status">
                            <p>Trạng thái hoạt động:</p>
                            <select name="status" id="">
                                <option value="" hidden>-- Chọn trạng thái --</option>
                                <option value="0"  >Active</option>
                                <option value="1"  >Disable</option>
                            </select>
                            <p style="color: red; padding: 8px 0 0 8px; font-size: 14px;"><?= $errors['status'] ?? "" ?></p>
                            
                        </div>
                        <div class="pice">
                            <p>Giá sản phẩm:</p>
                            <input type="number" name="price" value="<?= $price ?? "" ?>" >
                            <p style="color: red; padding: 8px 0 0 8px; font-size: 14px;"><?= $errors['price'] ?? "" ?></p>
                        </div>
                        <div class="discount">
                            <p>% Khuyến mại:</p>
                            <input min="0" max="100" type="number" name="discount" value="<?= $discount ?? "" ?>">
                        </div>
                        <div class="quantity">
                            <p>Số lượng:</p>
                            <input min="0" type="number" name="quantity" value="<?= $quantity ?? "" ?>" >
                            <p style="color: red; padding: 8px 0 0 8px; font-size: 14px;"><?= $errors['quantity'] ?? "" ?></p>
                        </div>
                        <div class="special">
                            <input type="checkbox" id="special" name="hotProduct">
                            <label for="special" style="font-size: 15px;">Sản phẩm đặc biệt</label>
                        </div>
                        <div class="btn__action btn__action--addProduct">
                            <button type="submit" class="btn--addProduct" name="btn--addProduct">Thêm sản phẩm</button>
                            <a href="index.php?actAdmin=showProduct" style="font-size: 13.333px;" >Quay lại</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script>
        CKEDITOR.replace('description');
    </script>
    <script src="../src/js/animation.js"></script>
</body>

</html>