<?php
defined( 'ABSPATH' ) || exit;
get_header();

// LUÔN khởi tạo product đúng chuẩn
$product = wc_get_product( get_the_ID() );
if ( ! $product ) return;
?>

<style>
/* =====================
   IMAGE ZOOM (DESKTOP)
====================== */
.zoom-box {
  overflow: hidden;
  background: #f5f5f5;
  cursor: zoom-in;
}

.zoom-box img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform .2s ease;
  transform-origin: center;
}

.zoom-box:hover img {
  transform: scale(1.9);
}

/* =====================
   MOBILE FIXES
====================== */
@media (max-width: 991px) {
  .zoom-box {
    cursor: default;
  }

  .zoom-box:hover img {
    transform: none;
  }

  .position-sticky {
    position: static !important;
  }
}
</style>

<div class="container-fluid p-lg-4 p-2">
  <div class="row gx-2">

    <!-- =====================
         IMAGE SECTION (9/12)
    ====================== -->
    <div class="col-lg-9">
      <div class="row g-2">

        <?php
        // Lấy ảnh gallery + ảnh đại diện
        $gallery_ids = $product->get_gallery_image_ids();
        $main_image  = $product->get_image_id();

        if ( $main_image ) {
          array_unshift( $gallery_ids, $main_image );
        }

        // Nếu không có ảnh
        if ( empty( $gallery_ids ) ) :
        ?>
          <div class="col-12">
            <img src="<?php echo wc_placeholder_img_src(); ?>" class="img-fluid">
          </div>
        <?php
        endif;

        foreach ( $gallery_ids as $image_id ) :
          $img = wp_get_attachment_image_src( $image_id, 'large' );
          if ( ! $img ) continue;
        ?>
          <div class="col-12 col-md-6">
            <div class="zoom-box ratio ratio-1x1">
              <img
                src="<?php echo esc_url( $img[0] ); ?>"
                alt="<?php the_title_attribute(); ?>"
                loading="lazy"
              >
            </div>
          </div>
        <?php endforeach; ?>

      </div>
    </div>

    <!-- =====================
         INFO SECTION (3/12)
    ====================== -->
    <div class="col-lg-3 mt-4 mt-lg-0">
      <div class="position-sticky py-4 px-4 bg-white" style="top:80px;">

        <!-- CATEGORY -->
        <p class="text-uppercase fw-semibold small mb-2">
          <?php
          echo wp_strip_all_tags(
            wc_get_product_category_list( $product->get_id() )
          );
          ?>
        </p>

        <!-- TITLE -->
        <h1 class="fw-bold mb-3 fs-3">
          <?php the_title(); ?>
        </h1>

        <!-- PRICE -->
        <p class="fs-5 mb-4 text-danger fw-bold">
          <?php echo $product->get_price_html(); ?>
        </p>

        <!-- SHORT DESCRIPTION -->
        <?php if ( $product->get_description() ) : ?>
          <div class="text-muted mb-4 small">
            <?php
            echo apply_filters(
              'the_content',
              $product->get_description()
            );
            ?>
          </div>
        <?php endif; ?>


      </div>
    </div>

  </div>
</div>

<!-- =====================
     JS: ZOOM FOLLOW CURSOR
====================== -->
<script>
document.querySelectorAll('.zoom-box').forEach(box => {
  const img = box.querySelector('img');

  box.addEventListener('mousemove', e => {
    const r = box.getBoundingClientRect();
    const x = ((e.clientX - r.left) / r.width) * 100;
    const y = ((e.clientY - r.top) / r.height) * 100;
    img.style.transformOrigin = `${x}% ${y}%`;
  });

  box.addEventListener('mouseleave', () => {
    img.style.transformOrigin = 'center';
  });
});
</script>

<?php get_footer(); ?>
