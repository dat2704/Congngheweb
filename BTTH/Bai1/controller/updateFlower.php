<?php
    $id = $_POST['sid'];
    $name = $_POST['name'];
    $desc = $_POST['description'];
    $image = $_POST['image'];

    require '../configs/database.php';

    $sql = "UPDATE flowers SET name=:name, description=:description, image=:image WHERE id=:id";

    if($connection != null){
        try{
            $statement = $connection->prepare($sql);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->bindParam(':name', $name);
            $statement->bindParam(':description', $desc);
            $statement->bindParam(':image', $image);
            $statement->execute();
            header("Location: ../src/admin.php");

        }
        catch(PDOException $e){
            $e->getMessage();
        }
    }
?>