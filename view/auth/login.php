<?php
session_start();
require_once "../../controller/Main.php";

$db = new db();
$message = [];
$email = $password = "";

if (isset($_POST['submit'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (!$email || !$password) {
        $message[] = "Please enter both email and password.";
    } else {
        $user = $db->checkUsers($email, $password);

        if (is_array($user) && !isset($user['error'])) {
            // Login success: set session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['fullname'] = trim($user['firstname'] . ' ' . $user['lastname']);
            $_SESSION['user_role'] = $user['role_name'] ?? 'Unknown';
            $_SESSION['type_id'] = $user['type_id'] ?? 0;

            $_SESSION['message'] = "Welcome, {$_SESSION['fullname']} ({$_SESSION['user_role']})!";
            $_SESSION['message_type'] = 'success';

            header("Location: ../../view/employee/dashboard.php");
            exit;

        } else {
            $message[] = $user['message'] ?? 'Login failed.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {margin:0; height:100vh; display:flex; justify-content:center; align-items:center; font-family:Arial,sans-serif; background:url('https://images.unsplash.com/photo-1503264116251-35a269479413?auto=format&fit=crop&w=1350&q=80') no-repeat center/cover;}
        .glass {width:400px; padding:30px; border-radius:20px; background:rgba(255,255,255,0.12); backdrop-filter:blur(15px); border:1px solid rgba(255,255,255,0.3); box-shadow:0 8px 32px rgba(0,0,0,0.3); color:#fff;}
        .glass h2 {text-align:center; margin-bottom:20px;}
        input {width:100%; padding:12px; margin:8px 0; border-radius:10px; border:none; background:rgba(255,255,255,0.2); color:#fff;}
        button {width:100%; padding:12px; margin-top:15px; border:none; border-radius:10px; background:rgba(255,255,255,0.3); color:#fff; font-weight:bold; cursor:pointer; font-size:16px;}
        button:hover {background:rgba(255,255,255,0.5);}
        .register-link {margin-top:15px; text-align:center;}
        .register-link a {color:#fff; text-decoration:underline;}
    </style>
</head>
<body>

<div class="glass">
    <h2>Login</h2>
    <form method="POST">
        <input type="email" name="email" placeholder="Email Address" value="<?= htmlspecialchars($email) ?>">
        <input type="password" name="password" placeholder="Password">
        <button type="submit" name="submit">Login</button>
    </form>
    <div class="register-link">
        <p>Don't have an account? <a href="register.php">Register Here</a></p>
    </div>
</div>

<?php if (!empty($message)): ?>
<script>
Swal.fire({icon:'error', title:'Oops!', html:`<?= implode('<br>', $message); ?>`});
</script>
<?php endif; ?>
</body>
</html>
