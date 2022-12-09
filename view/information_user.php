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
                                        echo '<li><a href="">Thông tin tài khoản</a></li>';
                                        break;
                                }
                            } ?>
                            <li><a href="index.php?act=dsdonhang">Đơn hàng của bạn</a></li>
                            <li><a href="index.php?act=doimatkhau">Đổi mật khẩu</a></li>
                        </ul>
                    </div>
                </div>
                <div class="nav__detail_user-right">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div>
                            <p class="title_login--children-2">THÔNG TIN TÀI KHOẢN</p>
                        </div>
                        <div class="list_title--inr222">
                            <p class="title_login--children-2 dij998">&ensp;</p>
                            <div class="cate--eu9998"><span class="both_text">
                                    Họ tên:&ensp;</span>
                                <input type="text" name="name" id="name" value="<?= $_SESSION['user']['name'] ? $_SESSION['user']['name'] : $_SESSION['user']['name'] = ''; ?>" class="update__innfo--user">
                            </div>
                            <div>
                                <span class="login__thongbao">
                                    <?= isset($thongbao[0]) ? $thongbao[0] : $thongbao[0] = ''; ?>
                                </span>
                            </div>
                            <div class="cate--eu9998"><span class="both_text">
                                    Email:&ensp;</span>
                                <input type="text" name="email" id="name" value="<?= $_SESSION['user']['email'] ? $_SESSION['user']['email'] : $_SESSION['user']['email'] = ''; ?>" class="update__innfo--user">
                            </div>
                            <div>
                                <span class="login__thongbao">
                                    <?= isset($thongbao[1]) ? $thongbao[1] : $thongbao[1] = ''; ?>
                                </span>
                            </div>
                            <div class="cate--eu9998"><span class="both_text">
                                    Địa chỉ:&ensp;</span>
                                <input type="text" name="address" id="name" value="<?= $_SESSION['user']['address'] ? $_SESSION['user']['address'] : $_SESSION['user']['address'] = ''; ?>" class="update__innfo--user">
                            </div>
                            <div>
                                <span class="login__thongbao">
                                    <?= isset($thongbao[2]) ? $thongbao[2] : $thongbao[3] = ''; ?>
                                </span>
                            </div>
                            <div class="cate--eu9998"><span class="both_text">
                                    Điện thoại:&ensp;</span>
                                <input type="text" name="phone" id="name" value="<?= $_SESSION['user']['phone'] ? $_SESSION['user']['phone'] : $_SESSION['user']['phone'] = ''; ?>" class="update__innfo--user">
                            </div>
                            <div>
                                <span class="login__thongbao">
                                    <?= isset($thongbao[3]) ? $thongbao[3] : $thongbao[3] = ''; ?>
                                </span>
                            </div>
                            <div class="cate--eu9998"><span class="both_text">
                                    Ngày tạo:&ensp;</span><span><?= $_SESSION['user']['created_at'] ?></span>
                            </div>
                            <input type="hidden" value="<?= $_SESSION['user']['image'] ? $_SESSION['user']['image'] : $_SESSION['user']['image'] = ''; ?>" name="image_old" id="image">
                            <div class="cate--eu9998"><span class="both_text">
                                    Ảnh đại diện:&ensp;</span>
                                <input type="file" name="image" id="image">
                            </div>
                            <div>
                                <img class="edit_img_user" src="Admin/UserAvt/<?= $_SESSION['user']['image'] ?>" alt="" srcset="" width="150px" height="150px">
                            </div>
                            <div>
                                <span class="login__thongbao">
                                    <?= isset($thongbao[4]) ? $thongbao[4] : $thongbao[4] = ''; ?>
                                </span>
                            </div>
                            <div>
                                <span class="login__thongbao">
                                    <?= isset($_GET['msg']) ? $_GET['msg'] : $_GET['msg'] = ''; ?>
                                </span>
                            </div>
                            <div>
                                <input type="submit" name="capnhat" class="capnhat__thongtin-guest" value="Cập nhật">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>