
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item ">
        <a class="nav-link" href="index.php" style="color:white;">Trang chủ <span class="sr-only"></span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link xx" href="nhacungcap.php" style="color:white;">Quản lý nhà cung cấp</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="nhavanchuyen.php" style="color:white;">Quản lý nhà vận chuyển</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="dathang.php" style="color:white;">Đặt hàng</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="doimatkhau.php" style="color:white;">Đổi mật khẩu</a>
      </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><div class="btn btn-warning" style="margin-right:5px;"><?php echo $_SESSION['sessUsername'] ?> </div> </li>
      <li><a href="../logout.php" class="btn btn-info"> Đăng xuất <i class="fas fa-sign-out-alt"></i></a></li>               
    </ul>
  </div>
</nav> 
