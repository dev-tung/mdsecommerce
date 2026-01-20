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

                    <div class="col-12 col-md-3">
                        <h5 class="footer-brand">Manh Dung Sports</h5>
                        <a class="footer-desc d-block small text-decoration-none mb-2">Địa chỉ vòng xuyến Văn Giang Ecopark</a>
                        <a class="footer-desc d-block small text-decoration-none mb-2">Mã số DN 0901190162</a>
                        <a class="footer-desc d-block small text-decoration-none mb-2">Người đại diện Đỗ Sơn Tùng</a>
                        <img
                            src="<?php echo get_template_directory_uri(); ?>/assets/img/bct.png"
                            class="bct-img mb-2 w-50"
                        />
                    </div>


                    <div class="col-12 col-md-2">
                        <h6 class="footer-title">Liên kết</h6>
                        <a href="/" class="footer-link d-block small mb-2">Trang chủ</a>
                        <a href="/shop" class="footer-link d-block small mb-2">Cửa hàng</a>
                        <a href="/string" class="footer-link d-block small mb-2">Căng cước</a>
                        <a href="/ctv" class="footer-link d-block small">Cộng tác viên</a>
                    </div>

                    <div class="col-12 col-md-2">
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
                    <!-- Google Map -->
                    <div class="col-12 col-md-3">
                        <h6 class="footer-title">Bản đồ cửa hàng</h6>

                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3726.1301894345106!2d105.93952307625392!3d20.947286290570084!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135afcc68063b9f%3A0x5b21b9e15c97cfa!2zQ-G6p3UgbMO0bmcgTeG6oW5oIETFqW5nIChNRCBCQURNSU5UT04gU0hPUCk!5e0!3m2!1sen!2s!4v1768876714999!5m2!1sen!2s" width="100%" height="220" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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
