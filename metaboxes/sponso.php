<?php


class SponsoMetabox
{

    const META_KEY = 'montheme_sponso';
    const NONCE = '_montheme_sponso_nonce';

    public static function register()
    {
        add_action('add_meta_boxes', [self::class, 'add']);
        add_action('save_post', [self::class, 'save']);
    }

    public static function add()
    {
        add_meta_box(self::META_KEY, 'Sponsoring', [self::class, 'render'], 'post', 'side');
    }
    public static function save($post)
    {
        if (
            wp_verify_nonce($_POST[self::NONCE], self::NONCE) // CSRF TOKEN
            && array_key_exists(self::META_KEY, $_POST) 
            && current_user_can('edit_post', $post)
            ) {
            if ($_POST[self::META_KEY] === '0') {
                delete_post_meta($post, self::META_KEY);
            } else {
                update_post_meta($post, self::META_KEY, 1);
            }
        }
    }
    public static function render()
    {
        $checked = true;
        if (!get_post_meta(get_the_ID(), self::META_KEY, true)) $checked = false;
        wp_nonce_field(self::NONCE, self::NONCE);
?>

        <input type="hidden" name="montheme_sponso" value="0" />
        <input type="checkbox" name="montheme_sponso" value="1" <?= $checked ? 'checked' : '' ?> />
        <label for="monthemesponso">Cet article est sponsorise ?</label>
<?php
    }
}
