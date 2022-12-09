<div class="grid wide content" style=" position: relative;
    top: 150px;">
    <form action="" method="post">
        <div class="row all_detail_products">
            <!-- layout 2 chia   8-4-->
            <div class="col l-8 pay_detai_left">
                <!-- tiêu đề -->
                <h4 class="name_shop">
                    <a href="index.php?act=showProducts">
                        F-Sport
                    </a>
                </h4>
                <div class="row">
                    <!-- info -->
                    <div class="col l-6">
                        <!--tiêu đề thông tin đặt hàng -->
                        <div class="title_info_pay">

                            <p class="title_pay">Thông tin nhận hàng</p>
                        </div>


                        <!-- form info nhận hàng -->
                        <div class="info_order_product">
                            <p style=" font-weight:bold; text-align: left; padding-bottom: 7px; padding-left: 5px;">Email:</p>
                            <input type="email" value="<?= $_SESSION['user']['email'] ?>" class="" placeholder="Email" name="email">

                            <p style="font-weight:bold;text-align: left; padding-bottom: 7px; padding-left: 5px;">Tên:</p>
                            <input type="text" value="<?= $_SESSION['user']['name'] ?>" name="name" class="" placeholder="Họ và tên">

                            <p style="font-weight:bold;text-align: left; padding-bottom: 7px; padding-left: 5px;">Số điện thoại:</p>
                            <input type="text" value="<?= $phoneNumber ?? ""  ?>" name="phone_number" class="" placeholder="Số điện thoại">

                            <!-- error -->
                            <p style="padding: 0 0 5px 5px;color: red; text-align:left; font-size:13px; "><?= $errors['phoneNumber'] ?? ""  ?></p>
                            <!-- error -->

                            <p style="font-weight:bold;text-align: left; padding-bottom: 7px; padding-left: 5px;">Địa chỉ:</p>
                            <input type="text" value="<?= $address ?? ""  ?>" name="address" class="" placeholder="Địa chỉ">

                            <!-- error -->
                            <p style="padding: 0 0 5px 5px;color: red; text-align:left; font-size:13px;"><?= $errors['address'] ?? ""  ?></p>
                            <!-- error -->

                            <p style="font-weight:bold;text-align: left; padding-bottom: 7px; padding-left: 5px;">Ghi chú:</p>
                            <textarea name="note" id="" placeholder="Ghi  chú" cols="20" rows="5"><?= $note ?? ""  ?></textarea>

                        </div>
                    </div>
                    <!-- vận chuyển  -->
                    <div class="col l-6">
                        <!--tiêu đề vận chuyển -->
                        <div class="title_info_pay">
                            <p class="title_pay">Vận chuyển</p>
                        </div>

                        <!--  -->
                        <div class="border_form">
                            <div>
                                <input type="radio" style=" cursor: pointer;" id="delivery" checked="checked" name="delivery" onclick="checkDelivery()" value="40000">
                                <label for="" style=" cursor: pointer;" onclick="checkDelivery()">Giao hàng tận nơi</label>
                            </div>
                            <p class="price_shipping" style="padding-right: 10px;">
                                40.000
                                <span class="icon_d_posiotion_">đ</span>
                            </p>
                        </div>
                        <!--  -->
                        <p class="method_pay">
                            Thanh toán
                        </p>
                        <div class="border_form">
                            <p>
                                <input type="radio" <?= isset($payWhen) && $payWhen == 0 ? 'checked' : "" ?> value="0" name="payWhen" id="payWhen" style=" cursor: pointer;" onclick="check()">
                                <label style=" cursor: pointer;" onclick="check()">Thanh toán khi giao hàng (COD)</label>
                            </p>
                            <span class="ion_payment">
                                <i class="fa-regular fa-money-bill-1"></i>
                            </span>
                        </div>
                    </div>


                    <!-- form info nhận hàng -->

                </div>
            </div>
            <div class="col l-4 pay_detai_right">
                <h2 style="display: flex; justify-content: center;" class="order_pay_title">Đơn hàng ( <?= count($_SESSION['mycart']) ?> sản phẩm )
                    <div class="rule__shop_addProduct">
                            <i class="fa-regular fa-circle-question" style="color: #000000; font-size: 20px; cursor: pointer; text-align: right;">
                                <div class="text_rule">
                                    <section>
                                        <h3>Quy định đổi trả tại Shop</h3>
                                        <ol>
                                            <li>Bạn có thể đổi sản phẩm trong vòng 03-07 ngày kể từ ngày mua sản phẩm.
                                            </li>
                                            <li>Chính sách chỉ áp dụng đổi sản phẩm nguyên giá và chỉ được đổi 01 lần duy nhất.</li>
                                            <li> Chính sách chỉ áp dụng khi sản phẩm còn hóa đơn mua hàng, còn nguyên nhãn mác, thẻ bài đính kèm sản phẩm và sản phẩm không bị dơ bẩn, hư hỏng bởi những tác nhân bên ngoài cửa hàng sau khi mua sản phẩm.
                                            </li>
                                            <li>
                                                Chính sách không áp dụng đối với sản phẩm giảm giá hoặc đổi từ sản phẩm nguyên giá sang sản phẩm giảm giá, hoặc sản phẩm đang trong chương trình ưu đãi khác.
                                            </li>
                                            <li>
                                                Sản phẩm nguyên giá mua tại cửa hàng chỉ được đổi trả tại cửa hàng cửa hàng đã mua.
                                            </li>
                                            <li>Tất cả các chi phí phát sinh khi đổi trả  khách hàng phải chịu 100%.</li>
                                        </ol>
                                    </section>
                                </div>
                            </i>
                        </div>
                </h2>

                <!-- <div class="padding_left-28"> -->


                <!-- thông tin sản phẩm đặt -->
                <div class="product_order_info">

                    <table style="text-align:center" class="product_order_info_detail">
                        <tr>
                            <th>Ảnh </th>
                            <th style="width: 170px;">Tên sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Giá tiền</th>
                        </tr>
                        <?php foreach ($_SESSION['mycart'] as $value) : ?>
                            <tr>
                                <td class="product_order_info_detail-img">
                                    <img src="./imageProduct/<?= $value['avatar'] ?>" alt="" />
                                </td>
                                <td class="product_order_info_detail-name">
                                    <?= $value['name']. ' (' .$value['sizeProduct'] .')' ?>
                                </td>
                                <td>
                                    <?= $value['use_quantity_buy'] ?>
                                </td>
                                <td class="product_order_info_detail-price" style="text-align: center;">
                                    <p class="price_shipping"> <?= number_format($value['giagiam'] * $value['use_quantity_buy']) ?> <span class="icon_d_posiotion_">đ</span></p>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>

                <!-- phí  -->
                <div class="table_total_pay">
                    <div class="price_total_pay">
                        <p>Tạm tính</p>
                        <p class="price_shipping"><?= number_format($totalAllProductPay) ?> <span class="icon_d_posiotion_">đ</span></p>
                    </div>

                    <div class="price_total_pay" id="price_total_pay--showHidden">
                        <p>Phí vận chuyển</p>
                        <p class="price_shipping">40,000 <span class="icon_d_posiotion_">đ</span></p>
                    </div>

                    <div class="price_total_all_pay">
                        <p>Tổng cộng</p>

                        <p class="price_shipping price_total_all_pay-color" id="total--fortyThousand"> <input type="hidden" name="totalPricePay1" value="<?= $totalAllProductPay + 40000 ?>"><?= number_format($totalAllProductPay + 40000) ?><span class="icon_d_posiotion_">đ</span></p>


                        <p style="display: none;" class="price_shipping price_total_all_pay-color" id="total--noneFortyThousand"><input type="hidden" name="totalPricePay" value="<?= $totalAllProductPay ?>"><?= number_format($totalAllProductPay) ?><span class="icon_d_posiotion_">đ</span></p>

                    </div>
                    <div class="input__rule">
                        <div class="btn__accepted_rule">
                            <input id="checkRule" type="checkbox" name="btn-checkRule" style="cursor: pointer;">
                            <label for="checkRule" style="cursor: pointer;">Đồng ý với <a href="index.php?act=gioithieu">chính sách</a> của F-Sport</label>
                        </div>
                        <p style="padding: 6px 0 5px 0px;color: red; text-align:left; font-size:13px; "><?= $errors['checkRule'] ?? ""  ?></p>
                      
                    </div>
                </div>

                <!-- button đặt hàng hay quay về -->
                <div class="order_payment_btn">


                    <a href="index.php?act=addToCart" class="return_cart_detail"><i class="fa-solid fa-chevron-left" style="margin-right: 5px;" ></i>Quay về giỏ
                        hàng</a>


                    <button class="order_total_pay_all-button" type="submit" name="btn-orderSuccess">Đặt hàng</button>
                    <div class="over-lay-payment payment--success-hidden">
                        <div class="payment--success">
                            <h2 class="congratulation">Chúc mừng bạn đã đặt hàng thành công!!</h2>
                           
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </form>
</div>

</main>
<script>
   
    let countPayMent = 0;

    function check() {
        countPayMent++;
        if (countPayMent % 2 != 0) {
            document.getElementById("payWhen").checked = true;
        } else {
            document.getElementById("payWhen").checked = false;
        }
    }
    let delivery = 1;

    function checkDelivery() {
        delivery++;
        if (delivery % 2 != 0) {
            document.getElementById("delivery").checked = true;
            document.querySelector('#price_total_pay--showHidden').style.display = "flex";
            document.querySelector('#total--fortyThousand').style.display = "block";
            document.querySelector('#total--noneFortyThousand').style.display = "none";
        } else {
            document.getElementById("delivery").checked = false;
            document.querySelector('#price_total_pay--showHidden').style.display = "none";
            document.querySelector('#total--noneFortyThousand').style.display = "block";
            document.querySelector('#total--fortyThousand').style.display = "none";
        }
    }

    // const btnPaySuccess = document.querySelector('.order_total_pay_all-button');

    // function toggleModal() {
    //     modal.classList.toggle('payment--success-hidden');
    // }
</script>
</body>

</html>