<?php

namespace ProjectName;

/**
 * Show on filter to be used with CM2
 *
 * Allows you to only show a meta box based on page slug
 *
 * ...
 * 'show_on' => [
 *     'key' => 'slug',
 *     // @param string|array The slugs to check against
 *     'value' => 'about'
 * ],
 * ...
 */
class ShowOnSlugFilter
{

    /**
     * @return void
     */
    public function __construct()
    {
        $this->registerHooks();
    }

    /**
     * @return void
     */
    public function registerHooks()
    {
        add_action('cmb2_show_on', [$this, 'showOn']);
    }

    /**
     * @return void
     */
    public function showOn($display, $metaBox)
    {
        if (!isset($metaBox['show_on']['key'], $metaBox['show_on']['value'])) {
            return $display;
        }

        if ($metaBox['show_on']['key'] !== 'slug') {
            return $display;
        }

        $postId = 0;

        if (isset($_GET['post'])) {
            $postId = $_GET['post'];
        } elseif (isset($_POST['post_ID'])) {
            $postId = $_POST['post_ID'];
        }

        if (!$postId) {
            return $display;
        }

        return in_array(get_post($postId)->post_name, (array)$metaBox['show_on']['value']);
    }
}
