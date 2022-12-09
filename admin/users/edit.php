<?php
if (is_array($infoUser)) {
    extract($infoUser);
}
?>
<div class="contentManager contentManager--product">
    <div class="contentManager--product__header">
        <div class="contentManager--product__header--title">
            <h2 style="color: #ffffff;">Chỉnh sửa người dùng</h2>
        </div>
        <div class="contentManager--product__header--control">
            <span><i class="fa-solid fa-house"></i>Trang chủ</span> <span style="padding: 0 10px; font-size: 22px;">></span> <span><i class="fa-brands fa-product-hunt"></i>Quản lý người dùng</span><span style="padding: 0 10px; font-size: 22px;">></span><span>Chỉnh sửa người dùng</span>
        </div>
    </div>
    <?php if (isset($notification)) : ?>
        <div class="alert alert-success">
            <?= $notification ?>
        </div>
    <?php endif ?>
    <?php if (isset($_GET['msg'])) : ?>
        <div class="alert alert-success">
            <?= $_GET['msg'] ?>
        </div>
    <?php endif ?>
    <div class="contentManager--product__footer contentManager--product__footer--addProduct">
        <form action="index.php?actAdmin=editUser&id=<?= $_GET['id'] ?>" method="post" enctype="multipart/form-data">
            <div class="form--left">
                <div class="name">
                    <p>Tên người dùng:</p>
                    <input class="name" name="name" value="<?= $name ?>" style=" background-color: #000000;" type="text" placeholder="Nhập tên người dùng...">
                </div>
                <div class="image">
                    <p>Ảnh người dùng:</p>
                    <input type="file" name="image" style="background-color: #0F172A;">
                    <input type="text" value="<?= isset($image) ? $image : $image ='' ;?>" name="image_old" id="" hidden>
                    <div>
                        <img src="./UserAvt/<?=$image?>" width="80px" height="80px" style="color: white; margin: 5px 5px" alt="Không có ảnh" srcset="">
                    </div>
                </div>
                <div class="image">
                    <p>Email:</p>
                    <input class="name" name="email" value="<?= $email ?>" style=" background-color: #000000;" type="text" placeholder="Nhập email người dùng...">
                </div>
                <div class="image">
                    <p>Mật khẩu:</p>
                    <input class="name" name="password" value="<?= $password ?>" style=" background-color: #000000;" type="password" placeholder="Nhập mật khẩu người dùng...">
                </div>
                <div class="image">
                    <p>Điện thoại:</p>
                    <input class="name" name="phone" value="<?= $phone ?>" style=" background-color: #000000;" type="number" placeholder="Nhập số điện thoại người dùng...">
                </div>
                <div class="image">
                    <p>Địa chỉ:</p>
                    <input class="name" name="address" value="<?= $address ?>" style=" background-color: #000000;" type="text" placeholder="Nhập địa chỉ người dùng...">
                </div>
            </div>
            <div class="form--right">
                <h2 style="color: white;">Đặc quyền người dùng</h2>
                <div class="status">
                    <p>Trạng thái hoạt động:</p>
                    <select name="status" id="">
                        <option value="" hidden>-- Chọn trạng thái --</option>
                        <option value="0" <?= ($status == 0) ? 'selected' :'' ?>>Active</option>
                        <option value="1" <?= ($status == 1) ? 'selected' :'' ?>>Inactive</option>  
                    </select>
                </div>
                <div class="status">
                    <p>Quyền quản trị:</p>
                    <select name="role" id="">
                        <option value="" hidden>-- Chọn trạng thái --</option>
                        <option value="0" <?= ($role == 0) ? 'selected' :'' ?>>Người dùng</option>
                        <option value="1" <?= ($role == 1) ? 'selected' :'' ?>>Quản trị</option>  
                    </select>
                </div>
                <div class="btn__action btn__action--addProduct mrg_top--btn">
                    <button type="submit" class="btn--addProduct" name="btn--editUser">Cập nhật người dùng</button>
                    <button type="reset">Nhập lại</button>
                    <a href="index.php?actAdmin=showUsers" class="btn_ds_user--1">Danh sách</a>
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