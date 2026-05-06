<style>
  .Menu {
    background-color: #ffd400;
  }

  .Menu__List {
    display: flex;
    gap: 20px;
    padding: 8px 0;
    margin: 0;
    list-style: none;
  }

  .Menu__Item {
    position: relative;
    white-space: nowrap;
  }

  .Menu__Link {
    text-decoration: none;
    color: #000;
    font-size: 14px;
    padding: 8px 10px;
    border-radius: 4px;
    display: inline-flex;
    align-items: center;
    transition: 0.2s;
    margin-left: -10px;
  }

  .Menu__Link:hover {
    background-color: rgba(0,0,0,0.08);
  }

  /* ICON MŨI TÊN */
  .Menu__Link--Dropdown::after {
    content: "";
    display: inline-block;

    width: 6px;
    height: 6px;

    margin-left: 8px;
    margin-top: -1px;

    border-right: 1.5px solid #000;
    border-bottom: 1.5px solid #000;

    transform: rotate(45deg);
    transform-origin: center;

    transition: transform .25s ease;
  }

  /* HOVER -> QUAY LÊN */
  .Menu__Item:hover .Menu__Link--Dropdown::after {
    transform: rotate(-135deg);
    margin-top: 3px;
  }
  
  /* DROPDOWN */
  .dropdown-menu {
    display: none;
    position: absolute;
    top: 100%;
    left: 0;

    min-width: 180px;

    background: #fff;
    border-radius: 8px;

    padding: 10px 0 6px;
    margin-top: 8px;

    box-shadow: 0 4px 14px rgba(0,0,0,0.1);
    z-index: 1000;
  }

  /* TAM GIÁC CHỔNG LÊN */
  .dropdown-menu::before {
    content: "";

    position: absolute;
    top: -8px;
    left: 20px;

    width: 0;
    height: 0;

    border-left: 8px solid transparent;
    border-right: 8px solid transparent;
    border-bottom: 8px solid #fff;
  }

  /* GIỮ HOVER */
  .Menu__Item::after {
    content: "";
    position: absolute;

    left: 0;
    top: 100%;

    width: 100%;
    height: 12px;
  }

  .Menu__Item:hover .dropdown-menu {
    display: block;
  }

  .dropdown-item {
    display: block;
    padding: 10px 14px;

    color: #000;
    text-decoration: none;
    font-size: 14px;
  }

  .dropdown-item:hover {
    background-color: #f5f5f5;
  }
</style>

<nav class="Menu">
  <div class="container">

    <ul class="Menu__List">

      <!-- DROPDOWN -->
      <li class="Menu__Item">

        <a href="#" class="Menu__Link Menu__Link--Dropdown">
          Vợt cầu lông
        </a>

        <div class="dropdown-menu">
          <a href="#" class="dropdown-item">Yonex</a>
          <a href="#" class="dropdown-item">Lining</a>
          <a href="#" class="dropdown-item">Victor</a>
        </div>

      </li>

      <li class="Menu__Item">
        <a href="#" class="Menu__Link">Giày cầu lông</a>
      </li>

      <li class="Menu__Item">
        <a href="#" class="Menu__Link">Quần áo</a>
      </li>

      <li class="Menu__Item">
        <a href="#" class="Menu__Link">Túi vợt</a>
      </li>

      <li class="Menu__Item">
        <a href="#" class="Menu__Link">Dây đan</a>
      </li>

      <li class="Menu__Item">
        <a href="#" class="Menu__Link">Quấn cán</a>
      </li>

      <li class="Menu__Item">
        <a href="#" class="Menu__Link">Phụ kiện</a>
      </li>

    </ul>

  </div>
</nav>