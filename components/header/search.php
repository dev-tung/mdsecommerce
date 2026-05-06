<style>
  .Header__SearchWrap {
    position: relative;
    width: 415px;
  }

  .Header__Search {
    display: flex;
    align-items: center;
    background-color: #fff;
    border-radius: 999px;
    padding: 6px 12px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
  }

  .Header__Search input {
    border: none;
    outline: none;
    flex: 1;
    font-size: 14px;
  }

  .Header__Search button {
    border: none;
    background: none;
    cursor: pointer;
    color: #333;
  }

  /* ===== DROPDOWN ===== */
  .Header__SearchDropdown {
    position: absolute;
    top: calc(100% + 10px);
    left: 0;
    right: 0;

    background: #fff;
    border-radius: 10px;

    box-shadow: 0 5px 15px rgba(0,0,0,0.15);

    padding: 10px;
    display: none;

    z-index: 1000;
  }

  /* TAM GIÁC CHỔNG LÊN */
  .Header__SearchDropdown::before {
    content: "";

    position: absolute;
    top: -8px;
    left: 24px;

    width: 0;
    height: 0;

    border-left: 8px solid transparent;
    border-right: 8px solid transparent;
    border-bottom: 8px solid #fff;
  }

  /* GIỮ HOVER / CLICK MƯỢT */
  .Header__SearchWrap::after {
    content: "";

    position: absolute;
    left: 0;
    top: 100%;

    width: 100%;
    height: 12px;
  }

  .Header__SearchWrap.active .Header__SearchDropdown {
    display: block;
  }

  /* ===== HEADER DROPDOWN ===== */
  .Header__SearchHeader {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 8px;
  }

  .Header__SearchTitle {
    font-size: 13px;
    color: #666;
  }

  /* ===== NÚT X (CUSTOM TGDD STYLE) ===== */
  .Header__SearchClose {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background: #f1f1f1;
    position: relative;
    cursor: pointer;
    transition: 0.2s;
  }

  .Header__SearchClose::before,
  .Header__SearchClose::after {
    content: "";
    position: absolute;
    top: 50%;
    left: 50%;
    width: 9px;
    height: 1.2px;
    background: #666;
    transform-origin: center;
  }

  .Header__SearchClose::before {
    transform: translate(-50%, -50%) rotate(45deg);
  }

  .Header__SearchClose::after {
    transform: translate(-50%, -50%) rotate(-45deg);
  }

  .Header__SearchClose:hover {
    background: #ddd;
  }

  /* ===== ITEM ===== */
  .Header__SearchItem {
    padding: 6px 8px;
    border-radius: 6px;
    cursor: pointer;
  }

  .Header__SearchItem:hover {
    background: #f5f5f5;
  }
</style>

<div class="Header__SearchWrap">
  <div class="Header__Search">
    <input type="text" placeholder="Bạn tìm gì...">
    <button><i class="bi bi-search"></i></button>
  </div>

  <div class="Header__SearchDropdown">

    <!-- HEADER -->
    <div class="Header__SearchHeader">
      <div class="Header__SearchTitle">Tìm kiếm gần đây</div>
      <div class="Header__SearchClose"></div>
    </div>

    <!-- ITEMS -->
    <div class="Header__SearchItem">Vợt Yonex</div>
    <div class="Header__SearchItem">Giày cầu lông</div>
    <div class="Header__SearchItem">Quấn cán vợt</div>

  </div>
</div>

<script>
  document.querySelectorAll('.Header__SearchWrap').forEach((wrap) => {
    const input = wrap.querySelector('input');
    const closeBtn = wrap.querySelector('.Header__SearchClose');

    // mở dropdown
    input.addEventListener('focus', () => {
      wrap.classList.add('active');
    });

    // click ngoài → đóng
    document.addEventListener('click', (e) => {
      if (!wrap.contains(e.target)) {
        wrap.classList.remove('active');
      }
    });

    // click X → đóng dropdown
    closeBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      wrap.classList.remove('active');
    });
  });
</script>