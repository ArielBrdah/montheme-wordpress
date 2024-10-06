<?php get_header() ?>


<!-- Article Start -->

<?php if (have_posts()) : ?>

    <?php while (have_posts()): the_post(); ?>


    <div class="mb-3 w-100 overflow-hidden position-relative" style="max-height: 300px;height: 300px; min-width: 100%;">
        <img class="position-absolute" style="transform: translate(-50px, -356px);object-fit: cover!important; width: 100%!important; object-position: center;" src="<?php the_post_thumbnail_url(); ?>" alt="">
    </div>
    <div class="container row g-5">
        <div class="col-md-8">
          <h3 class="pb-4 mb-4 fst-italic border-bottom">
            <?php the_title();  ?>
          </h3>
    
        <?php if (get_post_meta(get_the_ID(), 'montheme_sponso', true)): ?>
            <div class="alert alert-primary">
                Cet article est sponsorise
            </div>
        <?php endif; ?>

      <article class="blog-post">
        <h2 class="display-5 link-body-emphasis mb-1">
            <?php the_title();  ?>
        </h2>
        <p class="blog-post-meta">
            <?php the_content(); ?>
        </p>
     </article>

      <nav class="blog-pagination" aria-label="Pagination">
        <a class="btn btn-outline-primary rounded-pill" href="#">Older</a>
        <a class="btn btn-outline-secondary rounded-pill disabled" aria-disabled="true">Newer</a>
      </nav>

    </div>

    <div class="col-md-4">
      <div class="position-sticky" style="top: 2rem;">
        <div class="p-4 mb-3 bg-body-tertiary rounded">
          <h4 class="fst-italic">A propos</h4>
          <p class="mb-0">Je m'appel Ariel, Developpeur full stack depuis plus de 3 ans.</p>
        </div>

        <div>
          <h4 class="fst-italic">Recent posts</h4>
          <ul class="list-unstyled">
            <?= get_sidebar('homepage'); ?> 
          </ul>
        </div>

    
      </div>
    </div>
  </div>



<?php
if (comments_open() || get_comments_number()) {
    comments_template();
}
?>




        <!-- Article Relatif  -->
        <div id="articles-relatif" class="my-5">

            <div class="row">
                <div class="title h3">
                    Articles relatif
                </div>
                <?php
                $query = new WP_Query([
                    'post__not_in' => [get_the_ID()],
                    'post_type' => 'post',
                    'posts_per_page' => 3,
                    'orderby' => 'rand',
                    'tax_query' => [
                        [
                            'taxonomy' => 'sport',
                            'field' => 'slug',
                            'terms' => 'foot'
                        ]
                    ]
                ]);
                while ($query->have_posts()): $query->the_post();
                ?>

                    <div class="col-sm-4">
                        <?php get_template_part('partials/post', 'post'); ?>
                    </div>

                <?php endwhile;
                wp_reset_postdata(); ?>
            </div>
        </div>
        <!-- Article Relatif  -->



    <?php endwhile; ?>

<?php else: ?>

    <div>
        Pas d'article 📢
    </div>

<?php endif; ?>

<!-- Article End -->


<?php get_footer() ?>