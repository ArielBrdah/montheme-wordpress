<?php


class SponsoMetabox
{

    const META_KEY = 'montheme_sponso';
    const NONCE = '_montheme_sponso_nonce';

    public static function register()
    {
        add_action('add_meta_boxes', [self::class, 'add'],10,2);
        add_action('save_post', [self::class, 'save']);
    }

    public static function add($postType, $post)
    {
        // security only admin can sponso a post
        if ($postType === 'post' && current_user_can('publish_posts', $post)) {
            add_meta_box(self::META_KEY, 'Sponsoring', [self::class, 'render'], 'post', 'side');
        }
    }
    public static function save($post)
    {
        if (
            array_key_exists(self::META_KEY, $_POST)
            && wp_verify_nonce($_POST[self::NONCE], self::NONCE)
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
