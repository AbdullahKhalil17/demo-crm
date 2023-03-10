  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria_label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fa fa-search"></i>
          </button>
        </div>
      </div>
    </form>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto"> 
    <li class="nav-item">
      <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-expanded="false">
          <?php
          if(isset($_SESSION['auth']))
          {
            echo $_SESSION['auth_user']['empname'];
          }
          else
          {
            echo "Not Logged in";
          }
           ?>
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <form action="code.php" method="POST">
              <button type="submit" name="logout_btn" class="dropdown-item">Logout</button>
          </form>
        </div>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
        <i class="fas fa-th-larg"></i>
      </a>
    </li>
  </ul>
</nav>
<!-- /.navbar -->



