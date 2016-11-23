<?php

namespace ProjectName;

class PersonPostType
{

    /**
     * The name of the post type
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
        'plural' => 'People',
        'singular' => 'Person'
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
        add_action('init', [$this, 'registerPostType'], 998);
    }

    /**
     * @return void
     */
    public function registerPostType()
    {
        if (!post_type_exists($this->_name)) {
            register_post_type($this->_name, [
                'has_archive' => true,
                'hierarchical' => false,
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
                ],
                'public' => true,
                'rewrite' => [
                    'slug' => $this->_slug,
                    'with_front' => false,
                ],
                'supports' => $this->_supports
            ]);
        }
    }
}
