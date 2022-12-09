<div class="contentManager contentManager--product">
    <div class="contentManager--product__header">
        <div class="contentManager--product__header--title">
            <h2 style="color: #ffffff;">Danh sách người dùng</h2>
            <form action="index.php?actAdmin=SearchUsers" method="post" enctype="multipart/form-data">
                <input type="text" name="kyw" placeholder="Nhập từ khóa cần tìm kiếm">
                <button type="submit">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>
        <div class="contentManager--product__header--control">
            <span><i class="fa-solid fa-house"></i>Trang chủ</span> <span style="padding: 0 10px; font-size: 22px;">></span> <span><i class="fa-brands fa-product-hunt"></i>Quản lý người dùng</span>
        </div>
    </div>
    <div class="contentManager--product__footer">
        <div class="contentManager--product__footer--addProduct">
            <a href="index.php?actAdmin=addUser"><button><i class="fa-solid fa-plus"></i> Thêm người dùng mới</button></a>
        </div>
        <?php if (isset($notification)) : ?>
            <div class="alert alert-success">
                <?= $notification ?>
            </div>
        <?php endif ?>
        <?php if (isset($_GET['msg'])) : ?>
            <div class="alert alert-success">
                <?= $_GET['msg'] ?>
            </div>
        <?php endif ?>
        <div class="contentManager--product__footer--table">
            <table border="1">
                <thead>
                    <tr>
                        <!-- <th><input type="checkbox"></th> -->
                        
                        <th>Mã khách hàng</th>
                        <th>Tên</th>
                        <th>Ảnh</th>
                        <th>Email</th>
                        <th>Điện thoại</th>
                        <th>Địa chỉ</th>
                        <th>Trạng thái</th>
                        <th>Vai trò</th>
                        <th>Ngày tạo</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listUser as $key => $value) : ?>
                        <?php
                        $imagePath = "./UserAvt/" . $value['image'];
                        if (is_file($imagePath)) {
                            $image = "<img src='" . $imagePath . "' alt='' width='120px' height='120px'>";
                        } else {
                            $image = "<h4 style='color: #ffffff' >Không có hình ảnh</h4>";
                        }
                        ?>
                        <tr>
                            <!-- <td><input type="checkbox"></td> -->
                            
                            <td>KH00<?= $value['id'] ?></td>
                            <td class="name"><?= $value['name'] ?></td>
                            <td class="image">
                                <?= $image ?>
                            </td>
                            <td class="category">
                                <?= $value['email'] ?>
                            </td>
                            <td class="quantity">
                                <?= $value['phone'] ?>
                            </td>
                            <td class="dateCreate">
                                <?= $value['address'] ?>
                            </td>

                            <td class="status">
                                <?php
                                if($value['status']==0){
                                        echo "<button class='status-isset'>Active</button>";
                                }else if($value['status']==1){
                                 echo "<button class='status-empty'>Inactive</button>";
                                }else if($value['status']==3){
                                    echo "<button class='status-empty direct'>Direct</button>";
                                   }
                                ?>
                            </td>
                            <td class="status user">
                            <?php
                                if($value['role']==0){
                                        echo "<button class='status-isset'>Người dùng</button>";
                                }else if($value['role']==1){
                                 echo "<button class='status-empty'>Quản trị</button>";
                                    }
                                    else if($value['role']==3){
                                        echo "<button class='status-empty direct'>Khách hàng trực tiếp</button>";
                                           }
                                ?>
                            </td>
                            <td class="dateCreate">
                                <?= $value['created_at'] ?>
                            </td>
                            <td class="btn-action">
                                <?php if($value['role'] != 3){ ?>
                                    <a href="index.php?actAdmin=editUser&id=<?= $value['id'] ?>">
                                        <i class="fa-solid fa-screwdriver"></i>
                                    </a>
                                <?php } ?>
                               
                               
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <ul>
                <?php 
                        $table = 'users';
                        $rows = count_rows($table);
                        $slpage = ceil($rows['rows']/5);
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
                            $next = 2;
                        }
                 ?>
                <li>
                    <a href="index.php?actAdmin=showUsers&&page=1"><i class="fa-sharp fa-solid fa-angles-left"></i></a>
                </li>
                <li>
                    <a href="index.php?actAdmin=showUsers&&page=<?= isset($prev) ? $prev : ''?>"><i class="fa-solid fa-angle-left"></i></a>
                </li>
                <?php
                        $table = 'users';
                        $rows = count_rows($table);
                        $slpage = ceil($rows['rows']/5);
                        for ($i=1; $i <= $slpage; $i++) {
                            if(isset($_GET['page']) && $i == $_GET['page']){
                                echo ' <li style="margin: 0 3px;">
                                <a style="background-color: #F39C12; color: #ffffff;" href="index.php?actAdmin=showUsers&&page='.$i.'">'.$i.'</a></li>';
                            }else if(!isset($_GET['page'])){
                                if($i ==1 ){
                                    echo ' <li style="margin: 0 3px;">
                                    <a style="background-color: #F39C12; color: #ffffff;" href="index.php?actAdmin=showUsers&&page='.$i.'">'.$i.'</a></li>';
                                }else{
                                echo '<li style="margin: 0 3px">
                                <a href="index.php?actAdmin=showUsers&&page='.$i.'">'.$i.'</a></li>';
                                }
                            }else{
                                echo '<li style="margin: 0 3px">
                                <a href="index.php?actAdmin=showUsers&&page='.$i.'">'.$i.'</a></li>';
                            }
                           
                        }
                ?>
              

                <li>
                    <a href="index.php?actAdmin=showUsers&&page=<?= isset($next) ? $next : ''?>"><i class="fa-solid fa-angle-right"></i></a>
                </li>
                <li>
                    <a href="index.php?actAdmin=showUsers&&page=<?=$slpage?>"><i class="fa-sharp fa-solid fa-angles-right"></i></a>
                </li>
            </ul>
        </div>
    </div>
</div>
</div>
<script src="../src/js/animation.js"></script>
</body>

</html>