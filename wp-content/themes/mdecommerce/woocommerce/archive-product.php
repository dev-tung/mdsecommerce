<?php get_header(); ?>

<style>
/* ================= CARD ================= */
.card{
    border-radius:0;
    background:#fff;
    transition:.25s;
    border:none;
}
.card:hover{
    transform:translateY(-6px);
    box-shadow:0 14px 30px rgba(105,168,79,.2);
}
.product-img{
    height:200px;
    object-fit:cover;
    border-radius:0;
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
aside .bg-white{
    border-radius:0!important;
}
aside .list-group-item{
    border:none;
    cursor:pointer;
    padding:8px 10px;
    border-radius:0;
}
aside .list-group-item.active{
    background:#69A84F;
    color:#fff;
}

/* FIX BO GÓC LIST-GROUP */
.list-group,
.list-group-item,
.list-group-item:first-child,
.list-group-item:last-child,
.list-group-item.active{
    border-radius:0!important;
}

/* ================= FILTER BAR ================= */
.filter-bar input,
.filter-bar select{
    height:38px;
    border-radius:0;
}

/* ================= MOBILE ================= */
@media(max-width:768px){
    aside{order:2;}
    .col-md-9{order:1;}
    .product-img{height:160px;}

    .filter-bar{
        flex-wrap:wrap;
        gap:10px;
    }

    /* 2 cột sản phẩm */
    #productGrid{
        grid-template-columns:repeat(2,1fr);
        gap:12px;
    }
}

/* Ẩn sidebar desktop trên mobile */
@media (max-width:768px){
    .sidebar-desktop{display:none;}
}

/* Select danh mục mobile */
.category-mobile{
    display:none;
}
@media(max-width:768px){
    .category-mobile{
        display:block;
        border-radius:0;
    }
}

/* ================= FIX OVERFLOW MOBILE ================= */
@media (max-width:768px){

    /* chống tràn ngang toàn trang */
    body{
        overflow-x:hidden;
    }

    /* grid luôn fit container */
    #productGrid{
        width:100%;
        max-width:100%;
        grid-template-columns:repeat(2,minmax(0,1fr));
    }

    /* item không được vượt cột */
    .product-item,
    .card{
        width:100%;
        max-width:100%;
        box-sizing:border-box;
    }

    /* ảnh không làm bung cột */
    .product-img{
        width:100%;
        max-width:100%;
        display:block;
    }

    /* container bootstrap không đẩy width */
    .container,
    .row{
        overflow-x:hidden;
    }
}

/* ================= MOBILE FILTER FIX FINAL ================= */
@media (max-width:768px){

    .filter-bar{
        display:flex;
        flex-wrap:wrap;
        gap:8px;
    }

    /* search full dòng */
    #searchInput{
        flex:0 0 100%;
        width:100% !important;
    }

    /* ép sort + price chung 1 dòng */
    #sortSelect,
    #priceDropdown{
        flex:0 0 50%;
        max-width:50%;
        width:50% !important;
    }

    /* ĐÈ CHẾT w-auto bootstrap */
    .filter-bar .w-auto{
        width:50% !important;
    }

    /* reset min-width bootstrap */
    .filter-bar select{
        min-width:0 !important;
    }
}

/* ================= MOBILE FILTER GRID FIX (FINAL) ================= */
@media (max-width:768px){

    /* chuyển filter-bar sang GRID */
    .filter-bar{
        display:grid !important;
        grid-template-columns:1fr 1fr;
        gap:8px;
        width:100%;
    }

    /* search chiếm trọn 1 dòng */
    #searchInput{
        grid-column:1 / -1;
        width:100% !important;
    }

    /* sort + price mỗi cái 1 cột */
    #sortSelect,
    #priceDropdown{
        width:100% !important;
        max-width:100%;
        min-width:0 !important;
    }
}


</style>

<section class="py-4">
<div class="container">
<div class="row g-4">

<!-- ================= SIDEBAR DESKTOP ================= -->
<aside class="col-md-3 sidebar-desktop">
<div class="bg-white p-3 shadow-sm">
    <h6 class="fw-bold mb-3">Danh mục</h6>
    <ul class="list-group" id="categoryFilter">
        <li class="list-group-item active" data-category="all">Tất cả</li>
        <?php
        $terms = get_terms([
            'taxonomy'   => 'product_cat',
            'hide_empty' => true,
        ]);

        if($terms && !is_wp_error($terms)):
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

