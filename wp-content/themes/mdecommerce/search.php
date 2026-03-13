<?php get_header(); ?>

<style>

/* ================= PRODUCT CARD ================= */

.product-card{
border-radius:0;
background:#fff;
border:none;
transition:.25s;
height:100%;
}

.product-card:hover{
transform:translateY(-6px);
box-shadow:0 14px 30px rgba(105,168,79,.2);
}

.product-img{
height:200px;
object-fit:cover;
width:100%;
}

.product-title{
font-size:14px;
font-weight:600;
min-height:40px;
}

.price-old{
font-size:13px;
text-decoration:line-through;
color:#9ca3af;
}

.price-sale{
font-size:15px;
font-weight:700;
color:#dc2626;
}

.button-buy{
background:#f1f8fe;
border:1px solid #f1f8fe;
color:#4b8b2f;
font-weight:600;
border-radius:0;
}

.button-buy:hover{
background:#5c9645;
color:#fff;
}

/* ================= FILTER PRICE ================= */

.filter-price{
display:flex;
gap:10px;
flex-wrap:wrap;
margin-bottom:20px;
}

.filter-price a{
padding:6px 12px;
border:1px solid #e5e7eb;
text-decoration:none;
font-size:13px;
color:#333;
background:#fff;
}

.filter-price a.active{
background:#69A84F;
color:#fff;
border-color:#69A84F;
}

</style>


<section class="py-4">

<div class="container">

<div class="card shadow-sm border-0">

<div class="card-body">

<!-- FILTER PRICE -->

<?php $price_filter = isset($_GET['price']) ? $_GET['price'] : ''; ?>

<div class="filter-price">

<a href="?s=<?php echo get_search_query(); ?>" class="<?php if(!$price_filter) echo 'active'; ?>">Tất cả</a>

<a href="?s=<?php echo get_search_query(); ?>&price=1" class="<?php if($price_filter=='1') echo 'active'; ?>">
Dưới 500k
</a>

<a href="?s=<?php echo get_search_query(); ?>&price=2" class="<?php if($price_filter=='2') echo 'active'; ?>">
500k - 1 triệu
</a>

<a href="?s=<?php echo get_search_query(); ?>&price=3" class="<?php if($price_filter=='3') echo 'active'; ?>">
1 - 2 triệu
</a>

<a href="?s=<?php echo get_search_query(); ?>&price=4" class="<?php if($price_filter=='4') echo 'active'; ?>">
Trên 2 triệu
</a>

</div>


<div class="row g-3">

<?php

$meta_query = [];

if($price_filter == '1'){
$meta_query[] = [
'key' => '_price',
'value' => 500000,
'compare' => '<',
'type' => 'NUMERIC'
];
}

if($price_filter == '2'){
$meta_query[] = [
'key' => '_price',
'value' => [500000,1000000],
'compare' => 'BETWEEN',
'type' => 'NUMERIC'
];
}

if($price_filter == '3'){
$meta_query[] = [
'key' => '_price',
'value' => [1000000,2000000],
'compare' => 'BETWEEN',
'type' => 'NUMERIC'
];
}

if($price_filter == '4'){
$meta_query[] = [
'key' => '_price',
'value' => 2000000,
'compare' => '>',
'type' => 'NUMERIC'
];
}

$args = [
'post_type' => 'product',
'post_status' => 'publish',
'posts_per_page' => -1,
's' => get_search_query(),
'meta_query' => $meta_query
];

$q = new WP_Query($args);

if($q->have_posts()):

while($q->have_posts()): $q->the_post();

global $product;

$regular = (int)$product->get_regular_price();
$sale = (int)$product->get_sale_price();

$image = has_post_thumbnail()
? get_the_post_thumbnail_url(get_the_ID(),'medium')
: wc_placeholder_img_src();

?>

<div class="col-6 col-md-4 col-lg-3 col-xl-2">

<div class="product-card p-2 d-flex flex-column">

<img src="<?php echo esc_url($image); ?>" class="product-img mb-2">

<h6 class="product-title text-center">
<?php the_title(); ?>
</h6>

<?php if($sale): ?>

<div class="text-center price-old">
<?php echo wc_price($regular); ?>
</div>

<div class="text-center price-sale mb-2">
<?php echo wc_price($sale); ?>
</div>

<?php else: ?>

<div class="text-center price-sale mb-2">
<?php echo wc_price($regular); ?>
</div>

<?php endif; ?>

<a href="<?php the_permalink(); ?>" class="btn button-buy btn-sm mt-auto">
Xem chi tiết
</a>

</div>

</div>

<?php endwhile; ?>

<?php else: ?>

<div class="col-12 text-center py-5">

<h5>Không tìm thấy sản phẩm</h5>
<p>Thử từ khóa khác.</p>

</div>

<?php endif; wp_reset_postdata(); ?>

</div>

</div>

</div>

</div>

</section>

<?php get_footer(); ?>