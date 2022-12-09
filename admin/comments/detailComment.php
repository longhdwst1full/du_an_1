<div class="contentManager contentManager--product">
            <div class="contentManager--product__header">
                <div class="contentManager--product__header--title">
                    <?php foreach ($listCmt as $key => $value) {$countCmt=commented_count($value['product_id']);$sumCmt=$countCmt[0]['SL'];}?>
                    <h2 style="color: #ffffff;">Số lượng bình luận: <?=$sumCmt?></h2>
                    <form action="index.php?actAdmin=SearchProComment" method="post">
                        <input type="text" name="kyw" placeholder="Nhập từ khóa cần tìm kiếm">
                        <button type="submit">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </form>
                </div>
                <div class="contentManager--product__header--control">
                    <span><i class="fa-solid fa-house"></i>Trang chủ</span> <span style="padding: 0 10px; font-size: 22px;">></span> <span><i class="fa-solid fa-comment"></i>Quản lý bình luận</span><span style="padding: 0 10px; font-size: 22px;">></span><span><i class="fa-solid fa-eye" ></i>Chi tiết bình luận</span>
                </div>
            </div>
            <div class="show--productComment">
                <?php foreach ($listCmt as $key => $value) {$nameUser = commented_toUser($value['user_id'],$value['product_id']);$ProName=$nameUser['ProName'];$Avt = $nameUser['Avt'];}?>
                <h2>Sản phẩm bình luận: </h2><span> <?=$ProName?></span>
                <br>
                <div class="show--productComment--Image">
                    <img width="150px" height="150px" src="../imageProduct/<?=$Avt?>" alt="">
                </div>
            </div>
           
            <div class="btn-backtoComment" style="margin:20px 0px;">
                <?php 
                    if(isset($_GET['pageRate'])){
                        global $pageRate;
                        $pageRate = '&&rate';
                        $pageRate_1 = '&&pageRate';
                    }else{
                        $pageRate ='&&page';
                        $pageRate_1 = '';
                    }
                ?>
                <a href="index.php?actAdmin=comments<?=$pageRate?><?=$pageRate_1?>=<?=$_GET['parent']?>" style="color: white;padding: 10px 15px;background: #f51717;border-radius: 5px;font-weight: bold; font-size: 15px;">Quay lại</a>
                <?php if(isset($_GET['msg'])): ?>
                    <div class="alert alert-success" style="padding: 15px 0 15px 25px;">
                        <?= $_GET['msg'] ?>
                    </div>
            <?php endif ?>
            </div>
            <div class="contentManager--product__footer " style="padding-top: 0;">
                    
                <div class="contentManager--product__footer--table" style="margin-top: 10px">
                    <table border="1">
                        <thead>
                            <tr>
                                <!-- <th><input type="checkbox"></th> -->
                                <!-- <th>STT</th> -->
                                <th>Tên khách hàng</th>
                                <th>Email</th>
                                <th>Nội dung bình luận</th>
                                <th>Đánh giá</th>
                                <th>Ngày bình luận</th>
                                <th>Vai trò</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                             $stt =1;
                             foreach ($listCmt as $value) {
                                extract($value);
                                $nameUser = commented_toUser($value['user_id'],$value['product_id']);
                                $pathDele = 'index.php?actAdmin=detailCommentDele&cid='.$value['id'].'&uid='.$value['user_id'].'&pid='.$value['product_id'].'&page-at='.$_GET['page'];
                                if($nameUser['RoleUser']==1){$Role = 'Admin';}else if($nameUser['RoleUser']==0){$Role = 'Khách';};
                                switch ($value['rating_products']) {
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
                                        $star = '';
                                        break;
                                }
                                echo '
                                <tr>
                                    
                                    
                                    <td class="name">'.$nameUser['NameUser'].'</td>
                                    <td class="email">'.$nameUser['EamilUser'].'</td>
                                    <td class="content">'.$value['content'].'</td>
                                    <td class="content">'.$star.'</td>
                                    <td class="dateCreate">'.$value['created_at'].'</td>
                                    <td class="role">'.$Role.'</td>
                                    <td class="btn-action">
                                        <a onclick="return confirm(`Bạn có chắc chắn muốn xóa khônng ? `)" href="'.$pathDele.'"><i class="fa-sharp fa-solid fa-trash"></i></a>
                                    </td>
                                </tr>';
                                $stt++;
                            }
                            ?>
                        </tbody>
                    </table>
                    <ul>
                <?php   
                        if((isset($_GET['uid'])&& ($_GET['uid']>0))&&(isset($_GET['pid'])&& ($_GET['pid']>0))){
                            $uid = $_GET['uid'];
                            $pid = $_GET['pid'];
                        }else{
                            $uid = 0;
                            $pid = 0;
                        }
                        $rows = comment_count_pro_cmt($pid);
                        $slpage = ceil($rows['Count(*)']/5);
                        global $slpage;
                        if(isset($_GET['page'])){
                            if($_GET['page'] > 0){
                                if($_GET['page'] <= 1){
                                    $prev = 1 ;
                                }else{
                                    $prev = $_GET['page'] - 1;
                                }
                                if($_GET['page'] >= $slpage){
                                    $next = $_GET['page'];
                                }else{
                                    $next = $_GET['page'] + 1;
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
                    <a href="index.php?actAdmin=detailComment<?=$pageRate_1?>&parent=<?=$_GET['parent']?>&uid=<?=$uid?>&pid=<?=$pid?>&page=1"><i class="fa-sharp fa-solid fa-angles-left"></i></a>
                </li>
                <li>
                    <a href="index.php?actAdmin=detailComment<?=$pageRate_1?>&parent=<?=$_GET['parent']?>&uid=<?=$uid?>&pid=<?=$pid?>&page=<?= isset($prev) ? $prev : ''?>"><i class="fa-solid fa-angle-left"></i></a>
                </li>
                <?php
                        for ($i=1; $i <= $slpage; $i++) {
                            if(isset($_GET['page']) && $i == $_GET['page']){
                                echo ' <li style="margin: 0 3px;">
                                <a style="background-color: #F39C12; color: #ffffff;" href="index.php?actAdmin=detailComment'.$pageRate_1.'&parent='.$_GET['parent'].'&uid='.$uid.'&pid='.$pid.'&page='.$i.'">'.$i.'</a></li>';
                            }else if(!isset($_GET['page'])){
                                if($i ==1 ){
                                    echo ' <li style="margin: 0 3px;">
                                    <a style="background-color: #F39C12; color: #ffffff;" href="index.php?actAdmin=detailComment'.$pageRate_1.'&parent='.$_GET['parent'].'&uid='.$uid.'&pid='.$pid.'&page='.$i.'">'.$i.'</a></li>';
                                }else{
                                echo '<li style="margin: 0 3px">
                                <a href="index.php?actAdmin=detailComment'.$pageRate_1.'&parent='.$_GET['parent'].'&uid='.$uid.'&pid='.$pid.'&page='.$i.'">'.$i.'</a></li>';
                                }
                            }else{
                                echo '<li style="margin: 0 3px">
                                <a href="index.php?actAdmin=detailComment'.$pageRate_1.'&parent='.$_GET['parent'].'&uid='.$uid.'&pid='.$pid.'&page='.$i.'">'.$i.'</a></li>';
                            }
                        }
                ?>
                <li>
                    <a href="index.php?actAdmin=detailComment<?=$pageRate_1?>&parent=<?=$_GET['parent']?>&uid=<?=$uid?>&pid=<?=$pid?>&page=<?= isset($next) ? $next : ''?>"><i class="fa-solid fa-angle-right"></i></a>
                </li>
                <li>
                    <a href="index.php?actAdmin=detailComment<?=$pageRate_1?>&parent=<?=$_GET['parent']?>&uid=<?=$uid?>&pid=<?=$pid?>&page=<?=$slpage?>"><i class="fa-sharp fa-solid fa-angles-right"></i></a>
                </li>
            </ul>
                </div>
            </div>
        </div>
    </div>
    <script src="../src/js/animation.js"></script>
</body>

</html>