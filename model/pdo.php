<!-- Chứa các câu lệnh kết nối và làm việc với datatbase -->

<!-- Nhớ đặt tên file theo tiếng anh VD: model-product ( Tức là file này là model cho sản phẩm ) -->

<?php
    // Function connection data with database
    function pdo_get_connection(){
        $severName = "localhost";
        $conn = new PDO("mysql: host=$severName;dbname=da1","root","");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    }
    /**
    * @param string $sql câu lệnh sql
    * @param array $args mảng giá trị cung cấp cho các tham số của $sql
    * @throws PDOException Lỗi thực thi câu lệnh
    */
    // The function performs the functions of adding, editing, and deleting
    function pdo_execute($sql){
        $sql_args = array_slice(func_get_args(), 1);
        try{
            $conn = pdo_get_connection();
            $stmt = $conn->prepare($sql);
            $stmt->execute($sql_args);
        }catch(PDOException $e){
            throw $e;
        }
        finally{
            unset($conn);
        }
    }
    // The function return lastInsertId
    function pdo_execute_return_lastInsertId($sql){
        $sql_args = array_slice(func_get_args(), 1);
        try{
            $conn = pdo_get_connection();
            $stmt = $conn->prepare($sql);
            $stmt->execute($sql_args);
            return $conn->lastInsertId();
        }catch(PDOException $e){
            throw $e;
        }
        finally{
            unset($conn);
        }
    }
     /**
    * @param string $sql câu lệnh sql
    * @param array $args mảng giá trị cung cấp cho các tham số của $sql
    * @return array mảng các bản ghi
    * @throws PDOException Lỗi thực thi câu lệnh
    */
    // Function to get all data
    function pdo_query($sql){
        $sql_args = array_slice(func_get_args(), 1);
        try{
            $conn = pdo_get_connection();
            $stmt = $conn->prepare($sql);
            $stmt->execute($sql_args);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $rows;
        }catch(PDOException $e){
            throw $e;
        }finally{
            unset($conn);
        }
    }
    /**
    * @param string $sql câu lệnh sql
    * @param array $args mảng giá trị cung cấp cho các tham số của $sql
    * @return array mảng các bản ghi
    * @throws PDOException Lỗi thực thi câu lệnh
    */
    // The function takes 1 data
    function pdo_query_one($sql){
        $sql_args = array_slice(func_get_args(), 1);
        try{
            $conn = pdo_get_connection();
            $stmt = $conn->prepare($sql);
            $stmt->execute($sql_args);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row;
        }catch(PDOException $e){
            throw $e;
        }finally{
            unset($conn);
        }
    }
    /**
    * @param string $sql câu lệnh sql
    * @param array $args mảng giá trị cung cấp cho các tham số của $sql
    * @return array giá trị
    * @throws PDOException Lỗi thực thi câu lệnh
    */
    // The function takes one value
    function pdo_query_value($sql){
        $sql_agrs = array_slice(func_get_args(), 1);
        try{
            $conn = pdo_get_connection();
            $stmt = $conn->prepare($sql);
            $stmt->execute($sql_agrs);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return array_values($row)[0];
        }catch(PDOException $e){
            throw $e;
        }
        finally{
            unset($conn);
        }
    }
?>