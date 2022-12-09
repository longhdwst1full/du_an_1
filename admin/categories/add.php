<div class="contentManager contentManager--product">
    <div class="contentManager--product__header">
        <div class="contentManager--product__header--title">
            <h2 style="color: #ffffff;">Thêm danh mục mới</h2>
        </div>
        <div class="contentManager--product__header--control">
            <span><i class="fa-solid fa-house"></i>Trang chủ</span> <span style="padding: 0 10px; font-size: 22px;">></span> <span><i class="fa-brands fa-product-hunt"></i>Quản lý danh mục</span><span style="padding: 0 10px; font-size: 22px;">></span> <span>Thêm danh mục mới</span>
        </div>
    </div>
    <?php if (isset($notification)) : ?>
        <div class="alert alert-success">
            <?= $notification ?>
        </div>
    <?php endif ?>
    <div class="contentManager--product__footer contentManager--product__footer--addProduct">
        <form action="index.php?actAdmin=addCategory" method="post" enctype="multipart/form-data">
            <div class="form--left form--category">
                <div class="name">
                    <p>Tên danh mục:</p>
                    <input class="name" style=" background-color: #000000;" type="text" name="name" placeholder="Nhập tên danh mục...">
                    <?php if (isset($_GET['nameerr'])) : ?>
                        <span style="color: red; font-size: 14px;"><?= $_GET['nameerr'] ?></span>
                    <?php endif ?>
                </div>
                <div class="name">
                    <p>Ảnh danh mục:</p>
                    <input class="name" style=" background-color: #000000;" type="file" name="avatar" placeholder="Đăng ảnh danh mục..">
                    <?php if(isset($_GET['imageerr'])):?>
                <span style="color: red; font-size: 14px;"><?= $_GET['imageerr']?></span>
            <?php endif ?>
                </div>
                <div class="status">
                    <p>Trạng thái</p>
                    <select name="status" id="">
                        <option value="" hidden>-- Trạng thái hiển thị --</option>
                        <option value="0">Active</option>
                        <option value="1">Disable</option>
                    </select>
                    <?php if(isset($_GET['statuserr'])):?>
                <span style="color: red; font-size: 14px;"><?= $_GET['statuserr']?></span>
            <?php endif ?>
                </div>
                <div class="btn__action btn__action--addProduct">
                    <button type="submit" class="btn--addProduct" name="btn--addProduct">Thêm danh mục</button>
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