<?php
    // echo "Đây là trang edit";
    require '../configs/database.php';

    $id = $_GET['sid'];
    // echo $id;
    $sql = "SELECT * FROM flowers WHERE id = :id";

    if($connection != null){
        try{
            $statement = $connection->prepare($sql);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->execute();
            $flowers = $statement->fetch(PDO::FETCH_ASSOC);
            // echo $flowers['name'];
            // echo $flowers['description'];
        }
        catch(PDOException $e){
            $e->getMessage();
        }
    }
    else{
        echo "Kết nối thất bại";
    }

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
    <h1>Chỉnh sửa hoa </h1>

    <div class="section">
        <div class="container">
            <form action="../controller/updateFlower.php" method="POST">
                <input type="hidden" name="sid" id="sid" value="<?php echo $flowers['id']?>">
                <div class="mb3">
                    <label for="name">Tên loài hoa</label>
                    <input name="name" id="name" type="text" class="form-control" value="<?php echo $flowers['name'] ?> ">
                </div>
                <div class="mb-3">
                    <label for="description">Mô tả loài hoa</label>
                    <textarea type="text" class="form-control" rows="4"  name="description" id="description"><?php echo $flowers['description']?></textarea>
                </div>
                <div class="mb-3">
                    <label for="image">Đường dẫn ảnh</label>
                    <input type="text" class="form-control" value=<?php echo $flowers['image']?> name="image" id="image">
                </div>
                <div class="mb-3">
                    <label for="action">Trạng thái</label>
                    <input name ="action"class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                </div>
                <button type="submit" class="btn btn-success">Cập nhật</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

</body>
</html>