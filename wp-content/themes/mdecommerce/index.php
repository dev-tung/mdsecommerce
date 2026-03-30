<?php get_header(); ?>

<!-- ================= SWIPER CSS ================= -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

<style>

/* ================= PRODUCT CARD ================= */

.product-card{
    border-radius:0;
    background:#fff;
    border:none;
    transition:.25s;
}

.product-card:hover{
    transform:translateY(-6px);
    box-shadow:0 14px 30px rgba(105,168,79,.2);
}

.product-card__img{
    height:200px;
    object-fit:cover;
    width:100%;
    display:block;
    margin:0 auto;
}

.product-card__title{
    font-size:14px;
    font-weight:600;
    min-height:38px;
}

/* ================= PRICE ================= */

.product-card__price-old{
    font-size:13px;
    text-decoration:line-through;
    color:#9ca3af;
}

.product-card__price-sale{
    font-size:15px;
    font-weight:700;
    color:#dc2626;
}

/* ================= BUTTON ================= */

.button-buy{
    background:#f1f8fe;
    border:1px solid #f1f8fe;
    color:#4b8b2f;
    font-weight:600;
    border-radius:0;
}

.button-buy:hover{
    background:#5c9645;
    color:white;
}

.button-buy__icon{
    font-size:11px;
    margin-left:4px;
}

/* ================= SALE SLIDER ================= */

.saleSwiper .swiper-slide{
    height:auto;
}

/* ================= SLIDER ================= */

.slide-content{
    display:grid;
    grid-template-columns:1fr 1fr;
    align-items:center;
    height:365px;
}

.slide-text h2{
    font-size:36px;
    font-weight:700;
    margin-bottom:16px;
}

.slide-text p{
    font-size:16px;
    color:#4b5563;
    margin-bottom:24px;
}

.slide-text a{
    padding:10px 24px;
    background:#69A84F;
    color:#fff;
    font-weight:600;
    text-decoration:none;
}

.slide-text a:hover{
    background:#5c9645;
}

.slide-image img{
    width:100%;
    height:365px;
    object-fit:cover;
}

@media (max-width:768px){

.slide-content{
    grid-template-columns:1fr;
    height:auto;
}

.slide-text{
    padding-bottom:24px;
    text-align:center;
}

.slide-image img{
    height:260px;
}

}

/* ================= SWIPER PAGINATION ================= */

.swiper-pagination-bullet{
    background:#fff;
    opacity:.7;
}

.swiper-pagination-bullet-active{
    width:30px;
    border-radius:20px;
    background:#69A84F;
}

.hero-title{
    font-size:28px;
    font-weight:700;
    margin-bottom:12px;
}

.seo-box{
    background:#f9fafb;
    border:1px solid #e5e7eb;
    padding:20px;
    border-radius:8px;
    line-height:1.6;
}

.seo-box h2{
    font-size:20px;
    font-weight:700;
    margin-bottom:10px;
    color:#111827;
}

.seo-box p{
    font-size:15px;
    color:#4b5563;
    margin:0;
}
</style>


<!-- ================= HERO SLIDER ================= -->

<section class="py-4 bg-white">

<div class="container">

<div class="swiper homeSwiper">

<div class="swiper-wrapper">

<!-- Slide 1 -->
<div class="swiper-slide">
<div class="slide-content">

<div class="slide-text">

<h1 class="hero-title">
Shop cầu lông – Vợt Yonex, Lining chính hãng giá tốt
</h1>

<h2 class="mb-2">
Giày Yonex 65Z4 VA chính hãng
</h2>

<p>
Độ bám sân tốt – êm – phù hợp đánh phong trào & thi đấu. Xem review thực tế bên cạnh.
</p>

<a href="https://zalo.me/0966628838" class="btn button-buy">
Inbox để tư vấn & nhận ưu đãi
</a>

</div>

<div class="slide-image">
<iframe 
width="100%" 
height="365"
src="https://www.youtube.com/embed/-HowT-05GXY"
title="Review giày cầu lông Yonex 65Z4 VA"
frameborder="0" 
allow="encrypted-media" 
allowfullscreen>
</iframe>
</div>

