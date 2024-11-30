<?php
    require '../controller/getAllFlower.php';

?>
    
    <?php include "../components/Admin/header.php"?>
    <div style="display: flex; justify-content: space-around;">
        <h1 class="title_header">Danh sách các loài hoa</h1>
        <form action="index.php" method="get" style="text-align: center; align-content: center;">
            <button type="submit" style="height: 40px; align-self: center;">Xem danh sách</button>
        </form>
    </div>
    <div class="flower_manager" id="flowerList">
        
        <div class="container">
            <!-- Button trigger modal -->
            <button id="addFlowerBtn" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Thêm +
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm mới loài hoa</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="../controller/createFlower.php" method="POST">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Tên loài hoa</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên loài hoa" required>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Mô tả loài hoa</label>
                                    <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="image" class="form-label">Hình ảnh</label>
                                    <input class="form-control" id="image" name="image" placeholder="Nhập đường link ảnh " required></input>
                                </div>
                                <button class="btn btn-success" type="submit">Thêm</button>
                            </form>
                        </div>
   
                    </div>
                </div>
            </div>
            <table >
                <thead>
                    <tr>
                        <th scope="col">Tên loài hoa</th>
                        <th scope="col">Mô tả</th>
                        <th scope="col">Ảnh</th>
                        <th scope="col">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($flowers as $flower) : ?>
                        <tr>
                            <td><p class="flower_manager_title"><?php echo $flower['name']?></p></td>
                            <td><p class="flower_manager_desc"><?php echo $flower['description']?></p></td>
                            <td>
                                <?php if(substr($flower['image'], 0, 6) == "images"): ?>
                                    <img src="../<?php echo $flower['image']?>" alt="<?php echo $flower['name']?>">
                                <?php else: ?>
                                    <img src="<?php echo $flower['image']?>" alt="<?php echo $flower['name']?>">
                                <?php endif;?>
                            </td>
                            <td>
                                <a onclick="handleDelete(<?php echo $flower['id']; ?>)" href="javascript:void(0);" >
                                    <button class="btn btn-danger" type="submit">Xóa</button>
                                </a>
                                <a onclick="handleEdit(<?php echo $flower['id']?>)" href="javascript:void(0);">
                                    <button class="btn btn-warning">Sửa</button>
                                </a>
                            </td>
                        </tr>
                    
                </tbody>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
    <?php include '../components/Admin/footer.php'?>