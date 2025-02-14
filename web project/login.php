<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["toggle_password"])) {
    $_SESSION["show_password"] = !isset($_SESSION["show_password"]) ? true : !$_SESSION["show_password"];
}

$passwordType = isset($_SESSION["show_password"]) && $_SESSION["show_password"] ? "text" : "password";
?>

<form method="post">
    <input type="text" id="username" name="username" placeholder="Username" required>
    <input type="<?= $passwordType ?>" id="password" name="password" placeholder="Password" required>
    <button type="submit" name="toggle_password">
        <?= isset($_SESSION["show_password"]) && $_SESSION["show_password"] ? "Hide" : "Show" ?> Password
    </button>
    <button type="submit">Login</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST["toggle_password"])) {
   
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        echo "<script>alert('Please enter both username and password.'); window.location.href='index.html';</script>";
        exit;
    }

    $valid_username = "admin";
    $valid_password = "password123";
 
    if ($username === $valid_username && $password === $valid_password) {
        $_SESSION["user"] = $username; 
        header("Location: homepage.html"); 
        exit();
    } else {
        
        header("Location: login.html?error=invalid_credentials");
        exit();
    }
}
?>
