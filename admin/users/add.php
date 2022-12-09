<div class="contentManager contentManager--product">
    <div class="contentManager--product__header">
        <div class="contentManager--product__header--title">
            <h2 style="color: #ffffff;">Thêm người dùng mới</h2>
        </div>
        <div class="contentManager--product__header--control">
            <span><i class="fa-solid fa-house"></i>Trang chủ</span> <span style="padding: 0 10px; font-size: 22px;">></span> <span><i class="fa-brands fa-product-hunt"></i>Quản lý người dùng</span><span style="padding: 0 10px; font-size: 22px;">></span><span>Thêm người dùng mới</span>
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
        <form action="index.php?actAdmin=addUser" method="post" enctype="multipart/form-data">
            <div class="form--left">
                <div class="name">
                    <p>Tên người dùng:</p>
                    <input class="name" value="<?= isset($_POST['name']) ? $_POST['name'] : $_POST['name']='';?>" name="name" style=" background-color: #000000;" type="text" placeholder="Nhập tên người dùng...">
                    <?php
                        if(isset($thongbao[0])){
                         echo'<p style="padding-top: 5px">
                                <span style="color: #d53e3e;">&nbsp; '.$thongbao[0].'</span>
                            </p>';
                        }
                    ?>
                </div>
                <div class="image">
                    <p>Ảnh người dùng:</p>
                    <input type="file" name="image" style="background-color: #0F172A;">
                    <?php
                        if(isset($thongbao[1])){
                         echo'<p style="padding-top: 5px">
                                <span style="color: #d53e3e;">&nbsp; '.$thongbao[1].'</span>
                            </p>';
                        }
                    ?>
                </div>
                <div class="image">
                    <p>Email:</p>
                    <input class="name" value="<?= isset($_POST['email']) ? $_POST['email'] : $_POST['email']='';?>" name="email" style=" background-color: #000000;" type="text" placeholder="Nhập email người dùng...">
                    <?php
                        if(isset($thongbao[2])){
                         echo'<p style="padding-top: 5px">
                                <span style="color: #d53e3e;">&nbsp; '.$thongbao[2].'</span>
                            </p>';
                        }
                    ?>
                </div>
                <div class="image">
                    <p>Mật khẩu:</p>
                    <input class="name" value="<?= isset($_POST['password']) ? $_POST['password'] : $_POST['password']='';?>" name="password" style=" background-color: #000000;" type="password" placeholder="Nhập mật khẩu người dùng...">
                      <?php
                        if(isset($thongbao[3])){
                         echo'<p style="padding-top: 5px">
                                <span style="color: #d53e3e;">&nbsp; '.$thongbao[3].'</span>
                            </p>';
                        }
                    ?>
                </div>
                <div class="image">
                    <p>Điện thoại:</p>
                    <input class="name" value="<?= isset($_POST['phone']) ? $_POST['phone'] : $_POST['phone']='';?>" name="phone" style=" background-color: #000000;" type="number" placeholder="Nhập số điện thoại người dùng...">
                      <?php
                        if(isset($thongbao[4])){
                         echo'<p style="padding-top: 5px">
                                <span style="color: #d53e3e;">&nbsp; '.$thongbao[4].'</span>
                            </p>';
                        }
                    ?>
                </div>
                <div class="image">
                    <p>Địa chỉ:</p>
                    <input class="name" value="<?= isset($_POST['address']) ? $_POST['address'] : $_POST['address']='';?>" name="address" style=" background-color: #000000;" type="text" placeholder="Nhập địa chỉ người dùng...">
                      <?php
                        if(isset($thongbao[5])){
                         echo'<p style="padding-top: 5px">
                                <span style="color: #d53e3e;">&nbsp; '.$thongbao[5].'</span>
                            </p>';
                        }
                        ?>
                </div>
            </div>
            <div class="form--right">
                <h2 style="color: white;">Đặc quyền người dùng</h2>
                <div class="status">
                    <p>Trạng thái hoạt động:</p>
                    <select name="status" id="">
                        <option value="" hidden>-- Chọn trạng thái --</option>
                        <option value="0" selected>Active</button>
                        <option value="1">Inactive</button>
                    </select>
                    <?php
                        if(isset($thongbao[6])){
                         echo'<p style="padding-top: 5px">
                                <span style="color: #d53e3e;">&nbsp; '.$thongbao[6].'</span>
                            </p>';
                        }
                        ?>
                </div>
                <div class="status">
                    <p>Quyền quản trị:</p>
                    <select name="role" id="">
                        <option value="" disabled>-- Chọn trạng thái --</option>
                        <option value="0">Người dùng</button>
                        <option value="1">Quản trị</button>
                    </select>
                    <?php
                        if(isset($thongbao[7])){
                         echo'<p style="padding-top: 5px">
                                <span style="color: #d53e3e;">&nbsp; '.$thongbao[7].'</span>
                            </p>';
                        }
                        ?>
                </div>
                <div class="btn__action btn__action--addProduct mrg_top--btn">
                    <button type="submit" class="btn--addProduct" name="btn--addUser">Thêm người dùng</button>
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