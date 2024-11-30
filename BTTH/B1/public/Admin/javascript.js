function handleDelete(id) {
    var confirmation = confirm('Bạn có muốn xóa bông hoa này không?');
    
    if (confirmation) {
        window.location.href = 'http://localhost/TH1/B1/controller/deleteFlower.php?sid=' + id;
    } else {
        return false;
    }
}

function handleEdit(id){
    return window.location.href = 'http://localhost/TH1/B1/controller/editFlower.php?sid=' + id;
}