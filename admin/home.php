<div class="contentManager">
    <div class="contentManager--header">
        <div class="smallStatistics">
            <h2 class="numberStatistics">
                <?php
                $totalOrder = 0;
                foreach ($listBuyOnDay as $value) {
                    $totalOrder += $value['kh_mua'];
                }
                ?>
                <?= $totalOrder ?>
            </h2>
            <p class="nameStatistics">
                Đơn hàng giao dịch trong ngày
            </p>
            <div class="viewDetailStatistics">
                <a href="index.php?actAdmin=statisticals" style="color: #ffffff;"> Xem chi tiết<i class="fa-sharp fa-solid fa-gear"></i></a>
            </div>
        </div>
        <div class="smallStatistics smallStatisticsGreen">

            <h2 class="numberStatistics">
                <?php
                    $getCountProductHome = getCountProductHome();
                    echo $getCountProductHome['countProduct'];
                ?>
            </h2>
            <p class="nameStatistics">
                Số lượng sản phẩm hiện có
            </p>
            <div class="viewDetailStatistics">
                <a href="index.php?actAdmin=showProduct" style="color: #ffffff;"> Xem chi tiết<i class="fa-sharp fa-solid fa-gear"></i></a>
            </div>
        </div>
        <div class="smallStatistics smallStatisticsOrange">
            <h2 class="numberStatistics">
                <?php
                    $getCountUserHome = getCountUserHome();
                    echo $getCountUserHome['countUser'];
                ?>
            </h2>
            <p class="nameStatistics">
                Số lượng tài khoản khách hàng
            </p>
            <div class="viewDetailStatistics">
                <a href="index.php?actAdmin=showUsers" style="color: #ffffff;"> Xem chi tiết<i class="fa-sharp fa-solid fa-gear"></i></a>
            </div>
        </div>
        <div class="smallStatistics smallStatisticsRed">
            <h2 class="numberStatistics" style="text-align: center; padding-top:35px;">
                <?php
                // var_dump($countView);
                    $stringCount = str_pad($countView[0]['viewAccess'],8,"0",STR_PAD_LEFT);
                    echo $stringCount;
                ?>
            </h2>
            <p class="nameStatistics" style="text-align: center; padding: 15px 0;">
                Lượt truy cập website
            </p>
            <!-- <div class="viewDetailStatistics"> -->
                <!-- Xem chi tiết<i class="fa-sharp fa-solid fa-gear"></i> -->
            <!-- </div> -->
        </div>
    </div>
    <div class="contentManager--footer">
        <div class="contentManager--footer__left">
            <div class="title">
                <h2 style="color: #ffffff; padding-bottom: 20px; text-align: center; font-size: 28px;">Biểu đồ thống kê tổng quan</h2>
            </div>
            <canvas id="canvas5"></canvas>
        </div>
        <div class="contentManager--footer__right ">
            <?php if($bestSale != ""): ?>
                <div class="title ">
                    <?php
                        $productSale = getProductBestSalePrintAdmin();
                    ?>
                    <h2>Mã sản phẩm: SP00<?= $bestSale['id'] ?></h2>
                    <h2 style="padding-top: 10px;">Số lượng bán được: <?= $productSale['quantityBestSale'] ?></h2>
                </div>
                <div class="tableProduct ">
                    <?php
                    $imagePath = "../imageProduct/" . $bestSale['avatar'];
                    $image = "<img src='" . $imagePath . "' alt='' width='200px' >";
                    ?>
                    <div class="image">
                        <?= $image  ?>
                    </div>
                    <div class="infor">
                        <div class="title--inforProduct">
                            <h2 style="color: #ffffff;"><?= $bestSale['name'] ?></h2>
                        </div>
                        <div class="price--inforProduct">
                            <div class="price--inforProduct__discount">
                                <p style="color: #ffffff;"><?= number_format($bestSale['price']) . "đ"  ?></p>
                            </div>
                            <div class="price--inforProduct__root">

                                <p style="color: #ffffff;"><?= number_format($bestSale['price'] - ($bestSale['price'] * $bestSale['discount']) / 100) . "đ" ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="btn--seeProduct ">
                    <a href=""><button>Sản phẩm bán chạy nhất</button></a>
                </div>
            <?php else: ?>
            <div class="title ">
                <h2 style="text-align: center;">Chưa có sản phẩm bán chạy nào</h2>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
</div>
<script type="module" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.0.1/chart.umd.min.js"></script>
<script type="module">
    const labels = ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'];
    const data = {
        labels: labels,
        datasets: [{
                label: 'Lượt truy cập',
                backgroundColor: '#DD4B39',
                borderColor: '#DD4B39',
                data: [34, 27, 56, 34, 24, 53, 65, 74, 70, 71, 56, 89],
                tension: 0.4,
            },
            {
                label: 'Người đăng ký',
                backgroundColor: 'blue',
                borderColor: 'blue',
                data: [10, 20, 46, 44, 34, 63, 34, 28, 34, 80, 24, 32],
                tension: 0.4,
            },
            {
                label: 'Lượt mua hàng',
                backgroundColor: '#00C0EF',
                borderColor: '#00C0EF',
                data: [28, 54, 15, 34, 46, 44, 57, 23, 51, 69, 90, 21],
                tension: 0.4,
            },
        ]
    }

    const config = {
        type: 'bar',
        data: data,
    };
    const canvas = document.getElementById('canvas5');
    const chart = new Chart(canvas, config);
</script>
<script src="../src/js/animation.js"></script>
</body>

</html>