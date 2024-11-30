<?php
    require "../configs/database.php";

    echo $_GET['sid'];

    if(!$connection){
        die("Kết nối cơ sở dữ liệu thất bại");
    }


    $id = $_GET['sid'];

    $sql = "DELETE FROM flowers WHERE id = :id";
    try{
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        // echo "Hoa đã xóa thành công";
    }
    catch(PDOException $e){
        $e.getMessage();
    }
    header("Location: ../src/admin.php");

?>