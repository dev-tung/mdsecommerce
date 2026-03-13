
<?php
defined('ABSPATH') || exit;
get_header();

$product = wc_get_product(get_the_ID());
if(!$product) return;

$gallery = $product->get_gallery_image_ids();
$main = $product->get_image_id();

if($main){
array_unshift($gallery,$main);
}
?>

<style>

/* ===== CARD ===== */

.product-card{
background:#fff;
border-radius:6px;
padding:20px;
}

/* ===== IMAGE ===== */

.product-image img{
width:100%;
border-radius:6px;
}

/* ===== TITLE ===== */

.product-title{
font-size:26px;
font-weight:700;
margin-bottom:15px;
}

/* ===== PRICE ===== */

.product-price{
font-size:24px;
font-weight:700;
color:#d70018;
margin-bottom:10px;
}

/* ===== PROMO ===== */

.promo-box{
border:1px solid #eee;
padding:15px;
border-radius:6px;
margin-bottom:15px;
}

.promo-box ul{
margin:0;
padding-left:18px;
font-size:14px;
}

/* ===== BUY BUTTON GROUP ===== */

.buy-group{
display:flex;
gap:10px;
margin-top:15px;
}

.buy-now{
flex:1;
background:#fb6e2e;
border:none;
padding:14px;
font-weight:700;
color:#fff;
}

.buy-now:hover{
background:#e45a1c;
color:#fff;
}

.add-cart{
flex:1;
background:#fff;
border:1px solid #fb6e2e;
padding:14px;
font-weight:700;
color:#fb6e2e;
}

.add-cart:hover{
background:#fb6e2e;
color:#fff;
}

/* ===== POLICY ===== */

.policy-box{
border:1px solid #eee;
padding:15px;
border-radius:6px;
font-size:14px;
margin-top:15px;
}

</style>

<div class="container py-4">

<h1 class="product-title">
<?php the_title(); ?>
</h1>

<div class="row g-3">

<!-- LEFT CARD -->

<div class="col-lg-8">

<div class="product-card">

<div class="product-image mb-3">

<?php
if(!empty($gallery)){
$img = wp_get_attachment_image_src($gallery[0],'large');
?>

<img src="<?php echo esc_url($img[0]); ?>">

<?php } ?>

</div>

<div class="product-description">

<?php
echo apply_filters(
'the_content',
$product->get_description()
);
?>

</div>

</div>

</div>

<!-- RIGHT CARD -->

<div class="col-lg-4">

<div class="product-card">

<div class="product-price">

<?php echo $product->get_price_html(); ?>

</div>

<div class="promo-box">

<ul>

<li>Tặng quấn cán miễn phí</li>

<li>Giảm 20% dịch vụ căng dây</li>

<li>Tư vấn chọn vợt theo lối chơi</li>

</ul>

</div>

<?php if($product->is_purchasable() && $product->is_in_stock()): ?>

<form class="cart" method="post" action="<?php echo esc_url(wc_get_cart_url()); ?>">

<?php
woocommerce_quantity_input([
'min_value'=>1,
'max_value'=>$product->get_max_purchase_quantity()
]);
?>

<div class="buy-group">

<button
type="submit"
name="add-to-cart"
value="<?php echo esc_attr($product->get_id()); ?>"
class="add-cart"
>
Thêm giỏ hàng
</button>

<button
type="submit"
name="buy-now"
value="<?php echo esc_attr($product->get_id()); ?>"
class="buy-now"
>
Mua ngay
</button>

</div>

</form>

<?php endif; ?>

<div class="policy-box">

<div>✔ Hàng chính hãng 100%</div>

<div>✔ Bảo hành theo hãng</div>

<div>✔ Hỗ trợ căng dây chuẩn</div>

<div>✔ Giao hàng toàn quốc</div>

</div>

</div>

</div>

</div>

</div>

<script>

document.querySelector('.buy-now')?.addEventListener('click',function(){

document.querySelector('form.cart').action='/cart/?add-to-cart=<?php echo $product->get_id(); ?>';

});

</script>

<?php get_footer(); ?>