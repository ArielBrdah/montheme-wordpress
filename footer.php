</div>
<footer>
 <div class=" container my-5" >
        <div class=" rounded-4 p-4 bg-body-tertiary" style="width:fit-content">
            <div class="display-6 fw-bold my-3">Nos Horaire d'ouverture</div>
            <pre style="word-spacing: 2rem;"><?= get_option('agence_horaire') ?></pre>
        </div>
    </div>
    <div class="bg-body-tertiary p-4">
        <nav class="navbar navbar-expand-lg container">
            <div class="container-fluid">
                <a class=" fw-bolder text-decoration-none text-dark p-5" href="#">
                    <?php bloginfo('name'); ?>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <?php wp_nav_menu(['theme_location' => 'footer', 'container' => false, 'menu_class' => 'navbar-nav me-auto mb-2 mb-lg-0 flex-column fw-bold fs-6']); ?>
                </div>
            </div>
       
        </nav>
    </div>
    
</footer>
<?php wp_footer() ?>
</body>

</html>