<?php
    // Số lượng đơn mua theo ngày
    function buyProductWithDay(){
        $sql = "SELECT ors.*, COUNT(ors.id_kh) as kh_mua FROM (SELECT  kh.id id_kh , od.id id_don_hang, kh.name ,od.created_at, od.total_price
        FROM orders od JOIN users kh on od.user_id=kh.id
        WHERE  DATE_FORMAT(od.created_at, '%d/%m/%Y') LIKE (SELECT DATE_FORMAT(CURRENT_TIMESTAMP, '%d/%m/%Y')) ) ors
        GROUP BY id_kh
        ORDER  BY kh_mua DESC
        ";
        return pdo_query($sql);
    };
    function totalMonneyWithYearMonth(){
        $sql = "select year(created_at),month(created_at),sum(total_price) from orders group by year(created_at),month(created_at) order by year(created_at),month(created_at)
        ";
        return pdo_query_one($sql);
    };
    // Sản phẩm bán chạy nhất
    function getProductBestSalePrintAdmin(){
        $sql = "select SUM(quantity) as quantityBestSale ,product_id FROM orders_detail GROUP BY product_id ORDER BY SUM(quantity) DESC LIMIT 0,1";
       return pdo_query_one($sql);
    }
    function bestProductSales(){
        $productSale = getProductBestSalePrintAdmin();
        $id =  $productSale['product_id'];
        $sql = "select COUNT(B.product_id) as 'quantity', A.id, A.name, A.discount, A.price, A.avatar 
        FROM `products` A INNER JOIN `orders_detail` B ON A.id = B.product_id 
        WHERE B.product_id=$id
        GROUP BY B.product_id 
        ORDER BY COUNT(B.product_id) DESC LIMIT 0,1 ";
        return pdo_query_one($sql);
    }
    // Số lượng đơn theo tuần
    function totalOrderWithWeek(){
        $sql = "SELECT ors.*, COUNT(ors.id_kh) as kh_mua FROM (SELECT kh.id id_kh , od.id id_don_hang, kh.name ,od.created_at, od.total_price FROM orders od JOIN users kh on od.user_id=kh.id WHERE od.created_at >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)) ors GROUP BY id_kh ORDER BY kh_mua DESC;";
        return pdo_query($sql);
    }
    // Tổng doanh thu theo năm tháng hiện tại
    function sumMoneyMonthCurrently(){
        $sql = "select year(CURRENT_TIMESTAMP) total_flow_year,month(CURRENT_TIMESTAMP) total_flow_month,sum(total_price) from orders where status=6 group by year(created_at),month(created_at) order by year(created_at),month(created_at);";
        return pdo_query_one($sql);
    }
    function getToTalProductChartJs(){
        $sql = "select name, total_product FROM categories";
        return pdo_query($sql);
    }
    //<?= number_format($value['total_price']) . "đ" 
    function getTotalMoneyToShop(){
        $sql = "SELECT SUM(total_price) as money FROM `orders` WHERE status=6";
        return pdo_query_one($sql);
    }
    function getListMoneyOrderAdminPage($dayStart,$dayEnd){
        $sql = "SELECT A.`id`, A.`user_id`, A.`total_price`,A.`address`, A.`created_at`,B.`name` FROM `orders` A LEFT JOIN `users` B ON A.user_id=B.id WHERE A.status = 6";
        if($dayStart != "" && $dayEnd != ""){
            $sql .= " AND A.created_at >= '$dayStart' and A.created_at <= '$dayEnd' ";
        }else if($dayStart != "" && $dayEnd == ""){
            $sql .= " AND A.created_at >= '$dayStart'";
        }else if($dayStart == "" && $dayEnd != ""){
            $sql .= " AND A.created_at <= '$dayEnd'";
        }else{
            $sql .= " order by A.id desc";
        }
        $numberPage = pdo_query($sql);
        $countPage = sizeof($numberPage) / 8;
        return $countPage;
    }
    function getListMoneyOrderAdmin($dayStart,$dayEnd){
        $countPage = getListMoneyOrderAdminPage($dayStart,$dayEnd);
        if (isset($_GET['page']) &&  $_GET['page'] > 0 && $_GET['page'] <= $countPage + 1) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }
        $from = ($page - 1) * 8;

        $sql = "SELECT A.`id`, A.`user_id`, A.`total_price`,A.`address`, A.`created_at`,B.`name` FROM `orders` A LEFT JOIN `users` B ON A.user_id=B.id WHERE A.status = 6";
        if($dayStart != "" && $dayEnd != ""){
            $sql .= " AND A.created_at >= '$dayStart' and A.created_at <= '$dayEnd' limit $from,8";
        }else if($dayStart != "" && $dayEnd == ""){
            $sql .= " AND A.created_at >= '$dayStart' limit $from,8";
        }else if($dayStart == "" && $dayEnd != ""){
            $sql .= " AND A.created_at <= '$dayEnd' limit $from,8";
        }else{
            $sql .= " order by A.id desc limit $from,8";
        }
        return pdo_query($sql);
    }
