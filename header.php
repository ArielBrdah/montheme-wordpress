<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Site</title>
    <?php wp_head() ?>
</head>

<body>

    <nav class="navbar navbar-dark bg-dark navbar-expand-lg bg-body-dark p-4 px-5 ">
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

        <form class="d-flex my-2 my-lg-0">
            <input type="search" class="form-control me-sm-2 rounded-0" name="Search"  aria-label="Search">
            <button type="submit" class="btn btn-outline-primary d-inline my-2 my-sm-0 rounded-0">Search</button>
        </form>
    </nav>
    <div class="container">