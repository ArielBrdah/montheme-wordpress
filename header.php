<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Site</title>
    <?php wp_head() ?>
</head>

<body>

<div class="bg-light">

    <nav class="navbar navbar-light text-dark navbar-expand-lg container p-4 px-5 ">
        <div class="container-fluid">
            <a class="navbar-brand fw-bolder" href="#">
                <?php bloginfo('name'); ?>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <?php wp_nav_menu(['theme_location' => 'header', 'container' => false, 'menu_class' => 'navbar-nav me-auto mb-2 mb-lg-0']); ?>
            </div>
        </div>

      <?= get_search_form() ?> 
    </nav>
</div>
    <div class="container">