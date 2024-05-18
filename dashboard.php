<?php
session_start();
// Include your database connection file
include 'db_conn.php';

// Check if the user is not logged in, then redirect to the login page
if (!isset($_SESSION['username'])) {
    header("Location: loginform.php");
    exit();
}

// Initialize variables with default values
$full_name = $email = $address = $gender = $contact_info = $date_of_birth = $education = $skills = $social_media = $note = "";
$profile_picture = "default_profile.jpg"; // Default profile picture

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AdminLTE Interface</title>
  <!-- AdminLTE CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <style>
    
  .profile-user-img {
    width: 150px;
    height: 150px;
  }

  </style>
</head>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <!-- Home Button -->
        <li class="nav-item d-none d-sm-inline-block">
          <a href="dashboard.php
          " class="nav-link">Home</a>
        </li>
      </ul>
      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-comments"></i>
            <span class="badge badge-danger navbar-badge">3</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Brad Diesel
                  </h3>
                  <p class="text-sm">Call me whenever you can...</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
          </div>
        </li>
      </ul>
    </nav>
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
      </a>
      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Profile Link -->
            <li class="nav-item">
              <a href="dashboard.php" class="nav-link" id="profile-btn">
                <i class="nav-icon fas fa-user"></i>
                <p>Profile</p>
              </a>
            </li>
            <!-- Sign Out Link -->
            <li class="nav-item">
              <a href="logout.php" class="nav-link" id="sign-out-btn">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>Sign Out</p>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </aside>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1><?php echo isset($full_name) ? $full_name : "User"; ?> Profile</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item active"><?php echo isset($full_name) ? $full_name : "User"; ?></li>
              </ol>
            </div>
          </div>
        </div>
      </section>
      <section class="content">
        <div class="container-fluid">
          <?php
          // Check for error messages (from both GET and session)
          if (isset($_GET['error'])) {
            $error_message = urldecode($_GET['error']);
            echo "<div class='alert alert-danger'>$error_message</div>";
          } elseif (isset($_SESSION['user_pass_error'])) {
            $error_message = $_SESSION['user_pass_error'];
            echo "<div class='alert alert-danger'>$error_message</div>";
            unset($_SESSION['user_pass_error']);  // Clear session error
          }
          // Check for success messages (from both GET and session)
          if (isset($_GET['success'])) {
            $success_message = urldecode($_GET['success']);
            echo "<div class='alert alert-success'>$success_message</div>";
          }
          ?>
          <div class="row">
            <div class="col-md-3">
              <!-- Profile Image -->
              <div class="card card-purple card-outline">
                <div class="card-body box-profile">
                  <div class="text-center">
                   <?php
                    // Check if the user has a profile picture
                    if (!empty($profile_picture)) {
                      echo '<img class="profile-user-img img-fluid img-circle" src="data:image/jpeg;base64,'.base64_encode($profile_picture) . '" alt="User profile picture">';
                    } else {
                      echo '<img class="profile-user-img img-fluid img-circle" src="img/avatar.png" alt="Blank profile picture">';
                    }
                    ?>
                  </div>
                  <h3 class="profile-username text-center"><?php echo $full_name; ?><span class="small">&nbsp;(<?php echo $username; ?>)</span></h3>
                  <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                      <b>Email</b> <a class="float-right"><?php echo $email; ?></a>
                    </li>
                    <li class="list-group-item">
                      <b>Address</b> <a class="float-right"><?php echo $address; ?></a>
                    </li>
                    <li class="list-group-item">
                      <b>Gender</b> <a class="float-right"><?php echo $gender; ?></a>
                    </li>
                    <li class="list-group-item">
                      <b>Contact Info</b> <a class="float-right"><?php echo $contact_info; ?></a>
                    </li>
                  </ul>
                </div>
              </div>
              <!-- About Me Box -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">About Me</h3>
                </div>
                <div class="card-body">
                  <strong><i class="fas fa-birthday-cake mr-1"></i> Birthday</strong>
                  <p class="text-muted"><?php echo $date_of_birth; ?></p>
                  <hr>
                  <strong><i class="fas fa-book mr-1"></i> Education</strong>
                  <p class="text-muted"><?php echo $education; ?></p>
                  <hr>
                  <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>
                  <p class="text-muted">
                    <?php echo "<span class='tag tag-primary'>$skills</span>"; ?>
                  </p>
                  <hr>
                  <strong><i class="fas fa-globe mr-1"></i> Social Media</strong>
                  <p class="text-muted">
                    <?php echo "$social_media<br>"; ?>
                  </p>
                  <hr>
                  <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>
                  <p class="text-muted"><?php echo $note; ?></p>
                </div>
              </div>
            </div>
            <div class="col-md-9">
              <div class="card">
                <div class="card-header p-2">
                  <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#update_Profile" data-toggle="tab">Update Profile</a></li>
                    <li class="nav-item"><a class="nav-link" href="#Change_Password" data-toggle="tab">Change Password</a></li>
                  </ul>
                </div>
                <div class="card-body">
                  <div class="tab-content">
                    <!-- Update Profile -->
                    <div class="tab-pane active" id="update_Profile">
                      <form action="indexdash.php" method="post" enctype="multipart/form-data">
                      <div class="form-group row">
                            <label for="full_name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Name" value="<?= $full_name; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                          <label for="username" class="col-sm-2 col-form-label">Username</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>" placeholder="Username" required>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="email" class="col-sm-2 col-form-label">Email</label>
                          <div class="col-sm-10">
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" placeholder="Email" required>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="date_of_birth" class="col-sm-2 col-form-label">Birthday</label>
                          <div class="col-sm-10">
                            <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="<?php echo $date_of_birth; ?>" required>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="gender" class="col-sm-2 col-form-label">Gender</label>
                          <div class="col-sm-10">
                            <select class="form-control" id="gender" name="gender" required>
                              <option value="Male" <?php if($gender == 'Male') echo 'selected'; ?>>Male</option>
                              <option value="Female" <?php if($gender == 'Female') echo 'selected'; ?>>Female</option>
                              <option value="Other" <?php if($gender == 'Other') echo 'selected'; ?>>Other</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="contact_info" class="col-sm-2 col-form-label">Contact Info</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="contact_info" name="contact_info" value="<?php echo $contact_info; ?>" placeholder="Contact Info" required>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="profile_picture" class="col-sm-2 col-form-label">Profile Picture</label>
                          <div class="col-sm-10">
                            <input type="file" class="form-control" id="profile_picture" name="profile_picture" accept="image/*">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="address" class="col-sm-2 col-form-label">Address</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="address" name="address" value="<?php echo $address; ?>" placeholder="Address" required>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="education" class="col-sm-2 col-form-label">Education</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="education" name="education" value="<?php echo $education; ?>" placeholder="Education" required>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="skills" class="col-sm-2 col-form-label">Skills</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="skills" name="skills" value="<?php echo $skills; ?>" placeholder="Skills" required>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="social_media" class="col-sm-2 col-form-label">Social Media</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="social_media" name="social_media" value="<?php echo $social_media; ?>" placeholder="Social Media" required>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="note" class="col-sm-2 col-form-label">Notes</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="note" name="note" value="<?php echo $note; ?>" placeholder="Notes">
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="offset-sm-2 col-sm-10">
                            <button type="submit" name="submit" class="btn btn-danger">Submit</button>
                          </div>
                        </div>
                      </form>
                    </div>
                    <!-- Change Password -->
                    <div class="tab-pane" id="Change_Password">
                        <form action="#Change_password" method="post" class="form-horizontal">
                            <div class="card">
                                <div class="card-header bg-primary text-white">Update Password</div>
                                <div class="card-body">
                                    <?php if (isset($message)) : ?>
                                        <div class="alert alert-<?php echo $message_type; ?>" role="alert">
                                            <?php echo $message; ?>
                                        </div>
                                    <?php endif; ?>

                                    <div class="form-group row">
                                        <label for="current_password" class="col-sm-2 col-form-label">Current Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Current Password" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="new_password" class="col-sm-2 col-form-label">New Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="new_password" name="new_password" placeholder="New Password" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="confirm_password" class="col-sm-2 col-form-label">Confirm Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button type="submit" name="submit" class="btn btn-danger">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
    <footer class="main-footer">
      <strong>&copy; 2024 <a href="https://facebook.com/bolantoyyyy">Kim Andrie Mancera</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.1.0
      </div>
    </footer>
  </div>
  <!-- jQuery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/js/adminlte.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#profile-btn').on('click', function() {
        $('.edit-profile-form').toggle();
      });
    });
  </script>
</body>
</html>