<!-- ================= PRODUCTS ================= -->
<div class="col-md-9">

<!-- ================= CATEGORY MOBILE ================= -->
<select id="categoryMobile" class="form-select mb-3 category-mobile">
    <option value="all">Tất cả danh mục</option>
    <?php
    if($terms && !is_wp_error($terms)):
        foreach($terms as $t):
            if(in_array($t->slug,['uncategorized','cuoc-cuon','cuoc-vi'])) continue;
    ?>
        <option value="<?= esc_attr($t->slug); ?>">
            <?= esc_html($t->name); ?>
        </option>
    <?php endforeach; endif; ?>
</select>

<!-- ================= FILTER BAR ================= -->
<div class="d-flex align-items-center mb-3 gap-3 filter-bar">
    <input id="searchInput" class="form-control w-100" placeholder="Tìm theo sản phẩm...">

    <select id="sortSelect" class="form-select w-auto">
        <option value="">Sắp xếp</option>
        <option value="price-asc">Giá thấp → cao</option>
        <option value="price-desc">Giá cao → thấp</option>
    </select>

    <select id="priceDropdown" class="form-select w-auto">
        <option value="">Tất cả giá</option>
        <option value="0-1000000">Dưới 1 triệu</option>
        <option value="1000000-2000000">1 - 2 triệu</option>
        <option value="2000000-3000000">2 - 3 triệu</option>
        <option value="3000000-10000000">Trên 3 triệu</option>
    </select>
</div>

<div id="productGrid">
<?php
$q = new WP_Query([
    'post_type'      => 'product',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'tax_query'      => [
        [
            'taxonomy' => 'product_cat',
            'field'    => 'slug',
            'terms'    => ['cuoc-cuon','cuoc-vi'],
            'operator' => 'NOT IN'
        ]
    ]
]);

while($q->have_posts()): $q->the_post();
global $product;
if(!$product) continue;

$regular = (int)$product->get_regular_price();
$sale    = (int)$product->get_sale_price();
$price   = $sale ?: $regular;

$terms_p = get_the_terms(get_the_ID(), 'product_cat');
$slugs = [];

if ($terms_p && !is_wp_error($terms_p)) {
    // lấy category sâu nhất
    usort($terms_p, function ($a, $b) {
        return $b->parent - $a->parent;
    });

    foreach ($terms_p as $t) {
        if (!in_array($t->slug, ['uncategorized','cuoc-cuon','cuoc-vi'])) {
            $slugs[] = $t->slug;
            break; // CHỈ LẤY 1 category CHÍNH
        }
    }
}


$image = has_post_thumbnail()
    ? get_the_post_thumbnail_url(get_the_ID(),'medium')
    : wc_placeholder_img_src();
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

            <a href="<?= esc_url(get_permalink()); ?>" class="btn btn-buy btn-sm w-100 mt-auto">
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
const priceDropdown=document.getElementById('priceDropdown');
const categoryMobile=document.getElementById('categoryMobile');

function applyFilter(){
    const active = document.querySelector('#categoryFilter .active').dataset.category;
    const key = search.value.toLowerCase();

    let min = 0, max = 10000000;
    if(priceDropdown.value){
        [min, max] = priceDropdown.value.split('-').map(Number);
    }

    let filtered = items.filter(p => {
        const price = parseInt(p.dataset.price);
        const category = p.dataset.category;

        return (
            (active === 'all' || category === active) &&
            p.querySelector('h6').textContent.toLowerCase().includes(key) &&
            price >= min && price <= max
        );
    });

    if(sort.value === 'price-asc') filtered.sort((a,b)=>a.dataset.price-b.dataset.price);
    if(sort.value === 'price-desc') filtered.sort((a,b)=>b.dataset.price-a.dataset.price);

    grid.innerHTML = '';
    filtered.forEach(i => grid.appendChild(i));
}


cats.forEach(c=>c.onclick=()=>{
    cats.forEach(i=>i.classList.remove('active'));
    c.classList.add('active');
    applyFilter();
});

if(categoryMobile){
    categoryMobile.onchange=()=>{
        cats.forEach(i=>i.classList.remove('active'));
        const val=categoryMobile.value;
        const target=[...cats].find(i=>i.dataset.category===val);
        if(target) target.classList.add('active');
        applyFilter();
    };
}

search.oninput=applyFilter;
sort.onchange=applyFilter;
priceDropdown.onchange=applyFilter;
applyFilter();
});
</script>

<?php get_footer(); ?>
