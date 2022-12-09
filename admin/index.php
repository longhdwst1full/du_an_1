<!-- Conttroller Quản trị -->

<?php
session_start();

if (isset($_SESSION['user'])  && ($_SESSION['user']['role'] == 1)) {
    ob_start();

require_once "../global.php";
require_once "../model/pdo.php";
require_once "../model/model-user.php";
require_once "../model/model-product.php";
require_once "../model/model-category.php";
require_once "../model/model-order.php";
require_once "../model/model-statistical.php";
require_once "../model/model-comment.php";

if (!isset($_SESSION['orderAdmin'])) {
    $_SESSION['orderAdmin'] = [];
}
if (!isset($_SESSION['orderUpdateAdmin'])) {
    $_SESSION['orderUpdateAdmin'] = [];
}
$sumMoneyShop = getTotalMoneyToShop();

$countView = getViewAccessWebsite();
$listBuyOnDay = buyProductWithDay();
$bestSale = bestProductSales();
$totalOrderWeek = totalOrderWithWeek();
$sumMoneyMonthCurrently = sumMoneyMonthCurrently();
$listProductFlCat = getFilterCategory();
require_once "./header.php";
if (isset($_GET['actAdmin'])) {
    $actAdmin = $_GET['actAdmin'];
    switch ($actAdmin) {

                // long code categories
            case 'addCategory':
                if (isset($_POST['btn--addProduct'])) {
                    // status 
                    // 0 là hiển thị 
                    // 1 là ẩn 
                    $name = $_POST['name'];
                    $status = $_POST['status'];
                    $avatar = uniqid()  . $_FILES['avatar']['name'];

                    $nameerr = "";
                    $imageerr = "";
                    $statuserr = "";

                    if (strlen($name) == 0) {
                        $nameerr = "Mời bạn nhập vào tên danh mục";
                    } else if (strlen($name) <= 5) {
                        $nameerr = "Tên danh mục phải lớn hơn >= 5 kí tự";
                    }
                    if (strlen($status) == 0) {
                        $statuserr = "Mời bạn chọn trạng thái hiển thị danh mục";
                    }
                  
                    if (!empty($nameerr) || !empty($statuserr)) {
                        header("location: index.php?actAdmin=addCategory&nameerr=$nameerr&statuserr=$statuserr");
                        die;
                    }
                    move_uploaded_file($_FILES['avatar']['tmp_name'], "../imageProduct/" . $avatar);
                    category_insert($name, $avatar, $status);
                    $notification = "Thêm danh mục thành công";
                }
                $listdm = getAllCategories("");
                require_once "./categories/add.php";
                break;

            case 'listCategories':
                if(isset($_POST['btn-searchCategory'])){
                    $keyWord = $_POST['keyWord'];
                }else if(isset($_GET['keyWord'])){
                    $keyWord = $_GET['keyWord'];
                }else {
                    $keyWord = "";
                }
                $countPage = get_Page_Cat_admin_order($keyWord);
                $listdm = getAllCategories($keyWord);
                require_once "./categories/list.php";
                break;
            case 'deleteCategory':
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    // Insert Product to unspecified
                   
                    $productUnspecifiedCat = selectUnspecifiedProductCat($id);
                    if(sizeof($productUnspecifiedCat) > 0){
                        foreach ($productUnspecifiedCat as $value) {
                            insertUnspecifiedProduct($value['id'],$value['name'],$value['avatar'],$value['price'],$value['category_id']);
                        }
                    }
                   

                    $orderDetailUnspecifiedCat = selectUnspecifiedOrderDetailCat($id);
                    if(sizeof($orderDetailUnspecifiedCat) > 0){
                        foreach ($orderDetailUnspecifiedCat as $value) {
                            insertUnspecifiedOrderDetail($value['order_id'],$value['product_id'],$value['quantity'],$value['price_product']);
                        }
                    }
                   

                    // Insert Product to unspecified
                    $idDetailOrderCat = getIdDetailOrderNeedDeleteCat($id);
                    foreach($idDetailOrderCat as $value){
                        productDeleteDetailProduct($value['product_id']);
                    }
                    
                    $numberComment = getNumberComment($id);
                
                    if(sizeof($numberComment) > 0){
                        $idCatComment = getIdCatNeedDelete($id);
                        foreach($idCatComment as $value){
                            productDeletecommentCat($value['id']);
                        }
                    }
                    $idCatAllImage = selectAllImageProductFlowCategory($id);
                    foreach($idCatAllImage as $value){
                        deleteAllImageProductFlowCategory($value['id']);
                    }    
                    deleteProductFlowCategory($id);
                    category_delete($id);
                    $notification = "Xóa danh mục thành công";
                }
                $listdm = getAllCategories("");
                require_once "./categories/list.php";
                break;
            case 'editCategories';
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $detailDm = category_select($id);
                }
                require_once "./categories/edit.php";
                break;
            case 'updateCategory';
                if (isset($_POST['btn-editProduct'])) {
                    $name = $_POST['name'];
                    $avatar_new = $_FILES['avatar_new'];
                    $avatar = uniqid()  . $avatar_new['name'];
                    $status = $_POST['status'];
                    $id = $_POST['id'];

                    $nameerr = "";
                    $imageerr = "";
                    $statuserr = "";

                    if (strlen($name) == 0) {
                        $nameerr = "Mời Bạn nhập vào tên danh mục mới";
                    } 
                    if (strlen($status) == 0) {
                        $statuserr = "Mời bạn chọn trạng thái hiển thị danh mục";
                    }
                  
                    if (!empty($nameerr) || !empty($statuserr)) {
                        header("location: index.php?actAdmin=editCategories&id=$id&nameerr=$nameerr&statuserr=$statuserr");
                        die;
                    }
                    if ($avatar_new['size'] > 0) {
                        move_uploaded_file($avatar_new['tmp_name'], "../imageProduct/" . $avatar);
                    } else {
                        $avatar = $_POST['avatar_old'];
                    }
                    category_update($id, $name, $avatar, $status);
                    $notification = "Bạn đã chỉnh sửa danh mục thành công";
                }
                $listdm = getAllCategories("");
                require_once "./categories/list.php";
                break;
                // long code categories

            // products
            case 'deleteProduct':
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    $id = $_GET['id'];
                    // Update total product
                    $getIdCategory = getIdCategoryUpdateCount($id);
                    // Update total product
                    productDeleteAllImage($id);
                    productDeletecomment($id);
                    // Insert Product to unspecified
                    $orderDetailUnspecified = selectUnspecifiedOrderDetail($id);
                    foreach ($orderDetailUnspecified as $value) {
                        insertUnspecifiedOrderDetail($value['order_id'],$value['product_id'],$value['quantity'],$value['price_product']);
                    }
                    $productUnspecified = selectUnspecifiedProduct($id);
                    foreach ($productUnspecified as $value) {
                        insertUnspecifiedProduct($value['id'],$value['name'],$value['avatar'],$value['price'],$value['category_id']);
                    }
                    // Insert Product to unspecified
                    productDeleteDetailProduct($id);
                    productDelete($id);
                    reduceProductFollowCat($getIdCategory);
                    // Update total product
                    $notification = "Xóa sản phẩm thành công";
                    setcookie("notification", "Xóa sản phẩm thành công", time() + 1);
                    header("location: index.php?actAdmin=showProduct");
                }
                // $countPage = get_Page_Product_admin("","",$rowsProductAdmin);
                // $listProduct = getAllProduct("","",$rowsProductAdmin);
                // require_once "./products/list.php";
                break;
        case 'addProduct':
            if (isset($_POST['btn--addProduct'])) {
                $name = $_POST['nameProduct'];
                $file = $_FILES['image'];
                $name_image = $file['name'];
                $files = $_FILES['images'];
                $description = $_POST['description'];
                $category = $_POST['category'];
                $price = $_POST['price'];
                $discount = $_POST['discount'];
                $quantity = $_POST['quantity'];
                $status = $_POST['status'];
                $hotProduct = (isset($_POST['hotProduct']) ? 1 : 0);
                $errors = [];
                $validateNameProduct = getValidateNameProduct();
                if(trim($name) == ""){
                    $errors['name'] = "Bạn phải nhập tên sản phẩm";
                }
                foreach($validateNameProduct as $value){
                    if($name == $value['name']){
                        $errors['name'] = "Tên sản phẩm đã tồn tại";
                    }
                }
                if($category == ""){
                    $errors['category'] = "Bạn phải chọn danh mục";
                }
                if($status == ""){
                    $errors['status'] = "Bạn phải chọn trạng thái sản phẩm";
                }
                if($file['size'] <= 0){
                    $errors['image'] = "Vui lòng chọn ảnh sản phẩm";
                }else if($file['size'] > 0){
                    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
                    if($ext != 'png' && $ext != 'jpg' && $ext != 'jpeg'){
                        $errors['image'] = "Bạn chưa chọn đúng file ảnh (png, jpg, jpeg)";
                    }else if($file['size'] >= 3*1024*1024){
                        $errors['image'] = "Ảnh phải nhỏ hơn 3MB";
                    }
                }
                for ($i = 0; $i < count($files["name"]); $i++) {
                    if($files['size'][$i] > 0){
                        $exts[$i] = pathinfo($files['name'][$i], PATHINFO_EXTENSION);
                        if($exts[$i] != 'png' && $exts[$i] != 'jpg' && $exts[$i] != 'jpeg'){
                            $errors['images'] = "Bạn chưa chọn đúng file ảnh (png, jpg, jpeg)";
                        }
                    }
                }
              
                if($price == ""){
                    $errors['price'] = "Bạn phải nhập giá sản phẩm";
                }else if($price <= 0){
                    $errors['price'] = "Giá sản phẩm phải lớn hơn 0";
                }

                if($quantity == ""){
                    $errors['quantity'] = "Bạn phải nhập số lượng sản phẩm";
                }else if(!is_numeric($quantity)){
                    $errors['quantity'] = "Số lượng sản phẩm phải là số";
                }
                if(!$errors){
                    foreach ($files['name'] as $key => $value) {
                        $tmp_name = $files['tmp_name'][$key];
                        move_uploaded_file($tmp_name, "../imageProduct/" . $value);
                    }
                    move_uploaded_file($file['tmp_name'], "../imageProduct/" . $file['name']);
                    $idProduct = InsertProduct($name, $category, $name_image, $description, $quantity, $price, $discount, $hotProduct, $status);
                    // Update total product
                    countProductFollowCat($category);
                    // Update total product
                    foreach ($files['name'] as $value) {
                        pdo_execute("INSERT INTO `product_images`(`product_id`, `images`) VALUES ('$idProduct','$value')");
                    }
                    setcookie("notification", "Thêm sản phẩm thành công", time() + 1);
                    header("location: index.php?actAdmin=showProduct");
                }     
            }
            $listCategories = getAllCategories("");
            require_once "./products/add.php";
            break;
        case 'editProduct':
            $id = isset($_GET['id']) ? $_GET['id'] : "";
            if ($id > 0 && is_numeric($id)) {
                $detailProduct = getProductFollowId($id);
                $listCategories = getAllCategories("");
                $listImagesProduct = getProductAllImage($id);
                if (isset($_POST['btn--updateProduct'])) {
                    $idProduct = $_POST['idProduct'];
                    $avatarProduct = getAvatarProduct($idProduct);
                    $file = $_FILES['image'];
                    $files = $_FILES['images'];
                    $avatar = $avatarProduct['avatar'];
                    if ($file['error'] == 0) {
                        if ($avatarProduct["avatar"] != "" && file_exists("../imageProduct/" . $avatarProduct["avatar"])) {
                            unlink("../imageProduct/" . $avatarProduct["avatar"]);
                        }
                        $dir_uploads = "../imageProduct/";
                        if (!file_exists($dir_uploads)) {
                            mkdir($dir_uploads);
                        }
                        $avatar = time() . "-" . $file['name'];
                        move_uploaded_file($file['tmp_name'], $dir_uploads . $avatar);
                    }
    
                    if (!empty($files['name'][0])) {
                        $result = getProductAllImage($idProduct);
                        for ($i = 0; $i < count($result); $i++) {
                            if ($result[$i]["images"] != "" && file_exists("../imageProduct/" . $result[$i]["images"])) {
                                unlink("../imageProduct/" . $result[$i]["images"]);
                            }
                        }
                        productDeleteAllImage($idProduct);
                    }
                    for ($i = 0; $i < count($files["name"]); $i++) {
                        if ($files["error"][$i] == 0) {
                            $files_insert = time() . '-' . $files["name"][$i];
                            $is_insert = pdo_execute("INSERT INTO `product_images`(`product_id`, `images`) VALUES ('$idProduct','$files_insert')");
                            $dir_uploads = '../imageProduct/';
                            if (!file_exists($dir_uploads)) {
                                mkdir($dir_uploads);
                            }
                            move_uploaded_file($files['tmp_name'][$i], $dir_uploads . $files_insert);
                        }
                    }
                    $name = $_POST['nameProduct'];
                    $description = $_POST['description'];
                    $category = $_POST['category'];
                    $price = $_POST['price'];
                    $discount = $_POST['discount'];
                    $quantity = $_POST['quantity'];
                    $status = $_POST['status'];
                    $hotProduct = (isset($_POST['hotProduct']) ? 1 : 0);
                    $errors = [];
                    if(trim($name) == ""){
                        $errors['name'] = "Bạn phải nhập tên sản phẩm";
                    }
                  
                    if($name != $detailProduct['nameProduct']){
                        $validateNameProduct = getValidateNameProduct();
                        foreach($validateNameProduct as $value){
                            if($name == $value['name']){
                                $errors['name'] = "Tên sản phẩm đã tồn tại";
                            }
                        }
                    }
                   
                    if($file['size'] > 0){
                        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
                        if($ext != 'png' && $ext != 'jpg' && $ext != 'jpeg'){
                            $errors['image'] = "Bạn chưa chọn đúng file ảnh (png, jpg, jpeg)";
                        }else if($file['size'] >= 3*1024*1024){
                            $errors['image'] = "Ảnh phải nhỏ hơn 3MB";
                        }
                    }
                    for ($i = 0; $i < count($files["name"]); $i++) {
                        if($files['size'][$i] > 0){
                            $exts[$i] = pathinfo($files['name'][$i], PATHINFO_EXTENSION);
                            if($exts[$i] != 'png' && $exts[$i] != 'jpg' && $exts[$i] != 'jpeg'){
                                $errors['images'] = "Bạn chưa chọn đúng file ảnh (png, jpg, jpeg)";
                            }
                        }
                    }
                  
                    if($price == ""){
                        $errors['price'] = "Bạn phải nhập giá sản phẩm";
                    }else if($price <= 0){
                        $errors['price'] = "Giá sản phẩm phải lớn hơn 0";
                    }
    
                    if($quantity == ""){
                        $errors['quantity'] = "Bạn phải nhập số lượng sản phẩm";
                    }else if(!is_numeric($quantity)){
                        $errors['quantity'] = "Số lượng sản phẩm phải là số";
                    }
                    if(!$errors){
                        updateProduct($name, $category, $avatar, $description, $quantity, $price, $discount, $hotProduct, $idProduct, $status);
                        // Start fix error here (Completed)
                        $idCateNew = getIdCategoryUpdateCount($idProduct);
                        $idCateOld = $_POST['categoryCLone'];
                        $totalCurrent = getTotalProductCat($idCateNew);
                        $totalUpđate = getTotalProductCat2($idCateNew);
                        if ($totalCurrent != $totalUpđate) {
                            countProductFollowCat($idCateNew);
                            reduceProductFollowCat($idCateOld);
                        }
                        // End fix error here (Completed)
                        // $notification = "Bạn đã thay đổi sản phẩm thành công";
                        setcookie("notification", "Thay đổi sản phẩm thành công", time() + 1);  
                        header("location: index.php?actAdmin=showProduct");
                    }
                }
            }
            require_once "./products/edit.php";
            break;
        case 'showProduct':
            if(isset($_POST['btn__deleteProductAdmin'])){
                if(!empty($_POST['productID'])){
                    $sum = 0;
                    foreach($_POST['productID'] as $key => $value){
                        $sum++;
                        $id = $value;
                        // Update total product
                        $getIdCategory = getIdCategoryUpdateCount($id);
                        // Update total product
                        productDeleteAllImage($id);
                        productDeletecomment($id);
                        // Insert Product to unspecified
                        $orderDetailUnspecified = selectUnspecifiedOrderDetail($id);
                        foreach ($orderDetailUnspecified as $value) {
                            insertUnspecifiedOrderDetail($value['order_id'],$value['product_id'],$value['quantity'],$value['price_product']);
                        }
                        $productUnspecified = selectUnspecifiedProduct($id);
                        foreach ($productUnspecified as $value) {
                            insertUnspecifiedProduct($value['id'],$value['name'],$value['avatar'],$value['price'],$value['category_id']);
                        }
                        // Insert Product to unspecified
                        productDeleteDetailProduct($id);
                        productDelete($id);
                        reduceProductFollowCat($getIdCategory);
                        
                        // Update total product
                    }
                    echo "<script> alert('$sum sản phẩm đã được xóa') </script>";  

                }else{
                    echo "<script> alert('Không hàng nào chịu tác động') </script>";
                }
            }
            if (isset($_POST['btn-search--Product'] )) {
                $keyWord = $_POST['keyWord'];
            }else if(isset($_GET['keyWord'])) {
                $keyWord = $_GET['keyWord'];
            } else {
                $keyWord = "";
            }
            if(isset($_POST['btn--filterProduct__followCat'])){
                $nameCaterory = $_POST['nameCaterory'];
                $filterToPrice = $_POST['filterToPrice'];
            }else if(isset($_GET['nameCaterory'])) {
                $nameCaterory = $_GET['nameCaterory'];
                $filterToPrice = $_GET['filterToPrice'];
            }else{
                $nameCaterory = "";
                $filterToPrice = "";
            }
            
            $countPage = get_Page_Product_admin($keyWord,$nameCaterory,$rowsProductAdmin,$filterToPrice);
            $listProduct = getAllProduct($keyWord,$nameCaterory,$rowsProductAdmin,$filterToPrice);
            require_once "./products/list.php";
            break;
        case 'showOrder':
            if(isset($_POST['btn-searchOrder'])){
                $keyWord = $_POST['keyWord'];
            }else if(isset($_GET['keyWord'])){
                $keyWord = $_GET['keyWord'];
            }else{
                $keyWord = "";
            }
            $countPage = get_Page_Order_admin_order($keyWord);
            $listOrderUser = getAllOrderToAdmin($keyWord);
           
            require_once "./orders/list.php";
            break;
        case 'addOrderAdmin':
            $temp = -1;
            if (isset($_POST['btn-search--Product'])) {
                $keyWord = $_POST['keyWord'];
            }else if(isset($_GET['keyWord'])) {
                $keyWord = $_GET['keyWord'];
            } else {
                $keyWord = "";
            }
            if (isset($_POST['btn__addOrderAdmin'])) {
                $idProductOrder = $_POST['idProductOrder'];
                $nameProductOrder = $_POST['nameProductOrder'];
                $imageProductOrder = $_POST['imageProductOrder'];
                $priceProductOrder = $_POST['priceProductOrder'];
                $quantityProductOrder = $_POST['quantityProductOrder'];
                $sizeProduct = $_POST['sizeProduct'];

                    $orderEmty = [$idProductOrder, $nameProductOrder, $imageProductOrder, $priceProductOrder, $quantityProductOrder,$sizeProduct];
                    foreach ($_SESSION['orderAdmin'] as $key => $item) {
                        if ($idProductOrder == $item[0] && $sizeProduct == $item[5]) {
                            $temp = $key;
                            break;
                        }
                    }
                    if ($temp == -1) {
                        array_push($_SESSION['orderAdmin'], $orderEmty);
                    } else {
                        $_SESSION['orderAdmin'][$temp][4] += $quantityProductOrder;
                    }
                }

                if (isset($_GET['idRemoveOrder'])) {
                    $idRemove = $_GET['idRemoveOrder'];
                    array_splice($_SESSION['orderAdmin'], $idRemove, 1);
                }
                $countPage = get_Page_Product_admin_order($keyWord, $rowsProductAdmin);
                $listProduct = getAllProduct_order($keyWord, $rowsProductAdmin);
                $listOrderUser = getAllOrderToAdmin("");
                require_once "./orders/addOrderAdmin.php";
                break;
            case "update_quantity_products_CartAdmin":
                $id = $_GET['id'];
                $type = $_GET['type'];
                if ($type == 'decre') {
                    if ($_SESSION['orderAdmin'][$id][4] > 1) {

                        $_SESSION['orderAdmin'][$id][4]--;
                    } else {
                        unset($_SESSION['orderAdmin'][$id]);
                    }
                } else {
                    $_SESSION['orderAdmin'][$id][4]++;
                }
                $countPage = get_Page_Product_admin_order($keyWord, $rowsProductAdmin);
                $listProduct = getAllProduct_order($keyWord, $rowsProductAdmin);
                $listOrderUser = getAllOrderToAdmin("");
                require_once "./orders/addOrderAdmin.php";
                break;
            case 'AddOrderUserDirect':
                if (isset($_POST['btn--addProduct'])) {
                    date_default_timezone_set("Asia/Ho_Chi_Minh");
                    $errors = [];
                    $nameDirect = $_POST['nameDirect'];
                    $emailDirect = $_POST['emailDirect'];
                    $phoneDirect = $_POST['phoneDirect'];
                    $addressDirect = $_POST['addressDirect'];
                    $payWhen = 2;
                    $note = "";
                    $totalPricePay = $_POST['totalPricePay'];
                    $dateCurrent = time();
                    $dateToInt = date("Y-m-d h:i:s", $dateCurrent);
                    $role = "3";
                    $status = "3";
                    $statusOrder = "6";
                    $idUserDirect = insertToUserDirect($nameDirect, $emailDirect, $phoneDirect, $addressDirect, $role, $status);
                    $idOrderAdminDirect = insertToOrder($idUserDirect, $payWhen, $statusOrder, $totalPricePay, $note, $addressDirect, $dateToInt);

                    foreach ($_SESSION['orderAdmin'] as $value) {
                        insertToOrderDetail($idOrderAdminDirect, $value[0], $value[4], $value[3],$value[5]);
                        updateQuantityPaySuccess($value[0],$value[4]);
                        $_SESSION['orderAdmin'] = [];
                    }
                    setcookie("successOrder", "Thêm đơn mới thành công", time() + 1);
                    header("location: index.php?actAdmin=showOrder ");
                    exit;
                }
                break;
            case 'editOrderAdmin-WithUser':
                $id = isset($_GET['id']) ? $_GET['id'] : "";
                if ($id > 0 && is_numeric($id)) {
                    $inforUserDirect = getInforOrderDirect($id);
                    $_SESSION['orderUpdateAdmin'] = getOrderDirectU($id);
                  
                    updateQuantityWhenCancelOrder($id,$quantity);
                    if (isset($_POST['btn-search--Product'])) {
                        $keyWord = $_POST['keyWord'];
                    } else if (isset($_GET['keyWord'])) {
                        $keyWord = $_GET['keyWord'];
                    } else {
                        $keyWord = "";
                    }
                    $countPage = get_Page_Product_admin_order($keyWord, $rowsProductAdmin);
                    $listProduct = getAllProduct_order($keyWord, $rowsProductAdmin);
                }
                require_once "./orders/editOrderAdmin.php";
                break;
            case 'updateOrderAdmin-WithUser':
                $id = isset($_GET['id']) ? $_GET['id'] : "";
                if ($id > 0 && is_numeric($id)) {
                    $inforUserDirect = getInforOrderDirect($id);
                    if (isset($_POST['btn-search--Product'])) {
                        $keyWord = $_POST['keyWord'];
                    } else if (isset($_GET['keyWord'])) {
                        $keyWord = $_GET['keyWord'];
                    } else {
                        $keyWord = "";
                    }
                    $temp = -1;
                    if (isset($_POST['btn__updateOrderAdmin'])) {
                       
                        $idProductOrder = $_POST['idProductOrder'];
                        $sizeProduct = $_POST['sizeProduct'];

                        $priceProductOrder = $_POST['priceProductOrder'];
                        $quantityProductOrder = $_POST['quantityProductOrder'];

                        $product_value = getOneProductFlowIdUx($idProductOrder);
                        $product_value['quantity'] = $quantityProductOrder;
                        $product_value['price_product'] = $priceProductOrder;
                        $product_value['size'] = $sizeProduct;


                        foreach ($_SESSION['orderUpdateAdmin'] as $key => $item) {
                            if ($idProductOrder == $item['product_id'] && $sizeProduct == $item['size']) {
                                $temp = $key;
                                break;
                            }
                        }
                        if ($temp == -1) {
                            $_SESSION['orderUpdateAdmin'][] = $product_value;
                        } else {
                            $_SESSION['orderUpdateAdmin'][$temp]['quantity'] += $quantityProductOrder;
                        }
                    }
                    if (isset($_GET['idRemoveOrderUp'])) {
                        $idRemoveUp = $_GET['idRemoveOrderUp'];
                        unset($_SESSION['orderUpdateAdmin'][$idRemoveUp]);
                    }
                    if (isset($_GET['idPlussMinus'])) {
                        $idPlussMinus = $_GET['idPlussMinus'];
                        $type = $_GET['type'];
                        if ($type == 'decre') {
                            if ($_SESSION['orderUpdateAdmin'][$idPlussMinus]['quantity'] > 1) {

                                $_SESSION['orderUpdateAdmin'][$idPlussMinus]['quantity']--;
                            } else {
                                unset($_SESSION['orderUpdateAdmin'][$idPlussMinus]);
                            }
                        } else {
                            $_SESSION['orderUpdateAdmin'][$idPlussMinus]['quantity']++;
                        }
                    }
                    $countPage = get_Page_Product_admin_order($keyWord, $rowsProductAdmin);
                    $listProduct = getAllProduct_order($keyWord, $rowsProductAdmin);
                }
                require_once "./orders/editOrderAdmin.php";
                break;
            case 'updateOrderUserDirectSuccess':
                
                if (isset($_POST['btn--UpdateOrder'])) {
                    // date_default_timezone_set("Asia/Ho_Chi_Minh");
                    
                    $errors = [];
                    $nameDirect = $_POST['nameDirect'];
                    $emailDirect = $_POST['emailDirect'];
                    $phoneDirect = $_POST['phoneDirect'];
                    $addressDirect = $_POST['addressDirect'];
                    $payWhen = 2;
                    $note = "";
                    $totalPricePay = $_POST['totalPricePay'];
                    // $dateCurrent = time();
                    // $dateToInt = date("Y-m-d h:i:s", $dateCurrent);
                    $role = "3";
                    $status = "3";
                    $statusOrder = "6";
                    $idOrder = $_POST['idOrder'];
                    $idUser = $_POST['idUser'];
                    $updateNewQuantity = getOrderDirectU($idOrder);
                    foreach($updateNewQuantity as $value){
                        updateQuantityWhenCancelOrder($value['product_id'],$value['quantity']);
                    }
                    $idOrderDetail = selectIdOrderDetail($idOrder);
                    deleteUpdateOrderAdmin2($idOrder);
                    UpdateToUserDirect($idUser, $nameDirect, $emailDirect, $phoneDirect, $addressDirect, $role, $status);
                    UpdateToOrder($idOrder, $payWhen, $statusOrder, $totalPricePay, $note, $addressDirect);
                    
                    foreach ($_SESSION['orderUpdateAdmin'] as $value) {

                        insertToOrderDetail($idOrder, $value['product_id'], $value['quantity'], $value['price_product'],$value['size']);
                        updateQuantityPaySuccess($value['product_id'],$value['quantity']);
                       
                        $_SESSION['orderUpdateAdmin'] = [];

                        // }

                    }

                    setcookie("successOrder", "Cập nhật đơn thành công", time() + 1);
                    header("location: index.php?actAdmin=showOrder");
                    exit;
                }
                break;
            case 'updateOrderAdmin':
                $id = isset($_GET['id']) ? $_GET['id'] : "";
                $status = isset($_GET['status']) ? $_GET['status'] : "";
                if ($id > 0 && is_numeric($id) && $status >= 0 && is_numeric($status)) {
                    tickOrderAdmin($id, $status);
                }
                $listOrderUser = getAllOrderToAdmin("");
                require_once "./orders/list.php";
                break;
            case 'deleteOrder':
                $id = isset($_GET['id']) ? $_GET['id'] : "";
                if ($id > 0 && is_numeric($id)) {
                    deleteOrderDetailToAdmin($id);
                    deleteOrderToAdmin($id);
                    $notification = "Xóa đơn hàng thành công";
                } else {
                    require_once "./orders/list.php";
                }
                $listOrderUser = getAllOrderToAdmin("");
                require_once "./orders/list.php";
            
            $listOrderUser = getAllOrderToAdmin("");
            require_once "./orders/list.php";
            break;
        case "detailOrder":
            $id = isset($_GET['id']) ? $_GET['id'] : "";
            if ($id > 0 && is_numeric($id)) {
                $listOrderAdmin = getOrderAdmin($id);
            }
            require_once "./orders/detailOrder.php";
            break;
            // Đức - Quản lý người dùng
        case 'showUsers':
            if(isset($_GET['page'])){
                $table = 'users';
                $rows = count_rows($table);
                $slpage = ceil($rows['rows']/5);
                if($_GET['page'] > 0 && $_GET['page'] <= $slpage){
                    $page = (int)$_GET['page'];
                    $page = ($page-1)*5;
                    $listUser = getAllUser2($page);
                    require_once "./users/list.php";
                }else{
                    $listUser = getAllUser1();
                    require_once "./users/list.php";
                }
            }else{
                $listUser = getAllUser1();
                require_once "./users/list.php";
            }
            break;
        case 'SearchUsers':
            $kyw = $_POST['kyw'];
            $listUser = SearchUser($kyw);
            require_once "./users/list.php";
            break;
        case 'addUser':
                if (isset($_POST['btn--addUser'])) {
                    $name = $_POST['name'];
                    $image = $_FILES['image'];
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    $phone = $_POST['phone'];
                    $address = $_POST['address'];
                    $status = $_POST['status'];
                    $role = $_POST['role'];
                    $NameurlImage = $image['name'];
                    $pathImage = $image['tmp_name'];
                    $target_file = "UserAvt/" . $NameurlImage;
                    move_uploaded_file($pathImage, $target_file);

                $check = true;
                $checkemail_tontai = true;
                if ($name == "") {
                    $thongbao[0] = "Tên không được bỏ trống !!!";
                    $check = false;
                } else if (is_numeric($name) || (strlen($name) < 2)) {
                    $thongbao[0] = "Tên không phải là số , tối thiểu 2 ký tự !";
                    $check = false;
                }
                if ($image['size'] <= 0) {
                    $thongbao[1] = "Vui lòng chọn hình ảnh cho người dùng !!!";
                    $check = false;
                } else {
                    $NameurlImage = $image['name'];
                    $ext = pathinfo($NameurlImage, PATHINFO_EXTENSION);
                    if ($ext != 'gif' && $ext != 'jpeg' && $ext != 'png' && $ext != 'jpg') {
                        $thongbao[1] = "Sai định dạng ảnh(png,jpg,jpeg,gif)";
                        $check = false;
                    } else {
                        $pathImage = $image['tmp_name'];
                        $target_file = "UserAvt/" . $NameurlImage;
                        move_uploaded_file($pathImage, $target_file);
                    }
                }
                if ($email == "") {
                    $thongbao[2] = "Email không được bỏ trống !!!";
                    $check = false;
                } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $thongbao[2] = "Email không đúng định dạng";
                    $check = false;
                }else{
                    $checkmail_dangky = CheckEmail($email);
                    if (is_array($checkmail_dangky)) {
                        echo '<style> .form_validate_dangky{display: none !important;}</style>';
                        $thongbao[2] = "Email đã tồn tại !";
                        $checkemail_tontai = false;
                    }
                }
                if ($password == "") {
                    $thongbao[3] = "Mật khẩu không được bỏ trống !!!";
                    $check = false;
                } else if ((strlen($password) < 8)) {
                    $thongbao[3] = "Mật khẩu tối thiểu 8 ký tự !";
                    $check = false;
                }
                $password = md5($password);
                if ($phone == '') {
                    $thongbao[4] = "Điện thoại không được bỏ trống !!!";
                    $check = false;
                } else if (!is_numeric($phone)) {
                    $thongbao[4] = "Điện thoại phải là số !!!";
                    $check = false;
                } else if (strlen($phone) != 10) {
                    $thongbao[4] = "Điện thoại phải đủ 10 số !!!";
                    $check = false;
                }
                if ($address == "") {
                    $thongbao[5] = "Địa chỉ không được bỏ trống !!!";
                    $check = false;
                } else if (is_numeric($address) || (strlen($address) < 6)) {
                    $thongbao[5] = "Địa chỉ không phải là số , tối thiểu 6 ký tự !";
                    $check = false;
                }
                if ($status == "") {
                    $thongbao[6] = "Trạng thái không được bỏ trống !!!";
                    $check = false;
                }
                if ($role == "") {
                    $thongbao[7] = "Quyền không được bỏ trống !!!";
                    $check = false;
                }
                if ($check == true && $checkemail_tontai == true) {
                    InsertUser2($name, $email, $password, $phone, $address, $NameurlImage, $status, $role);
                    header('Location: index.php?actAdmin=showUsers&&msg=Thêm người thành công !');
                    ob_end_flush();
                }
            }
            require_once "./users/add.php";
            break;
        case 'editUser':
            $id = $_GET['id'];
            $infoUser = getUserFollowId($id);
            if (isset($_POST['btn--editUser'])) {
                if (is_array($infoUser)) {
                    extract($infoUser);
                }
                $id = $_GET['id'];
                $name_update = $_POST['name'];
                $email_update = $_POST['email'];
                $password_update = $_POST['password'];
                $phone_update = $_POST['phone'];
                $address_update = $_POST['address'];
                $image = $_FILES['image'];
                $status_update = $_POST['status'];
                $role_update = $_POST['role'];
                if ($password_update != $password) {
                    $password_update = md5($password_update);
                }
                if($image['size'] <= 0){
                    $NameurlImage = $_POST['image_old'];
                }else{
                    $NameurlImage = $image['name'];
                    $pathImage = $image['tmp_name'];
                    $target_file = "UserAvt/" . $NameurlImage;
                    move_uploaded_file($pathImage, $target_file);
                }
                UpdatetUser($name_update, $email_update, $password_update, $phone_update, $address_update, $NameurlImage, $status_update, $role_update, $id);
                header('Location: index.php?actAdmin=showUsers&&msg=Cập nhật thành công !');
                ob_end_flush();
            }
            require_once "./users/edit.php";
            break;
        case 'deleteUser':
            $id = $_GET['id'];
            if (isset($id) && $id != "") {
                UserDelete($id);
                $notification = "Xóa tài khoản thành công !";
                $listUser = getAllUser();
                require_once "./users/list.php";
            }
            break;
        case 'statisticals':
            $getToTalProductChart = getToTalProductChartJs();
      
            if(isset($_POST['btn__find--OrderMoney'])){
                if(isset($_POST['dayStart'])&&isset($_POST['dayEnd'])){
                    $dayStart = $_POST['dayStart'];
                    $dayEnd = $_POST['dayEnd'];
                }else if(isset($_POST['dayStart'])&&!isset($_POST['dayEnd'])){
                    $dayStart = $_POST['dayStart'];
                    $dayEnd = "";
                }else if(!isset($_POST['dayStart'])&&!isset($_POST['dayEnd'])){
                    $dayStart = "";
                    $dayEnd = $_POST['dayEnd'];
                }else{
                    $dayStart = "";
                    $dayEnd = "";
                }

                $getListMoneyOrderAdmin = getListMoneyOrderAdmin($dayStart,$dayEnd);
                $countPage = getListMoneyOrderAdminPage($dayStart,$dayEnd);
            }else{
                if(isset($_GET['dayStart'])&&isset($_GET['dayEnd'])) {
                    $dayStart = $_GET['dayStart'];
                    $dayEnd = $_GET['dayEnd'];
                    $getListMoneyOrderAdmin = getListMoneyOrderAdmin($dayStart,$dayEnd);
                    $countPage = getListMoneyOrderAdminPage($dayStart,$dayEnd);
                }else{
                    $getListMoneyOrderAdmin = getListMoneyOrderAdmin("","");
                    $countPage = getListMoneyOrderAdminPage("","");
                }
              
            }
          
         
            require_once "./statisticals/list.php";
            break;
        case 'comments':
            if(isset($_GET['rate'])&&isset($_GET['pageRate'])){
                $table = 'comments_product';
                $rows = count_rows($table);
                $slpage = ceil($rows['rows']/5);
                if($_GET['pageRate'] > 0 && $_GET['pageRate'] < $slpage){
                    $page = (int)$_GET['pageRate'];
                    $page = ($page-1)*5;
                    $listCmt = filter_rate2($page);
                    require_once "./comments/cmtMuch.php";
                }else{
                    $listCmt = filter_rate2(0);
                    require_once "./comments/cmtMuch.php";
                }
            }
            if(isset($_GET['page'])){
                $table = 'comments_product';
                $rows = count_rows($table);
                $slpage = ceil($rows['rows']/5);
                if($_GET['page'] > 0 && $_GET['page'] < $slpage){
                    $page = (int)$_GET['page'];
                    $page = ($page-1)*5;
                    $listCmt = commented_getAll2($page);
                    require_once "./comments/list.php";
                }else{
                    $listCmt = commented_getAll2(0);
                    require_once "./comments/list.php";
                }
            }
            // else{
            //     $listCmt = commented_getAll2(0);
            //     require_once "./comments/list.php";
            // }
            break;
        case 'searchProCmt':
            $kyw = $_POST['kyw'];
            $listCmt = comment_searchFollow_pro($kyw);
            require_once "./comments/list.php";
            break;
        case 'detailComment':
            if(isset($_GET['pid'])){
                if(isset($_GET['page'])){
                    $rows = comment_count_pro_cmt($_GET['pid']);
                    $slpage = ceil($rows['Count(*)']/5);
                    if($_GET['page'] > 0 && $_GET['page'] <= $slpage){
                        $page = (int)$_GET['page'];
                        $page = ($page-1)*5;
                        $listCmt=comment_select_pro_cmt($page,$_GET['pid']);
                        require_once "./comments/detailComment.php";
                    }else{
                        $listCmt=comment_select_pro_cmt(0,$_GET['pid']);
                        require_once "./comments/detailComment.php";
                    }
                }else{
                    $listCmt=comment_select_pro_cmt(0,$_GET['pid']);
                    require_once "./comments/detailComment.php";
                }
            }else{
                header('Location: index.php?actAdmin=comments');
            }
            break;
        case 'detailCommentDele':
            $uid=$_GET['uid'];
            $pid=$_GET['pid'];
            if(isset($_GET['pageRate'])){
                global $pageRate;
                $pageRate = '&&rate';
                $pageRate_1 = '&&pageRate';
                
            }else{
                $pageRate ='';
                $pageRate_1 = '&&page';
            }
            comment_delete($_GET['cid']);
            $rows = comment_count_pro_cmt($pid);
            $slpage = ceil($rows['Count(*)']/5);
            $count_cmt_detail = comment_count_pro_cmt($pid);
            if($_GET['page-at'] > $slpage){
                $page_at = $slpage;
            }else{
                $page_at = $_GET['page-at'];
            }
            if($count_cmt_detail['Count(*)']<1){
                header('Location: index.php?actAdmin=comments&&page=1&msg=Xoá bình luận thành công !');
            }else{
                header('Location: index.php?actAdmin=detailComment'.$pageRate_1.'&parent='.$_GET['parent'].'&uid='.$uid.'&pid='.$pid.'&page='.$page_at.'&msg=Xoá bình luận thành công !');
            }
            break;

        case 'dangxuat':
            session_destroy();
            header("Location: ../index.php?act=dangnhap");
            break;
        default:
            $listBuyOnDay = buyProductWithDay();
            $bestSale = bestProductSales();
            $totalOrderWeek = totalOrderWithWeek();
            $sumMoneyMonthCurrently = sumMoneyMonthCurrently();

                require_once "./home.php";
                break;
        }
    } else {
        $listBuyOnDay = buyProductWithDay();
        $bestSale = bestProductSales();
        $totalOrderWeek = totalOrderWithWeek();
        $sumMoneyMonthCurrently = sumMoneyMonthCurrently();

        require_once "./home.php";
    }
} else {
    header('Location: ../index.php?act=dangnhap');
    ob_end_flush();
}

?>