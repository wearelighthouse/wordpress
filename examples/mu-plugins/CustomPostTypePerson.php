<?php

namespace ProjectName;

class CustomPostTypePerson
{

    /**
     * The name of the custom post type
     *
     * @var string
     */
    private $_name = 'person';

    /**
     * The slug for archive and single
     *
     * @var string
     */
    private $_slug = 'people';

    /**
     * The singular and plural terms for the admin area
     *
     * @var array
     */
    private $_labels = [
        'singular' => 'Person',
        'plural' => 'People'
    ];

    /**
     * The post type supports
     *
     * @var array
     */
    private $_supports = [
        'title',
        'editor',
        'thumbnail'
    ];

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
        add_action('init', [$this, 'registerCustomPostType']);
    }

    /**
     * @return void
     */
    public function registerCustomPostType()
    {
        if (!post_type_exists($this->_name)) {
            register_post_type($this->_name, [
                'label' => $this->_labels['plural'],
                'public' => true,
                'show_ui' => true,
                'show_in_menu' => true,
                'capability_type' => 'post',
                'hierarchical' => false,
                'query_var' => true,
                'has_archive' => true,
                'rewrite' => [
                    'slug' => $this->_slug,
                    'with_front' => false,
                ],
                'supports' => $this->_supports,
                'labels' => [
                    'name' => $this->_labels['plural'],
                    'singular_name' => $this->_labels['singular'],
                    'menu_name' => $this->_labels['plural'],
                    'add_new' => 'Add New',
                    'add_new_item' => 'Add New ' . $this->_labels['singular'],
                    'edit' => 'Edit',
                    'edit_item' => 'Edit ' . $this->_labels['singular'],
                    'new_item' => 'New ' . $this->_labels['singular'],
                    'view' => 'View ' . $this->_labels['singular'],
                    'view_item' => 'View ' . $this->_labels['singular'],
                    'search_items' => 'Search ' . $this->_labels['plural'],
                    'not_found' => 'No ' . $this->_labels['plural'] . ' Found',
                    'not_found_in_trash' => 'No ' . $this->_labels['plural'] . ' Found in Trash',
                    'parent' => 'Parent ' . $this->_labels['singular'],
                ]
            ]);
        }
    }
}
