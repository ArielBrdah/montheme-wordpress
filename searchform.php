<form class="d-flex my-2 my-lg-0" action="<?= esc_url(home_url('/')) ?>">
    <input value="<?= get_search_query(); ?>" type="search" class="form-control me-sm-2" name="s" aria-label="Search">
    <button type="submit" class="btn btn-outline-primary d-inline my-2 my-sm-0 ">Search</button>
</form>
