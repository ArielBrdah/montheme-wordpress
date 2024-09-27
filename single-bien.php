<?php get_header() ?>


<!-- Article Start -->

<?php if (have_posts()) : ?>

    <?php while (have_posts()): the_post(); ?>
        <img src="<?php the_post_thumbnail_url(); ?>" alt="">
        <h1 class="display-2 fw-bolder mb-4">
            <?php the_title() ?>
        </h1>
        <?php if(get_post_meta(get_the_ID(), 'montheme_sponso', true)): ?>
            <div class="alert alert-primary">
                Cet article est sponsorise
            </div>
        <?php endif; ?>
        <?php the_content() ?>
    <?php endwhile; ?>

<?php else: ?>

    <div>
        Pas d'article 📢
    </div>

<?php endif; ?>

<!-- Article End -->


<?php get_footer() ?>