<?php
session_start();

//   $sv = [
//     0 => ['ma' => 'sv1', 'name' => 'NVA', 'email' => 'sv1@gmail.com', 'phone' => '09876543', 'address' => 'Hà Nội', 'image' => 'images/1.jpg'],
//     1 => ['ma' => 'sv2', 'name' => 'NVB', 'email' => 'sv1@gmail.com', 'phone' => '09876543', 'address' => 'Hà Nội', 'image' => 'images/2.jpg'],
//     2 => ['ma' => 'sv3', 'name' => 'NVC', 'email' => 'sv1@gmail.com', 'phone' => '09876543', 'address' => 'Hà Nội', 'image' => 'images/3.jpg'],
//     3 => ['ma' => 'sv4', 'name' => 'NVD', 'email' => 'sv1@gmail.com', 'phone' => '09876543', 'address' => 'Hà Nội', 'image' => 'images/4.jpg'],
//     4 => ['ma' => 'sv5', 'name' => 'NVE', 'email' => 'sv1@gmail.com', 'phone' => '09876543', 'address' => 'Hà Nội', 'image' => 'images/1.jpg'],
//     5 => ['ma' => 'sv6', 'name' => 'NVF', 'email' => 'sv1@gmail.com', 'phone' => '09876543', 'address' => 'Hà Nội', 'image' => 'images/1.jpg'],
//     6 => ['ma' => 'sv7', 'name' => 'NVG', 'email' => 'sv1@gmail.com', 'phone' => '09876543', 'address' => 'Hà Nội', 'image' => 'images/1.jpg'],
//     7 => ['ma' => 'sv8', 'name' => 'NVH', 'email' => 'sv1@gmail.com', 'phone' => '09876543', 'address' => 'Hà Nội', 'image' => 'images/1.jpg'],
//     8 => ['ma' => 'sv9', 'name' => 'NVG', 'email' => 'sv1@gmail.com', 'phone' => '09876543', 'address' => 'Hà Nội', 'image' => 'images/1.jpg'],
//     9 => ['ma' => 'sv10', 'name' => 'NVK', 'email' => 'sv1@gmail.com', 'phone' => '09876543', 'address' => 'Hà Nội', 'image' => 'images/1.jpg'],
// ];
// $_SESSION['arr_sinh_vien'] = $sv;
$arr_sinh_vien = [];
if(isset($_SESSION['arr_sinh_vien'])) $arr_sinh_vien = $_SESSION['arr_sinh_vien'];
//Kiểm tra tồn tại $_GET['action'] hay không
if(isset($_GET['action'])){
    $action = $_GET['action'];
    if($action == 'delete'){
        //Xử lý xóa
        $id_delete = $_GET['id'];
        if(isset($_SESSION['arr_sinh_vien'][$id_delete])) unset($_SESSION['arr_sinh_vien'][$id_delete]);
    }
}
//Xử lý tìm kiếm
$arr_search = null;
$keyword ='';
if(isset($_GET['search'])){
    $keyword = htmlspecialchars($_GET['keyword']);//Xử lý XSS
    foreach($_SESSION['arr_sinh_vien'] as $id=>$row){
        if(strpos($row['ma'], $keyword) !== false || strpos($row['name'], $keyword) !== false){
            $arr_search[] = $row;//Thêm phần tử tìm thấy vào cuối mảng tìm kiếm
        }
    }
}
?>
<!doctype html>
<head>
    <link href="style.css" rel="stylesheet" />
</head>
<body>
    <div class="container">
        <form method="get" action="">
            <input type="text" name="keyword" id="keyword" value="<?=$keyword?>">
            <button type="submit" name="search">Tìm kiếm</button>
        </form>
    </div>
    <div class="container">
        <a href="add_sv.php">Thêm SV</a>
        <table>
            <tr>
                <td>Id</td>
                <td>Mã</td>
                <td>Tên</td>
                <td>Email</td>
                <td>Phone</td>
                <td>Địa chỉ</td>
                <td>Ảnh</td>
                <td>Sửa</td>
                <td>Xóa</td>
            </tr>
            <?php   
            foreach($arr_search ?? $arr_sinh_vien as $id=>$row){
                if(is_array($row)){
                ?>
                    <tr>
                        <td><?=$id?></td>
                        <td><?=$row['ma']?></td>
                        <td><?=$row['name']?></td>
                        <td><?=$row['email']?></td>
                        <td><?=$row['phone']?></td>
                        <td><?=$row['address']?></td>
                        <td><img src="images/<?=$row['image']?>" width="100" /> </td>
                        <td><a href="edit_sv.php?id=<?=$id?>">Sửa</a></td>
                        <td><a href="?action=delete&id=<?=$id?>">Xóa</a></td>
                    </tr>
                <?php
                }
            }
            ?>
        </table>
</div>
</body>
</html>