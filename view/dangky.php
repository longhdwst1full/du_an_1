<section class="ctn__size--width login__acc">
  <div class="login__top--title">
    <div class="login__top--title-menu">
      <ul class="menu__children_header--bottom">
        <li>
          <a href="">Trang chủ</a> <i class="fa-solid fa-angle-right"></i>
        </li>
        <li>
          <a href="">Đăng ký tài khoản</a>
        </li>
      </ul>
    </div>
    <div class="login__top--title-2">
      <p class="title_login--children">Đăng ký tài khoản</p>
      <p class="title_login--children-2">ĐĂNG KÝ TÀI KHOẢN</p>
    </div>
  </div>
  <div class="login__bottom-form">
    <div class="login__bottom-form--title">
      <div>
        <span>Nếu chưa có tài khoản vui lòng đăng ký tại đây.</span>
      </div>
      <div>
        <span> </span>
      </div>
    </div>
    <div class="login__form--check">
      <div class="login__bottom-form--dangky">
        <form action="index.php?act=dangky" method="post" enctype="multipart/form-data">
          <div class="form__dky-001">
            <div>
              <p>Họ *</p>
              <input type="text" name="ho" id="ho" placeholder="Họ" value="<?= isset($_POST['ho']) ? $_POST['ho'] : $_POST['ho'] = '' ;?>"/>
              <div class="login__thongbao"><?= isset($thongbao[1]) ? $thongbao[1] : $thongbao[1] = ''; ?></div>
            </div>
            <div>
              <p>Tên *</p>
              <input type="text" name="ten" id="ten" placeholder="Tên" value="<?= isset($_POST['ten']) ? $_POST['ten'] : $_POST['ten'] = '' ;?>"/>
              <div class="login__thongbao"><?= isset($thongbao[2]) ? $thongbao[2] : $thongbao[2] = ''; ?></div>
            </div>
            <div>
              <p>Email *</p>
              <input type="email" name="email" id="email" placeholder="Email" value="<?= isset($_POST['email']) ? $_POST['email'] : $_POST['email'] = '' ;?>"/>
              <div class="login__thongbao"><?= isset($thongbao[5]) ? $thongbao[5] : $thongbao[5] = ''; ?></div>
            </div>
            <div>
              <p>Mật khẩu *</p>
              <input type="password" name="password" id="password" placeholder="Mật khẩu"/>
              <div class="login__thongbao"><?= isset($thongbao[3]) ? $thongbao[3] : $thongbao[3] = ''; ?></div>
            </div>
          </div>
          <div class="xyly__dky--002">
            <div class="form_validate_dangky">
            </div>
            <p class="login__thongbao">
              <?= isset($thongbao[4]) ? $thongbao[4] : $thongbao[4] = ''; ?>
            </p>
            <p class="login__thongbao">
                <?= isset($thongbao[0]) ? $thongbao[0] : $thongbao[0] = ''; ?>
              </p>
            <input type="submit" value="Đăng ký" name="dangky" />
            <a href="index.php?act=dangnhap">Đăng nhập</a>
          </div>
        </form>
        <!-- <div class="hoac__login--with-fb-gg">
          <p>Hoặc đăng nhập bằng</p>
          <div class="login__fb--gg">
            <div>
              <i class="fa-brands fa-facebook-f"></i>
              <span>Facebook</span>
            </div>
            <div>
              <i class="fa-brands fa-google-plus-g"></i>
              <span>Google</span>
            </div>
          </div> -->
        </div>
      </div>
    </div>
  </div>
</section>