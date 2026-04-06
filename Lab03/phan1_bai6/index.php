<!DOCTYPE html>
<html lang="vi">
<head><meta charset="UTF-8"><title>Phần 1 - Bài 6</title></head>
<body>
<h1>Bài 6: Máy tính cơ bản</h1>
<form method="post">
    Số a: <input type="number" step="any" name="a" required><br>
    Số b: <input type="number" step="any" name="b"><br>
    Phép tính:
    <select name="op">
        <option value="+">Cộng</option>
        <option value="-">Trừ</option>
        <option value="*">Nhân</option>
        <option value="/">Chia</option>
        <option value="pow">Lũy thừa</option>
        <option value="inv">Nghịch đảo a</option>
    </select><br>
    <button type="submit">Tính</button>
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $a = floatval($_POST['a']);
    $b = floatval($_POST['b']);
    $op = $_POST['op'];
    switch ($op) {
        case '+': $result = $a + $b; break;
        case '-': $result = $a - $b; break;
        case '*': $result = $a * $b; break;
        case '/': $result = $b == 0 ? 'Không thể chia cho 0' : $a / $b; break;
        case 'pow': $result = pow($a, $b); break;
        case 'inv': $result = $a == 0 ? 'Không tồn tại' : 1 / $a; break;
        default: $result = 'Phép tính không hợp lệ';
    }
    echo '<p>Kết quả: ' . htmlspecialchars((string)$result) . '</p>';
}
?>
</body>
</html>
