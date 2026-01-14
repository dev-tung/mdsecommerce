<style>
    /* ===== FOOTER ===== */
    .footer-sport {
        background-color: #f8f9fa;
        border-top: 1px solid #e5e5e5;

        /* shadow chỉ lên trên */
        box-shadow: 0 -8px 16px -8px rgba(0, 0, 0, 0.08);
        min-height: 
    }


    .footer-title {
        color: #333;
        font-weight: 600;
    }

    .footer-brand {
        font-weight: 700;
        color: #111;
    }

    .footer-desc,
    .footer-text {
        color: #666;
    }

    .footer-link {
        color: #555;
        text-decoration: none;
    }

    .footer-link:hover {
        color: #000;
    }

    .footer-divider {
        border-color: #ddd;
    }

    .bct-img {
        max-width: 120px;
    }

    /* ===== MOBILE ===== */
    @media (max-width: 768px) {
        footer,
        * {
            text-align: left !important;
        }
    }

    
</style>

        <footer class="footer-sport pt-5 pb-4">
            <div class="container">

                <div class="row gy-4">

                    <div class="col-12 col-md-4">
                        <h5 class="footer-brand">Manh Dung Sports</h5>
                        <a class="footer-desc d-block small text-decoration-none mb-2">Địa chỉ vòng xuyến Văn Giang Ecopark</a>
                        <a class="footer-desc d-block small text-decoration-none mb-2">Mã số DN 0901190162</a>
                        <a class="footer-desc d-block small text-decoration-none mb-2">Người đại diện Đỗ Sơn Tùng</a>
                        <img
                            src="<?php echo get_template_directory_uri(); ?>/assets/img/bct.png"
                            class="bct-img mb-2 w-25"
                        />
                    </div>


                    <div class="col-12 col-md-3">
                        <h6 class="footer-title">Liên kết</h6>
                        <a href="/" class="footer-link d-block small mb-2">Trang chủ</a>
                        <a href="/shop" class="footer-link d-block small mb-2">Cửa hàng</a>
                        <a href="/string" class="footer-link d-block small">Căng cước</a>
                    </div>

                    <div class="col-12 col-md-3">
                        <h6 class="footer-title">Bảo hành</h6>
                        <a class="footer-link d-block small mb-2" href="https://manhdungsports.store/chinh-sach-bao-hanh-vot-cau-long-yonex/" >Vợt Yonex</a>
                        <a class="footer-link d-block small mb-2" href="https://manhdungsports.store/chinh-sach-bao-hanh-vot-cau-long-li-ning/" >Vợt Lining</a>
                    </div>

                    <div class="col-12 col-md-2">
                        <h6 class="footer-title">Mạng xã hội</h6>

                        <a href="https://www.facebook.com/manh.dung.sports/" target="_blank" class="footer-link d-block small mb-2">
                            Facebook
                        </a>

                        <a href="https://zalo.me/0966628838" target="_blank" class="footer-link d-block small mb-2">
                            Zalo
                        </a>

                        <a href="https://www.tiktok.com/@manhdungsports.store" target="_blank" class="footer-link d-block small mb-2">
                            TikTok
                        </a>

                        <a href="https://www.youtube.com/@manhdungsports" target="_blank" class="footer-link d-block small">
                            YouTube
                        </a>
                    </div>

                </div>

                <hr class="footer-divider my-4" />

                <div class="small">
                    © 2026 Manh Dung Sports
                </div>

            </div>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
