<?php
if (is_array($detailDm)) {
    extract($detailDm);
}
?>
<div class="contentManager contentManager--product">
    <div class="contentManager--product__header">
        <div class="contentManager--product__header--title">
            <h2 style="color: #ffffff;">Thêm sản phẩm mới</h2>
        </div>
        <div class="contentManager--product__header--control">
            <span><i class="fa-solid fa-house"></i>Trang chủ</span> <span style="padding: 0 10px; font-size: 22px;">></span> <span><i class="fa-brands fa-product-hunt"></i>Quản lý sản phẩm</span><span style="padding: 0 10px; font-size: 22px;">></span> <span>Thêm sản phẩm mới</span>
        </div>
    </div>
    <div class="contentManager--product__footer contentManager--product__footer--addProduct">
        <form action="index.php?actAdmin=updateCategory" method="post" enctype="multipart/form-data">
            <div class="form--left form--category">
                <div class="name">
                    <p>Mã danh mục</p>
                    <input class="name" style=" background-color: #000000;" value="<?= $id ?>" name="id" readonly>
                </div>
                <div class="name">
                    <p>Tên danh mục:</p>
                    <input class="name" style=" background-color: #000000;" type="text" name="name" value="<?= $name ?>">
                    <?php if (isset($_GET['nameerr'])) : ?>
                        <span style="color: red; font-size: 14px;"><?= $_GET['nameerr'] ?></span>
                    <?php endif ?>
                </div>
                <div class="name">
                    <p>Ảnh danh mục:</p>
                    <input type="hidden" name="avatar_old" value="<?= $avatar ?>">
                    <input class="name" style=" background-color: #000000;" type="file" name="avatar_new">
                    <?php
                            $imagePath = "../imageProduct/" . $avatar;
                            if (is_file($imagePath)) {
                                $image = "<img src='" . $imagePath . "' alt='' width='100px' height='100px'>";
                            } else {
                                $image = "<h4 style='color: #ffffff' >Không có hình ảnh</h4>";
                            }
                        ?>
                    <?= $image ?>
                </div>
                <div class="status">
                    <p>Trạng thái</p>
                    <select name="status" id="">
                        <option value="" hidden>-- Trạng thái hiển thị --</option>
                        <option value="0" <?= $status == 0 ? 'selected' : '' ?>>Active</option>
                        <option value="1" <?= $status == 1 ? 'selected' : '' ?>>Disable</option>
                    </select>
                    <?php if(isset($_GET['statuserr'])):?>
                <span style="color: red; font-size: 14px;"><?= $_GET['statuserr']?>
                <?php endif ?>
            </span>
                </div>

                <div class="btn__action btn__action--addProduct">
                    <button type="submit" class="btn--addProduct" name="btn-editProduct">Sửa danh mục</button>
                    <a href="index.php?actAdmin=listCategories">Quay lại</a>
                </div>
            </div>
            <?php
                if (isset($thongbao) && $thongbao != "") {
                    echo $thongbao;
                }
            ?>
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