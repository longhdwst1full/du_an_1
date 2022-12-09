<section class="ctn__size--width login__acc">
    <div class="login__top--title">
      <div class="login__top--title-menu">
        <ul class="menu__children_header--bottom">
          <li>
            <a href="">Trang chủ</a> <i class="fa-solid fa-angle-right"></i>
          </li>
          <li>
            <a href="">Tin tức</a>
          </li>
        </ul>
      </div>
      <div class="login__top--title-2">
        <p class="title_login--children">Tin tức</p>
      </div>
    </div>
    <div class="login__bottom-form tintuc__ctn">
      <div class="tintuc__left--menu">
        <div class="tintuc__left--menu-top">
          <div>
            <h4 class="title__menu--jj">DANH MỤC TIN TỨC</h4>
          </div>
          <div>
            <ul class="menu__left--children">
              <li class="nav_li">
                <a href="index.php">Trang chủ</a>
              </li>
              <li class="nav_li">
                <a href="index.php?act=showProducts">Sản phẩm</a>
                <i class="fa-solid fa-angle-down show__nav" onclick="chan(this)"></i>
                <ul class="sub__menu--children">
                  <li>
                    <a href="">Giày nam</a>
                  </li>
                  <li>
                    <a href="">Giày nữ</a>
                  </li>
                  <li>
                    <a href="">Giày bé trai</a>
                  </li>
                  <li>
                    <a href="">Giày bé gái</a>
                  </li>
                </ul>
              </li>
              <li class="nav_li">
                <a href="index.php?act=lienhe">Liên hệ</a>
              </li>
              <li class="nav_li">
                <a href="index.php?act=gioithieu">Giới thiệu</a>
              </li>
              <li class="nav_li">
                <a href="index.php?act=tintuc">Tin tức</a>
              </li>
            </ul>
          </div>
        </div>
        <div class="tintuc__left--menu-bottom">
          <div>
            <h4 class="title__menu--jj">
              <a class="cls__f_t_a" href="">SIÊU BÃO VỀ GIÁ</a>
            </h4>
          </div>
          <div class="content__sbvg--ctn">
          <?php
            foreach ($listLowPrice as $value) {
              $priceFM = number_format($value['price'] - ($value['price'] / 100)*$value['discount'], 0, '', ',');
              echo '
                  <div class="rows_sbvg">
                    <div class="sbvg__image">
                      <img
                        src="imageProduct/'.$value['avatar'].'"
                        alt="" srcset="" />
                    </div>
                    <div class="sbvg__content">
                      <p>
                        <a href="index.php?act=detail_product&id='.$value['id'].'" class="cls__f_t_a">'.$value['name'].'</a>
                      </p>
                      <p class="price__sbvg">'.$priceFM.' đ</p>
                      <p class="price__sbvg-old">'.number_format($value['price'], 0, '', ',').' đ</p>
                    </div>
                  </div>
              ';
            }

          ?>
            <!-- <div class="rows_sbvg">
              <div class="sbvg__image">
                <img
                  src="https://bizweb.dktcdn.net/thumb/medium/100/342/645/products/men-s-original-canvas-casual-skate-shoes.png?v=1545564063607"
                  alt="" srcset="" />
              </div>
              <div class="sbvg__content">
                <p>
                  <a href="" class="cls__f_t_a">Giày thể thao nữ cổ thấp mẫu mới nhất</a>
                </p>
                <p class="price__sbvg">269.000 đ</p>
                <p class="price__sbvg-old">200.000 đ</p>
              </div>
            </div> -->
          </div>
        </div>
      </div>
      <div class="tintuc__right--content">
        <div class="tintuc__noibat">
          <div class="anh__ttnb">
            <a href=""><img
                src="https://cf.shopee.vn/file/sg-11134201-22100-ms6ckijmmxiv82"
                alt="" class="daupage" /></a>
          </div>
          <div class="noidung__ttnb">
            <h4>
              <a href="" class="cls__f_t_a">Bộ thể thao nam nỉ bông ấm đẹp nhất năm 2022</a>
            </h4>
            <p>
            Nỉ vải nỉ bông suất dư Bên ngoài nỉ trơn mịn đẹp, bên trong nót 1lớp bông, mềm mịn, đẹp có tác dụng giữ ấm tốt. 
            Lô gô chữ thêu sịn đét chống bong tróc chống phai.
            Cam kết 100%  ko bao giờ xù gião phai. 
            Kiểu dáng trẻ trung,  năng động,  lịch sự.
            Phù hợp mặc đôi nam nữ.
            Bo chuẩn đẹp, full tem nhãn hãng,  may kĩ,  2 túi áo túi quần có khóa dây rút quần cẩn thận.
            Full sz m l xl từ 48kg đến 78kg.
            2 Màu y ảnh đen sọc trắng và đen sọc đen.
            khách ib shop để đk tư vấn size cho chuẩn trước khi đặt hàng.
            </p>
          </div>
        </div>
        <h3 class="bvk__op0">BÀI VIẾT KHÁC</h3>
        <div>
          <div class="list__tintuc-card">
            <div class="l__tt_c_children">
              <div class="anh__ttnb size__df">
                <a href=""><img
                    src="https://cf.shopee.vn/file/638762add77d2abd5260c57bb9f186f6"
                    alt="" srcset="" /></a>
              </div>
              <div class="noidung__ttnb">
                <h4>
                  <a href="" class="cls__f_t_a">QUẦN ÁO BÓNG CHUYỀN JUSTPLAY NAM VOLLY</a>
                </h4>
                <p class="contentt__child33">
                Chất liệu thun lạnh cao cấp mềm, mịn, bền, đẹp, không bị ra màu
                có khả năng co giãn và rút mồ hôi tốt, tạo cảm giác thoải mái trong khi mặc thi đấu
                Sợi Poly có tác dụng kháng vết bẩn khá tốt, dễ giặt và vệ sinh.
                Chi tiết ản phẩm giống ảnh 100%
                </p>
              </div>
            </div>
            <div class="l__tt_c_children">
              <div class="anh__ttnb size__df">
                <a href=""><img
                    src="https://cf.shopee.vn/file/a3b2c7b736e8684b5b72dbc59c8443fa"
                    alt="" srcset="" /></a>
              </div>
              <div class="noidung__ttnb">
                <h4>
                  <a href="" class="cls__f_t_a">Áo gió 1 lớp nam Uniqlo chính hãng</a>
                </h4>
                <p class="contentt__child33">
                Áo gió 1 lớp nam Uniqlo chính hãng
                Pick store China
                🌿Mô tả áo rất nhẹ và nên đặt trong túi lưu trữ để dễ dàng mang theo.  , thiết thực và nổi bật.  
                🌿Nó phù hợp để mặc trong mùa biến đổi khí hậu, và nó có cảm giác mặc nhẹ.  Peter Saville là một nghệ sĩ đồ họa có đóng góp cho cuộc sống hàng ngày là độc nhất. 
                🌿 Là người sáng lập và giám đốc nghệ thuật của công ty thu âm huyền thoại "Factory", ông đã làm cho tác phẩm đột phá của mình trở nên phổ biến với nhạc pop, ảnh hưởng đến quá trình văn hóa thị giác đương đại. 
                🌿 [Thành phần vải] 100% sợi polyester. 
                Fb CUC NGUYEN HÀNG XÁCH TAY
                </p>
              </div>
            </div>
            <div class="l__tt_c_children">
              <div class="anh__ttnb size__df">
                <a href=""><img
                    src="https://cf.shopee.vn/file/06b3fd8c823afefd2c121c6c49179b0f"
                    alt="" srcset="" /></a>
              </div>
              <div class="noidung__ttnb">
                <h4>
                  <a href="" class="cls__f_t_a">Áo Bóng Chuyền Ngắn Tay Phong Cách Nhật Bản 2022 Dành Cho Nam</a>
                </h4>
                <p class="contentt__child33">
                ♥️♥️♥️Chào mừng bạn đến với cửa hàng của chúng tôi, nơi chúng tôi cố gắng cung cấp cho khách hàng một loạt các sản phẩm đáp ứng nhu cầu về chất lượng và hiệu quả. Mua sản phẩm của chúng tôi từ Shopee một cách thoải mái. Mua sắm không thể dễ dàng hơn thế này, vì vậy hãy bắt đầu ngay hôm nay!💕💕
                </p>
              </div>
            </div>
            <div class="l__tt_c_children">
              <div class="anh__ttnb size__df">
                <a href=""><img
                    src="https://cf.shopee.vn/file/ebfe23e32501cc0e9d139dd3c082ff38"
                    alt="" srcset="" /></a>
              </div>
              <div class="noidung__ttnb">
                <h4>
                  <a href="" class="cls__f_t_a">Bộ Quần Áo Thể Thao Nam Uniqlo Tennis Roger Federer Open</a>
                </h4>
                <p class="contentt__child33">
                - Là sản phẩm được thiết kế riêng cho tay vợt Fenderer thi đấu, từ chất liệu polyester có khả năng thấm hút mồ hôi vượt trội, sử dụng công nghệ làm mát Dry-Ex kết hợp với style thiết kế thể thao, trẻ trung và nam tính mạnh mẽ là sự lựa chọn hoàn hảo với những vận động viên.
                - Uniqlo đã thực hiện với những thiết kế phối kết hợp màu hiện đại thời trang đặc trưng của của bộ muôn tennis đã tạo nên sự đặc biệt và nổi bật trong thế giới thời trang thể thao.
                </p>
              </div>
            </div>
            <div class="l__tt_c_children">
              <div class="anh__ttnb size__df">
                <a href=""><img
                    src="https://cf.shopee.vn/file/8bb7bf7a3668f7e5feffac8c32bf58e4"
                    alt="" srcset="" /></a>
              </div>
              <div class="noidung__ttnb">
                <h4>
                  <a href="" class="cls__f_t_a">Bộ đồ thể thao nam thời trang cao cấp GUCCI GG GC</a>
                </h4>
                <p class="contentt__child33">
                - Là sản phẩm được thiết kế riêng cho tay vợt Fenderer thi đấu, từ chất liệu polyester có khả năng thấm hút mồ hôi vượt trội, sử dụng công nghệ làm mát Dry-Ex kết hợp với style thiết kế thể thao, trẻ trung và nam tính mạnh mẽ là sự lựa chọn hoàn hảo với những vận động viên.
                - Uniqlo đã thực hiện với những thiết kế phối kết hợp màu hiện đại thời trang đặc trưng của của bộ muôn tennis đã tạo nên sự đặc biệt và nổi bật trong thế giới thời trang thể thao.
                </p>
              </div>
            </div>
            <div class="l__tt_c_children">
              <div class="anh__ttnb size__df">
                <a href=""><img
                    src="https://salt.tikicdn.com/cache/w1200/ts/product/dd/a3/87/a1f271f335a4aa4ca3c0e1de70f63681.jpg"
                    alt="" srcset="" /></a>
              </div>
              <div class="noidung__ttnb">
                <h4>
                  <a href="" class="cls__f_t_a">Bộ Quần Áo Bóng Chuyền Nam Hiwing H1-2019</a>
                </h4>
                <p class="contentt__child33">
                Bộ Quần Áo Bóng Chuyền Nam Hiwing H1-2019 - Hàng Chính Hãng là sự đột phá về thiết kế và chất liệu vải thun mè cao cấp có hạt lạnh. Một sản phẩm được nghiên cứu và phát triển để trở thành một loại vải mè chuyên sâu trong sản xuất áo, quần thể thao ngoài ra chúng còn được phối với vải Interlock.
