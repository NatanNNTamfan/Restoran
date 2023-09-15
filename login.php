<html>
    <head>
            <title>Login Karyawan</title>
            <link rel="stylesheet" href="assets/css/bootstrap.min.css">

            <style>
                .my-custom-container {
                    max-width: 700px;
                    margin-top: 100px;
                }
                .my-custom-containerr {
                    max-width : 700px;
                    height : 100px;
                }
            </style>
    </head>
    <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand mr-4" href="index.php">Resto</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active mr-4 ">
        <a class="nav-link" href="index.php">Menu <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item mr-4">
        <a class="nav-link" href="lihat_data.php">Lihat Data</a>
      </li>
      <li class="nav-item mr-4">
        <a class="nav-link" href="tambah.php">Tambah Data</a>
      </li>
      <li class="nav-item mr-4">
        <a class="nav-link" href="login.php">Login</a>
      </li>
    </ul>
  </div>
</nav>
        <div class="container my-custom-containerr">
    <div class="jumbotron ">
  <div class="container">
    <center><h1 class="display-5">Login</h1></center>
  </div>
        </div>
</div>
    <form action="proseslogin.php" method="post">
        <div class="container my-custom-container" >
  <div class="form-group">
    <label for="exampleInputEmail1">Username</label>
    <input type="text" class="form-control" id="username" name="username"  placeholder="Enter Username">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
  </div>
  <p><input type="submit" class="btn btn-primary" value="Submit">&nbsp;
</p>
</form>
</div>
    <body>
</html>