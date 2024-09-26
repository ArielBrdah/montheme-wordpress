<?php get_header() ?>

<!-- Articles Start -->

<div class="h2 fw-bolder text-gray">
    Mes articles
</div>

<?php if (have_posts()) : ?>

    <div class="row">
        <?php while (have_posts()): the_post(); ?>
            <div class="col-12 col-md-4 col-lg-3">
                <div class="card shadow border-0" style="width: 18rem;">
                    <?php the_post_thumbnail('medium', ['class' => 'card-img-top', 'alt' => '']); ?>
                    <div class="card-body">
                        <h5 class="card-title"><?php the_title() ?></h5>
                        <p class="text text-muted"><?php the_category() ?></p>
                        <p class="card-text"><?php the_excerpt() ?></p>
                        <a href="<?php the_permalink(); ?>" class="btn btn-link">voir l'article</a>
                    </div>
                </div>
            </div>

        <?php endwhile; ?>
    </div>

<?php else: ?>

    <div>
        Pas d'articles 📢
    </div>

<?php endif; ?>

<!-- Articles End -->


<?php get_footer() ?>