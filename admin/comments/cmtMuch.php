<div class="contentManager contentManager--product">
            <div class="contentManager--product__header">
                <div class="contentManager--product__header--title">
                    <h2 style="color: #ffffff;">Danh sách sản phẩm có bình luận</h2>
                    <form action="index.php?actAdmin=searchProCmt" method="post">
                        <input type="text" name="kyw" value="<?= isset($_POST['kyw']) ? $_POST['kyw'] : '';?>" placeholder="Nhập từ khóa cần tìm kiếm">
                        <button type="submit">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                            <a href="index.php?actAdmin=comments&&rate&&pageRate=1" style="color: white;padding: 15px;background: #b31212;/* border: 1px; */border-radius: 8px;margin-left: 10px; font-weight: bold;">Bình luận nhiều nhất</a>
                    </form>
                </div>
                <div class="contentManager--product__header--control">
                    <span><i class="fa-solid fa-house"></i>Trang chủ</span> <span style="padding: 0 10px; font-size: 22px;">></span> <span><i class="fa-solid fa-comment"></i>Quản lý bình luận</span>
                </div>
            </div>
            <div class="contentManager--product__footer">
                <div class="contentManager--product__footer--table">
                    <table border="1">
                        <thead>
                            <tr>
                                <!-- <th>STT</th> -->
                                <th>Mã sản phẩm</th>
                                <th>Sản phẩm</th>
                                <th>Ảnh</th>
                                <th>Danh mục</th>
                                <th>Đánh giá</th>
                                <th>Số lượng bình luận</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $stt = 1;
                                foreach ($listCmt as $key => $value) {
                                    $countCmt=commented_count($value['product_id']);
                                    $nameUser = commented_toUser($value['user_id'],$value['product_id']);
                                    $cuontRat=commented_sumRat($value['product_id']);
                                    $path = 'index.php?actAdmin=detailComment&pageRate&parent='.$_GET['pageRate'].'&uid='.$value['user_id'].'&pid='.$value['product_id'].'&page=1';
                                    switch (ceil(($cuontRat['sum']/$countCmt[0]['SL']))) {
                                        case '1':
                                            $star = '<i class="fa-regular fa-star orange"></i>';
                                            break;
                                        case '2':
                                            $star = '<i class="fa-regular fa-star orange"></i><i class="fa-regular fa-star orange"></i>';
                                            break;
                                        case '3':
                                            $star = '<i class="fa-regular fa-star orange"></i><i class="fa-regular fa-star orange"></i><i class="fa-regular fa-star orange"></i>';
                                            break;
                                        case '4':
                                            $star = '<i class="fa-regular fa-star orange"></i><i class="fa-regular fa-star orange"></i><i class="fa-regular fa-star orange"></i><i class="fa-regular fa-star orange"></i>';
                                            break;
                                        case '5':
                                            $star = '<i class="fa-regular fa-star orange"></i><i class="fa-regular fa-star orange"></i><i class="fa-regular fa-star orange"></i><i class="fa-regular fa-star orange"></i><i class="fa-regular fa-star orange"></i>';
                                            break;
                                        default:
                                            $star = '<i class="fa-regular fa-star"></i> <i class="fa-regular fa-star"></i> <i class="fa-regular fa-star"></i> <i class="fa-regular fa-star"></i> <i class="fa-regular fa-star"></i>';
                                            break;
                                    }
                                    echo '
                                        <tr>
                                            
                                            <td>SP0'.$nameUser['Pid'].'</td>
                                            <td class="name">'.$nameUser['ProName'].'</td>
                                            <td class="image">
                                                <img width="100px" height="100px" src="../imageProduct/'.$nameUser['Avt'].'" alt="">
                                            </td>
                                            <td class="category">
                                            '.$nameUser['CatName'].'
                                            </td>
                                            <td class="dateCreate">
                                            <div>
                                            '.$star.'
                                        </div>
                                            </td>
                                            <td class="dateCreate">
                                               '.$countCmt[0]['SL'].'
                                            </td>
                                            <td class="detailBill">
                                                <a href="'.$path.'"><button class="detailBill--see"><i class="fa-solid fa-eye" style="padding-right: 5px;" ></i>Xem chi tiết</button></a>
                                            </td>
                                        </tr>
                                    ';
                                    $stt++;
                                }
                            ?>
                        </tbody>
                    </table>
                    <ul>
                <?php 
                        $rows = comment_count_pro();
                        $slpage = ceil($rows['Count(*)']/5);
                        if(isset($_GET['pageRate'])){
                            if($_GET['pageRate'] > 0){
                                if($_GET['pageRate'] <= 1){
                                    $prev = 1 ;
                                }else{
                                    $prev = $_GET['pageRate'] - 1;
                                }
                                if($_GET['pageRate'] >= $slpage){
                                    $next = $_GET['pageRate'];
                                }else{
                                    $next = $_GET['pageRate'] + 1;
                                }
                            }else{
                                $next = 1;
                            }
                        }else{
                            $prev = 1;
                            $next = 1;
                        }
                 ?>
                <li>
                    <a href="index.php?actAdmin=comments&&rate&&pageRate=1"><i class="fa-sharp fa-solid fa-angles-left"></i></a>
                </li>
                <li>
                    <a href="index.php?actAdmin=comments&&rate&&pageRate=<?= isset($prev) ? $prev : ''?>"><i class="fa-solid fa-angle-left"></i></a>
                </li>
                <?php
                        $rows = comment_count_pro();
                        $slpage = ceil($rows['Count(*)']/5);
                        for ($i=1; $i <= $slpage; $i++) {
                            if(isset($_GET['pageRate']) && $i == $_GET['pageRate']){
                                echo ' <li style="margin: 0 3px;">
                                <a style="background-color: #F39C12; color: #ffffff;" href="index.php?actAdmin=comments&&rate&&pageRate='.$i.'">'.$i.'</a></li>';
                            }else if(!isset($_GET['pageRate'])){
                                if($i ==1 ){
                                    echo ' <li style="margin: 0 3px;">
                                    <a style="background-color: #F39C12; color: #ffffff;" href="index.php?actAdmin=comments&&rate&&pageRate='.$i.'">'.$i.'</a></li>';
                                }else{
                                echo '<li style="margin: 0 3px">
                                <a href="index.php?actAdmin=comments&&rate&&pageRate='.$i.'">'.$i.'</a></li>';
                                }
                            }else{
                                echo '<li style="margin: 0 3px">
                                <a href="index.php?actAdmin=comments&&rate&&pageRate='.$i.'">'.$i.'</a></li>';
                            }
                        }
                ?>
                <li>
                    <a href="index.php?actAdmin=comments&&rate&&pageRate=<?= isset($next) ? $next : ''?>"><i class="fa-solid fa-angle-right"></i></a>
                </li>
                <li>
                    <a href="index.php?actAdmin=comments&&rate&&pageRate=<?=$slpage?>"><i class="fa-sharp fa-solid fa-angles-right"></i></a>
                </li>
            </ul>
                </div>
            </div>
        </div>
    </div>
    <script src="../src/js/animation.js"></script>
</body>

</html>
