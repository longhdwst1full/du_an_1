<div class="contentManager contentManager--product">
            <div class="contentManager--product__header">
                <div class="contentManager--product__header--title">
                    <h2 style="color: #ffffff;">Danh sách đơn hàng</h2>
                    <form action="" method="post">
                        <input type="text"  placeholder="Nhập từ khóa cần tìm kiếm" name="keyWord" value="<?= $keyWord ?? "" ?>">
                        <button type="submit" name="btn-searchOrder">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </form>
                </div>
                <div class="contentManager--product__header--control">
                    <span><i class="fa-solid fa-house"></i>Trang chủ</span> <span style="padding: 0 10px; font-size: 22px;">></span> <span><i class="fa-solid fa-cart-flatbed-suitcase"></i>Quản lý đơn hàng</span>
                </div>
            </div>
            <div class="contentManager--product__footer">
                <div class="contentManager--product__footer--addProduct">
                    <a href="index.php?actAdmin=addOrderAdmin"><button><i class="fa-solid fa-plus"></i> Thêm đơn hàng mới</button></a>
                </div>
                <?php if(isset($notification)): ?>
                    <div class="alert alert-success">
                        <?= $notification ?>
                    </div>
                <?php endif; ?>
                <?php if (isset($_COOKIE['successOrder'])) : ?>
                    <div class="alert alert-success">
                        <?= $_COOKIE['successOrder'] ?>
                    </div>
                <?php endif ?>
                <div class="contentManager--product__footer--table">
                    <table border="1" class="orderAdminTable">
                        <thead>
                            <tr>
                                <!-- <th><input type="checkbox"></th> -->
                                <!-- <th>STT</th> -->
                                <th>Mã đơn hàng</th>
                                <th>Tên khách hàng</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái</th>
                                <th>Ngày tạo</th>
                                <th>Chi tiết đơn hàng</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($listOrderUser as $key => $value): ?>
                                <tr>
                                    <!-- <td><input type="checkbox"></td> -->
                                    
                                    <td>DH00<?= $value['id'] ?></td>
                                    <td class="name"><?= $value['name'] ?></td>
                                    <td class="price">
                                        <?= number_format($value['total_price'])."đ" ?>
                                    </td>
                                    <td class="status order-status">
                                        <?php if($value['status'] == 0): ?>
                                            <button class="status-isset">Đơn hàng mới</button>
                                        <?php elseif($value['status'] == 1): ?>
                                            <button class="status-isset" style="background-color: #24448f;">Đơn đã duyệt</button>
                                        <?php elseif($value['status'] == 6): ?>
                                            <button class="status-isset" style="background-color: #DD4B39;">Đã thanh toán</button>
                                        <?php endif; ?>
                                        
                                        <?php if($value['status'] == 0): ?>
                                            <div class="tick--Order">
                                                <p style="color: #ffffff;">Duyệt đơn mới</p>
                                                <a href="index.php?actAdmin=updateOrderAdmin&&status=1&&id=<?= $value['id'] ?>">
                                                    <i class="fa-solid fa-check"></i>
                                                </a>
                                            </div>
                                        <?php elseif($value['status'] == 1): ?>
                                            <div class="tick--Order">
                                                <p style="color: #ffffff;">Hoàn thành đơn</p>
                                                <a href="index.php?actAdmin=updateOrderAdmin&&status=6&&id=<?= $value['id'] ?>">
                                                    <i class="fa-solid fa-arrow-right" style="color: #24448f;"></i>
                                                </a>
                                            </div>
                                        <?php endif; ?>

                                        
                                    </td>
                                    <td class="dateCreate">
                                        <?= $value['created_at'] ?>
                                    </td>
                                    <td class="detailBill">
                                        <a href="index.php?actAdmin=detailOrder&&id=<?= $value['id'] ?>"><button class="detailBill--see"><i class="fa-solid fa-eye" style="padding-right: 5px;" ></i>Xem chi tiết</button></a>
                                        
                                        
                                    </td>
                                    <td class="btn-action">
                                        <?php if($value['statusUser'] == 3): ?>
                                            <a href="index.php?actAdmin=editOrderAdmin-WithUser&&id=<?= $value['id'] ?>" class="update"><i class="fa-solid fa-screwdriver"></i></a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <ul>
                <!-- Start Pagination -->
                <?php if(ceil($countPage) <= 1){ 
                    $i = ""; 
                ?>
                <?php }else{
                    $i = 0; 
                ?>
                        <?php if(isset($_GET['page']) && $_GET['page'] > 2){ $fisrtPage = 1; ?>
                            <li><a href="index.php?actAdmin=showOrder&page=<?= $fisrtPage ?><?= isset($_REQUEST['keyWord']) ? "&keyWord=".$_REQUEST['keyWord'] : "" ?> "><i class="fa-sharp fa-solid fa-angles-left"></i></a></li>
                        <?php } ?>

                        <?php if(isset($_GET['page']) && $_GET['page'] > 1){ $prevPage = $_GET['page'] - 1; ?>
                            <li><a  href="index.php?actAdmin=showOrder&page=<?= $prevPage ?><?= isset($_REQUEST['keyWord']) ? "&keyWord=".$_REQUEST['keyWord'] : "" ?>"><i class="fa-solid fa-angle-left"></i></a></li>
                        <?php } ?>

                        <?php for($i; $i < $countPage; $i++): ?>
                                <?php if(isset($_GET['page'])): ?>
                                    <?php if($i+1 != $_GET['page']): ?>
                                        <?php if($i+1 > $_GET['page']-2 && $i+1 < $_GET['page']+2): ?>
                                            <li><a href="index.php?actAdmin=showOrder&page=<?= $i+1 ?><?= isset($_REQUEST['keyWord']) ? "&keyWord=".$_REQUEST['keyWord'] : "" ?>"><?= $i+1 ?></a></li>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <li><a style="background-color: #F39C12; color: #ffffff" href="index.php?actAdmin=showOrder&page=<?= $i+1 ?><?= isset($_REQUEST['keyWord']) ? "&keyWord=".$_REQUEST['keyWord'] : "" ?>"><?= $i+1 ?></a></li>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <?php   
                                        if($i+1 == 1){
                                            $backGround = "style=background-color:";
                                            $color = "#F39C12;";
                                            $word = "color:";
                                            $colorWord = "#ffffff";
                                        }else{
                                            $backGround = "";
                                            $color = "";
                                            $word = "";
                                            $colorWord = "";
                                        } 
                                    ?>
                                    <?php if($i < 4): ?>
                                        <li><a <?= $backGround.$color.$word.$colorWord ?> href="index.php?actAdmin=showOrder&page=<?= $i+1 ?><?= isset($_REQUEST['keyWord']) ? "&keyWord=".$_REQUEST['keyWord'] : "" ?>"><?= $i+1 ?></a></li>
                                        
                                    <?php endif; ?>
                                    
                                <?php endif; ?>
                        <?php endfor ?>
                       
                          
                        <?php if(!isset($_GET['page'])){ $nextPage = 2; ?>
                            <li><a  href="index.php?actAdmin=showOrder&page=<?= $nextPage ?><?= isset($_REQUEST['keyWord']) ? "&keyWord=".$_REQUEST['keyWord'] : "" ?>"><i class="fa-solid fa-angle-right"></i></a></li>
                        <?php } ?>

                        <?php if(!isset($_GET['page'])){ $endPage = ceil($countPage); ?>
                            <li><a  href="index.php?actAdmin=showOrder&page=<?= $endPage ?><?= isset($_REQUEST['keyWord']) ? "&keyWord=".$_REQUEST['keyWord'] : "" ?>"><i class="fa-sharp fa-solid fa-angles-right"></i></a></li>
                        <?php } ?>
                          
                       
                        
                        <?php if(isset($_GET['page']) && $_GET['page'] < ceil($countPage)){ $nextPage = $_GET['page'] + 1; ?>
                            <li><a  href="index.php?actAdmin=showOrder&page=<?= $nextPage ?><?= isset($_REQUEST['keyWord']) ? "&keyWord=".$_REQUEST['keyWord'] : "" ?>"><i class="fa-solid fa-angle-right"></i></a></li>
                        <?php } ?>

                        <?php if(isset($_GET['page']) && $_GET['page'] < ceil($countPage)-1){ $endPage = ceil($countPage); ?>
                            <li><a  href="index.php?actAdmin=showOrder&page=<?= $endPage ?><?= isset($_REQUEST['keyWord']) ? "&keyWord=".$_REQUEST['keyWord'] : "" ?>"><i class="fa-sharp fa-solid fa-angles-right"></i></a></li>
                        <?php } ?>

                    <?php } ?>
                    <!-- End Pagination -->
            </ul>
                </div>
            </div>
        </div>
    </div>
    <script src="../src/js/animation.js"></script>
</body>

</html>