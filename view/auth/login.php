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
        body {
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
            background: url('https://cdn.pixabay.com/photo/2022/08/14/01/35/leaves-7384743_1280.jpg') no-repeat center/cover;
        }

        .glass {
            width: 400px;
            padding: 30px;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            color: #fff;
        }

        .glass h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        input {
            width: 94%;
            padding: 12px;
            margin: 8px 0;
            border-radius: 10px;
            border: none;
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
            background-color: #fff;
            outline: none;
        }

        button {
            width: 100%;
            padding: 12px;
            margin-top: 15px;
            border: 1px solid black;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.3);
            color: black;
            font-weight: bold;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background: white;
        }

        .register-link {
            margin-top: 15px;
            text-align: center;
        }

        .register-link a,
        p {
            color: black;
            ;
        }



        .srdi-logo {
            width: 100px;
            border-radius: 50%;
        }

        .title-page {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h2 {
            font-weight: bolder;
            color: black;
            letter-spacing: 1px;
        }

        label {
            font-size: 14px;
            letter-spacing: 1px;
            margin-left: 10px;
            color: black;

        }

        input:focus {
            background-color: #fff;
            border: 3px solid green !important;
            color: black;
        }

        h3 {
            letter-spacing: 2px;
            background-color: #fff;
            color: black;
            font-weight: bolder;
            padding: 5px;
            border-radius: 10px;
        }
    </style>
</head>

<body>

    <div class="glass">
        <div class="title-page">

            <img src="https://www.dmmmsu.edu.ph/wp-content/uploads/2019/06/SRDI-Logo.jpg" class="srdi-logo" alt="">
            <h3>DMMMSU SRDI</h1>
                <h2>LOG IN</h2>

        </div>

        <form method="POST">
            <label for="">Email</label>
            <input type="email" name="email" placeholder="Email Address" value="<?= htmlspecialchars($email) ?>">
            <label for="">Password</label>
            <input type="password" name="password" placeholder="Password">
            <button type="submit" name="submit">Log in</button>
        </form>
        <div class="register-link">
            <p>Don't have an account? <a href="register.php">Register Here</a></p>
        </div>
    </div>

    <?php if (!empty($message)): ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops!',
                html: `<?= implode('<br>', $message); ?>`
            });
        </script>
    <?php endif; ?>
</body>

</html>