</div>
</div>

</div>

<div class="swiper-pagination"></div>

</div>

</div>

</section>

<?php

$args_sale = [
    'post_type' => 'product',
    'posts_per_page' => 10,
    'post_status' => 'publish',

    'tax_query' => [
        'relation' => 'AND',

        // Chỉ lấy vợt
        [
            'taxonomy' => 'product_cat',
            'field'    => 'slug',
            'terms'    => ['vot-cau-long'],
        ],

        // Loại bỏ bao vợt
        [
            'taxonomy' => 'product_cat',
            'field'    => 'slug',
            'terms'    => ['bao-vot-cau-long'],
            'operator' => 'NOT IN',
        ]
    ],

    'meta_query' => [
        [
            'key' => '_sale_price',
            'value' => 0,
            'compare' => '>',
            'type' => 'NUMERIC'
        ]
    ]
];

$query_sale = new WP_Query($args_sale);

if ($query_sale->have_posts()) :

?>

<section class="py-5">

<div class="container">

<h2 class="fw-bold mb-4">Vợt cầu lông đang khuyến mãi</h2>

<div class="swiper saleSwiper">

<div class="swiper-wrapper">

<?php while ($query_sale->have_posts()) : $query_sale->the_post();

$product = wc_get_product(get_the_ID());
if(!$product) continue;

$image_url = get_the_post_thumbnail_url(
get_the_ID(),
'woocommerce_thumbnail'
) ?: wc_placeholder_img_src();

$terms = get_the_terms(get_the_ID(), 'product_cat');
$category_name = 'Sản phẩm cầu lông';

if ($terms && !is_wp_error($terms)) {
    $category_name = $terms[0]->name;
}
?>

<div class="swiper-slide">

<div class="product-card h-100">

<img
src="<?php echo esc_url($image_url); ?>"
class="product-card__img"
alt="<?php echo $category_name . ' ' . get_the_title() . ' chính hãng giá tốt'; ?>"
>

<div class="card-body text-center d-flex flex-column p-2">

<h6 class="product-card__title">
<?php the_title(); ?>
</h6>

<?php if ($product->get_regular_price()) : ?>

<div class="product-card__price-old">
<?php echo wc_price($product->get_regular_price()); ?>
</div>

<?php endif; ?>

<div class="product-card__price-sale mb-2">
<?php echo wc_price($product->get_sale_price()); ?>
</div>

<a href="<?php the_permalink(); ?>" class="btn button-buy btn-sm mt-auto">
Xem chi tiết
</a>

</div>

</div>

</div>

<?php endwhile; ?>

</div>

</div>

<div class="text-center mt-4">

<a href="<?php echo home_url('/cua-hang'); ?>" class="btn button-buy">

Xem thêm sản phẩm

<i class="bi bi-chevron-right button-buy__icon"></i>

</a>

</div>

</div>

</section>

<section class="container pb-5">

<div class="seo-box">

<h2>
Shop cầu lông Yonex chính hãng tại Văn Giang, Ecopark Hưng Yên – Mạnh Dũng Sports
</h2>

<p>
Chúng tôi chuyên cung cấp vợt cầu lông, giày cầu lông chính hãng từ Yonex, Lining với giá tốt.
Hỗ trợ đan vợt lấy ngay, tư vấn chọn vợt phù hợp cho người mới và người chơi nâng cao.
</p>

</div>

</section>

<?php endif; wp_reset_postdata(); ?>


<!-- ================= SWIPER JS ================= -->

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>

new Swiper('.homeSwiper',{
loop:false,
autoplay:{
delay:3000,
disableOnInteraction:false
},
pagination:{
el:'.swiper-pagination',
clickable:true
}
});

new Swiper('.saleSwiper',{
slidesPerView:5,
spaceBetween:16,
loop:true,
autoplay:{
delay:2500,
disableOnInteraction:false
},
breakpoints:{
0:{slidesPerView:2},
768:{slidesPerView:3},
992:{slidesPerView:4},
1200:{slidesPerView:6}
}
});

</script>


<?php get_footer(); ?>