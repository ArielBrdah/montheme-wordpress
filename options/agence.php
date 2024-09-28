<?php

class AgenceMenuPage
{
    const GROUP = "agence_options";
    public static function register()
    {
        add_action('admin_menu', [self::class, 'addMenu']);
        add_action('admin_init', [self::class, 'registerSettings']);
        add_action('admin_enqueue_scripts', [self::class, 'registerScripts']);
    }

    public static function registerScripts()
    {
        wp_register_style('flatpickr', 'https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css', [], false);
        wp_register_script('flatpickr', 'https://cdn.jsdelivr.net/npm/flatpickr', [], false, true);
        wp_enqueue_script('montheme_admin', get_template_directory_uri() . '/assets/admin.js', ['flatpickr'], false, true);
        wp_enqueue_style('flatpickr');
    }

    public static function registerSettings()
    {
        register_setting(self::GROUP, 'agence_horaire');
        register_setting(self::GROUP, 'agence_date');
        add_settings_section('agence_option_section', 'Parametre', function () {
?>
            <div>Vous pouvez ici gerez les parametres concernant votre agence immobiliere</div>
        <?php
        }, self::GROUP);

        add_settings_section('agence_option_horaire', 'Horraire d\'ouverture', function () {
        ?>
            <textarea name="agence_horaire" cols="30" rows="10" style="width: 100%"><?= esc_html(get_option('agence_horaire')); ?></textarea>
        <?php
        }, self::GROUP, 'agence_options_section');

        add_settings_section('agence_option_date', 'Date d\'ouverture', function () {
        ?>
            <input type="text" class="montheme_datepicker" name="agence_date" value="<?php get_option('agence_date'); ?>" />
        <?php
        }, self::GROUP, 'agence_options_section');
    }
    public static function addMenu()
    {
        add_options_page(
            "Getion de l'agence",
            "Agence",
            "manage_options",
            self::GROUP,
            [self::class, "render"]
        );
    }
    public static function render()
    {

        ?>
        <h1>Horraire d'ouverture de l'agence</h1>
        <form action="options.php" method="POST">
            <?php settings_fields(self::GROUP) ?>
            <?php do_settings_sections(self::GROUP) ?>
            <?php submit_button() ?>
        </form>
<?php
    }
}
