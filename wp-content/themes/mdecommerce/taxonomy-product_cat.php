```php
<?php get_header(); ?>

<style>

/* ================= PRICE FILTER ================= */

.price-filter{
display:flex;
gap:10px;
flex-wrap:wrap;
margin-bottom:16px;
}

.filter-btn{
padding:6px 12px;
background:#f3f4f6;
border-radius:4px;
font-size:13px;
text-decoration:none;
color:#333;
font-weight:500;
}

.filter-btn:hover{
background:#69A84F;
color:#fff;
}

.filter-btn.active{
background:#69A84F;
color:#fff;
}

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

</style>

<section class="py-4">

<div class="container">

<?php woocommerce_breadcrumb(); ?>

<h1 class="mb-3">
<?php woocommerce_page_title(); ?>
</h1>

<div class="card shadow-sm border-0">

<div class="card-body">

<?php
$min = isset($_GET['min_price']) ? intval($_GET['min_price']) : '';
$max = isset($_GET['max_price']) ? intval($_GET['max_price']) : '';
?>

<!-- ===== FILTER PRICE ===== -->

<div class="price-filter">

<a href="<?php echo get_permalink( wc_get_page_id('shop') ); ?>"
class="filter-btn <?php if(!$min && !$max) echo 'active'; ?>">
Tất cả
</a>

<a href="?min_price=0&max_price=1000000"
class="filter-btn <?php if($max==1000000) echo 'active'; ?>">
Dưới 1tr
</a>

<a href="?min_price=1000000&max_price=2000000"
class="filter-btn <?php if($min==1000000 && $max==2000000) echo 'active'; ?>">
1tr - 2tr
</a>

<a href="?min_price=2000000&max_price=3000000"
class="filter-btn <?php if($min==2000000 && $max==3000000) echo 'active'; ?>">
2tr - 3tr
</a>

<a href="?min_price=3000000"
class="filter-btn <?php if($min==3000000 && !$max) echo 'active'; ?>">
Trên 3tr
</a>

</div>

<div class="row g-3">

<?php

$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

$args = [
'post_type' => 'product',
'posts_per_page' => 24,
'paged' => $paged
];

if($min || $max){

$args['meta_query'][] = [
'key' => '_price',
'value' => [$min ?: 0, $max ?: 999999999],
'compare' => 'BETWEEN',
'type' => 'NUMERIC'
];

}

$query = new WP_Query($args);

?>

<?php if($query->have_posts()): ?>

<?php while($query->have_posts()): $query->the_post(); ?>

<?php

$product = wc_get_product(get_the_ID());

$regular = (int)$product->get_regular_price();
$sale = (int)$product->get_sale_price();

$image = has_post_thumbnail()
? get_the_post_thumbnail_url(get_the_ID(),'medium')
: wc_placeholder_img_src();

?>

<div class="col-6 col-md-4 col-lg-3 col-xl-2">

<div class="product-card p-2 d-flex flex-column">

<a href="<?php the_permalink(); ?>">
<img src="<?php echo esc_url($image); ?>" class="product-img mb-2">
</a>

<h6 class="product-title text-center">

<a href="<?php the_permalink(); ?>" style="text-decoration:none;color:inherit;">
<?php the_title(); ?>
</a>

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

<?php wp_reset_postdata(); ?>

</div>

<!-- ===== PAGINATION ===== -->

<div class="mt-4">

<?php
echo paginate_links([
'total' => $query->max_num_pages
]);
?>

</div>

<?php else: ?>

<div class="col-12 text-center py-5">
<h5>Chưa có sản phẩm</h5>
</div>

<?php endif; ?>

</div>

</div>

</div>

</div>

</section>

<?php get_footer(); ?>
```
