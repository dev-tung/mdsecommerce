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
    overflow-x: visible;
  }

  .Menu__Item {
    position: relative;
    white-space: nowrap;
  }

  .Menu__Link {
    text-decoration: none;
    color: black;
    font-size: 14px;
    padding: 6px 8px;
    border-radius: 4px;
    display: inline-block;
  }

  .Menu__Link:hover {
    background-color: rgba(0,0,0,0.1);
  }

  /* ICON */
  .Menu__Link--Dropdown::after {
    content: "";
    display: inline-block;
    margin-left: 6px;

    border: solid black;
    border-width: 0 1.5px 1.5px 0;
    padding: 3px;

    transform: rotate(45deg);
    transition: 0.2s;
  }

  .Menu__Item:hover .Menu__Link--Dropdown::after {
    transform: rotate(225deg);
  }

  .dropdown-toggle::after {
    display: none;
  }

  /* DROPDOWN */
  .dropdown-menu {
    border-radius: 6px;
    border: none;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    min-width: 180px;
  }

  .dropdown-item:hover {
    background-color: #f5f5f5;
  }

  .Menu .dropdown:hover > .dropdown-menu {
    display: block;
  }
</style>

<nav class="Menu">
  <div class="container">
    <ul class="Menu__List">

      <li class="Menu__Item dropdown">
        <a href="#" class="Menu__Link Menu__Link--Dropdown dropdown-toggle" data-bs-toggle="dropdown">
          Vợt cầu lông
        </a>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="#">Yonex</a></li>
          <li><a class="dropdown-item" href="#">Lining</a></li>
          <li><a class="dropdown-item" href="#">Victor</a></li>
        </ul>
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