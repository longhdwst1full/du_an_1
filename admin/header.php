<!DOCTYPE html>
<html lang="en">



<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistical Page</title>
    <!-- CSS only -->

    <link rel="stylesheet" href="../src/css/style.css">
    <link rel="stylesheet" href="../src/css/productAdmin.css">
    <link rel="stylesheet" href="../src/css/categoryAdmin.css">
    <link rel="stylesheet" href="../src/css/comment.css">
    <link rel="stylesheet" href="../src/css/billAdmin.css">
    <link rel="stylesheet" href="../src/css/showUser.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="../src/css/product_review.css">
    
</head>

<body>
    <div class="container">
        <!-- Start navigation left -->
        <nav class="navigationRow">
            <div class="featuresRow">
                <div class="titlePageAdmin">
                    <div class="logoBrand">
                        <!-- <a href=""><img src="src/image/FSport.png" alt=""></a> -->
                        <a href="../index.php"><img src="../src/imageAdmin/FSport1.png" alt=""></a>
                        <a href="../index.php" class="hiddenImage"><img src="../src/imageAdmin/FSport2.png" alt=""></a>
                    </div>
                </div>
                <div class="spaceLogoBrand">
                    <div class="menuShowIcon">
                        <div class="Iconlabel">
                            <i class="fa-solid fa-bars"></i>
                        </div>
                    </div>
                    <div class="accountAdmin row">
                        <div class="avatarAdmin row">
                            <?php
                                if ($_SESSION['user']['image'] != "") {
                                    echo
                                    '   <img src="./UserAvt/' . $_SESSION['user']['image'] . '" alt="">';
                                } else {
                                    $string1 = $_SESSION['user']['name'];
                                    $string = convert_vi_to_en($string1);
                                    $pieces = explode(' ', $string);
                                    $name_user1 = array_pop($pieces);
                                    $name_user2 = ucfirst($name_user1);
                                    $name_user3 = substr($name_user2, 0, 1);
                                    echo
                                    '  <div class="imgNameUser-right">
                                        <span class="nameUser-right">' . $name_user3 . '</span>
                                    </div>';
                                }
                            ?>
                        </div>
                        <div class="nameAdmin row">
                            <?= $_SESSION['user']['name'] ?>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <nav class="navigationColumn">
            <!-- Navigation First -->
            <div class="listMainFirst">
                <div class="accountAdmin accountAdmin--canHidden">
                    <div class="avatarAdmin">
                        <?php
                        if ($_SESSION['user']['image'] != "") {
                            echo
                            '  <img src="./UserAvt/' . $_SESSION['user']['image'] . '" alt="">';
                        } else {
                            $string1 = $_SESSION['user']['name'];
                            $string = convert_vi_to_en($string1);
                            $pieces = explode(' ', $string);
                            $name_user1 = array_pop($pieces);
                            $name_user2 = ucfirst($name_user1);
                            $name_user3 = substr($name_user2, 0, 1);
                            echo
                            '  <div class="imgNameUser">
                            <span class="nameUser-small">' . $name_user3 . '</span>
                        </div>';
                        }
                        ?>
                    </div>
                    <div class="nameAdmin nameAdmin--navLeft">
                        <?=$_SESSION['user']['name']?>
                        <div class="statusAdmin">
                            <div></div>
                            <p>Online</p>
                        </div>
                    </div>
                </div>
                <div class="titleList">
                    <h2>Danh sách chức năng</h2>
                </div>
                <nav class="navigationListFisrt">
                    <ul>
                        <li>
                            <a href="index.php"><i class="fa-solid fa-house"></i></a>
                            <a href="index.php" class="canHidden">Trang chủ</a>
                        </li>
                        <li>
                            <a href="index.php?actAdmin=showProduct"><i class="fa-brands fa-product-hunt"></i></a>
                            <a href="index.php?actAdmin=showProduct" class="canHidden">Quản lý sản phẩm</a>
                        </li>
                        <li>
                            <a href="index.php?actAdmin=listCategories"><i class="fa-solid fa-book-atlas"></i></a>
                            <a href="index.php?actAdmin=listCategories" class="canHidden">Quản lý danh mục</a>
                        </li>
                        <li>
                            <a href="index.php?actAdmin=showOrder"><i class="fa-solid fa-cart-flatbed-suitcase"></i></a>
                            <a href="index.php?actAdmin=showOrder" class="canHidden">Quản lý đơn hàng</a>
                        </li>
                        <li>
                            <a href="index.php?actAdmin=showUsers"><i class="fa-solid fa-user"></i></a>
                            <a href="index.php?actAdmin=showUsers" class="canHidden">Quản lý người dùng</a>
                        </li>
                        <li>
                            <a href="index.php?actAdmin=comments&&page=1"><i class="fa-solid fa-comment"></i></a>
                            <a href="index.php?actAdmin=comments&&page=1" class="canHidden">Quản lý bình luận</a>
                        </li>
                        <li>
                            <a href="index.php?actAdmin=statisticals"><i class="fa-solid fa-database"></i></a>
                            <a href="index.php?actAdmin=statisticals" class="canHidden">Thống kê báo cáo</a>
                        </li>
                        <li>
                            <a href="index.php?actAdmin=dangxuat"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
                            <a href="index.php?actAdmin=dangxuat" class="canHidden">Đăng xuất</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <!-- Navigation First -->
        </nav>