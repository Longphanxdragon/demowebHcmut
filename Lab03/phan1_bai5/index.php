<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Phần 1 - Bài 5</title>
    <style>body{font-family:Arial}table{border-collapse:collapse;width:100%}td,th{border:1px solid #ccc;padding:8px}form{margin-bottom:16px}</style>
</head>
<body>
<h1>Bài 5: Quản lý công việc</h1>
<?php
$file = 'tasks.txt';
if (!file_exists($file)) file_put_contents($file, '');
$tasks = array_filter(explode("\n", file_get_contents($file)), 'strlen');
$search = trim($_GET['search'] ?? '');
$page = max(1, intval($_GET['page'] ?? 1));
$perPage = 10;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty(trim($_POST['new_task']))) {
    $newTask = htmlspecialchars(trim($_POST['new_task']));
    $tasks[] = $newTask;
    file_put_contents($file, implode("\n", $tasks));
    header('Location: ?');
    exit;
}
if (isset($_GET['action']) && $_GET['action'] === 'delete' && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);
    if (isset($tasks[$id])) {
        array_splice($tasks, $id, 1);
        file_put_contents($file, implode("\n", $tasks));
        header('Location: ?');
        exit;
    }
}
$filtered = $search === '' ? $tasks : array_values(array_filter($tasks, function($task) use ($search) {
    return stripos($task, $search) !== false;
}));
$total = count($filtered);
$pages = max(1, ceil($total / $perPage));
$start = ($page - 1) * $perPage;
$current = array_slice($filtered, $start, $perPage);
?>
<form method="get">
    Tìm kiếm: <input type="text" name="search" value="<?=htmlspecialchars($search)?>">
    <button type="submit">Tìm</button>
</form>
<form method="post">
    Thêm công việc: <input type="text" name="new_task" style="width:300px" required>
    <button type="submit">Thêm</button>
</form>
<table>
    <tr><th>#</th><th>Công việc</th><th>Hành động</th></tr>
    <?php foreach ($current as $index => $task): ?>
        <tr>
            <td><?= $start + $index + 1 ?></td>
            <td><?= htmlspecialchars($task) ?></td>
            <td><a href="?action=delete&id=<?= $start + $index ?>" onclick="return confirm('Xóa công việc?')">Xóa</a></td>
        </tr>
    <?php endforeach; ?>
</table>
<p>Trang: 
<?php for ($i = 1; $i <= $pages; $i++): ?>
    <a href="?page=<?=$i?>&search=<?=urlencode($search)?>"><?=$i?></a>
<?php endfor; ?>
</p>
</body>
</html>
