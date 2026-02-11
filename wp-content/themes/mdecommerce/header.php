<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title><?php bloginfo('name'); ?><?php wp_title('|'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>

    <style>
        /* ================= BODY ================= */
        body {
            background: #ede7f2;
        }

        /* ================= NAVBAR ================= */
        .navbar {
            position: sticky;
            top: 0;
            z-index: 1020;
            background:#69A84F;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
            border-bottom: 1px solid #e5e7eb;
        }
        
        .navbar-brand {
            color: #69A84F !important;
            font-weight: 700;
            font-size: 18px;
        }

        /* ================= FLOATING BUTTONS ================= */
        .zalo-float,
        .phone-float {
            position: fixed;
            right: 20px;
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: #69A84F;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            transition: .25s;
            overflow: visible;
        }

        .zalo-float { bottom: 70px; }
        .phone-float { bottom: 140px; }

        .zalo-float:hover,
        .phone-float:hover {
            transform: scale(1.08);
        }

        .zalo-float img {
            width: 32px;
            height: 32px;
        }

        /* ================= HOVER TEXT (CHUNG) ================= */
        .float-text {
            position: absolute;
            right: 70px;
            white-space: nowrap;
            background: #69A84F;
            color: #fff;
            padding: 8px 14px;
            border-radius: 6px;
            font-size: 14px;
            opacity: 0;
            transform: translateX(10px);
            transition: .25s ease;
            pointer-events: none;
            box-shadow: 0 6px 16px rgba(0,0,0,.2);
        }

        .float-text::after {
            content: "";
            position: absolute;
            right: -6px;
            top: 50%;
            transform: translateY(-50%);
            border-width: 6px;
            border-style: solid;
            border-color: transparent transparent transparent #69A84F;
        }

        .zalo-float:hover .float-text,
        .phone-float:hover .float-text {
            opacity: 1;
            transform: translateX(0);
        }

        /* ================= PULSE ================= */
        .pulse {
            animation: pulse 1.6s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(105,168,79,.6);
            }
            70% {
                box-shadow: 0 0 0 18px rgba(105,168,79,0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(105,168,79,0);
            }
        }

        .navbar .nav-link {
            font-weight: 500;
            color: white;
        }

        .navbar .nav-link:hover {
            text-decoration: underline;
        }

    </style>

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <!-- ZALO FLOAT -->
    <a href="https://zalo.me/0966628838"
       class="zalo-float pulse"
       target="_blank"
       aria-label="Chat Zalo">

        <span class="float-text">Chat Zalo 0966 628 838</span>

        <img src="https://upload.wikimedia.org/wikipedia/commons/9/91/Icon_of_Zalo.svg" alt="Zalo">
    </a>

    <!-- PHONE FLOAT -->
    <a href="tel:0973359165"
       class="phone-float pulse"
       aria-label="Gọi điện thoại">

        <span class="float-text">Gọi Hotline 0973 359 165</span>
        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="#fff" viewBox="0 0 16 16">
            <path d="M3.654 1.328a.678.678 0 0 1 .737-.054l2.522 1.515c.329.197.445.62.27.977l-1.013 2.027a.678.678 0 0 0 .145.788l2.457 2.457a.678.678 0 0 0 .788.145l2.027-1.013a.678.678 0 0 1 .977.27l1.515 2.522a.678.678 0 0 1-.054.737l-1.318 1.318c-.89.89-2.216 1.108-3.262.544a18.634 18.634 0 0 1-7.12-7.12c-.564-1.046-.346-2.372.544-3.262L3.654 1.328z"/>
        </svg>
    </a>

    <!-- HEADER -->
    <nav class="navbar navbar-light navbar-expand-lg">
        <div class="container">

            <!-- Logo -->
            <a class="navbar-brand" href="<?php echo home_url(); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.png" alt="Logo" width="120">
            </a>

            <!-- Toggle button (mobile) -->
            <button class="navbar-toggler" type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#mainNavbar"
                    aria-controls="mainNavbar"
                    aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menu -->
            <div class="collapse navbar-collapse" id="mainNavbar">
                <div class="navbar-nav ms-auto gap-lg-4">
                    <a href="<?php echo home_url('/'); ?>" class="nav-link">Trang chủ</a>
                    <a href="<?php echo home_url('/cua-hang'); ?>" class="nav-link">Cửa hàng</a>
                    <a href="<?php echo home_url('/string'); ?>" class="nav-link">Căng cước</a>
                    <a href="<?php echo home_url('/category/blog'); ?>" class="nav-link">Tin tức</a>
                    <a href="<?php echo home_url('/gio-hang'); ?>" class="nav-link">Giỏ hàng</a>
                    <a href="<?php echo home_url('/lien-he'); ?>" class="nav-link">Liên hệ</a>
                </div>
            </div>

        </div>
    </nav>
    <!-- END HEADER -->


