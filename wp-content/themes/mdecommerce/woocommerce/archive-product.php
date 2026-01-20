<?php get_header(); ?>

<style>
/* ================= CARD ================= */
.card{
    border-radius:0;
    background:#fff;
    transition:.25s;
    border:none;
    width:100%;
}
.card:hover{
    transform:translateY(-6px);
    box-shadow:0 14px 30px rgba(105,168,79,.2);
}
.product-img{
    height:200px;
    width:100%;
    object-fit:cover;
}
.card-body h6{
    font-size:14px;
    font-weight:600;
    min-height:38px;
}

/* ================= PRICE ================= */
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

/* ================= BUTTON ================= */
.btn-buy{
    background:#69A84F;
    border:1px solid #69A84F;
    color:#fff;
    font-weight:600;
    border-radius:0;
}
.btn-buy:hover{
    background:#5c9645;
}

/* ================= GRID ================= */
#productGrid{
    display:grid;
    grid-template-columns:repeat(auto-fill,minmax(200px,1fr));
    gap:16px;
}

/* ================= SIDEBAR ================= */
aside .bg-white{border-radius:0;}
aside .list-group-item{
    border:none;
    cursor:pointer;
    padding:8px 10px;
}
aside .list-group-item.active{
    background:#69A84F;
    color:#fff;
}

/* ================= FILTER BAR ================= */
.filter-bar input,
.filter-bar select{
    height:38px;
    border-radius:0;
}

/* ================= MOBILE ================= */
@media (max-width:768px){
    html,body{overflow-x:hidden;}
    .container{padding:0 12px;}
    aside{display:none;}
    .product-img{height:160px;}

    .filter-bar{
        display:flex;
        flex-wrap:wrap;
        gap:8px;
    }

    #searchInput{
        flex:0 0 100%;
        width:100%;
    }

    #mobileCategory{
        flex:0 0 100%;
        width:100%;
    }

    /* FIX CHẮC CHẮN GIÁ + SẮP XẾP 1 HÀNG */
    #priceDropdown,
    #sortSelect{
        flex:0 0 calc(50% - 4px);
        width:calc(50% - 4px);
        min-width:0 !important;
    }

    #productGrid{
        grid-template-columns:repeat(2,minmax(0,1fr));
        gap:10px;
    }
}
</style>

<section class="py-4">
<div class="container">
<div class="row g-4">

<!-- ========== SIDEBAR DESKTOP ========== -->
<aside class="col-md-3">
<div class="bg-white p-3 shadow-sm">
    <h6 class="fw-bold mb-3">Danh mục</h6>
    <ul class="list-group" id="categoryFilter">
        <li class="list-group-item active" data-category="all">Tất cả</li>
        <?php
        $terms = get_terms(['taxonomy'=>'product_cat','hide_empty'=>true]);
        if($terms):
            foreach($terms as $t):
                if(in_array($t->slug,['uncategorized','cuoc-cuon','cuoc-vi'])) continue;
        ?>
        <li class="list-group-item" data-category="<?= esc_attr($t->slug); ?>">
            <?= esc_html($t->name); ?>
        </li>
        <?php endforeach; endif; ?>
    </ul>
</div>
</aside>

<!-- ========== PRODUCTS ========== -->
<div class="col-md-9">

<div class="filter-bar mb-3">
    <input id="searchInput" class="form-control" placeholder="Tìm theo sản phẩm...">

    <!-- MOBILE CATEGORY -->
    <select id="mobileCategory" class="form-select d-md-none">
        <option value="all">Tất cả danh mục</option>
        <?php
        if($terms):
            foreach($terms as $t):
                if(in_array($t->slug,['uncategorized','cuoc-cuon','cuoc-vi'])) continue;
        ?>
        <option value="<?= esc_attr($t->slug); ?>">
            <?= esc_html($t->name); ?>
        </option>
        <?php endforeach; endif; ?>
    </select>

    <select id="priceDropdown" class="form-select">
        <option value="">Tất cả giá</option>
        <option value="0-1000000">Dưới 1 triệu</option>
        <option value="1000000-2000000">1 - 2 triệu</option>
        <option value="2000000-3000000">2 - 3 triệu</option>
        <option value="3000000-10000000">Trên 3 triệu</option>
    </select>

    <select id="sortSelect" class="form-select">
        <option value="">Sắp xếp</option>
        <option value="price-asc">Giá thấp → cao</option>
        <option value="price-desc">Giá cao → thấp</option>
    </select>
