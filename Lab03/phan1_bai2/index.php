<!DOCTYPE html>
<html lang="vi">
<head><meta charset="UTF-8"><title>Phần 1 - Bài 2</title></head>
<body>
<h1>Bài 2: Switch theo phần dư mod 5</h1>
<form method="post">
    Nhập số nguyên dương: <input type="number" name="value" min="0" required>
    <button type="submit">Gửi</button>
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $n = intval($_POST['value']);
    $r = $n % 5;
    switch ($r) {
        case 0: echo "Hello"; break;
        case 1: echo "How are you?"; break;
        case 2: echo "I'm doing well, thank you"; break;
        case 3: echo "See you later"; break;
        case 4: echo "Good-bye"; break;
    }
}
?>
</body>
</html>
