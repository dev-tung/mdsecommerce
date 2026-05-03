<style>
  .Header {
    background-color: #ffd400;
  }

  .Header__Logo {
    font-weight: bold;
    font-size: 20px;
  }

  .Header__Action {
    font-size: 12px;
    cursor: pointer;
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  .Header__Action i {
    font-size: 18px;
  }
</style>

<header class="Header py-2">
  <div class="container">
    <div class="row align-items-center">

      <!-- LOGO -->
      <div class="col-2">
        <a href="#" class="Header__Logo text-dark text-decoration-none">
          MD Sport
        </a>
      </div>

      <!-- SEARCH -->
      <div class="col-6">
        <?php include __DIR__ . '/search.php'; ?>
      </div>

      <!-- ACTION -->
      <div class="col-4 d-flex justify-content-end gap-3">

        <div class="Header__Action">
          <i class="bi bi-telephone"></i>
          <span>Gọi mua</span>
        </div>

        <div class="Header__Action">
          <i class="bi bi-geo-alt"></i>
          <span>Cửa hàng</span>
        </div>

        <div class="Header__Action fw-bold">
          <i class="bi bi-cart"></i>
          <span>Giỏ hàng</span>
        </div>

      </div>

    </div>
  </div>
</header>