</div>

<div id="productGrid">
<?php
$q = new WP_Query(['post_type'=>'product','posts_per_page'=>-1,'post_status'=>'publish']);
while($q->have_posts()): $q->the_post();
global $product;
if(!$product) continue;

$regular=(int)$product->get_regular_price();
$sale=(int)$product->get_sale_price();
$price=$sale?:$regular;

$terms=get_the_terms(get_the_ID(),'product_cat');
$slugs=[];
if($terms){
    foreach($terms as $t){
        if(!in_array($t->slug,['uncategorized','cuoc-cuon','cuoc-vi'])){
            $slugs[]=$t->slug;
        }
    }
}
$image=has_post_thumbnail()?get_the_post_thumbnail_url(get_the_ID(),'medium'):wc_placeholder_img_src();
?>

<div class="product-item"
     data-category="<?= esc_attr(implode('|',$slugs)); ?>"
     data-price="<?= esc_attr($price); ?>">
    <div class="card h-100">
        <img src="<?= esc_url($image); ?>" class="product-img">
        <div class="card-body text-center d-flex flex-column">
            <h6><?= esc_html(get_the_title()); ?></h6>

            <?php if($sale): ?>
                <div class="price-old"><?= wc_price($regular); ?></div>
                <div class="price-sale mb-2"><?= wc_price($sale); ?></div>
            <?php else: ?>
                <div class="price-sale mb-2"><?= wc_price($regular); ?></div>
            <?php endif; ?>

            <a href="<?= esc_url(get_permalink()); ?>" class="btn btn-buy btn-sm mt-auto w-100">
                Xem chi tiết
            </a>
        </div>
    </div>
</div>

<?php endwhile; wp_reset_postdata(); ?>
</div>

</div>
</div>
</div>
</section>

<script>
document.addEventListener("DOMContentLoaded",()=>{
const items=[...document.querySelectorAll('.product-item')];
const grid=document.getElementById('productGrid');
const cats=document.querySelectorAll('#categoryFilter li');
const search=document.getElementById('searchInput');
const sort=document.getElementById('sortSelect');
const price=document.getElementById('priceDropdown');
const mobileCat=document.getElementById('mobileCategory');

function applyFilter(){
    let active='all';
    if(window.innerWidth<=768 && mobileCat){
        active=mobileCat.value;
    }else{
        active=document.querySelector('#categoryFilter .active').dataset.category;
    }

    const key=search.value.toLowerCase();
    let min=0,max=10000000;
    if(price.value){[min,max]=price.value.split('-').map(Number);}

    let filtered=items.filter(p=>{
        const pr=parseInt(p.dataset.price);
        return (
            (active==='all'||p.dataset.category.includes(active)) &&
            p.querySelector('h6').textContent.toLowerCase().includes(key) &&
            pr>=min && pr<=max
        );
    });

    if(sort.value==='price-asc') filtered.sort((a,b)=>a.dataset.price-b.dataset.price);
    if(sort.value==='price-desc') filtered.sort((a,b)=>b.dataset.price-a.dataset.price);

    grid.innerHTML='';
    filtered.forEach(i=>grid.appendChild(i));
}

cats.forEach(c=>c.onclick=()=>{
    cats.forEach(i=>i.classList.remove('active'));
    c.classList.add('active');
    applyFilter();
});

search.oninput=applyFilter;
sort.onchange=applyFilter;
price.onchange=applyFilter;
if(mobileCat) mobileCat.onchange=applyFilter;

applyFilter();
});
</script>

<?php get_footer(); ?>
