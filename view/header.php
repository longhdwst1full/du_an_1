<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fsport</title>
    <link href="./src/css/magiczoomplus-trial/magiczoomplus/magiczoomplus.css" rel="stylesheet" type="text/css" media="screen" />
    <script src="./src/css/magiczoomplus-trial/magiczoomplus/magiczoomplus.js" type="text/javascript"></script>

    <script src="https://kit.fontawesome.com/f5f3ef5d7f.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./src/css/dangky_dangnhap.css" />
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.2.0/css/sharp-solid.css" />
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.2.0/css/all.css" />
    <link rel="stylesheet" href="./src/css/header_hoan.css">
    <link rel="stylesheet" href="./src/css/gridsystem.css">
    <link rel="stylesheet" href="./src/css/section.css">
    <link rel="stylesheet" href="./src/css/category.css">
    <link rel="stylesheet" href="./src/css/sanpham.css">
    <link rel="stylesheet" href="./src/css/detail_product.css">
    <link rel="stylesheet" href="./src/css/pay_detail.css">
    <link rel="stylesheet" href="./src/css/yourOrder.css">
    <link rel="stylesheet" href="./src/css/product_review.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


</head>

<body>
    <div class="grid">
        <!-- HEADER -->
        <header class="header__website" id="scrollUpHeader">
            <header class="header">
                <!-- <div class="topbar">
                <img class="topbar__img" src="./src/image/img_header_hoan/slideshow_1.png" alt="">
            </div> -->
                <div class="grid wide  mid-header">
                    <div class="mid-header__logo">
                        <a href="./index.php"><img src="./src/image/img_header_hoan/Layer 1.png" alt=""></a>
                    </div>

                    <div class="mid-header__nav">
                        <form action="index.php?act=showProducts" class="mid-header__form" method="post">
                            <input type="text" name="kyw" class="mid-header__form__ip__searchTerm mid-header__form__ip--size" placeholder="Tìm kiếm...">
                            <button type="submit" class="mid-header__form__btn__searchIcon" name="search">
                                <i class="fas fa-search" style="font-size:22px;color:#ff2d37"></i>
                            </button>
                        </form>
                        <a class="mid-header__support__link" href="">
                            <div class="mid-header__support">
                                <div class="mid-header__support__text">
                                    <p>Tư vấn bán hàng</p>
                                    <span>Gọi ngay 19004673</span>
                                </div>
                                <img class="mid-header__sp__img" src="./src/image/img_header_hoan/circle-phone-removebg-preview.png" alt="">
                            </div>
                        </a>

                        <div class="mid-header__user">
                            <ul class="mid-header__user-menu">
                                <?php
                                if (isset($_SESSION['user']) && is_array($_SESSION['user'])) {
                                    extract($_SESSION['user']);
                                    if ($_SESSION['user']['image'] != "") {
                                        echo
                                        '   <li class="ctn__user--img-1">
                                <a href="">
                                <img class="ctn__user--img-2" src="Admin/UserAvt/' . $_SESSION['user']['image'] . '" alt="" srcset="">
                                </a>';
                                        if ($_SESSION['user']['role'] == 1) {
                                            echo '
                                        <ul class="user__sup-menu user__sup-menu--haveAccount avtUserRole">
                                        <li class="user__sup-menu__sign-in li-sign ccc__334"><a href="index.php?act=dsdonhang">Danh sách đơn hàng</a></li>
                                        <li class="user__sup-menu__sign-in li-sign ccc__334"><a href="admin/index.php">Trang quản trị</a></li><li class="user__sup-menu__sign-in li-sign ccc__334"><a href="index.php?act=thongtintaikhoan">Thông tin tài khoản</a></li>
                                        <li class="user__sup-menu__sign-in li-sign ccc__334"><a href="index.php?act=dangxuat">Đăng xuất</a></li>';
                                        } else {
                                            echo ' 
                                        <ul class="user__sup-menu user__sup-menu--haveAccount avtUser">
                                        <li class="user__sup-menu__sign-in li-sign ccc__334"><a href="index.php?act=dsdonhang">Danh sách đơn hàng</a></li>
                                        <li class="user__sup-menu__sign-in li-sign ccc__334"><a href="index.php?act=thongtintaikhoan">Thông tin tài khoản</a></li>
                                        <li class="user__sup-menu__sign-in li-sign ccc__334"><a href="index.php?act=dangxuat">Đăng xuất</a></li>
                                    </ul>
                                    </li>';
                                        }
                                    } else {
                                        $string1 = $_SESSION['user']['name'];
                                        $string = convert_vi_to_en($string1);
                                        $pieces = explode(' ', $string);
                                        $name_user1 = array_pop($pieces);
                                        $name_user2 = ucfirst($name_user1);
                                        $name_user3 = substr($name_user2, 0, 1);
                                        echo
                                        '   <li class="ctn__user--img-1">
                                <a href="">
                                    <span class="mid-header__user__icon mid-header__user__icon--color">' . $name_user3 . '
                                    </span>
                                </a>
                                <ul class="user__sup-menu user__sup-menu--haveAccount user__sup-menu--haveAccount">
                                    <li class="user__sup-menu__sign-in li-sign ccc__334"><a href="index.php?act=dsdonhang">Danh sách đơn hàng</a></li>';
                                        if ($_SESSION['user']['role'] == 1) {
                                            echo '<li class="user__sup-menu__sign-in li-sign ccc__334"><a href="admin/index.php">Trang quản trị</a></li>';
                                        }
                                        echo ' <li class="user__sup-menu__sign-in li-sign ccc__334"><a href="index.php?act=thongtintaikhoan">Thông tin tài khoản</a></li>
                                    <li class="user__sup-menu__sign-in li-sign ccc__334"><a href="index.php?act=dangxuat">Đăng xuất</a></li>
                                </ul>
                                </li>';
                                    }
                                } else {
                                    echo '
                               <li>
                                <a href="">
                                <i class="mid-header__user__icon mid-header__user__icon--color fas fa-user">
                                </i>
                                </a>
                                <ul class="user__sup-menu">
                                <li class="user__sup-menu__sign-in li-sign ccc__334"><a href="index.php?act=dangnhap">Đăng nhập</a>
                                </li>
                                <li class="user__sup-menu__sign-in li-sign ccc__334"><a href="index.php?act=dangky">Đăng ký</a>
                                </li>
                                </ul>
                                </li>
                               ';
                                }
                                ?>
                            </ul>
                        </div>
                        <div class="mid-header__cart">
                            <div class="mid-header__cart--count">
                                <?php

                                echo sizeof($_SESSION['mycart']);

                                ?>
                            </div>
                            <a href="index.php?act=cart"><i class="mid-header__cart__icon mid-header__cart__icon--color fas fa-shopping-cart"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </header>
            <div class="nav--bg-color">
                <nav class="nav">
                    <ul class="nav__ul--main-menu">
                        <li class="nav__ul__li--list nav__ul--home"><a href="index.php">Trang chủ</a>
                        </li>
                        <li class="nav__ul__li--list nav__ul--product"><a href="index.php?act=showProducts">Sản phẩm</a></li>

                        <li class="nav__ul__li--list nav__ul--contact"><a href="index.php?act=lienhe">Liên hệ</a></li>
                        <li class="nav__ul__li--list nav__ul--introduce"><a href="index.php?act=gioithieu">Giới thiệu</a></li>
                        <li class="nav__ul__li--list nav__ul--news"><a href="index.php?act=tintuc">Tin tức</a></li>
                    </ul>
                </nav>
            </div>
        </header>