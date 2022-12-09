<div class="contentManager contentManager--product">
    <div class="contentManager--product__header">
        <div class="contentManager--product__header--title">
            <h2 style="color: #ffffff;">Thống kê hệ thống</h2>

        </div>
        <div class="contentManager--product__header--control">
            <span><i class="fa-solid fa-house"></i>Trang chủ</span> <span style="padding: 0 10px; font-size: 22px;">></span> <span><i class="fa-solid fa-database"></i>Thống kê báo cáo</span>
        </div>
    </div>
    <h2 style="color: #ffffff; margin-top: 45px; margin-bottom: 10px;">Tổng doanh thu tháng <?= $sumMoneyMonthCurrently['total_flow_month']  ?>/<?= $sumMoneyMonthCurrently['total_flow_year'] ?> là: <?= number_format($sumMoneyMonthCurrently['sum(total_price)']) . "đ" ?> </h2>
    <div class="statistical--second">

        <div class="statistical--chart statistical--orderRecent chart ">
            <div class="title">
                <h2>Doanh thu của F-Sport: <?= number_format($sumMoneyShop['money']) . 'đ' ?> </h2>
            </div>
            <div class="tableProduct">
                <form action="" method="POST" class="formOrderMoney">
                    <input type="date" name="dayStart" id="" value="<?= $dayStart ?? "" ?>">

                    <p><i class="fa-solid fa-arrow-right"></i></p>

                    <input type="date" name="dayEnd" id="" value="<?= $dayEnd ?? "" ?>">

                    <button type="submit" name="btn__find--OrderMoney"><i class="fa-sharp fa-solid fa-filter" style="margin-right: 5px; font-size: 16px; color: #ffffff;"></i>Lọc </button>
                </form>
                <table border="1">
                    <thead>
                        <tr>
                            <th>Mã dơn hàng</th>
                            <th>Mã khách hàng</th>
                            <th>Tên khách hàng</th>
                            <th>Tổng tiền</th>
                            <th>Địa chỉ</th>
                            <th>Ngày mua</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (sizeof($getListMoneyOrderAdmin) > 0) : ?>
                            <?php foreach ($getListMoneyOrderAdmin as $value) : ?>
                                <tr>
                                    <td>DH00<?= $value['id'] ?></td>
                                    <td>KH00<?= $value['user_id'] ?></td>

                                    <td><?= $value['name'] ?></td>
                                    <td><?= number_format($value['total_price']) . 'đ' ?></td>
                                    <td><?= $value['address'] ?></td>

                                    <td><?= $value['created_at'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="6" style="padding: 20px 0;">Không tìm thấy kết quả nào</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <ul>
                    <!-- Start Pagination -->
                    <?php if (ceil($countPage) <= 1) {
                        $i = "";
                    ?>
                    <?php } else {
                        $i = 0;
                    ?>
                        <?php if (isset($_GET['page']) && $_GET['page'] > 2) {
                            $fisrtPage = 1; ?>
                            <li><a href="index.php?actAdmin=statisticals&page=<?= $fisrtPage ?><?= (isset($_REQUEST['dayStart'])&&isset($_REQUEST['dayEnd']))  ? "&dayStart=" . $_REQUEST['dayStart']."&dayEnd=" . $_REQUEST['dayEnd']  : "" ?>"><i class="fa-sharp fa-solid fa-angles-left"></i></a></li>
                        <?php } ?>

                        <?php if (isset($_GET['page']) && $_GET['page'] > 1) {
                            $prevPage = $_GET['page'] - 1; ?>
                            <li><a href="index.php?actAdmin=statisticals&page=<?= $prevPage ?><?= (isset($_REQUEST['dayStart'])&&isset($_REQUEST['dayEnd']))  ? "&dayStart=" . $_REQUEST['dayStart']."&dayEnd=" . $_REQUEST['dayEnd']  : "" ?>"><i class="fa-solid fa-angle-left"></i></a></li>
                        <?php } ?>

                        <?php for ($i; $i < $countPage; $i++) : ?>
                            <?php if (isset($_GET['page'])) : ?>
                                <?php if ($i + 1 != $_GET['page']) : ?>
                                    <?php if ($i + 1 > $_GET['page'] - 2 && $i + 1 < $_GET['page'] + 2) : ?>
                                        <li><a href="index.php?actAdmin=statisticals&page=<?= $i + 1 ?><?= (isset($_REQUEST['dayStart'])&&isset($_REQUEST['dayEnd']))  ? "&dayStart=" . $_REQUEST['dayStart']."&dayEnd=" . $_REQUEST['dayEnd']  : "" ?>"><?= $i + 1 ?></a></li>
                                    <?php endif; ?>
                                <?php else : ?>
                                    <li><a style="background-color: #F39C12; color: #ffffff" href="index.php?actAdmin=statisticals&page=<?= $i + 1 ?><?= (isset($_REQUEST['dayStart'])&&isset($_REQUEST['dayEnd']))  ? "&dayStart=" . $_REQUEST['dayStart']."&dayEnd=" . $_REQUEST['dayEnd']  : "" ?>"><?= $i + 1 ?></a></li>
                                <?php endif; ?>
                            <?php else : ?>
                                <?php
                                if ($i + 1 == 1) {
                                    $backGround = "style=background-color:";
                                    $color = "#F39C12;";
                                    $word = "color:";
                                    $colorWord = "#ffffff";
                                } else {
                                    $backGround = "";
                                    $color = "";
                                    $word = "";
                                    $colorWord = "";
                                }
                                ?>
                                <?php if ($i < 4) : ?>
                                    <li><a <?= $backGround . $color . $word . $colorWord ?> href="index.php?actAdmin=statisticals&page=<?= $i + 1 ?><?= (isset($_REQUEST['dayStart'])&&isset($_REQUEST['dayEnd']))  ? "&dayStart=" . $_REQUEST['dayStart']."&dayEnd=" . $_REQUEST['dayEnd']  : "" ?>"><?= $i + 1 ?></a></li>

                                <?php endif; ?>

                            <?php endif; ?>
                        <?php endfor ?>


                        <?php if (!isset($_GET['page'])) {
                            $nextPage = 2; ?>
                            <li><a href="index.php?actAdmin=statisticals&page=<?= $nextPage ?><?= (isset($_REQUEST['dayStart'])&&isset($_REQUEST['dayEnd']))  ? "&dayStart=" . $_REQUEST['dayStart']."&dayEnd=" . $_REQUEST['dayEnd']  : "" ?>"><i class="fa-solid fa-angle-right"></i></a></li>
                        <?php } ?>

                        <?php if (!isset($_GET['page'])) {
                            $endPage = ceil($countPage); ?>
                            <li><a href="index.php?actAdmin=statisticals&page=<?= $endPage ?><?= (isset($_REQUEST['dayStart'])&&isset($_REQUEST['dayEnd']))  ? "&dayStart=" . $_REQUEST['dayStart']."&dayEnd=" . $_REQUEST['dayEnd']  : "" ?>"><i class="fa-sharp fa-solid fa-angles-right"></i></a></li>
                        <?php } ?>



                        <?php if (isset($_GET['page']) && $_GET['page'] < ceil($countPage)) {
                            $nextPage = $_GET['page'] + 1; ?>
                            <li><a href="index.php?actAdmin=statisticals&page=<?= $nextPage ?><?= (isset($_REQUEST['dayStart'])&&isset($_REQUEST['dayEnd']))  ? "&dayStart=" . $_REQUEST['dayStart']."&dayEnd=" . $_REQUEST['dayEnd']  : "" ?>"><i class="fa-solid fa-angle-right"></i></a></li>
                        <?php } ?>

                        <?php if (isset($_GET['page']) && $_GET['page'] < ceil($countPage) - 1) {
                            $endPage = ceil($countPage); ?>
                            <li><a href="index.php?actAdmin=statisticals&page=<?= $endPage ?><?= (isset($_REQUEST['dayStart'])&&isset($_REQUEST['dayEnd']))  ? "&dayStart=" . $_REQUEST['dayStart']."&dayEnd=" . $_REQUEST['dayEnd']  : "" ?>"><i class="fa-sharp fa-solid fa-angles-right"></i></a></li>
                        <?php } ?>

                    <?php } ?>
                    <!-- End Pagination -->
                </ul>
            </div>
        </div>
        <div class="statistical--orderRecent">
            <div class="title">
                <?php
                $sumWeek = 0;
                foreach ($totalOrderWeek as $value) {
                    $sumWeek += $value['kh_mua'];
                }
                ?>
                <h2>Số lượng đơn hàng giao dịch trong tuần: <?= $sumWeek ?></h2>
            </div>
            <div class="tableProduct">
                <table border="1">
                    <thead>
                        <tr>
                            <th>Mã khách hàng</th>

                            <th>Tên khách hàng</th>
                            <th>Số lượng đơn</th>
                            <!-- <th>Tổng tiền</th> -->
                            <th>Ngày mua</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($totalOrderWeek as $value) : ?>
                            <tr>
                                <td>KH00<?= $value['id_kh'] ?></td>

                                <td><?= $value['name'] == "" ? "Khách hàng trực tiếp" : $value['name'] ?></td>
                                <td><?= $value['kh_mua'] ?></td>

                                <td><?= $value['created_at'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="contentManager--product__footer contentManager--product__footer--addProduct">
        <div class="statistical--first">
            <div class="statistical--topProduct">
                <div class="title">
                    <?php
                    $totalOrder = 0;
                    foreach ($listBuyOnDay as $value) {
                        $totalOrder += $value['kh_mua'];
                    }
                    ?>

                    <h2>Đơn hàng giao dịch trong ngày: <?= $totalOrder ?></h2>
                </div>
                <div class="tableProduct">
                    <table border="1">
                        <thead>
                            <tr>
                                <th>Mã khách hàng</th>
                                <!-- <th>Mã đơn hàng</th> -->
                                <th>Tên khách hàng</th>
                                <th>Số lượng đơn</th>
                                <!-- <th>Tổng tiền</th> -->
                                <th>Ngày mua</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listBuyOnDay as $value) : ?>
                                <tr>
                                    <td>KH00<?= $value['id_kh'] ?></td>

                                    <td><?= $value['name'] == "" ? "Khách hàng trực tiếp" : $value['name'] ?></td>
                                    <td><?= $value['kh_mua'] ?></td>

                                    <td><?= $value['created_at'] ?></td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="statistical--chart statistical--topProduct ">
                <div class="title">
                    <h2>Thống kê sản phẩm theo danh mục</h2>
                </div>
                <div class="chart--doughnut">
                    <canvas id="chart__first"></canvas>
                </div>
            </div>
        </div>


    </div>
</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.0.1/chart.umd.min.js"></script>
<script>
    const data3 = {
        labels: [
            <?php
            $total = count($getToTalProductChart);
            $i = 1;
            foreach ($getToTalProductChart as $value) {
                extract($value);
                if ($i == $total) {
                    $sign = "";
                } else {
                    $sign = ",";
                }
                echo "'" . $value['name'] . "'" . $sign;
                $i++;
            }
            ?>
        ],
        datasets: [{
            label: 'Số lượng',
            data: [
                <?php
                $total = count($getToTalProductChart);
                $i = 1;
                foreach ($getToTalProductChart as $value) {
                    extract($value);
                    if ($i == $total) {
                        $sign = "";
                    } else {
                        $sign = ",";
                    }
                    echo $value['total_product'] . $sign;
                    $i++;
                }
                ?>
            ],
            backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                '#009900',
                '#FFFF00',
                '#000080',
                '#FFFFFF',
                '#800000'

            ],
            hoverOffset: 4
        }]
    };

    const config3 = {
        type: 'doughnut',
        data: data3,
    };
    const canvas3 = document.getElementById('chart__first');
    const chart3 = new Chart(canvas3, config3);
</script>
<script src="../src/js/statisticalSecond.js"></script>
<script src="../src/js/animation.js"></script>
</body>

</html>