<?php
    require_once '../configs/database.php';

    $sql = "SELECT id, name, description, image, active  FROM flowers";

    if($connection != null){
        try{
            $statement = $connection->prepare($sql);
            $statement->execute();
            $result = $statement->setFetchMode(PDO::FETCH_ASSOC);
            $flowers = $statement->fetchAll();
            // foreach($flowers as $flower){
            //     echo $flower['image'];
            // }
        }catch (PDOException $e) {
            echo "Cannot query data. Error: " . $e->getMessage();
        }
    }
?>