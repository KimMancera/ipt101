<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="Stylesheet" type="text/css" href="Stylesheets.css"> 
</head>

<body>
    <form id="loginForm" action="index.php" method="POST">
        <h2 style="color:white">LOGIN</h2>
        <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p> <?php } ?>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" placeholder="username">

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" placeholder="password"><br>
        
        <button type="submit">submit</button><br><br>

        <div>
            <a href="registrationform.php">Click to register</a>
        </div>
    </form>

    <script>
        // Retrieve username from local storage if exists
        document.addEventListener("DOMContentLoaded", function() {
            const username = localStorage.getItem("username");
            if (username) {
                document.getElementById("username").value = username;
            }
        });

        // Store username in local storage when the form is submitted
        document.getElementById("loginForm").addEventListener("submit", function(event) {
            const username = document.getElementById("username").value;
            localStorage.setItem("username", username);
        });
    </script>
</body>
</html>
