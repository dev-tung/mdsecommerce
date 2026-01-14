<?php
get_header();

$args = [
    'post_type'      => 'product',
    'posts_per_page' => -1,

    /* SORT GIÁ THẤP → CAO */
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
/* ===== WRAPPER (GIỐNG .content TRANG SINGLE) ===== */
.product-wrapper{
    background:#fff;
    font-size:0.95rem;   /* body */
    line-height:1.8;
}

/* ===== TIÊU ĐỀ BẢNG (H1) ===== */
.product-wrapper > h1{
    font-size:1.8rem;    /* giống h1 single */
    font-weight:600;
    margin-bottom:1.5rem;
}

/* ===== CARD ===== */
.product-item{
    background:#fff;
    border:1px solid rgba(0,0,0,.08);
    border-radius:0;
}

/* CARD BODY */
.product-item .card-body{
    padding:8px 12px;
}

/* ===== TITLE SẢN PHẨM (≈ h3 SINGLE) ===== */
.product-title{
    color:#111;
    font-size:0.95rem;   /* = .content h3 */
    line-height:1.4;
    text-decoration:none;
}
.product-title:hover{
    text-decoration:underline;
}

/* ===== GIÁ ===== */
.product-price{
    color:#111;
    font-size:0.95rem;   /* body */
    white-space:nowrap;
}

/* ===== SAO ===== */
.star{
    color:#69A84F;
    font-size:0.9rem;
    line-height:1;
}

/* ===== MOBILE ===== */
@media (max-width:576px){
/* ===== TIÊU ĐỀ BẢNG (H1) ===== */
    .product-wrapper > h1{
        font-size:1.8rem;    /* giống h1 single */
        font-weight:600;
        margin-bottom:1.5rem;
    }

    .product-wrapper{
        font-size:0.95rem;
    }

    .product-wrapper > h1{
        font-size:1.1rem;
    }

    .product-title{
        font-size:0.95rem; /* giữa h3 & h4 */
    }

    .product-item .card-body{
        padding:6px 10px;
    }
}
</style>



<div class="container my-5">
<?php if ($query->have_posts()) : ?>
    <div class="product-wrapper p-4">
        <h1 class="text-center mb-4">
            BẢNG GIÁ CĂNG CƯỚC VỢT CẦU LÔNG
        </h1>

        <div class="row g-3">
        <?php while ($query->have_posts()) : $query->the_post(); ?>
            <?php $product = wc_get_product(get_the_ID()); ?>

            <!-- 3 CỘT -->
            <div class="col-12 col-sm-6 col-md-4">
                <div class="card product-item">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-2">
                            <span class="star">★</span>
                            <a href="<?php the_permalink(); ?>" class="product-title">
                                <?php the_title(); ?>
                            </a>
                        </div>

                        <span class="product-price">
                            <?php echo $product ? $product->get_price_html() : ''; ?>
                        </span>
                    </div>
                </div>
            </div>

        <?php endwhile; ?>
        </div>
    </div>
<?php else : ?>
    <p class="text-center">Không có sản phẩm</p>
<?php endif; ?>
</div>

<?php
wp_reset_postdata();
get_footer();
