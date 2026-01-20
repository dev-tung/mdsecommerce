<?php get_header(); ?>

<!-- ================= SWIPER CSS ================= -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

<style>
/* ================= CARD ================= */
.card {
    border-radius: 0;
    background: #fff;
    border: none;
    transition: .25s;
}
.card:hover {
    transform: translateY(-6px);
    box-shadow: 0 14px 30px rgba(105, 168, 79, .2);
}
.product-img {
    height: 200px;
    object-fit: cover;
}
.card-body h6 {
    font-size: 14px;
    font-weight: 600;
    min-height: 38px;
}

/* ================= PRICE ================= */
.price-old {
    font-size: 13px;
    text-decoration: line-through;
    color: #9ca3af;
}
.price-sale {
    font-size: 15px;
    font-weight: 700;
    color: #dc2626;
}

/* ================= BUTTON ================= */
.btn-buy {
    background: #69A84F;
    border: 1px solid #69A84F;
    color: #fff;
    font-weight: 600;
    border-radius: 0;
}
.btn-buy:hover {
    background: #5c9645;
}

/* ================= GRID ================= */
#productGrid {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 16px;
}

@media (max-width: 1200px) {
    #productGrid { grid-template-columns: repeat(4, 1fr); }
}
@media (max-width: 992px) {
    #productGrid { grid-template-columns: repeat(3, 1fr); }
}
@media (max-width: 576px) {
    #productGrid { grid-template-columns: repeat(2, 1fr); }
}

/* ================= SLIDER ================= */
.slide-content {
    display: grid;
    grid-template-columns: 1fr 1fr;
    align-items: center;
    height: 420px;
}

.slide-text h2 {
    font-size: 36px;
    font-weight: 700;
    margin-bottom: 16px;
}
.slide-text p {
    font-size: 16px;
    color: #4b5563;
    margin-bottom: 24px;
}
.slide-text a {
    padding: 10px 24px;
    background: #69A84F;
    color: #fff;
    font-weight: 600;
    text-decoration: none;
}
.slide-text a:hover {
    background: #5c9645;
}

.slide-image img {
    width: 100%;
    height: 420px;
    object-fit: cover;
}

@media (max-width: 768px) {
    .slide-content {
        grid-template-columns: 1fr;
        height: auto;
    }
    .slide-text {
        padding-bottom: 24px;
        text-align: center;
    }
    .slide-image img {
        height: 260px;
    }
}

/* ================= PAGINATION ================= */
.swiper-pagination-bullet {
    background: #fff;
    opacity: .7;
}
.swiper-pagination-bullet-active {
    width: 30px;
    border-radius: 20px;
    background: #69A84F;
}
</style>

<!-- ================= SLIDER ================= -->
<section class="py-4 bg-white">
    <div class="container">
        <div class="swiper homeSwiper">
            <div class="swiper-wrapper">

                <!-- Slide 1 -->
                <div class="swiper-slide">
                    <div class="slide-content">
                        <div class="slide-text">
                            <h2>Shop Cầu Lông Chính Hãng</h2>
                            <p>Vợt, giày, quần áo và phụ kiện cầu lông chất lượng cao.</p>
                            <a href="/cua-hang">Xem sản phẩm</a>
                        </div>
                        <div class="slide-image">
                            <img src="https://qvbadminton.com/wp-content/uploads/2024/11/alt-lin-dan-thi-dau-voi-phong-thai-tu-tin-0f4668c8.webp" alt="Shop cầu lông">
                        </div>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="swiper-slide">
                    <div class="slide-content">
                        <div class="slide-text">
                            <h2>Ưu Đãi Cầu Lông Mỗi Ngày</h2>
                            <p>Giảm giá vợt cầu lông, giày thi đấu và phụ kiện hot.</p>
                            <a href="/cua-hang">Mua ngay</a>
                        </div>
                        <div class="slide-image">
                            <img src="https://cdn.shopvnb.com/uploads/images/tin_tuc/lindan-vs-lee-chong-wei-top-5-tran-dau-dang-cap-cua-ky-phung-dich-thu-2.webp" alt="Khuyến mãi cầu lông">
                        </div>
                    </div>
                </div>

                <!-- Slide 3 -->
                <div class="swiper-slide">
                    <div class="slide-content">
                        <div class="slide-text">
                            <h2>Đồng Hành Cùng Người Chơi Cầu Lông</h2>
                            <p>Tư vấn chọn vợt phù hợp – giao hàng nhanh toàn quốc.</p>
                            <a href="/cua-hang">Khám phá ngay</a>
                        </div>
                        <div class="slide-image">
                            <img src="https://www.badmintonplanet.com/wp-content/uploads/2016/05/05-13-2016-badminton-news-lee-chong-wei.jpg" alt="Cầu lông chuyên nghiệp">
                        </div>
                    </div>
                </div>

            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>


<!-- ================= PRODUCTS ================= -->
<?php
$args = [
    'post_type'      => 'product',
    'posts_per_page' => 12,
    'meta_query'     => [
        [
            'key'     => '_sale_price',
            'value'   => 0,
            'compare' => '>',
            'type'    => 'NUMERIC'
        ]
    ]
];

$query = new WP_Query($args);

if ($query->have_posts()) :
?>
<section class="py-5">
    <div class="container">
        <h4 class="fw-bold mb-4">Sản phẩm khuyến mãi</h4>

        <div id="productGrid">
            <?php while ($query->have_posts()) : $query->the_post();
                $product = wc_get_product(get_the_ID());
                if (!$product) continue;

                $image_url = get_the_post_thumbnail_url(get_the_ID(), 'woocommerce_thumbnail') ?: wc_placeholder_img_src();
            ?>
            <div class="card h-100">
                <img src="<?php echo esc_url($image_url); ?>" class="product-img" alt="<?php the_title(); ?>">

                <div class="card-body text-center d-flex flex-column">
                    <h6><?php the_title(); ?></h6>

                    <?php if ($product->get_regular_price()) : ?>
                        <div class="price-old">
                            <?php echo wc_price($product->get_regular_price()); ?>
                        </div>
                    <?php endif; ?>

                    <div class="price-sale mb-2">
                        <?php echo wc_price($product->get_sale_price()); ?>
                    </div>

                    <a href="<?php the_permalink(); ?>" class="btn btn-buy btn-sm mt-auto">
                        Xem chi tiết
                    </a>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>
<?php
endif;
wp_reset_postdata();
?>

<!-- ================= SWIPER JS ================= -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
new Swiper('.homeSwiper', {
    loop: true,
    autoplay: {
        delay: 3000,
        disableOnInteraction: false
    },
    pagination: {
        el: '.swiper-pagination',
        clickable: true
    }
});
</script>

<?php get_footer(); ?>
