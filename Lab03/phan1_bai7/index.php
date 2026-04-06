<!DOCTYPE html>
<html lang="vi">
<head><meta charset="UTF-8"><title>Phần 1 - Bài 7</title>
<style>label{display:block;margin:6px 0}input,select,textarea{width:300px}</style>
</head>
<body>
<h1>Bài 7: Đăng ký thành viên</h1>
<?php
$errors = [];
$values = ['first_name'=>'','last_name'=>'','email'=>'','password'=>'','birthday'=>'','gender'=>'','country'=>'','about'=>''];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($values as $key => $val) {
        $values[$key] = trim($_POST[$key] ?? '');
    }
    if (strlen($values['first_name']) < 2 || strlen($values['first_name']) > 30) {
        $errors[] = 'First name phải từ 2-30 ký tự.';
    }
    if (strlen($values['last_name']) < 2 || strlen($values['last_name']) > 30) {
        $errors[] = 'Last name phải từ 2-30 ký tự.';
    }
    if (!filter_var($values['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Email không đúng định dạng.';
    }
    if (strlen($values['password']) < 2 || strlen($values['password']) > 30) {
        $errors[] = 'Password phải từ 2-30 ký tự.';
    }
    if (empty($values['birthday'])) {
        $errors[] = 'Birthday là bắt buộc.';
    }
    if (!in_array($values['gender'], ['Male','Female','Other'])) {
        $errors[] = 'Gender phải hợp lệ.';
    }
    if (!in_array($values['country'], ['Vietnam','Australia','United States','India','Other'])) {
        $errors[] = 'Country phải hợp lệ.';
    }
    if (strlen($values['about']) > 10000) {
        $errors[] = 'About không được quá 10000 ký tự.';
    }
    if (empty($errors)) {
        echo '<p style="color:green">Complete!</p>';
    }
}
if (!empty($errors)) {
    echo '<ul style="color:red">';
    foreach ($errors as $error) echo '<li>' . htmlspecialchars($error) . '</li>';
    echo '</ul>';
}
?>
<form method="post">
    <label>First name:<input type="text" name="first_name" value="<?=htmlspecialchars($values['first_name'])?>" required></label>
    <label>Last name:<input type="text" name="last_name" value="<?=htmlspecialchars($values['last_name'])?>" required></label>
    <label>Email:<input type="email" name="email" value="<?=htmlspecialchars($values['email'])?>" required></label>
    <label>Password:<input type="password" name="password" value="<?=htmlspecialchars($values['password'])?>" required></label>
    <label>Birthday:<input type="date" name="birthday" value="<?=htmlspecialchars($values['birthday'])?>" required></label>
    <label>Gender:
        <label><input type="radio" name="gender" value="Male" <?= $values['gender']=='Male' ? 'checked' : '' ?>> Male</label>
        <label><input type="radio" name="gender" value="Female" <?= $values['gender']=='Female' ? 'checked' : '' ?>> Female</label>
        <label><input type="radio" name="gender" value="Other" <?= $values['gender']=='Other' ? 'checked' : '' ?>> Other</label>
    </label>
    <label>Country:
        <select name="country">
            <option value="Vietnam" <?= $values['country']=='Vietnam' ? 'selected' : '' ?>>Vietnam</option>
            <option value="Australia" <?= $values['country']=='Australia' ? 'selected' : '' ?>>Australia</option>
            <option value="United States" <?= $values['country']=='United States' ? 'selected' : '' ?>>United States</option>
            <option value="India" <?= $values['country']=='India' ? 'selected' : '' ?>>India</option>
            <option value="Other" <?= $values['country']=='Other' ? 'selected' : '' ?>>Other</option>
        </select>
    </label>
    <label>About:<textarea name="about" rows="5"><?=htmlspecialchars($values['about'])?></textarea></label>
    <button type="submit">Submit</button>
    <button type="reset">Reset</button>
</form>
</body>
</html>
