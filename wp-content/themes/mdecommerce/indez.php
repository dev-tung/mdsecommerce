<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop cầu lông</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>

        /* ================= BODY ================= */

        body {
            background: #f2f4f7;
        }

        /* ================= HEADER ================= */

        .header {
            background: #69A84F;
            color: white;
        }

        /* ================= TOP BANNER ================= */

        .header__banner {
            height: 44px;
            overflow: hidden;
        }

        .header__banner-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* ================= MAIN HEADER ================= */

        .header__main {
            padding: 12px 0;
        }

        .header__logo {
            font-size: 22px;
            font-weight: 700;
            color: white;
            text-decoration: none;
        }

        /* ================= SEARCH ================= */

        .header__search-input {
            border-radius: 0;
        }

        .header__search-btn {
            background: white;
            border: none;
            color: #69A84F;
            border-radius: 0;
        }

        /* ================= ACTIONS ================= */

        .header__actions {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 20px;
        }

        .header__action {
            display: flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
        }

        .header__action i {
            font-size: 18px;
            width: 18px;
            text-align: center;
        }

        /* ================= MENU ================= */

        .header__menu {
            display: flex;
            gap: 12px;
        }

        .header__menu-item {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 10px 16px;
            text-decoration: none;
            color: white;
            font-weight: 500;
        }

        .header__menu-item:hover {
            background: rgba(255,255,255,0.15);
            border-radius: 4px;
        }

        /* ================= MOBILE MENU ================= */

        .menu-toggle {
            font-size: 28px;
            cursor: pointer;
            color: white;
        }

        .mobile-menu a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 0;
            text-decoration: none;
            color: #333;
            font-weight: 500;
            border-bottom: 1px solid #eee;
        }

        .mobile-menu i {
            width: 20px;
            text-align: center;
        }

        /* ================= RESPONSIVE ================= */

        @media (max-width: 992px) {

            .header__menu {
                display: none;
            }

        }

    </style>

</head>

<body>

<header class="header">

    <!-- ===== TOP BANNER ===== -->

    <div class="header__banner">

        <a href="#">

            <img
                src="images/banner-top.jpg"
                alt="Khuyến mãi cầu lông"
                class="header__banner-img"
            >

        </a>

    </div>


    <!-- ===== MAIN HEADER ===== -->

    <div class="header__main">

        <div class="container">

            <div class="row align-items-center">

                <!-- LOGO -->

                <div class="col-4 col-lg-3">

                    <a href="#" class="header__logo">
                        SHOP CẦU LÔNG
                    </a>

                </div>


                <!-- SEARCH -->

                <div class="col-8 col-lg-6">

                    <div class="input-group">

                        <input
                            type="text"
                            class="form-control header__search-input"
                            placeholder="Tìm vợt cầu lông..."
                        >

                        <button class="btn header__search-btn">
                            <i class="bi bi-search"></i>
                        </button>

                    </div>

                </div>


                <!-- ACTIONS (DESKTOP) -->

                <div class="col-lg-3 d-none d-lg-block">

                    <div class="header__actions">

                        <div class="header__action">
                            <i class="bi bi-person"></i>
                            Đăng nhập
                        </div>

                        <div class="header__action">
                            <i class="bi bi-cart"></i>
                            Giỏ hàng
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- ===== MENU ===== -->

    <div class="container">

        <div class="d-flex justify-content-between align-items-center">

            <!-- DESKTOP MENU -->

            <div class="header__menu">

                <a href="#" class="header__menu-item">
                    <i class="bi bi-lightning-charge"></i>
                    Vợt cầu lông
                </a>

                <a href="#" class="header__menu-item">
                    <i class="bi bi-person-walking"></i>
                    Giày cầu lông
                </a>

                <a href="#" class="header__menu-item">
                    <i class="bi bi-tshirt"></i>
                    Quần áo
                </a>

                <a href="#" class="header__menu-item">
                    <i class="bi bi-bag"></i>
                    Túi vợt
                </a>

                <a href="#" class="header__menu-item">
                    <i class="bi bi-link-45deg"></i>
                    Dây căng
                </a>

                <a href="#" class="header__menu-item">
                    <i class="bi bi-gear"></i>
                    Phụ kiện
                </a>

                <a href="#" class="header__menu-item">
                    <i class="bi bi-tag"></i>
                    Khuyến mãi
                </a>

                <a href="#" class="header__menu-item">
                    <i class="bi bi-journal-text"></i>
                    Blog
                </a>

            </div>


            <!-- MOBILE TOGGLE -->

            <div class="d-lg-none">

                <i
                    class="bi bi-list menu-toggle"
                    data-bs-toggle="offcanvas"
                    data-bs-target="#mobileMenu">
                </i>

            </div>

        </div>

    </div>

</header>


<!-- ================= MOBILE MENU ================= -->

<div
    class="offcanvas offcanvas-end"
    tabindex="-1"
    id="mobileMenu"
>

    <div class="offcanvas-header">

        <h5>Danh mục</h5>

        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="offcanvas">
        </button>

    </div>

    <div class="offcanvas-body mobile-menu">

        <a href="#">
            <i class="bi bi-lightning-charge"></i>
            Vợt cầu lông
        </a>

        <a href="#">
            <i class="bi bi-person-walking"></i>
            Giày cầu lông
        </a>

        <a href="#">
            <i class="bi bi-tshirt"></i>
            Quần áo
        </a>

        <a href="#">
            <i class="bi bi-bag"></i>
            Túi vợt
        </a>

        <a href="#">
            <i class="bi bi-link-45deg"></i>
            Dây căng
        </a>

        <a href="#">
            <i class="bi bi-gear"></i>
            Phụ kiện
        </a>

        <a href="#">
            <i class="bi bi-tag"></i>
            Khuyến mãi
        </a>

        <a href="#">
            <i class="bi bi-journal-text"></i>
            Blog
        </a>

    </div>

</div>


<!-- ================= JS ================= -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>