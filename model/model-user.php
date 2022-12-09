<?php
function InsertUser($name, $email, $password, $phone, $address, $image, $role)
{
    $sql = "INSERT INTO `users`(`name`, `email`, `password`, `phone`, `address`, `image`, `role`) VALUES ('$name','$email','$password','$phone','$address','$image','$role')";
    return pdo_execute_return_lastInsertId($sql);
}
function InsertUser2($name, $email, $password, $phone, $address, $image, $status, $role)
{
    $sql = "INSERT INTO `users`(`name`, `email`, `password`, `phone`, `address`, `image`,`status`, `role`) VALUES ('$name','$email','$password','$phone','$address','$image','$status','$role')";
    return pdo_execute_return_lastInsertId($sql);
}
function CheckUser($email, $password)
{
    $sql = "SELECT * FROM users WHERE email='$email' AND `password`='$password';";
    $info =  pdo_query_one($sql);
    return $info;
}
function CheckEmail($email)
{
    $sql = "SELECT * FROM users WHERE email='$email'";
    $info =  pdo_query_one($sql);
    return $info;
}
function CheckEmail_Name($email,$name)
{
    $sql = "SELECT * FROM users WHERE email='$email' and name='$name'";
    $info =  pdo_query_one($sql);
    return $info;
}
function Reset_pass($pass,$email,$name)
{
    $sql = "UPDATE users SET `password`='$pass'  WHERE email='$email' and name='$name'";
    pdo_execute($sql);
}
function convert_vi_to_en($str)
{
    $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", "a", $str);
    $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", "e", $str);
    $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", "i", $str);
    $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", "o", $str);
    $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", "u", $str);
    $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", "y", $str);
    $str = preg_replace("/(đ)/", "d", $str);
    $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", "A", $str);
    $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", "E", $str);
    $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", "I", $str);
    $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", "O", $str);
    $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", "U", $str);
    $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", "Y", $str);
    $str = preg_replace("/(Đ)/", "D", $str);
    return $str;
}
function getAllUser()
{
    $sql = "SELECT * FROM users order by id desc ";
    return pdo_query($sql);
}
function UserDelete($id)
{
    $sql = "delete from Users where id='$id';";
    pdo_execute($sql);
}
function SearchUser($kyw)
{
    $sql = "SELECT * FROM users WHERE 1";
    if ($kyw != "") {
        $sql .= " and name like '%" . $kyw . "%'";
    }
    $sql .= " ORDER BY id DESC";
    $listUsers = pdo_query($sql);
    return $listUsers;
}
function getUserFollowId($id)
{
    $sql = "SELECT * FROM users WHERE id = '$id';";
    $info =  pdo_query_one($sql);
    return $info;
}
function UpdatetUser($name, $email, $password, $phone, $address, $image, $status, $role, $id)
{
    $sql = "UPDATE `users` SET `name`='$name', `email`='$email', `password`='$password', `phone`='$phone', `address`='$address', `image`='$image', `status`='$status', `role`='$role' WHERE `id`='$id';";
    pdo_execute($sql);
}
function UpdatetUserGuest($name, $email, $password, $phone, $address, $image, $status, $role, $ngaytao, $id)
{
    $sql = "UPDATE `users` SET `name`='$name', `email`='$email', `password`='$password', `phone`='$phone', `address`='$address', `image`='$image', `status`='$status', `role`='$role',`created_at`='$ngaytao' WHERE `id`='$id';";
    pdo_execute($sql);
}
function UpdatePasstUser($password, $id)
{
    $sql = "UPDATE `users` SET  `password`='$password' WHERE `id`='$id';";
    pdo_execute($sql);
}
// Select count users home
function getCountUserHome(){
    $sql = "select COUNT(*) as countUser from users WHERE role >=0 AND role <=1";
    return pdo_query_one($sql);
}   
// Select count users home

function getAllUser1()
{
    $sql = "SELECT * FROM users order by id desc limit 0,5";
    return pdo_query($sql);
}
function getAllUser2($page)
{
    $sql = "SELECT * FROM users order by id desc limit $page,5";
    return pdo_query($sql);
}
function count_rows($table){
    $sql = "SELECT COUNT(id) AS `rows` FROM $table";
    return pdo_query_one($sql);
}
function getPageLimit($page,$soPage,$table)
{
    $sql = "SELECT * FROM $table order by id desc limit $page,$soPage";
    return pdo_query($sql);
}
