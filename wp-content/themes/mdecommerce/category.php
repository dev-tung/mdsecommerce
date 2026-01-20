<?php
/**
 * The main template file
 *
 * @package YourThemeName
 */

get_header();
?>

<main id="primary" class="site-main container py-4 bg-white my-4">

    <?php if ( have_posts() ) : ?>

        <?php
        // Start the Loop
        while ( have_posts() ) :
            the_post();
        ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class('mb-4'); ?>>
                <h2 class="post-title fs-4">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_title(); ?>
                    </a>
                </h2>

                <div class="post-meta text-muted mb-2">
                    <?php echo get_the_date(); ?> • <?php the_author(); ?>
                </div>

                <div class="post-content">
                    <?php the_excerpt(); ?>
                </div>
            </article>

        <?php endwhile; ?>

        <!-- Pagination -->
        <div class="pagination">
            <?php the_posts_pagination(); ?>
        </div>

    <?php else : ?>

        <p>Không có bài viết nào.</p>

    <?php endif; ?>

</main>

<?php
get_footer();
