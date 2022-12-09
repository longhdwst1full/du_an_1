<?php
$check_user_bying_product = check_user_bying_product();

foreach ($check_user_bying_product as $check) {
    // add comment
    if (isset($_POST['send_add_comments'])) {

        if (isset($_SESSION['user'])) {
            $id = $_SESSION['user']['id'];
            $content_comment = $_POST['content_comment'];
            $id_product = $_POST['id_product'];
            $count_start = $_POST['count_start'];
            if ($check['user_id'] == $id && $check['product_id'] == $id_product) {
                comment_insert($id_product, $id, $content_comment, $count_start);
               
                $total_comment_by_product= total_comment_id_product($id_product);
                extract($total_comment_by_product);
                // die;

                update_total_comment_id($total_comment_id_product,$total,$id_product);
                header("location: " . $_SERVER['HTTP_REFERER']);
            } else {
                echo "<script>  
                 window.location.href = 'index.php?act=detail_product&id=$id_product';
                        alert('Bạn phải mua hàng mới được bình luận');
                        </script>";
            }
        } else {
            require_once "./view/dangnhap.php";
            exit;
        }
    }

    // delete comment
    if (isset($_POST['delete_comment'])) {
        if (isset($_SESSION['user'])) {

            $id = $_SESSION['user']['id'];
            $id_comment = $_POST['id_comment'];
            $id_product = $_POST['id_product'];


            if ($check['user_id'] == $id && $check['product_id'] == $id_product) {
                comment_delete($id_comment);
                header("location: " . $_SERVER['HTTP_REFERER']);
            } else {
                echo "<script>  
                 window.location.href = 'index.php?act=detail_product&id=$id_product';
                        alert('Bạn phải mua hàng mới được bình luận');
                        </script>";
            }
        } else {
            require_once "./view/dangnhap.php";
            exit;
        }
    }

    if (isset($_POST['update_comments'])) {
        if (isset($_SESSION['user'])) {

            $id = $_SESSION['user']['id'];
            $content_comment = $_POST['content_comment'];
            $id_product = $_POST['id_product'];
            $id_comment = $_POST['id_comment'];
            $rating_products = $_POST['count_start'];
            echo $id, $content_comment, $id_product, $id_comment, $rating_products;

            // die;
            if ($check['user_id'] == $id && $check['product_id'] == $id_product) {
                comment_update($id_comment, $id_product, $id, $content_comment, $rating_products);

                header("location: " . $_SERVER['HTTP_REFERER']);
            } else {
                echo "<script>  
                 window.location.href = 'index.php?act=detail_product&id=$id_product';
                        alert('Bạn phải mua hàng mới được bình luận');
                        </script>";
            }
        } else {
            require_once "./view/dangnhap.php";
            exit;
        }
    }
}
?>