Chất liệu vải mượt mà, mát, mịn, chắc chắ
                </p>
              </div>
            </div>
            <div class="l__tt_c_children">
              <div class="anh__ttnb size__df">
                <a href=""><img
                    src="https://cf.shopee.vn/file/e368169cf8fada3f48b022d698cba9b0"
                    alt="" srcset="" /></a>
              </div>
              <div class="noidung__ttnb">
                <h4>
                  <a href="" class="cls__f_t_a">Bộ Quần áo Tennis Co Dãn Cao Cấp</a>
                </h4>
                <p class="contentt__child33">
                Bộ quần áo thể thao uniqlo,bộ quần áo tennis hàng cao cấp:
              •    Chất liệu MÈ THÁI cao cấp 
              •    KHÔNG NHĂN – KHÔNG XÙ – KHÔNG PHAI
              •    Thấm hút mồ hôi cực tốt.
              •    Thiết kế mạnh mẽ,  hiện đại,
              Bảng chọn size
              Size M từ 45 - 56 kg

                </p>
              </div>
            </div>
            <div class="l__tt_c_children">
              <div class="anh__ttnb size__df">
                <a href=""><img
                    src="https://cf.shopee.vn/file/9d63627abe410e26d6313996b691ce19"
                    alt="" srcset="" /></a>
              </div>
              <div class="noidung__ttnb">
                <h4>
                  <a href="" class="cls__f_t_a">Bộ Quần Áo Thể Thao Nam Uniqlo - Bộ Quần áo Tennis Cao Cấp</a>
                </h4>
                <p class="contentt__child33">
                ❌ Logo dệt sắc sảo, bền đẹp không bong tróc
                ❌ Vải Thái cao cấp, đặt dệt độc quyền mềm và mịn.
                ❌ Một ưu điểm đặc biệt của chất liệu này đó là khả năng thấm hút tốt, chơi thể thao mồ hôi sẽ tiết ra rất nhiều gây ướt và khó chịu,  toàn bộ mồ hôi sẽ được thấm hút mang đến cho bạn sự thoải mái và tự tin hơn.
                </p>
              </div>
            </div>
          </div>
          <div>
            <ul class="chuyentiep__tintuc">
              <li class="next active"><a href="" class="cls__f_t_a">1</a></li>
              <li class="next"><a href="" class="cls__f_t_a">2</a></li>
              <li class="next"><a href="" class="cls__f_t_a">>></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>

  </section>