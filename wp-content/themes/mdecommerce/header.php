<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>

<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>
<?php bloginfo('name'); ?> <?php wp_title('|'); ?>
</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>

/* ================= BODY ================= */

body{
background:#f2f4f7;
}

/* ================= SITE HEADER ================= */

.site-header{
background:#69A84F;
color:#fff;
}

.header__banner{
background: linear-gradient(90deg, #A5CE1E, #69A84F, #A5CE1E);
}

.header__banner-text{
font-size:24px;
font-weight:500;  
padding:10px;
}

/* ================= MAIN HEADER ================= */

.site-header__main{
padding:12px 0;
}

/* ================= LOGO ================= */

.site-header__logo img{
width:120px;
display:block;
}

/* ================= SEARCH ================= */

.site-header__search .input-group{
background:#fff;
border-radius:6px;
overflow:hidden;
}

.site-header__search-input{
border:none;
box-shadow:none;
}

.site-header__search-input:focus{
box-shadow:none;
}

.site-header__search-btn{
background:#fff;
border:none;
color:#69A84F;
padding:0 16px;
}

/* ================= ACTIONS ================= */

.site-header__actions{
display:flex;
justify-content:flex-end;
align-items:center;
gap:20px;
}

.site-header__action{
display:flex;
align-items:center;
gap:6px;
color:#fff;
text-decoration:none;
}

.site-header__action i{
font-size:18px;
width:auto;
}

/* ================= MENU ================= */

.site-header__menu{
display:flex;
gap:5px;
margin-left:-10px;
}

.site-header__menu-item{
display:flex;
align-items:center;
gap:6px;
padding:10px;
color:#fff;
text-decoration:none;
font-weight:500;
}

.site-header__menu-item:hover{
background:rgba(255,255,255,0.15);
border-radius:4px;
}

.site-header__menu-item.active{
background:rgba(255,255,255,0.25);
border-radius:4px;
}

/* ================= MOBILE MENU ================= */

.mobile-header-actions .site-header__menu-toggle{
font-size:28px;
color:#fff;
cursor:pointer;
}

.site-header__mobile-item{
display:flex;
align-items:center;
gap:10px;
padding:12px 0;
text-decoration:none;
color:#333;
font-weight:500;
border-bottom:1px solid #eee;
}

.site-header__mobile-item i{
width:20px;
}

/* ================= FLOAT CONTACT ================= */

.float-contact{
position:fixed;
right:20px;
width:56px;
height:56px;
border-radius:50%;
background:#69A84F;
display:flex;
align-items:center;
justify-content:center;
z-index:9999;
}

.float-contact--zalo{
bottom:70px;
}

.float-contact--phone{
bottom:140px;
}

.float-contact img{
width:30px;
}

/* ================= MOBILE HEADER FIX ================= */

.mobile-header-actions{
display:none;
}

@media (max-width:992px){

.site-header__logo img{
width:100px;
display:block;
}

.site-header__menu{
display:none;
}

.logo-row{
display:flex;
justify-content:space-between;
align-items:center;
width:100%;
}

.mobile-header-actions{
display:flex;
align-items:center;
gap:16px;
}

.mobile-header-actions i{
font-size:23px;
}

.search-row{
width:100%;
margin-top:10px;
}

}

</style>

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<?php $current_url = $_SERVER['REQUEST_URI']; ?>

<!-- FLOAT CONTACT -->

<a href="https://zalo.me/0966628838" class="float-contact float-contact--zalo" target="_blank">
<img src="https://upload.wikimedia.org/wikipedia/commons/9/91/Icon_of_Zalo.svg">
</a>

<a href="tel:0973359165" class="float-contact float-contact--phone">

<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="#fff" viewBox="0 0 16 16">
<path d="M3.654 1.328a.678.678 0 0 1 .737-.054l2.522 1.515c.329.197.445.62.27.977l-1.013 2.027a.678.678 0 0 0 .145.788l2.457 2.457a.678.678 0 0 0 .788.145l2.027-1.013a.678.678 0 0 1 .977.27l1.515 2.522a.678.678 0 0 1-.054.737l-1.318 1.318c-.89.89-2.216 1.108-3.262.544a18.634 18.634 0 0 1-7.12-7.12c-.564-1.046-.346-2.372.544-3.262L3.654 1.328z"/>
</svg>

</a>

<header class="site-header">

<div class="header__banner text-center">
<h3 class="header__banner-text">Giày 65Z4 đã về shop rồi, CÁC LÔNG THỦ ƠI !!!</h3>
</div>

<div class="site-header__main">

<div class="container">

<div class="row align-items-center">

<div class="col-12 col-lg-3 logo-row">

<a href="<?php echo home_url(); ?>" class="site-header__logo">
<img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.png" alt="Logo">
</a>

<div class="mobile-header-actions d-lg-none">

<a href="<?php echo wc_get_cart_url(); ?>" class="site-header__action">
<i class="bi bi-cart"></i>
</a>

<i class="bi bi-list site-header__menu-toggle"
data-bs-toggle="offcanvas"
data-bs-target="#mobileMenu"></i>

</div>

</div>

<div class="col-12 col-lg-6 search-row">

<form role="search"
method="get"
action="<?php echo home_url('/'); ?>"
class="site-header__search">

<div class="input-group">

<input type="text"
name="s"
class="form-control site-header__search-input"
placeholder="Giày 65Z4 VA..."
value="<?php echo get_search_query(); ?>">

<button class="btn site-header__search-btn">
<i class="bi bi-search"></i>
</button>

</div>
</form>

</div>

<div class="col-lg-3 d-none d-lg-block">

<div class="site-header__actions">

<a href="<?php echo wc_get_cart_url(); ?>" class="site-header__action">
<i class="bi bi-cart"></i>
Giỏ hàng
</a>

</div>

</div>

</div>

</div>

</div>

<div class="container">

<div class="d-flex justify-content-between align-items-center">

<div class="site-header__menu">

<a href="<?php echo home_url('/danh-muc-san-pham/vot-cau-long'); ?>" class="site-header__menu-item <?php if(strpos($current_url,'vot-cau-long')!==false) echo 'active'; ?>">Vợt cầu lông</a>

<a href="<?php echo home_url('/danh-muc-san-pham/giay-cau-long'); ?>" class="site-header__menu-item <?php if(strpos($current_url,'giay-cau-long')!==false) echo 'active'; ?>">Giày cầu lông</a>

<a href="<?php echo home_url('/danh-muc-san-pham/ao-cau-long'); ?>" class="site-header__menu-item <?php if(strpos($current_url,'ao-cau-long')!==false) echo 'active'; ?>">Áo cầu lông</a>

<a href="<?php echo home_url('/danh-muc-san-pham/quan-cau-long'); ?>" class="site-header__menu-item <?php if(strpos($current_url,'quan-cau-long')!==false) echo 'active'; ?>">Quần cầu lông</a>

<a href="<?php echo home_url('/danh-muc-san-pham/bao-vot-cau-long'); ?>" class="site-header__menu-item <?php if(strpos($current_url,'bao-vot-cau-long')!==false) echo 'active'; ?>">Bao vợt</a>

<a href="<?php echo home_url('/danh-muc-san-pham/balo-vot-cau-long'); ?>" class="site-header__menu-item <?php if(strpos($current_url,'balo-vot-cau-long')!==false) echo 'active'; ?>">Balo</a>

<a href="<?php echo home_url('/danh-muc-san-pham/hop-cau-long'); ?>" class="site-header__menu-item <?php if(strpos($current_url,'hop-cau-long')!==false) echo 'active'; ?>">Hộp cầu lông</a>

<a href="<?php echo home_url('/string'); ?>" class="site-header__menu-item <?php if(strpos($current_url,'string')!==false) echo 'active'; ?>">Dây căng</a>

<a href="<?php echo home_url('/danh-muc-san-pham/phu-kien-cau-long'); ?>" class="site-header__menu-item <?php if(strpos($current_url,'phu-kien-cau-long')!==false) echo 'active'; ?>">Phụ kiện khác</a>

<a href="<?php echo home_url('/category/blog/'); ?>" class="site-header__menu-item <?php if(strpos($current_url,'blog')!==false) echo 'active'; ?>">Tin tức</a>

</div>

</div>

</div>

</header>