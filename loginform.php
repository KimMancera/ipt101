<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 500px;
            margin-top: 100px;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                
                <?php if (isset($_GET['error'])) { ?>
                    <p class="error text-center"><?php echo $_GET['error']; ?></p>
                <?php } ?>
                <form  class="shadow-lg p-3 mb-5 bg-white rounded" action="index.php" method="POST">
					<h2 class="text-center">LOGIN</h2>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username:</label>
                        <input type="text" name="username" class="form-control" placeholder="username">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" name="password" class="form-control" placeholder="password">
                    </div>
                    <button type="submit" class="btn btn-primary">submit</button>
                </form>
                <div class="text-center mt-3">
                    <a href="registrationform.php">Click to register</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>