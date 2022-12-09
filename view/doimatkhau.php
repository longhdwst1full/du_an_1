<section class="ctn__size--width login__acc">
    <div class="login__top--title">
        <div class="login__top--title-menu">
            <ul class="menu__children_header--bottom">
                <li>
                    <a href="">Trang chủ</a> <i class="fa-solid fa-angle-right"></i>
                </li>
                <li>
                    <a href="">Trang khách hàng</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="cjdd">
        <div class="ctn__page-guest">
            <div class="login__top--title-2">
                <p class="title_login--children">Trang khách hàng</p>
            </div>
            <div class="info__user--guest">
                <div class="nav__info_user-left">
                    <p class="title_login--children-2 pageacc">TRANG TÀI KHOẢN</p>
                    <div class="info_user--tilte-hello">
                        <h4>Xin chào, <span style="color: #ff2d37"><?= $_SESSION['user']['name'] ?> !</span></h4>
                    </div>
                    <div class="nav_editInfo-user">
                        <ul>
                            <?php if (isset($_GET['act'])) {
                                $actc = $_GET['act'];
                                switch ($actc) {
                                    case 'thongtintaikhoan':
                                        echo '<li><a href=""style="color:#ff2d37">Thông tin tài khoản</a></li>';
                                        break;
                                    default:
                                        echo '<li><a href="index.php?act=thongtintaikhoan">Thông tin tài khoản</a></li>';
                                        break;
                                }
                            } ?>
                            <li><a href="index.php?act=dsdonhang">Đơn hàng của bạn</a></li>

                            <?php if (isset($_GET['act'])) {
                                $actc = $_GET['act'];
                                switch ($actc) {
                                    case 'doimatkhau':
                                        echo '<li><a href=""style="color:#ff2d37">Đổi mật khẩu</a></li>';
                                        break;
                                    default:
                                        echo '<li><a href="">Đổi mật khẩu</a></li>';
                                        break;
                                }
                            } ?>
                            
                        </ul>
                    </div>
                </div>
                <div class="nav__detail_user-right">
                    <p class="title_login--children-2">ĐỔI MẬT KHẨU</p>
                    <p class="title_login--children-2 dij998">&ensp;</p>
                    <p style="margin-bottom: 10px">Để đảm bảo tính bảo mật vui lòng đặt mật khẩu với ít nhất 8 kí tự</p>
                    <div class="login__bottom-form-left not">
                        <form action="index.php?act=doimatkhau&&codelogin=<?= isset($_GET['codelogin']) ? $_GET['codelogin'] : $_GET['codelogin'] = ''; ?>" method="post" enctype="multipart/form-data">
                            <div>
                                <p>Mật khẩu cũ *</p>
                                <input type="password" value="<?= isset($_GET['codelogin']) ? $_GET['codelogin'] : $_GET['codelogin'] = ''; ?>" name="password_Old" id="email" placeholder="Mật khẩu cũ" />
                                <p class="login__thongbao">
                                    <?= isset($thongbao[1]) ? $thongbao[1] : $thongbao[1] = ''; ?>
                                </p>
                            </div>
                            <div>
                                <p>Mật khẩu mới *</p>
                                <input type="password" value="" name="password_new" id="email" placeholder="Mật khẩu mới" />
                                <p class="login__thongbao">
                                    <?= isset($thongbao[2]) ? $thongbao[2] : $thongbao[2] = ''; ?>
                                </p>
                            </div>
                            <div>
                                <p>Xác nhận lại mật khẩu *</p>
                                <input type="password" value="" name="verypassword_new" id="email" placeholder="Xác nhận lại mật khẩu" />
                                <p class="login__thongbao">
                                    <?= isset($thongbao[3]) ? $thongbao[3] : $thongbao[3] = ''; ?>
                                </p>
                            </div>
                            <div>
                                <span class="login__thongbao">
                                    <?= isset($_GET['msg']) ? $_GET['msg'] : $_GET['msg'] = ''; ?>
                                </span>
                            </div>
                            <div>
                                <input type="submit" name="doimatkhau" class="capnhat__thongtin-guest" value="Đổi mật khẩu">
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>