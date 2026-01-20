<?php
get_header();

$args = [
    'post_type'      => 'product',
    'posts_per_page' => -1,

    // SORT GIÁ THẤP → CAO
    'meta_key'       => '_price',
    'orderby'        => 'meta_value_num',
    'order'          => 'ASC',

    'tax_query'      => [
        [
            'taxonomy' => 'product_cat',
            'field'    => 'slug',
            'terms'    => ['cuoc-vi', 'cuoc-cuon'],
            'operator' => 'IN',
        ]
    ],
];

$query = new WP_Query($args);
?>

<style>
.product-wrapper{
    background:#fff;
    font-size:0.95rem;
    line-height:1.8;
}

.product-wrapper > h1{
    font-size:1.8rem;
    font-weight:600;
    margin-bottom:1.5rem;
}

.product-item{
    background:#fff;
    border:1px solid rgba(0,0,0,.08);
    border-radius:0;
}

.product-item .card-body{
    padding:8px 12px;
}

.product-title{
    color:#111;
    font-size:1rem;
    line-height:1.4;
    text-decoration:none;
}
.product-title:hover{
    text-decoration:underline;
}

.product-price{
    color:#111;
    font-size:1rem;
    white-space:nowrap;
}

.star{
    color:#69A84F;
    font-size:1rem;
    line-height:1;
}

@media (max-width:576px){
    .product-wrapper > h1{
        font-size: 1.3rem;
    }

    .product-title{
        font-size:0.9rem;
    }

    .product-price{
        font-size:0.9rem;
    }

    .star{
        font-size:0.9rem;
    }
}
</style>

<div class="container-fluid p-lg-4 p-2">
<?php if ($query->have_posts()) : ?>

<?php
/* ===============================
   1. LẤY DỮ LIỆU + LOẠI TITLE TRÙNG
   =============================== */
$items = [];
$rendered_titles = [];

while ($query->have_posts()) {
    $query->the_post();
    $title = get_the_title();

    if (in_array($title, $rendered_titles)) {
        continue; // bỏ title trùng
    }

    $rendered_titles[] = $title;

    $items[] = [
        'id'    => get_the_ID(),
        'title' => $title,
        'link'  => get_permalink(),
        'price' => wc_get_product(get_the_ID())?->get_price_html(),
    ];
}

/* ===============================
   2. CHIA THEO CỘT (GIÁ TĂNG DẦN DỌC)
   =============================== */
$columns = 3;
$total   = count($items);
$perCol  = ceil($total / $columns);
$chunked = array_chunk($items, $perCol);
?>

<div class="product-wrapper p-4">
    <h1 class="text-center mb-4">
        Bảng giá căng cước vợt cầu lông
    </h1>

    <div class="row g-3">
        <?php foreach ($chunked as $col) : ?>
            <div class="col-12 col-sm-6 col-md-4 d-flex flex-column gap-3">
                <?php foreach ($col as $item) : ?>
                    <div class="card product-item">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center gap-2">
                                <span class="star">★</span>
                                <a href="<?= esc_url($item['link']); ?>" class="product-title">
                                    <?= esc_html($item['title']); ?>
                                </a>
                            </div>
                            <span class="product-price">
                                <?= $item['price']; ?>
                            </span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php else : ?>
    <p class="text-center">Không có sản phẩm</p>
<?php endif; ?>
</div>

<?php
wp_reset_postdata();
get_footer();
