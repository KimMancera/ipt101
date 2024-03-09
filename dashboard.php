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
    .edit-profile-form {
      display: none;
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
          <a href="#" class="nav-link">Home</a>
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
              <a href="#" class="nav-link" id="profile-btn">
                <i class="nav-icon fas fa-user"></i>
                <p>
                  Profile
                </p>
              </a>
            </li>
            <!-- Sign Out Link -->
            <li class="nav-item">
              <a href="#" class="nav-link" id="sign-out-btn">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>
                  Sign Out
                </p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Edit Profile Form -->
          <div class="row justify-content-center">
            <div class="col-md-8 edit-profile-form">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Edit Profile</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form">
                  <div class="card-body">
                    <div class="form-group">
                      <label for="firstName">First Name</label>
                      <input type="text" class="form-control" id="firstName" placeholder="Enter first name">
                    </div>
                    <div class="form-group">
                      <label for="lastName">Last Name</label>
                      <input type="text" class="form-control" id="lastName" placeholder="Enter last name">
                    </div>
                    <div class="form-group">
                      <label for="middleName">Middle Name (Optional)</label>
                      <input type="text" class="form-control" id="middleName" placeholder="Enter middle name">
                    </div>
                    <div class="form-group">
                      <label for="emailAddress">Email Address</label>
                      <input type="email" class="form-control" id="emailAddress" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                      <label for="phoneNumber">Phone Number</label>
                      <input type="text" class="form-control" id="phoneNumber" placeholder="Enter phone number">
                    </div>
                    <div class="form-group">
                      <label for="address">Address</label>
                      <input type="text" class="form-control" id="address" placeholder="Enter address">
                    </div>
                    <div class="form-group">
                      <label for="dateOfBirth">Date of Birth</label>
                      <input type="date" class="form-control" id="dateOfBirth">
                    </div>
                    <div class="form-group">
                      <label for="gender">Gender</label>
                      <select class="form-control" id="gender">
                        <option>Male</option>
                        <option>Female</option>
                        <option>Other</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="profilePicture">Profile Picture</label>
                      <input type="file" class="form-control-file" id="profilePicture">
                    </div>
                    <div class="form-group">
                      <label for="contactInfo">Contact Info</label>
                      <textarea class="form-control" id="contactInfo" rows="3" placeholder="Enter contact information"></textarea>
                    </div>
                    <div class="form-group">
                      <label for="bio">Bio</label>
                      <textarea class="form-control" id="bio" rows="3" placeholder="Enter bio"></textarea>
                    </div>
                    <div class="form-group">
                      <label for="socialMedia">Social Media</label>
                      <input type="text" class="form-control" id="socialMedia" placeholder="Enter social media links">
                    </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div>
              <!-- /.card -->
            </div>
          </div>
          <!-- /.row -->
        </div>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
    </aside>
    <!-- /.control-sidebar -->
    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- To the right -->
      <div class="float-right d-none d-sm-inline">
        Anything you want
      </div>
      <!-- Default to the left -->
      <strong>Footer &copy; 2024 <a href="#">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>
  </div>
  <!-- jQuery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/js/adminlte.min.js"></script>
  <script>
    $(document).ready(function() {
        // Handle sign out button click
        $('#sign-out-btn').click(function(e) {
            e.preventDefault();
            // Perform sign-out logic here, such as redirecting to a sign-out page or logging the user out
            alert('Signing out...');
        });

        // Handle profile button click
        $('#profile-btn').click(function(e) {
            e.preventDefault();
            // Toggle the visibility of the edit profile form
            $('.edit-profile-form').toggle();
        });
    });
  </script>
</body>
</html>
