<?php get_header() ?>


<h1 class="display-2 fw-bolder my-3">Voir tous nos bien</h1>

<!-- Articles Start -->

<?php if (have_posts()) : ?>

    <div class="row d-flex align-items-center justify-content-stretch" style="height: 600px;">
        <?php while (have_posts()): the_post(); ?>
            <div class="col-12 col-md-4 col-lg-3 ">
                <?php require('partials/post.php'); ?>
            </div>

        <?php endwhile; ?>
    </div>

<?php else: ?>

    <div>
        Pas de bien📢
    </div>

<?php endif; ?>

<!-- Articles End -->

<!-- Pagination -->
<?= montheme_pagination(); ?>
<!-- Pagination -->

<?php get_footer() ?>