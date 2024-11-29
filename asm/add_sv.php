<?php
session_start();
//Xử lý thêm sv
if(isset($_POST['action'])){
    $action = $_POST['action'];
    if($action == 'add'){
        $ma = htmlspecialchars($_POST['ma']);
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $phone = htmlspecialchars($_POST['phone']);
        $address = htmlspecialchars($_POST['address']);
        $image = 'no-avatar.jpg';
        //Xử lý upload
        $file = $_FILES['image'];
        // echo '<pre>';
        // print_r($file);die();
        //Kiểm tra người dùng có upload file hay không
        if($file['name'] != ''){
            //Kiểm tra file có phải là hình ảnh hay không
            if(getimagesize($file['tmp_name'])){
                $path = 'images/';
                $new_image_name = time().$file['name'];//Tạo 1 tên mới cho hình ảnh để khỏi trùng tên với ảnh cũ
                move_uploaded_file($file['tmp_name'], $path. $new_image_name);//Xử lý upload
                $image = $new_image_name;
            }
        }
        //Tạo ra 1 mảng sv mới
        $sv_new = [
            'ma' => $ma, 
            'name' => $name, 
            'email' => $email, 
            'phone' => $phone, 
            'address' => $address, 
            'image' => $image
        ];
        if(isset($_SESSION['arr_sinh_vien']))
            $id_new = count($_SESSION['arr_sinh_vien']);//Đếm xem có bao nhiêu phần tử, lấy số này làm id_new luôn
        else $id_new = 0;
        $_SESSION['arr_sinh_vien'][$id_new] = $sv_new;
        // array_push($sv, $sv_new);//Cách 1 để thêm phần tử mới vào cuối mảng 2 chiều
        // $sv[] = $sv_new;// Cách 2 để thêm phần tử mới vào cuối mảng 2 chiều
        header("Location: index.php");
    }
}
?>
<!doctype html>
<head>
    <link href="style.css" rel="stylesheet" />
</head>
<body>
<h1>Thêm sinh viên</h1>
<form method="post" action="" enctype="multipart/form-data">
    <table>
        <tr>
            <td>Mã</td>
            <td><input type="text" name="ma" required></td>
        </tr>
        <tr>
            <td>Tên</td>
            <td><input type="text" name="name" required></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><input type="email" name="email" required></td>
        </tr>
        <tr>
            <td>SĐT</td>
            <td><input type="text" name="phone" required></td>
        </tr>
        <tr>
            <td>Địa chỉ</td>
            <td><input type="text" name="address" required></td>
        </tr>
        <tr>
            <td>Image</td>
            <td><input type="file" name="image"></td>
        </tr>
    </table>
    <button type="submit" name="action" value="add">Lưu</button>
</form>
</body>
</html>