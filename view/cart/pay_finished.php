<section class="grid wide your--order">
    <div class="link--yourOder">
        <ul>
            <li><a href="">Trang chủ</a></li>
            <li><a href="">></a></li>
            <li><a href="" style="color: red;">Danh sách đơn hàng</a></li>
        </ul>
    </div>
    <div class="detail--yourOrder">
        <div class="title__detail--yourOrder">
            <h2>Danh sách đơn hàng</h2>
        </div>
        <div class="title__detail--yourOrder">
            <h3>Xin chào <span style="color: red; font-size:18px;"><?= $_SESSION['user']['name'] ?></span>, đây là đơn hàng của bạn:</h3>
        </div>
        <div class="table__detail--yourOrder">
            <table border="1">
                <tr>
                    <th>Đơn hàng</th>
                    <th>Ngày</th>
                    <th>Địa chỉ</th>
                    <th>Giá trị đơn hàng</th>
                    <th>PT thanh toán</th>
                    <th>TT đơn hàng</th>
                    <th>Thao tác</th>
                </tr>
                <?php if(count($listYourOrder) > 0): ?>
                    <?php foreach($listYourOrder as $key => $value): ?>
                        <tr class="totalModal">
                            <td>DH00<?= $value['id'] ?></td>
                            <td><?= $value['created_at'] ?></td>
                            <td><?= $value['address'] ?></td>
                            <td><?= number_format($value['total_price'])."đ" ?></td>
                            <td ><?= $value['payment']==0 ? "Thanh toán khi nhận hàng" : "" ?></td>
                            <td>
                                <?php
                                    if($value['status'] == 0){
                                        echo "Đơn hàng mới";
                                    }else if($value['status'] == 1){
                                        echo "Đã duyệt đơn";
                                    }else{
                                        echo "Đã thanh toán";
                                    }
                                ?>
                            </td>
                            <td>
                                <button class="btnSee__detail--yourOrder">Xem chi tiết</button>
                                <?php if($value['status'] == 0): ?>
                                    <a onclick="return confirm('Bạn có chắc muốn hủy đơn hàng này không?');" href="index.php?act=cancelOrderUser&idOrder=<?= $value['id'] ?>"><button class="detailBill--cancelOrder">Hủy đơn</button></a>
                                <?php endif; ?>
                                <?php
                                    $detailPayS = getDeltailPaySuccess($value['id']);
                                    $detailPaySUnspecified = getDeltailPaySuccessUnspecified($value['id']);
                                ?>
                                <div class="over-lay detail_payment--success-hidden" >
                                    <div class="detail_payment--success">
                                        <div class="btn-exitOut" style="text-align: right; padding: 10px 20px 0 0;">
                                            <i class="fa-regular fa-circle-xmark" style="font-size: 28px; color: #ff2d37;"></i>
                                        </div>
                                        <h2>Chi tiết đơn hàng DH00<?= $value['id'] ?></h2>
                                        <table border="1">
                                            <tr>
                                                <th>Mã sản phẩm</th>
                                                <th>Tên sản phẩm</th>
                                                <th>Ảnh sản phẩm</th>
                                                <th>Số lượng</th>
                                                <th>Giá</th>
                                                <th>Tổng</th>
                                            </tr>
                                            <?php foreach($detailPayS as $valueDetail): ?>
                                                <?php
                                                    $imagePath = "./imageProduct/" . $valueDetail['avatar'];
                                                    $image = "<img class='imageOrder' src='" . $imagePath . "' alt=''>";
                                                ?>
                                                <tr class="detail">
                                                    <td>SP00<?= $valueDetail['id'] ?></td>
                                                    <td><?= $valueDetail['name']. ' (' .$valueDetail['size'] .')'  ?></td>
                                                    <td class="image"><?= $image ?></td>
                                                    <td><?= $valueDetail['quantity'] ?></td>
                                                    <td><?= number_format($valueDetail['price_product'])."đ" ?></td>
                                                    <td><?= number_format($valueDetail['quantity']*$valueDetail['price_product'])."đ" ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                            <?php foreach($detailPaySUnspecified as $key => $valueDetail): ?>
                                                <?php
                                                    $imagePath = "./imageProduct/" . $valueDetail['avatar'];
                                                    $image = "<img class='imageOrder' src='" . $imagePath . "' alt=''>";
                                                ?>
                                                <tr>
                                                    
                                                    <td>SP00<?= $valueDetail['id_product'] ?></td>
                                                    <td><?= $valueDetail['name_product']. ' (' .$valueDetail['size'] .')' ?></td>
                                                    <td class="image"><?= $image ?></td>
                                                    <td><?= $valueDetail['quantity'] ?></td>
                                                    <td><?= number_format($valueDetail['price_product'])."đ" ?></td>
                                                    <td><?= number_format($valueDetail['quantity']*$valueDetail['price_product'])."đ" ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </table>  
                                        
                                    </div>
                                </div>
                                    
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td style="padding: 20px 0;" colspan="7">Không có đơn hàng nào</td>
                    </tr>
                <?php endif; ?>

            </table>
        </div>
    </div>
</section>