<?php
defined('ABSPATH') || exit;
get_header();
?>

<div class="container my-4 p-4 bg-white rounded">

    <h1 class="mb-4">Liên hệ</h1>

    <!-- Google Maps -->
    <div class="mb-4">
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3726.1301894345106!2d105.93952307625392!3d20.947286290570084!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135afcc68063b9f%3A0x5b21b9e15c97cfa!2zQ-G6p3UgbMO0bmcgTeG6oW5oIETFqW5nIChNRCBCQURNSU5UT04gU0hPUCk!5e0!3m2!1sen!2s!4v1768876714999!5m2!1sen!2s"
            width="100%"
            height="220"
            style="border:0;"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>

    <div class="row">
        <!-- Thông tin liên hệ -->
        <div class="col-md-5 mb-4">
            <h4>Thông tin liên hệ</h4>
            <p><strong>Địa chỉ:</strong> Cầu Lông Mạnh Dũng (MD BADMINTON SHOP)</p>
            <p><strong>Hotline:</strong> <a href="tel:0909123456">09973359165</a></p>
            <p><strong>Email:</strong> <a href="mailto:manhdungsports@gmail.com">manhdungsports@gmail.com</a></p>
            <p><strong>Giờ làm việc:</strong> 8:00 – 21:00 (Tất cả các ngày)</p>
        </div>

        <!-- Form liên hệ -->
        <div class="col-md-7">
            <h4>Gửi liên hệ</h4>

            <form method="post">
                <div class="mb-3">
                    <label class="form-label">Họ và tên *</label>
                    <input type="text" name="contact_name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email *</label>
                    <input type="email" name="contact_email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Số điện thoại</label>
                    <input type="text" name="contact_phone" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Nội dung *</label>
                    <textarea name="contact_message" rows="4" class="form-control" required></textarea>
                </div>

                <button type="submit" name="submit_contact" class="btn btn-primary">
                    Gửi liên hệ
                </button>
            </form>

            <?php
            if (isset($_POST['submit_contact'])) {

                $name    = sanitize_text_field($_POST['contact_name']);
                $email   = sanitize_email($_POST['contact_email']);
                $phone   = sanitize_text_field($_POST['contact_phone']);
                $message = sanitize_textarea_field($_POST['contact_message']);

                $to = get_option('admin_email');
                $subject = 'Liên hệ mới từ website';
                $content = "Họ tên: $name\nEmail: $email\nSĐT: $phone\n\nNội dung:\n$message";

                if (wp_mail($to, $subject, $content)) {
                    echo '<div class="alert alert-success mt-3">Gửi liên hệ thành công. Chúng tôi sẽ phản hồi sớm!</div>';
                } else {
                    echo '<div class="alert alert-danger mt-3">Gửi thất bại. Vui lòng thử lại.</div>';
                }
            }
            ?>
        </div>
    </div>

</div>

<?php get_footer(); ?>
