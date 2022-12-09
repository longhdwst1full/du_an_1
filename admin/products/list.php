<div class="contentManager contentManager--product">
    <div class="contentManager--product__header">
        <div class="contentManager--product__header--title">
            <h2 style="color: #ffffff;">Danh sách sản phẩm</h2>
            <form action="" method="post">
                <input type="text" placeholder="Nhập từ khóa cần tìm kiếm" name="keyWord" value="<?= $keyWord ?? "" ?>" >
                <button type="submit" name="btn-search--Product">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>
        <div class="contentManager--product__header--control">
            <span><i class="fa-solid fa-house"></i>Trang chủ</span> <span style="padding: 0 10px; font-size: 22px;">></span> <span><i class="fa-brands fa-product-hunt"></i>Quản lý sản phẩm</span>
        </div>
    </div>
    <div class="contentManager--product__footer">
        <div class="contentManager--product__footer--addProduct">
            <a href="index.php?actAdmin=addProduct"><button><i class="fa-solid fa-plus"></i> Thêm sản phẩm mới</button></a>
        </div>
        
        <?php if(isset($_COOKIE['notification'])): ?>
            <div class="alert alert-success" style="margin-bottom: 15px;">
                <?= $_COOKIE['notification'] ?>
            </div>
        <?php endif ?>
        <div class="filer__Product--followCategory">
           <form action="" method="POST" >

                <select name="nameCaterory" id="">
                    <option value="" hidden>--- Lọc sản phẩm theo danh mục ---</option>
                    <option value="" <?= (isset($nameCaterory)&&$nameCaterory=="") ? "selected" : "" ?> >Tất cả sản phẩm</option>
                    <?php foreach($listProductFlCat as $value): ?>
                        <option value="<?= $value['id'] ?>" <?= (isset($_POST['nameCaterory'])&&$_POST['nameCaterory']==$value['id']||isset($_GET['nameCaterory'])&&$_GET['nameCaterory']==$value['id']) ? "selected" : "" ?>  ><?= $value['name'] ?></option>
                    <?php endforeach; ?>
                </select>

                <select name="filterToPrice" id="" style="margin-left: 5px;" >
                    <option value="" hidden>--- Lọc sản phẩm theo giá ---</option>
                    <option value="hightToLow" <?= (isset($filterToPrice)&&$filterToPrice=="hightToLow") ? "selected" : "" ?>  >Giá từ cao xuống thấp</option>
                    <option value="lowTohight" <?= (isset($filterToPrice)&&$filterToPrice=="lowTohight") ? "selected" : "" ?> >Giá từ thấp lên cao</option>
                </select>

                <button type="submit" name="btn--filterProduct__followCat"><i class="fa-sharp fa-solid fa-filter"></i>Lọc </button>
           </form>
         
            <label onclick="return confirm('Bạn có muốn xóa các mục đã chọn')" for="submitCheckbox" class="deleteChoose">Xóa mục chọn</label>
          
          
        </div>
        <div id="getData" class="contentManager--product__footer--table" >
        <form action="" method="post"> 
            <table border="1">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="Allproduct"></th>
                        
                        <th>Mã sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>Ảnh</th>
                        <th>Tên danh mục</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Trạng thái</th>
                        <th>Ngày tạo</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(sizeof($listProduct) > 0): ?> 
                    <?php foreach ($listProduct as $key => $value) : ?>
                        <?php
                            $imagePath = "../imageProduct/" . $value['avatar'];
                            if (is_file($imagePath)) {
                                $image = "<img src='" . $imagePath . "' alt='' width='120px' height='150px'>";
                            } else {
                                $image = "<h4 style='color: #ffffff' >Không có hình ảnh</h4>";
                            }
                        ?>
                        <tr>
                            <td>                                 
                                <input type="checkbox" name="productID[]" value="<?= $value['id'] ?>" >
                                <input type="submit" id="submitCheckbox" name="btn__deleteProductAdmin" hidden  value="">                                                                                           
                            </td>
                           
                            <td>SP00<?= $value['id'] ?></td>
                            <td class="name"><?= $value['nameProduct'] ?></td>
                            <td class="image">
                                <?= $image ?>
                            </td>
                            <td class="category">
                                <?= $value['name'] ?>
                            </td>
                            <td class="price">
                                <?= number_format($value['price'])."đ" ?>
                            </td>
                            <td class="quantity">
                                <?= $value['quantity'] ?>
                            </td>
                            <td class="status">
                                <?php
                                    if( $value['status'] == 0 ){
                                        echo "<button class='status-isset'>Active</button>";
                                        
                                    }else{
                                        echo " <button class='status-empty'>Disable</button>";
                                    }
                                ?>
                            </td>
                            <td class="dateCreate">
                                <?= $value['created_at'] ?>
                            </td>
                            <td class="btn-action">
                                <a href="index.php?actAdmin=editProduct&&id=<?= $value['id'] ?>" class="update" style="margin-right:5px;" ><i class="fa-solid fa-screwdriver"></i></a>
                                
                                <a onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm <?= $value['nameProduct'] ?> không?')" href="index.php?actAdmin=deleteProduct&&id=<?= $value['id'] ?>" class="remove"><i class="fa-sharp fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php else: ?> 
                        <tr>
                            <td colspan="10" style="padding: 15px 0;">Không có sản phẩm nào</td>
                        </tr>
                    <?php endif; ?> 
                </tbody>
            </table>
        </form>
            <ul>
                <!-- Start Pagination -->
                <?php if(ceil($countPage) <= 1){ 
                    $i = ""; 
                ?>
                <?php }else{
                    $i = 0; 
                ?>
                        <?php if(isset($_GET['page']) && $_GET['page'] > 2){ $fisrtPage = 1; ?>
                            <li><a  href="index.php?actAdmin=showProduct&page=<?= $fisrtPage ?><?= isset($_REQUEST['keyWord']) ? "&keyWord=".$_REQUEST['keyWord'] : "" ?><?= isset($_REQUEST['nameCaterory']) ? "&nameCaterory=".$_REQUEST['nameCaterory'] : "" ?><?= isset($_REQUEST['filterToPrice']) ? "&filterToPrice=".$_REQUEST['filterToPrice'] : "" ?> "><i class="fa-sharp fa-solid fa-angles-left"></i></a></li>
                        <?php } ?>

                        <?php if(isset($_GET['page']) && $_GET['page'] > 1){ $prevPage = $_GET['page'] - 1; ?>
                            <li><a  href="index.php?actAdmin=showProduct&page=<?= $prevPage ?><?= isset($_REQUEST['keyWord']) ? "&keyWord=".$_REQUEST['keyWord'] : "" ?><?= isset($_REQUEST['nameCaterory']) ? "&nameCaterory=".$_REQUEST['nameCaterory'] : "" ?><?= isset($_REQUEST['filterToPrice']) ? "&filterToPrice=".$_REQUEST['filterToPrice'] : "" ?>"><i class="fa-solid fa-angle-left"></i></a></li>
                        <?php } ?>

                        <?php for($i; $i < $countPage; $i++): ?>
                                <?php if(isset($_GET['page'])): ?>
                                    <?php if($i+1 != $_GET['page']): ?>
                                        <?php if($i+1 > $_GET['page']-2 && $i+1 < $_GET['page']+2): ?>
                                            <li><a href="index.php?actAdmin=showProduct&page=<?= $i+1 ?><?= isset($_REQUEST['keyWord']) ? "&keyWord=".$_REQUEST['keyWord'] : "" ?><?= isset($_REQUEST['nameCaterory']) ? "&nameCaterory=".$_REQUEST['nameCaterory'] : "" ?><?= isset($_REQUEST['filterToPrice']) ? "&filterToPrice=".$_REQUEST['filterToPrice'] : "" ?>"><?= $i+1 ?></a></li>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <li><a style="background-color: #F39C12; color: #ffffff" href="index.php?actAdmin=showProduct&page=<?= $i+1 ?><?= isset($_REQUEST['keyWord']) ? "&keyWord=".$_REQUEST['keyWord'] : "" ?><?= isset($_REQUEST['nameCaterory']) ? "&nameCaterory=".$_REQUEST['nameCaterory'] : "" ?><?= isset($_REQUEST['filterToPrice']) ? "&filterToPrice=".$_REQUEST['filterToPrice'] : "" ?>"><?= $i+1 ?></a></li>
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
                                        <li><a <?= $backGround.$color.$word.$colorWord ?> href="index.php?actAdmin=showProduct&page=<?= $i+1 ?><?= isset($_REQUEST['keyWord']) ? "&keyWord=".$_REQUEST['keyWord'] : "" ?><?= isset($_REQUEST['nameCaterory']) ? "&nameCaterory=".$_REQUEST['nameCaterory'] : "" ?><?= isset($_REQUEST['filterToPrice']) ? "&filterToPrice=".$_REQUEST['filterToPrice'] : "" ?>"><?= $i+1 ?></a></li>
                                        
                                    <?php endif; ?>
                                    
                                <?php endif; ?>
                        <?php endfor ?>
                       
                          
                        <?php if(!isset($_GET['page'])){ $nextPage = 2; ?>
                            <li><a  href="index.php?actAdmin=showProduct&page=<?= $nextPage ?><?= isset($_REQUEST['keyWord']) ? "&keyWord=".$_REQUEST['keyWord'] : "" ?><?= isset($_REQUEST['nameCaterory']) ? "&nameCaterory=".$_REQUEST['nameCaterory'] : "" ?><?= isset($_REQUEST['filterToPrice']) ? "&filterToPrice=".$_REQUEST['filterToPrice'] : "" ?>"><i class="fa-solid fa-angle-right"></i></a></li>
                        <?php } ?>

                        <?php if(!isset($_GET['page'])){ $endPage = ceil($countPage); ?>
                            <li><a  href="index.php?actAdmin=showProduct&page=<?= $endPage ?><?= isset($_REQUEST['keyWord']) ? "&keyWord=".$_REQUEST['keyWord'] : "" ?><?= isset($_REQUEST['nameCaterory']) ? "&nameCaterory=".$_REQUEST['nameCaterory'] : "" ?><?= isset($_REQUEST['filterToPrice']) ? "&filterToPrice=".$_REQUEST['filterToPrice'] : "" ?>"><i class="fa-sharp fa-solid fa-angles-right"></i></a></li>
                        <?php } ?>
                          
                       
                        
                        <?php if(isset($_GET['page']) && $_GET['page'] < ceil($countPage)){ $nextPage = $_GET['page'] + 1; ?>
                            <li><a  href="index.php?actAdmin=showProduct&page=<?= $nextPage ?><?= isset($_REQUEST['keyWord']) ? "&keyWord=".$_REQUEST['keyWord'] : "" ?><?= isset($_REQUEST['nameCaterory']) ? "&nameCaterory=".$_REQUEST['nameCaterory'] : "" ?><?= isset($_REQUEST['filterToPrice']) ? "&filterToPrice=".$_REQUEST['filterToPrice'] : "" ?>"><i class="fa-solid fa-angle-right"></i></a></li>
                        <?php } ?>

                        <?php if(isset($_GET['page']) && $_GET['page'] < ceil($countPage)-1){ $endPage = ceil($countPage); ?>
                            <li><a  href="index.php?actAdmin=showProduct&page=<?= $endPage ?><?= isset($_REQUEST['keyWord']) ? "&keyWord=".$_REQUEST['keyWord'] : "" ?><?= isset($_REQUEST['nameCaterory']) ? "&nameCaterory=".$_REQUEST['nameCaterory'] : "" ?><?= isset($_REQUEST['filterToPrice']) ? "&filterToPrice=".$_REQUEST['filterToPrice'] : "" ?>"><i class="fa-sharp fa-solid fa-angles-right"></i></a></li>
                        <?php } ?>

                    <?php } ?>
                    <!-- End Pagination -->
            </ul>
            
        </div>
    </div>
</div>
</div>
<script src="../src/js/animation.js"></script>
<script src="../src/js/script.js"></script>
</body>

</html>