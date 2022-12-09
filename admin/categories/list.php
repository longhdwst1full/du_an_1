<div class="contentManager contentManager--product">
    <div class="contentManager--product__header">
        <div class="contentManager--product__header--title">
            <h2 style="color: #ffffff;">Danh sách danh mục</h2>
            <form action="" method="post">
                <input type="text" placeholder="Nhập từ khóa cần tìm kiếm" name="keyWord" value="<?= $keyWord ?? "" ?>">
                <button type="submit" name="btn-searchCategory">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>
        <div class="contentManager--product__header--control">
            <span><i class="fa-solid fa-house"></i>Trang chủ</span> <span style="padding: 0 10px; font-size: 22px;">></span> <span><i class="fa-brands fa-product-hunt"></i>Quản lý danh mục</span>
        </div>
    </div>
    <div class="contentManager--product__footer">
        <div class="contentManager--product__footer--addProduct">
            <a href="index.php?actAdmin=addCategory"><button><i class="fa-solid fa-plus"></i> Thêm danh mục mới</button></a>
        </div>
        <?php if (isset($notification)) : ?>
            <div class="alert alert-success">
                <?= $notification ?>
            </div>
        <?php endif ?>
        <div class="contentManager--product__footer--table">
            <table border="1">
                <thead>
                    <tr>
                        <!-- <th><input type="checkbox"></th> -->
                        <!-- <th>STT</th> -->
                        <th>Mã danh mục</th>
                        <th>Tên danh mục</th>
                        <th>Ảnh danh mục</th>
                        <th>Trạng thái</th>
                        <th>Số lượng sản phẩm</th>
                        <th>Ngày tạo</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    foreach ($listdm as $key => $category) :
                    ?>
                      <?php
                            $imagePath = "../imageProduct/" . $category['avatar'];
                            if (is_file($imagePath)) {
                                $image = "<img src='" . $imagePath . "' alt='' width='100px' height='100px'>";
                            } else {
                                $image = "<h4 style='color: #ffffff' >Không có hình ảnh</h4>";
                            }
                        ?>
                        <tr>
                            <!-- <td><input type="checkbox"></td> -->
                           
                            <td>DM00<?= $category['id'] ?></td>
                            <td class="name"><?= $category['name'] ?></td>
                            <td class="name">
                                <?= $image ?>
                            </td>

                            <td class="status">
                                <?php
                                    if( $category['status'] == 0 ){
                                        echo "<button class='status-isset'>Active</button>";
                                        
                                    }else{
                                        echo " <button class='status-empty'>Disable</button>";
                                    }
                                ?>
                            </td>
                            <td><?= $category['total_product'] ?></td>
                            <td class="dateCreate">
                                <?= $category['created_at'] ?>
                            </td>
                            <td class="btn-action">
                                <a href="index.php?actAdmin=editCategories&id=<?= $category['id'] ?>" style="margin-right: 5px;">
                                    <i class="fa-solid fa-screwdriver"></i></a>
                                <a onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục <?= $category['name'] ?> không?')" href="index.php?actAdmin=deleteCategory&id=<?= $category['id'] ?>">
                                    <i class="fa-sharp fa-solid fa-trash"></i></a>
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
                            <li><a href="index.php?actAdmin=listCategories&page=<?= $fisrtPage ?><?= isset($_REQUEST['keyWord']) ? "&keyWord=".$_REQUEST['keyWord'] : "" ?> "><i class="fa-sharp fa-solid fa-angles-left"></i></a></li>
                        <?php } ?>

                        <?php if(isset($_GET['page']) && $_GET['page'] > 1){ $prevPage = $_GET['page'] - 1; ?>
                            <li><a  href="index.php?actAdmin=listCategories&page=<?= $prevPage ?><?= isset($_REQUEST['keyWord']) ? "&keyWord=".$_REQUEST['keyWord'] : "" ?>"><i class="fa-solid fa-angle-left"></i></a></li>
                        <?php } ?>

                        <?php for($i; $i < $countPage; $i++): ?>
                                <?php if(isset($_GET['page'])): ?>
                                    <?php if($i+1 != $_GET['page']): ?>
                                        <?php if($i+1 > $_GET['page']-2 && $i+1 < $_GET['page']+2): ?>
                                            <li><a href="index.php?actAdmin=listCategories&page=<?= $i+1 ?><?= isset($_REQUEST['keyWord']) ? "&keyWord=".$_REQUEST['keyWord'] : "" ?>"><?= $i+1 ?></a></li>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <li><a style="background-color: #F39C12; color: #ffffff" href="index.php?actAdmin=listCategories&page=<?= $i+1 ?><?= isset($_REQUEST['keyWord']) ? "&keyWord=".$_REQUEST['keyWord'] : "" ?>"><?= $i+1 ?></a></li>
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
                                        <li><a <?= $backGround.$color.$word.$colorWord ?> href="index.php?actAdmin=listCategories&page=<?= $i+1 ?><?= isset($_REQUEST['keyWord']) ? "&keyWord=".$_REQUEST['keyWord'] : "" ?>"><?= $i+1 ?></a></li>
                                        
                                    <?php endif; ?>
                                    
                                <?php endif; ?>
                        <?php endfor ?>
                       
                          
                        <?php if(!isset($_GET['page'])){ $nextPage = 2; ?>
                            <li><a  href="index.php?actAdmin=listCategories&page=<?= $nextPage ?><?= isset($_REQUEST['keyWord']) ? "&keyWord=".$_REQUEST['keyWord'] : "" ?>"><i class="fa-solid fa-angle-right"></i></a></li>
                        <?php } ?>

                        <?php if(!isset($_GET['page'])){ $endPage = ceil($countPage); ?>
                            <li><a  href="index.php?actAdmin=listCategories&page=<?= $endPage ?><?= isset($_REQUEST['keyWord']) ? "&keyWord=".$_REQUEST['keyWord'] : "" ?>"><i class="fa-sharp fa-solid fa-angles-right"></i></a></li>
                        <?php } ?>
                          
                       
                        
                        <?php if(isset($_GET['page']) && $_GET['page'] < ceil($countPage)){ $nextPage = $_GET['page'] + 1; ?>
                            <li><a  href="index.php?actAdmin=listCategories&page=<?= $nextPage ?><?= isset($_REQUEST['keyWord']) ? "&keyWord=".$_REQUEST['keyWord'] : "" ?>"><i class="fa-solid fa-angle-right"></i></a></li>
                        <?php } ?>

                        <?php if(isset($_GET['page']) && $_GET['page'] < ceil($countPage)-1){ $endPage = ceil($countPage); ?>
                            <li><a  href="index.php?actAdmin=listCategories&page=<?= $endPage ?><?= isset($_REQUEST['keyWord']) ? "&keyWord=".$_REQUEST['keyWord'] : "" ?>"><i class="fa-sharp fa-solid fa-angles-right"></i></a></li>
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