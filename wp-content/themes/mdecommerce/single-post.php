<?php get_header(); ?>
<style>
    /* Giảm font-size toàn bộ nội dung bài viết */
    /* Tiêu đề bài viết */
    h1 {
        font-size: 1.8rem;
    }

    /* Heading trong nội dung */
    .content h2 {
        font-size: 1.3rem;
    }

    .content h3 {
        font-size: 1.15rem;
    }

    .content h4 {
        font-size: 1.05rem;
    }
    
    .content {
        font-size: 0.95rem;
        line-height: 1.8;
    }

    .content p {
        margin-bottom: 1rem;
    }

    .content img {
        max-width: 100%;
        height: auto;
    }

    .content h2,
    .content h3,
    .content h4 {
        margin-top: 2rem;
        margin-bottom: 1rem;
    }
</style>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-12">

            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

                <!-- Wrapper nền trắng -->
                <div class="bg-white p-4">

                    <!-- Tiêu đề -->
                    <h1 class="mb-3"><?php the_title(); ?></h1>

                    <!-- Meta -->
                    <div class="mb-4 text-muted">
                        <?php echo get_the_date(); ?> |
                        <?php the_author(); ?> |
                        <?php the_category(', '); ?>
                    </div>

                    <!-- Ảnh đại diện -->
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="mb-4">
                            <?php the_post_thumbnail('large', [
                                'class' => 'img-fluid'
                            ]); ?>
                        </div>
                    <?php endif; ?>

                    <!-- Nội dung -->
                    <div class="content">
                        <?php the_content(); ?>
                    </div>

                </div>

            <?php endwhile; endif; ?>

        </div>
    </div>
</div>

<?php get_footer(); ?>
