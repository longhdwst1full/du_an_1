<section class="ctn__size--width login__acc">
  <div class="login__top--title">
    <div class="login__top--title-menu">
      <ul class="menu__children_header--bottom">
        <li>
          <a href="">Trang chủ</a> <i class="fa-solid fa-angle-right"></i>
        </li>
        <li>
          <a href="">Đăng nhập tài khoản</a>
        </li>
      </ul>
    </div>
    <div class="login__top--title-2">
      <p class="title_login--children">Đăng nhập tài khoản</p>
      <p class="title_login--children-2">ĐĂNG NHẬP TÀI KHOẢN</p>
    </div>
  </div>
  <div class="login__bottom-form">
    <div class="login__bottom-form--title">
      <div>
        <span>Nếu bạn đã có tài khoản, đăng nhập tại đây.</span>
        <p class="login__thongbao success__color--pr lg_succes">
          <?= isset($_GET['msg']) ? $_GET['msg'] : $_GET['msg'] = ''; ?>
        </p>
      </div>
      <div>
        <span style="margin-left: 20px;">Bạn quên mật khẩu? Nhập địa chỉ email để lấy lại mật khẩu qua
          email.</span>
      </div>
    </div>
    <div class="login__form--check">
      <div class="login__bottom-form-left">
        <form action="index.php?act=dangnhap" method="post" enctype="multipart/form-data">
          <div>
            <p>Email *</p>
            <input type="text" 
            value="<?= isset($_POST['email_login'])? $_POST['email_login'] : $_POST['email_login'] =''; ?>" 
            name="email_login" id="email" placeholder="Email" />
            <p class="login__thongbao">
              <?= isset($thongbao[1]) ? $thongbao[1] : $thongbao[1] = ''; ?>
            </p>
          </div>
          <div>
            <p>Mật khẩu *</p>
            <input type="text" name="code" value="<?= isset($_GET['code']) ? $_GET['code'] : $_GET['code']=''?>" id="" hidden>
            <input type="password" name="password" id="password" placeholder="Mật khẩu" />
            <p class="login__thongbao">
              <?= isset($thongbao[2]) ? $thongbao[2] : $thongbao[2] = ''; ?>
            </p>
          </div>
          <div>
            <p class="login__thongbao">
              <?= isset($thongbao[0]) ? $thongbao[0] : $thongbao[0] = ''; ?>
            </p>
          </div>
          <div>
            <input type="submit" name="dangnhap" value="Đăng nhập" />
            <a href="index.php?act=dangky">Đăng ký</a>
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
          </div>
        </div> -->
      </div>
      <div class="login__bottom-form-right">
        <form action="index.php?act=dangnhap" method="post" enctype="multipart/form-data">
          <div>
            <p>Email *</p>
            <input type="text" name="email" value="<?= isset($_POST['email']) ? $_POST['email'] : $_POST['email']=''?>" id="email" placeholder="Email" />
            <div>
              <span class="login__thongbao">
                <?= isset($thongbao[3]) ? $thongbao[3] : $thongbao[3] = ''; ?>
              </span>
            </div>
          </div>
          <div style="margin-top: 15px;">
            <p style="margin-bottom: 5px;">Họ tên *</p>
            <input type="text" name="name" value="<?= isset($_POST['name']) ? $_POST['name'] : $_POST['name']=''?>" id="namefoget" placeholder="Họ tên trong tài khoản" />
            <div>
              <span class="login__thongbao">
                <?= isset($thongbao[4]) ? $thongbao[4] : $thongbao[4] = ''; ?>
              </span>
            </div>
          </div>
          <div>
              <span class="login__thongbao">
                <?= isset($_GET['codelogin']) ? $_GET['codelogin'] : $_GET['codelogin'] = ''; ?>
              </span>
              <span class="login__thongbao">
                <?= isset($thongbao[5]) ? $thongbao[5] : $thongbao[5] = ''; ?>
              </span>
            </div>
          <div>
            <input class="forget__pass" name="quenmatkhau" type="submit" value="Lấy lại mật khẩu" />
          </div>
        </form>
      </div>
    </div>
  </div>
</section>