<div class="grid wide" style="position: relative;
    top: 150px;">
    <!-- điều hương -->
    <div class="row product_title_path">
        <p>Trang chủ</p>
        <!-- <span>></span>
        <p>Giày nam</p> -->
        <span>></span>
        <p>
            <span class="red_word">
                Chi tiết sản phẩm
            </span>
        </p>
    </div>
    <?php
    extract($onepro_categories)

    ?>
    <p class="product_title_name"><?= $name ?></p>
    <div class="row all_detail_products">
        <div class="col l-9">
            <div class="row">
                <!-- ảnh -->

                <div class="col l-6 image_hover_detail_scole">

                    <a href="./imageProduct/<?= $avatar ?>" class="MagicZoom" id="product_change_images" data-options="cssClass: thumbnails-style-shaded;">
                        <img src="./imageProduct/<?= $avatar ?>" />
                    </a>
                </div>
                <div class="col l-6">
                    <!-- list ảnh -->
                    <div class="row product_list_img">
                        <?php foreach ($list_image_product as $value) {
                            extract($value);

                        ?>

                            <div class="col l-3 product__list_img-onec">
                                <a data-zoom-id="product_change_images" href="./imageProduct/<?= $images ?>" data-image="./imageProduct/<?= $images ?>">
                                    <img src="./imageProduct/<?= $images ?>" />
                                </a>
                            </div>
                        <?php } ?>
                        <?php
                        $giagiam = $price * ($discount / 100);
                        ?>
                    </div>

                    <!-- titile production -->
                    <h3 class="one_product_title_name_" style="text-align: left;"><?= $name ?></h3>
                    <!-- thương hiệu -->
                    <div class="product_name_brand_quantity">
                        <p class="product_brand">
                            Danh mục:
                            <span class="red_word">
                                <?= $name_category ?> </span>
                        </p>
                        <p class="product_brand">
                            Kho :
                            <?php if($quantity > 0):  ?>
                                <span class="red_word">Còn hàng</span>
                            <?php else: ?>
                                <span class="red_word">Hết hàng</span>
                            <?php endif; ?>
                        </p>

                    </div>
                    <!-- hướng dẫn chọn size -->
                  

                    <!-- giá -->
                    <div class="one_product_price_detail">

                        <p class="product_one_price">
                            <?= number_format($price - $giagiam) ?> <span class="product_currency">đ</span>
                        <p class="product_one_price_old">
                            <?= number_format($price) ?>

                            <span class="product_currency">đ</span>
                        </p>
                        </p>
                    </div>
                  

                    <!-- số lượng -->
                    <div class="product__one_quantity">

                        <form action="index.php?act=addToCart" id="form_quantity" method="post" enctype="multipart/form-data">
                              <!-- size -->
                            <div class="size--ProductDetail">
                                <ul>
                                    <li class="size" ><input name="" type="text" value="XS" readonly></li>
                                    <li class="size active"><input name="sizeProduct" type="text" value="S" readonly></li>
                                    <li class="size"><input name="" type="text" value="M" readonly ></li>
                                    <li class="size"><input name="" type="text" value="L" readonly ></li>
                                    <li class="size"><input name="" type="text" value="XL" readonly ></li>
                                    <li class="size"><input name="" type="text" value="2XL" readonly ></li>
                                </ul>
                            </div>
                            <!-- size -->
                            <div class="form_product_submit_quatity">
                                <p class="product_quantity_name">
                                    Số lượng :
                                </p>
                                <input id="quantityCheck" type="text" hidden value="<?= $quantity ?>">
                                <div class="quantity_change_number">
                                    <div class="btn_decre">-</div>
                                    <input type="text" id="btn_product_quantity_input" min="1" name="product_quantity_input" value="1">
                                    <div class="btn_incre">+</div>
                                </div>
                            </div>
                            <!-- form id price sp -->
                            <input type="hidden" name="id" value="<?= $id ?>">
                            <input type="hidden" name="price" value="<?= $price ?>">
                            <input type="hidden" name="giagiam" value="<?= $price - $giagiam ?>">
                            <!--  -->
                            <div class="one_product_btn_buy">
                                <?php if($quantity > 0):  ?>
                                    <button type="submit" name="btn-addCart" class="btn_buy_products">Mua
                                    ngay</button>
                                <?php else: ?>
                                    <span class="red_word"></span>
                                <?php endif; ?>
                               
                                <div class="contact_information">
                                    <p>Mua số lượng lớn
                                        <br>
                                        Gọi ngay 19006750
                                    </p>
                                    <span class="prodcut_icon_phone_number">
                                        <i class="fa-solid fa-phone fa-2x"></i>

                                    </span>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>

            </div>
            <!-- tab chọn bình luận -->
            <div class="row mt_chung">
                <ul class="product_change_tab">
                    <li class='tab-item active'>Mô tả sản phẩm</li>
                    <li class="tab-item">Bình luận - đánh giá</li>
                    <!-- <li class="tab-item">Demo</li> -->
                </ul>
            </div>
            <div class="row product_desc_detail">
                <!-- mô tả sản phẩm  -->
                <div class="tab-pane active">
                    <p>
                        <?= $description ?>

                    </p>
                </div>
                <!-- tab tùy chỉnh -->
                <div class="tab-pane">
                    <div class="row">
                        <div class="form-comment">
                            <ul class='show-comments_user'>
                                <?php foreach ($data as $value) : extract($value); ?>

                                    <li>
                                        <form ation="<?= $_SERVER['PHP_SELF'] ?>" method="post" class="form_edit_delete">
                                            <input type="hidden" name="id_comment" value="<?= $id ?>">
                                            <input type="hidden" name="id_product" value="<?= $_GET['id'] ?>">
                                            <input type="hidden" name="content_comment" value="<?= $content ?>">

                                            <div class="form-comment--one">
                                                <div class="form-comment__avatar">
                                                <?php
                                                    if ($image != "") {
                                                         echo'<img src="./Admin/UserAvt/'.$image.'" alt="">';
                                                        } else {
                                                            $string1 = $name_person_comment;
                                                            $string = convert_vi_to_en($string1);
                                                            $pieces = explode(' ', $string);
                                                            $name_user1 = array_pop($pieces);
                                                            $name_user2 = ucfirst($name_user1);
                                                            $name_user3 = substr($name_user2, 0, 1);
                                                            echo ' <div class="cmt_pro---img" style=" position: relative; height: 37px; width: 37px; background-color: #ff2d37; border-radius: 50%;">
                                                            <span class="name" style=" position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); color: white; font-weight: 500; font-size: 19px; ">'.$name_user3.'</span>
                                                        </div>';
                                                        }
                                                 ?>
                                                </div>
                                                <div class="form-comment__content">
                                                    <div class="form__toggle_clickedit">
                                                        <div class="form-comment__content--text">

                                                            <p class="id_comment"> <?= $name_person_comment ?> </p>
                                                            <p class="content_comment"><?= $content ?></p>
                                                            <p class="review_comment">
                                                                <input type="hidden" value="<?= $rating_products ?>" name="rating_products">
                                                                <?php for ($i = 0; $i < $rating_products; $i++) { ?>
                                                                    <i class="fa-solid fa-star orange"></i>

                                                                <?php } ?>
                                                            </p>
                                                        </div>
                                                        <span class="form-comment__content--button">

                                                            <?php
                                                            if (isset($_SESSION['user'])) {
                                                                if ($_SESSION['user']['id'] == $user_id) {  ?>
                                                                    <button onclick="return confirm('Bạn có chắc chắn muốn xóa comments <?= $content ?> không?')" name="delete_comment" class="a click_change" style="margin-right: 40px;" >Delete</button> 
                                                                    <?php
                                                                            }
                                                            } ?>
                                                            <?php

                                                            date_default_timezone_set("Asia/Ho_Chi_Minh");
                                                            $timeCurrent = time();
                                                            $timeCommentDate = $created_at;
                                                            $timeCommentString = strtotime($timeCommentDate);

                                                            $timeCommentCalculate = $timeCurrent - $timeCommentString;


                                                            // $timeCommentShow = date("s", $timeCommentCalculate)." giây";
                                                            $timeCommentShow = '<p style="white-space: normal;" >Vừa xong</p>';
                                                            if ($timeCommentCalculate > 0 && $timeCommentCalculate < 60) {
                                                                $timeCommentShow = date("s", $timeCommentCalculate) . "<span style='margin-left:5px; font-size:15px;'>giây</span>";
                                                            } else if ($timeCommentCalculate >= 60 && $timeCommentCalculate < 60 * 60) {
                                                                $timeCommentShow = date("i", $timeCommentCalculate) . "<span style='margin-left:5px; font-size:15px;'>phút</span>";
                                                            } else if ($timeCommentCalculate >= 60 * 60 && $timeCommentCalculate < 60 * 60 * 24) {
                                                                $timeCommentShow = date("G", $timeCommentCalculate - 8 * 60 * 60) . "<span style='margin-left:5px; font-size:15px;'>giờ</span>";
                                                            } else if ($timeCommentCalculate >= 60 * 60 * 24 && $timeCommentCalculate < 60 * 60 * 24 * 7) {
                                                                $timeCommentShow = floor($timeCommentCalculate / (60 * 60 * 24)) . "<span style='margin-left:5px; font-size:15px;'>ngày</span>";
                                                            } else if ($timeCommentCalculate >= 60 * 60 * 24 * 7) {
                                                                $timeCommentShow = floor($timeCommentCalculate / (60 * 60 * 24 * 7)) . "<span style='margin-left:5px; font-size:15px;'>tuần</span>";
                                                            }

                                                            ?>
                                                            <span style="font-size: 15px;"  >
                                                                <?= $timeCommentShow;
                                                                ?>
                                                            </span>
                                                        </span>
                                                    </div>

                                                </div>
                                            </div>
                                        </form>

                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="form_to_seen_cmt ">
                            <h3>Đánh giá, bình luận sản phẩm</h3>
                            <form ation="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                                <input type="hidden" id="count_start" name="count_start" value="">
                                <input type="hidden" name="id_product" value="<?= $_GET['id'] ?>">
                                <label for="">Đánh giá của bạn</label>
                                <ul class="stars">
                                    <li class="star">&#10029;</li>
                                    <li class="star">&#10029;</li>
                                    <li class="star">&#10029;</li>
                                    <li class="star">&#10029;</li>
                                    <li class="star">&#10029;</li>
                                </ul>
                                <input type="text" placeholder="Viết bình luận" name="content_comment" class="write_comment">
                                <input type="submit" class="write_comment_send" value="Send" name="send_add_comments">
                            </form>
                        </div>
                    </div>
                </div>
                <!-- tab tùy chỉnh -->
                <div class="tab-pane">
                    <p>
                        đổi nội dung
                    </p>
                </div>
            </div>
            <!-- sản phẩm cùng loại -->
            <div class="row"></div>
        </div>
        <div class="col l-3">
            <div class=" product_info_shipper ">
                <!-- vận chuyển -->
                <div class="product_info_shipper-item">
                    <div class="product_info_shipper-item-img">
                        <img src="./src/image/img_header_hoan/srv_1.webp" alt="">

                    </div>
                    <div class="product_info_shipper-title">
                        <p class="product_info_shipper-title--name">
                            Miễn phí vận chuyển
                        </p>
                        <p class="product_info_shipper-desc-title">
                            Miễn phí vận chuyển nội thành
                        </p>
                    </div>
                </div>
                <!-- đổi trả hàng -->
                <div class="product_info_shipper-item">
                    <div class="product_info_shipper-item-img">
                        <img src="./src/image/img_header_hoan/srv_2.webp" alt="">

                    </div>
                    <div class="product_info_shipper-title">
                        <p class="product_info_shipper-title--name">
                            Đổi trả hàng
                        </p>
                        <p class="product_info_shipper-desc-title">
                            Đổi trả lên tới 30 ngày
                        </p>
                    </div>
                </div>
                <!-- thời gian -->
                <div class="product_info_shipper-item">
                    <div class="product_info_shipper-item-img">
                        <img src="./src/image/img_header_hoan/srv_3.webp" alt="">

                    </div>
                    <div class="product_info_shipper-title">
                        <p class="product_info_shipper-title--name">
                            Tiết kiệm thời gian
                        </p>
                        <p class="product_info_shipper-desc-title">
                            Mua sắm dễ hơn khi online
                        </p>
                    </div>
                </div>
                <!-- tư vấn -->
                <div class="product_info_shipper-item">
                    <div class="product_info_shipper-item-img">
                        <img src="./src/image/img_header_hoan/srv_4.webp" alt="">

                    </div>
                    <div class="product_info_shipper-title">
                        <p class="product_info_shipper-title--name">
                            Tư vấn trực tiếp
                        </p>
                        <p class="product_info_shipper-desc-title">
                            Đội ngũ tư vấn nhiệt tình
                        </p>
                    </div>
                </div>

            </div>
            <!-- bộ sưu tập -->
            <h3 class="collection_product_list">Bộ sưu tập hot</h3>
            <div class=" collection_product_list--item ">
                <?php
                foreach ($protop4 as $value) {
                    extract($value);
                    $pricesale = $price * ($discount / 100);

                    $img =  $image_path . $avatar;
                    $linkpro = "index.php?act=detail_product&id=" . $id;
                    echo '<div class="one_collection_product_list--item-detail">
                      <div class="one_product_list--item-detail-img">
                          <a href="' . $linkpro . '"> <img src="' . $img . '" alt=""></a>
            </div>
            <div class="one_product_list--item-detail-nameproduct">
                <p>
                    <a href="">
                        ' . $name . '
                    </a>
                </p>
                <p class="red_word">' . number_format($price - $pricesale) . '<span class="product_currency">đ</span>
                </p>
                <span class="product_one_price_old">' . number_format($price) . '<span class="product_currency">đ</span>
                </span>
            </div>
        </div>';
                }
                ?>
            </div>
        </div>
    </div>
    <!-- hàng cùng loại -->
    <div class="row">
        <section class="grid wide section__product--hot">
            <h2 class="product_list_with_categories_title">SẢN PHẨM cùng loại</h2>
            <div class="section__product--hot__banner review__product--hot row">

                <?php
                foreach ($protop5 as $value) {
                    extract($value);
                    $pricesale = $price * ($discount / 100);
                    $img =  $image_path . $avatar;
                    $linkpro = "index.php?act=detail_product&id=" . $id;
                    echo '<div class="col l-2-4 m-6 c-6">
                      <div class="product__banner">
                          <div class="product--hot__img">
                          <a href="' . $linkpro . '"> <img src="' . $img . '"
                                  alt="">  </a>
                          </div>
                          <div class="product__banner__name">
                          <a href="' . $linkpro . '">   <p>' . $name . '</p>  </a>
                          </div>
                      </div>
                      <div class="product__banner__price">
                          <div>
                              <p class="product__banner__price--cost">' . number_format($price - $pricesale) . '<u>đ</u></p>
                              <p class="product__banner__price--sale product_one_price_old">' . number_format($price) . '<u>đ</u></p>
                          </div>
                          <div class="product__banner__btn--detail">
                              <a href="' . $linkpro . '">chi tiết</a>
                          </div>
                      </div>
                      </div>';
                }
                ?>
            </div>
        </section>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script>
    let btn_decre = document.querySelector(".btn_decre");
    let btn_incre = document.querySelector(".btn_incre");
    const quantityCheck = document.querySelector('#quantityCheck');

    let btn_product_quantity_input = document.querySelector("#btn_product_quantity_input")
            
    btn_incre.addEventListener("click", () => {
        if (btn_product_quantity_input.value == quantityCheck.value) {
            btn_incre.disabled = true;
            alert('Bạn đã đặt quá số lượng tồn tại');
        } else {
            btn_incre.style.cursor = 'pointer';
            console.log(btn_product_quantity_input.value);
            btn_product_quantity_input.value++;
        }
    });
    btn_decre.addEventListener("click", () => {
        if (btn_product_quantity_input.value == 1) {
            btn_decre.disabled = true;
        } else {
            btn_decre.style.cursor = 'pointer';
            console.log(btn_product_quantity_input.value);
            --btn_product_quantity_input.value;
        }
    });
    // chuyển tab
    let tab_iteam = document.querySelectorAll('.tab-item');
    let tab_pane = document.querySelectorAll('.tab-pane');


    tab_iteam.forEach((tab, index) => {
        tab.onclick = function() {
            const panes = tab_pane[index];

            document.querySelector(".tab-item.active").classList.remove("active");

            document.querySelector(".tab-pane.active").classList.remove("active");
            this.classList.add("active");
            panes.classList.add("active");
        }
    });

    const starUl = document.querySelector(".stars");
    const stars = document.querySelectorAll(".star");
    const count_start = document.querySelector("#count_start");
    stars.forEach((star, index) => {
        star.starValue = (index + 1);

        star.addEventListener("click", starRate);

    })


    function starRate(e) {
        count_start.value = e.target.starValue;
        stars.forEach((star, index) => {
            if (index < e.target.starValue) {
                star.classList.add("orange")
            } else {
                star.classList.remove("orange")
            }
        })
    }
    // Chuyển size
    const parentSize = document.querySelector('.size--ProductDetail ul');
    const menuSize = parentSize.querySelectorAll('li');
    menuSize.forEach((size, index) => {
        size.onclick = function(){
            const getNameSize = parentSize.querySelector('.size.active');
            getNameSize.classList.remove("active");
            getNameSize.querySelector('input').name = "";
            this.classList.add("active");
            this.querySelector('input').name = "sizeProduct";
        }
    });
    // Chuyển size




</script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.review__product--hot').slick({
            slidesToShow: 5,
            slidesToScroll: 1,
            // autoplay: true,
            autoplaySpeed: 2000,
            arrows: true,
            prevArrow: '<span class="prevArrow" id="prevArrowLimited"><i class="fa-solid fa-chevron-left"></i></span>',
            nextArrow: '<span class="nextArrow" id="nextArrowLimited"><i class="fa-solid fa-chevron-right"></i></span',
            slidesToScroll: 1
        });
    });
</script>