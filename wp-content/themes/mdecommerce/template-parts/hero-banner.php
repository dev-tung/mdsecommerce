<style>
    /* ===== BANNER ===== */
    .banner-img {
        width: 100%;
        height: 360px;
        object-fit: cover;
    }

    @media (max-width: 768px) {
        .banner-img {
            height: 240px;
        }
    }
</style>

<!-- ================= BANNER ================= -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="swiper bannerSwiper">
            <div class="swiper-wrapper">

                <div class="swiper-slide">
                    <div class="row align-items-center g-3">
                        <div class="col-md-6">
                            <h1 class="fw-bold">Shop Cầu Lông Chính Hãng</h1>
                            <p class="lead">Vợt – Giày – Phụ kiện</p>
                            <a href="/shop" class="btn btn-warning">Xem sản phẩm</a>
                        </div>

                        <div class="col-md-6">
                            <img
                                class="banner-img"
                                src="data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='800' height='360'><rect width='100%' height='100%' fill='%23cccccc'/></svg>"
                            />
                        </div>
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="row align-items-center g-3">
                        <div class="col-md-6">
                            <h1 class="fw-bold">Khuyến mãi hấp dẫn</h1>
                            <p class="lead">Giá tốt mỗi ngày</p>
                            <a href="/shop" class="btn btn-warning">Mua ngay</a>
                        </div>

                        <div class="col-md-6">
                            <img
                                class="banner-img"
                                src="data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='800' height='360'><rect width='100%' height='100%' fill='%23cccccc'/></svg>"
                            />
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>


<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    new Swiper(".bannerSwiper", {
        loop: true,
        autoplay: { delay: 4000 },
    });
</script>