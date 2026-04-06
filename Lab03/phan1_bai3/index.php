<!DOCTYPE html>
<html lang="vi">
<head><meta charset="UTF-8"><title>Phần 1 - Bài 3</title></head>
<body>
<h1>Bài 3: In số lẻ 0-100</h1>
<h2>Dùng vòng lặp for</h2>
<?php
for ($i = 1; $i <= 100; $i += 2) {
    echo $i . ' ';
}
?>
<h2>Dùng vòng lặp while</h2>
<?php
$i = 1;
while ($i <= 100) {
    echo $i . ' ';
    $i += 2;
}
?>
</body>
</html>
