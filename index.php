<!-- Conttroller khách hàng -->
<?php
ob_start();
session_start();

require_once "./global.php";
require_once "./model/pdo.php";
require_once "./model/model-user.php";
require_once "./model/model-product.php";
require_once "./model/model-category.php";
require_once "./model/model-order.php";
require_once "./model/model-comment.php";
updateViewAccessWebsite();
$pronew = loadall_product_home();
$pronew2 = loadall_product_home2();
$pronew3 = loadall_product_home3();



if (!isset($_SESSION['mycart'])) {
    $_SESSION['mycart'] = [];
}
// Ai làm bên này có giao diện người dùng thì tự động thêm vào
// Làm cái gì thì cứ comment tên người làm lại ở đầu và cuối chức năng
// Comment thêm tên chức năng nữa nhé
$protop8 =  loadtop8_product_home();
// $protop16 = loadtop16_product_home();
$protop4 = loadtop4_product_home();
$dsdm = loadall_category();
$load2dm = load2_category();
$load3dm = load3_category();
$fillter_price_desc = fillter_price_desc();
$fillter_created_at_desc = fillter_created_at_desc();
$fillter_create_at_asc = fillter_create_at_asc();
$fillter_price_asc = fillter_price_asc();
require_once "view/header.php";
if (isset($_GET['act'])) {
    $actAdmin = $_GET['act'];
    switch ($actAdmin) {
            // Hiệp làm showProducts
        case 'showProducts':  // hiện thị sản phẩm theo danh mục
            if (isset($_POST['kyw']) && ($_POST['kyw'] != "")) {
                $kyw = $_POST['kyw'];
            } else {
                $kyw = "";
            }
            if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                $idcategori = $_GET['id'];
            } else {
                $idcategori = 0;
            }

            $prolist = loadall_product($kyw, $idcategori);
            $prolist1 = loadall_product_fromproducs();

            $namecategory = load_name_category($idcategori);

            require_once "view/showProducts.php";
            break;
        case 'detail_product':
            if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                $id = $_GET['id'];
                $onepro_categories =  loadone_detail_product_flow_categories($id);
                $list_image_product = loadone_detail_product_flow_product_images($id);
                $idCategory = $onepro_categories['id_category'];
                // extract($onepro_categories);
                // var_dump($onepro_categories);
                // die();
                $protop5 = loadtop4_product_home2($idCategory);


                $data = comment_select_by_users($id);

                require_once "view/detail_product.php";
            } else {
                require_once "view/home.php";
            }

            break;
            // Đức làm đăng ký đăng nhập quên mật khẩu
        case 'thongtintaikhoan':
            if (!isset($_SESSION['user'])) {
                require_once "view/dangnhap.php";
            } else {
                if (isset($_POST['capnhat'])) {
                    $id = $_SESSION['user']['id'];
                    $name_update = $_POST['name'];
                    $email_update = $_POST['email'];
                    $password_update = $_SESSION['user']['password'];
                    $phone_update = $_POST['phone'];
                    $address_update = $_POST['address'];
                    $ngaytao = $_SESSION['user']['created_at'];
                    $image = $_FILES['image'];
                    $status_update = $_SESSION['user']['status'];
                    $role_update = $_SESSION['user']['role'];
                    $check = true;
                    if ($name_update == "") {
                        $thongbao[0] = "Tên không được bỏ trống !!!";
                        $check = false;
                    } else if (is_numeric($name_update) || (strlen($name_update) < 2)) {
                        $thongbao[0] = "Tên không phải là số , tối thiểu 2 ký tự !";
                        $check = false;
                    }
                    if ($email_update == "") {
                        $thongbao[1] = "Email không được bỏ trống !!!";
                        $check = false;
                    } else if (!filter_var($email_update, FILTER_VALIDATE_EMAIL)) {
                        $thongbao[1] = "Email không đúng định dạng";
                        $check = false;
                    }
                    if ($address_update == "") {
                        $thongbao[2] = "Địa chỉ không được bỏ trống !!!";
                        $check = false;
                    } else if (is_numeric($address_update) || (strlen($address_update) < 2)) {
                        $thongbao[2] = "Địa chỉ không phải là số , tối thiểu 6 ký tự !";
                        $check = false;
                    }
                    if ($phone_update == '') {
                        $thongbao[3] = "Điện thoại không được bỏ trống !!!";
                        $check = false;
                    } else if (!is_numeric($phone_update)) {
                        $thongbao[3] = "Điện thoại phải là số !!!";
                        $check = false;
                    } else if (strlen($phone_update) != 10) {
                        $thongbao[3] = "Điện thoại phải đủ 10 số !!!";
                        $check = false;
                    }
                    if ($image['size'] <= 0) {
                        $NameurlImage = $_SESSION['user']['image'];
                    } else {
                        $NameurlImage = $image['name'];
                        $ext = pathinfo($NameurlImage, PATHINFO_EXTENSION);
                        if ($ext != 'gif' && $ext != 'jpeg' && $ext != 'png' && $ext != 'jpg') {
                            $thongbao[4] = "Sai định dạng ảnh(png,jpg,jpeg,gif)";
                            $check = false;
                        } else {
                            $pathImage = $image['tmp_name'];
                            $target_file = "Admin/UserAvt/" . $NameurlImage;
                            move_uploaded_file($pathImage, $target_file);
                        }
                    }
                    if ($check == true) {
                        UpdatetUserGuest($name_update, $email_update, $password_update, $phone_update, $address_update, $NameurlImage, $status_update, $role_update, $ngaytao, $id);
                        header('Location: index.php?act=thongtintaikhoan&&msg=Cập nhật thành công !');
                        ob_end_flush();
                        $id = $_SESSION['user']['id'];
                        $user = getUserFollowId($id);
                        unset($_SESSION['user']);
                        $_SESSION['user'] = [];
                        $_SESSION['user'] = $user;
                    }
                }
                require_once "view/information_user.php";
            }
            break;
        case 'doimatkhau':
            if(isset($_SESSION['user'])){
                if (isset($_POST['doimatkhau'])) {
                    $password_old = $_POST['password_Old'];
                    $password_new = $_POST['password_new'];
                    $verypassword_new = $_POST['verypassword_new'];
                    $id = $_SESSION['user']['id'];
                    $check = true;
                    $password_old_md5 = md5($password_old);
                    if ($password_old_md5 != $_SESSION['user']['password']) {
                        $thongbao[1] = "Mật khẩu cũ không chính xác  !!!";
                        $check = false;
                    }
                    if ($password_old == '') {
                        $thongbao[1] = "Trường này không được bỏ trống  !!!";
                        $check = false;
                    }
                    if ($password_new == '') {
                        $thongbao[2] = "Trường này không được bỏ trống  !!!";
                        $check = false;
                    } else if (strlen($password_new) < 8) {
                        $thongbao[2] = "Mật khẩu tối thiểu 8 ký tự  !!!";
                        $check = false;
                    }
                    if ($verypassword_new == '') {
                        $thongbao[3] = "Trường này không được bỏ trống  !!!";
                        $check = false;
                    } else if ($verypassword_new != $password_new) {
                        $thongbao[3] = "Mật khẩu xác nhận không chính xác !!!";
                        $check = false;
                    }
                    if ($check == true) {
                        $password_new_insert = md5($password_new);
                        UpdatePasstUser($password_new_insert, $id);
                        header('Location: index.php?act=doimatkhau&&msg=Cập nhật mật khẩu thành công !');
                        ob_end_flush();
                    }
                }
                require_once "view/doimatkhau.php";
            }else{
                header("Location: index.php");
                ob_end_flush();
            }
            break;
        case 'dangnhap':
            if (isset($_POST['dangnhap']) == true) {
                $email_login = $_POST['email_login'];
                $password = $_POST['password'];
                $check = true;
                $code = $_POST['code'];
                if ($email_login == "") {
                    $thongbao[1] = "Email không được bỏ trống !";
                    $check = false;
                } else if (!filter_var($email_login, FILTER_VALIDATE_EMAIL)) {
                    $thongbao[1] = "Email sai định dạng VD: duc@abc.xyz !";
                    $check = false;
                }
                if ($password == "") {
                    $thongbao[2] = "Mật khẩu không được bỏ trống !";
                    $check = false;
                } else if (strlen($password) < 6) {
                    $thongbao[2] = "Mật khẩu tối thiểu 6 ký tự";
                    $check = false;
                }
                $password = md5($password);
                $checkuser_success = CheckUser($email_login, $password);
                if ($check == true) {
                    if (is_array($checkuser_success)) {
                        if (($checkuser_success['status'] == 1)) {
                            $thongbao[0] = "Tài khoản của bạn đã bị vô hiệu hóa liên hệ admin để được hỗ trợ !";
                        } else {
                            if(isset($code) && ($code>100000)) {
                                $_SESSION['user'] = $checkuser_success;
                                header("Location: index.php?act=doimatkhau&codelogin=".$code);
                            }else{
                                $_SESSION['user'] = $checkuser_success;
                                $thongbao[0] = "Đăng nhập thành công !";
                                echo $_GET['code'];
                                header("Location: index.php");
                                ob_end_flush();
                            }
                        }
                    } else {
                        $thongbao[0] = "Sai email hoặc mật khẩu !";
                    }
                }
            }
            if (isset($_POST['quenmatkhau']) == true) {
                $email = $_POST['email'];
                $name = $_POST['name'];
                $check = true;
                if($name == ''){
                    $thongbao[4] = "Vui lòng nhập họ tên trong tài khoản";
                    $check = false;
                }
                if ($email == "") {
                    $thongbao[3] = "Vui lòng nhập email liên kết tài khoản";
                    $check = false;
                } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $thongbao[3] = "Email sai định dạng VD: duc@abc.xyz !";
                    $check = false;
                } 
                if($check==true){
                    $pass = rand(100000,999999);
                    $check_email = CheckEmail_Name($email,$name);
                    if (is_array($check_email)) {
                        // $thongbao[5] = 'Mật khẩu của bạn là: ' . $pass;
                        $passins = md5($pass);
                        Reset_pass($passins,$email,$name);
                        header("Location: index.php?act=dangnhap&codelogin=Mật khẩu mới của bạn là: ".$pass.'&code='.$pass);
                    } else {
                        $thongbao[5] = 'Email "' . $email . '" hoặc họ tên "'.$name.'" không đúng';
                    }
                }
            }
            // if (isset($_SESSION['user'])) {
            //     header("Location: index.php?");
            // } else {
                //     require_once "./view/dangnhap.php";
                // }
            if(!isset($_SESSION['user'])){
                require_once "./view/dangnhap.php";
            }

            break;
        case 'dangky':
            if (isset($_POST['dangky'])) {
                $check = true;
                $checkemail_tontai = true;
                $ho = $_POST['ho'];
                $ten = $_POST['ten'];
                $name = $ho . ' ' . $ten;
                $email = $_POST['email'];
                $password = $_POST['password'];
                $phone = '';
                $address = '';
                $image = '';
                $role = 0;
                // Vaidate form đăng ký
                if ($ho == "") {
                    $thongbao[1] = "Họ không được bỏ trống !!!";
                    $check = false;
                } else if (is_numeric($ho) || (strlen($ho) < 2)) {
                    $thongbao[1] = "Họ không phải là số , tối thiểu 2 ký tự !";
                    $_POST['ho'] = "";
                    $check = false;
                }
                if ($ten == "") {
                    $thongbao[2] = "Tên không được bỏ trống !!!";
                    $check = false;
                } else if (is_numeric($ten) || (strlen($ten) < 2)) {
                    $thongbao[2] = "Tên không phải là số , tối thiểu 2 ký tự !";
                    $_POST['ten'] = "";
                    $check = false;
                }
                if ($email == "") {
                    $thongbao[5] = "Email không được bỏ trống !!!";
                    $check = false;
                } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $thongbao[5] = "Email không đúng định dạng";
                    $_POST['ten'] = "";
                    $check = false;
                }
                if ($password == "") {
                    $thongbao[3] = "Mật khẩu không được bỏ trống !!!";
                    $check = false;
                } else if ((mb_strlen($password) < 6)) {
                    $thongbao[3] = "Mật khẩu tối thiểu 6 ký tự !";
                    $check = false;
                }
                $checkmail_dangky = CheckEmail($email);
                if (is_array($checkmail_dangky)) {
                    echo '<style> .form_validate_dangky{display: none !important;}</style>';
                    $_POST['ho'] = "";
                    $_POST['ten'] = "";
                    $_POST['email'] = "";
                    $thongbao[4] = "Email đã tồn tại đăng nhập để mua hàng !";
                    $checkemail_tontai = false;
                }
                if ($check == true && $checkemail_tontai == true) {
                    $thongbao[0] = "Đăng ký thành công !";
                    $_POST['ho'] = "";
                    $_POST['ten'] = "";
                    $_POST['email'] = "";
                    $email = convert_vi_to_en($email);
                    $email = strtolower($email);
                    $password = convert_vi_to_en($password);
                    $password = strtolower($password);
                    $password = preg_replace('/\s+/', '', $password);
                    $password = md5($password);
                    InsertUser($name, $email, $password, $phone, $address, $image, $role);
                    header("Location: index.php?act=dangnhap&msg=Tạo tài khoản thành công !!!");
                    ob_end_flush();
                }
            }
            if (isset($_SESSION['user'])) {
                header("Location: index.php?");
            } else {
                require_once "view/dangky.php";
            }
            break;
        case 'dangxuat':
            session_destroy();
            header("Location: index.php?act=dangnhap&msg=Đã đăng xuất !!!");
            break;

            // long cart 


        case "cart":
            require_once "./view/cart/giohang.php";
            break;
        case "addToCart":
            $temp = -1;
            if (isset($_POST['btn-addCart'])) {
                $id = $_POST['id'];
                $sizeProduct = $_POST['sizeProduct'];
                $giagiam = $_POST['giagiam'];
                $product_quantity_input = $_POST['product_quantity_input'];
                $product_value = getOneProductFlowId($id);
                $product_value['use_quantity_buy'] = $product_quantity_input;
                $product_value['giagiam'] = $giagiam;
                $product_value['sizeProduct'] = $sizeProduct;

                foreach ($_SESSION['mycart'] as $key => $item) {
                    if ($id == $item['id'] && $sizeProduct == $item['sizeProduct']) {
                        $temp = $key;
                        break;
                    }
                }
                if ($temp == -1) {
                    $_SESSION['mycart'][] = $product_value;
                } else {
                    // nếu id của sp đã có trong giỏ hàng rồi
                    // lấy ra số index của sản phẩm bị trùng
                    // cập nhật số lượng quantity ++
                    $_SESSION['mycart'][$temp]['use_quantity_buy'] += $product_quantity_input;
                }

                echo "<script>window.location.href='index.php?act=cart';</script>";
            }

            // $_SESSION['mycart'] = [];

            require_once "./view/cart/giohang.php";

            break;
            // delete product cart
        case "delete_product_cart_byId":

            $id = $_GET['id'];
            unset($_SESSION['mycart'][$id]);
            // echo "<script>
            // window.location.href = 'index.php?act=cart';
            // </script>";
           
         // require_once "./view/cart/giohang.php";
            echo "<script>window.location.href='index.php?act=cart';</script>";

            break;
            // update quantity use by product
        case "update_quantity_products_Cart":
            $id = $_GET['id'];
            $type = $_GET['type'];
            if ($type == 'decre') {
                if ($_SESSION['mycart'][$id]['use_quantity_buy'] > 1) {

                    $_SESSION['mycart'][$id]['use_quantity_buy']--;
                } else {
                    unset($_SESSION['mycart'][$id]);
                }
            } else {
                $_SESSION['mycart'][$id]['use_quantity_buy']++;
            }

            // require_once "./view/cart/giohang.php";
            echo "<script>window.location.href='index.php?act=cart';</script>";

            break;

            //pay money 
        case "payMoneyProducts":
            if (!isset($_SESSION['user'])) {
                require_once "./view/dangnhap.php";
                exit;
            } else {
                $totalAllProductPay = isset($_POST['totalAllProductPay']) ? $_POST['totalAllProductPay'] : $_POST['totalPricePay'];
            
                if (isset($_POST['btn-orderSuccess'])) {
                    date_default_timezone_set("Asia/Ho_Chi_Minh");
                    $errors = [];
                    $name = $_POST['name'];
                    $id = $_SESSION['user']['id'];
                    $phoneNumber = $_POST['phone_number'];
                    $address = $_POST['address'];
                    $payWhen = isset($_POST['payWhen']) ? $_POST['payWhen'] : "";
                    $note = $_POST['note'];
                    $totalPricePay = $_POST['totalPricePay1'];
                    $dateCurrent = time();
                    $dateToInt = date("Y-m-d h:i:s", $dateCurrent);

                    
                    if(!isset($_POST['btn-checkRule'])){
                        $errors['checkRule'] = "Chấp nhận chính sách để thanh toán!";
                    }
                    


                    if ($phoneNumber == "") {
                        $errors['phoneNumber'] = "Bạn phải nhập số điện thoại";
                    } else if (!is_numeric($phoneNumber)) {
                        $errors['phoneNumber'] = "Địa chỉ số điện thoại phải là số";
                    } else if (strlen($phoneNumber) != 10  || substr($phoneNumber, 0, 1) != 0) {
                        $errors['phoneNumber'] = "Số điện thoại không tồn tại";
                    }
                    if ($address == "") {
                        $errors['address'] = "Bạn phải nhập địa chỉ";
                    }
                    if (!$errors) {
                        $idOrder = insertToOrderClient($id, $payWhen, $totalPricePay, $note, $address,$dateToInt);
                        foreach ($_SESSION['mycart'] as $value) {
                            insertToOrderDetail($idOrder, $value['id'], $value['use_quantity_buy'], $value['giagiam'],$value['sizeProduct']);
                            updateQuantityPaySuccess($value['id'],$value['use_quantity_buy']);
                        }
                        // header("location: index.php?act=dsdonhang");
                        $_SESSION['mycart'] = [];
                        echo "<script> 
                                alert('Bạn đã mua hàng thành công');
                                window.location.href = 'index.php?act=dsdonhang';
                            </script>";
                          
                    }
                }
                require_once "./view/cart/pay_detail.php";
            }
            break;
        case "dsdonhang":
            if (!isset($_SESSION['user'])) {
                require_once "./view/dangnhap.php";
                exit;
            } else {
                $id = $_SESSION['user']['id'];
                $listYourOrder = getYourOrder($id);
                require_once "./view/cart/pay_finished.php";
            }

            break;
        case "cancelOrderUser":
            $idOrder = $_GET['idOrder'] ?? "";
            if(is_numeric($idOrder) && $idOrder > 0){
                $_SESSION['mycart'] = [];
                $product_value = selectOrderCancelToCart($idOrder);
                foreach($product_value as $value){
                    $_SESSION['mycart'][] = $value;
                    updateQuantityWhenCancelOrder($value['id'],$value['use_quantity_buy']);
                }
                cancelOrderUserFromDetailOrder($idOrder);
                cancelOrderUserFromOrder($idOrder);
                header("location: index.php?act=cart");
            }
            break;
        case "lienhe":
            require_once "./view/lienhe.php";
            break;
        case "gioithieu":
            require_once "./view/gioithieu.php";
            break;

        case "tintuc":
            $listLowPrice = fillter_price_low();
            require_once "./view/tintuc.php";
            break;
    
        default:
            // require_once "";
            break;
    }
} else {
    require_once "view/home.php"; // Show giao diện người dùng ( Trang chủ  )
}
//  Show giao diện người dùng ( Footer )
require_once "view/footer.php";
?>