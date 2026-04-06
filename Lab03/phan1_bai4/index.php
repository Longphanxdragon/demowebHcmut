<!DOCTYPE html>
<html lang="vi">
<head><meta charset="UTF-8"><title>Phần 1 - Bài 4</title></head>
<body>
<h1>Bài 4: Bảng số</h1>
<table border="1" cellspacing="0" cellpadding="5">
<?php
$values = [1,2,3,4,5,6,7,24,68,10,12,14,36,91,21,51,82,14,81,21,62,02,42,85,10,15,20,25,30,35,61,21,82,43,03,64,27,14,21,28,35,42,49];
$cols = 7;
for ($row = 0; $row < ceil(count($values)/$cols); $row++) {
    echo '<tr>';
    for ($col = 0; $col < $cols; $col++) {
        $index = $row * $cols + $col;
        if (isset($values[$index])) {
            echo '<td>' . $values[$index] . '</td>';
        } else {
            echo '<td>&nbsp;</td>';
        }
    }
    echo '</tr>';
}
?>
</table>
</body>
</html>
