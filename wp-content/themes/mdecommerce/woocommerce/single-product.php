<?php get_header(); ?>

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

        <div class="col-12 col-md-6">
          <div class="zoom-box ratio ratio-1x1">
            <img
              src="https://images.unsplash.com/photo-1600185365926-3a2ce3cdb9eb"
              alt="Barricade 14"
              loading="lazy"
            >
          </div>
        </div>

        <div class="col-12 col-md-6">
          <div class="zoom-box ratio ratio-1x1">
            <img
              src="https://images.unsplash.com/photo-1600180758890-6b94519a8ba6"
              alt="Barricade 14"
              loading="lazy"
            >
          </div>
        </div>

        <div class="col-12 col-md-6">
          <div class="zoom-box ratio ratio-1x1">
            <img
              src="https://images.unsplash.com/photo-1600185365483-26d7a4cc7519"
              alt="Barricade 14"
              loading="lazy"
            >
          </div>
        </div>

        <div class="col-12 col-md-6">
          <div class="zoom-box ratio ratio-1x1">
            <img
              src="https://images.unsplash.com/photo-1549298916-b41d501d3772"
              alt="Barricade 14"
              loading="lazy"
            >
          </div>
        </div>

      </div>
    </div>

    <!-- =====================
         INFO SECTION (3/12)
    ====================== -->
    <div class="col-lg-3 mt-4 mt-lg-0">
      <!-- ⚠️ PX-2 mobile = PX-2 ảnh → THẲNG HÀNG -->
      <div class="position-sticky py-4 px-4 bg-white" style="top:80px;">

        <p class="text-uppercase fw-semibold small mb-2">Tennis Shoes</p>

        <h1 class="fw-bold mb-3">Barricade 14</h1>

        <p class="fw-bold fs-5 mb-4">4.200.000₫</p>

        <div class="text-muted mb-4">
          Thiết kế tối ưu độ ổn định, kiểm soát và độ bền,
          phù hợp cho người chơi baseline cường độ cao.
        </div>

        <div class="text-muted mb-4">
          Thiết kế tối ưu độ ổn định, kiểm soát và độ bền,
          phù hợp cho người chơi baseline cường độ cao.
        </div>

        <div class="text-muted mb-4">
          Thiết kế tối ưu độ ổn định, kiểm soát và độ bền,
          phù hợp cho người chơi baseline cường độ cao.
        </div>

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
