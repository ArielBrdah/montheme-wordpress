<?php get_header() ?>

<!-- Title Start -->
<div class="h1 fw-bolder">
    <?php wp_title(); ?>
</div>
<!-- Title End -->


<!-- Article Start -->

<?php if (have_posts()) : ?>

    <?php while (have_posts()): the_post(); ?>
        <img src="<?php the_post_thumbnail_url(); ?>" alt="">
        <h1 class="display-2 fw-bolder mb-4">
            <?php the_title() ?>
        </h1>
        <?php the_content() ?>
    <?php endwhile; ?>

<?php else: ?>

    <div>
        Pas d'article 📢
    </div>

<?php endif; ?>

<!-- Article End -->


<?php get_footer() ?>