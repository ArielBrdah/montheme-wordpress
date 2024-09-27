<?php get_header() ?>


<?php wp_list_categories(['taxonomy' => 'sport', 'title_li'=>'']); ?>

<?php 
    $sports = get_terms(['taxonomy' => 'sport']);
?>

<ul class="nav nav-pills rounded-0 my-4">
<?php foreach ($sports as $sport): ?>
    <li class="nav-item">
        <?= montheme_anchor($sport); ?>
    </li>
<?php endforeach; ?>
</ul>

    <!-- Articles Start -->

    <div class="display-2 fw-bolder text-gray my-4">
        Mes articles
    </div>
     
    <?php if(have_posts()) : ?>

        <div class="row d-flex align-items-center justify-content-stretch" style="height: 600px;">
            <?php while(have_posts()): the_post(); ?>
            <div class="col-12 col-md-4 col-lg-3 " >
               <?php require('partials/post.php'); ?>
            </div>
            
            <?php endwhile; ?>
        </div>

    <?php else: ?>

            <div>
                Pas d'articles 📢
            </div>

    <?php endif; ?>

    <!-- Articles End -->

    <!-- Pagination -->
    <?= montheme_pagination(); ?>

    <!-- Pagination -->

<?php get_footer() ?>