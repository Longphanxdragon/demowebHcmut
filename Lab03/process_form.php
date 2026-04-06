<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    echo "GET Data:<br>";
    echo "Name: " . htmlspecialchars($_GET['name']) . "<br>";
    echo "Email: " . htmlspecialchars($_GET['email']) . "<br>";
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "POST Data:<br>";
    echo "Name: " . htmlspecialchars($_POST['name']) . "<br>";
    echo "Email: " . htmlspecialchars($_POST['email']) . "<br>";
}
?>