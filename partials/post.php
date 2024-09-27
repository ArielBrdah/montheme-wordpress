<!-- 
    Post Component
    Type: Card Article
    Updated: 27.2024
-->
<div class="card shadow border-0" style="width: 18rem; min-height:320px;">
    <?php the_post_thumbnail('card-header', ['class' => 'card-img-top', 'alt' => '']); ?>
    <div class="card-body">
        <h5 class="card-title"><?php the_title() ?></h5>
        <p class="text text-muted"><?php the_category() ?></p>
        <?php the_terms(get_the_ID(), 'sport', '<ul>', '<li></li>', '</ul>'); ?>
        <?= the_excerpt() ?>
        <a href="<?php the_permalink(); ?>" class="btn btn-link">voir l'article</a>
    </div>
</div>