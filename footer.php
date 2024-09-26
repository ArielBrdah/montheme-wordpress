</div>
<footer>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class=" fw-bolder display-3 text-decoration-none text-warning p-5" href="#">
                <?php bloginfo('name'); ?>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <?php wp_nav_menu(['theme_location' => 'footer', 'container' => false, 'menu_class' => 'navbar-nav me-auto mb-2 mb-lg-0 flex-column fw-bold fs-5']); ?>
            </div>
        </div>
    </nav>
</footer>
<?php wp_footer() ?>
</body>
</html>