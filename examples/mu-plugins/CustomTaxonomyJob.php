<?php

namespace ProjectName;

class CustomTaxonomyJob
{

    /**
     * The name of the custom taxonomy
     *
     * @var string
     */
    private $_name = 'job';

    /**
     * The slug for archive and single
     *
     * @var string
     */
    private $_slug = 'jobs';

    /**
     * The singular and plural terms for the admin area
     *
     * @var array
     */
    private $_labels = [
        'plural' => 'Jobs',
        'singular' => 'Job'
    ];

    /**
     * The custom post types that will use this taxonomy
     *
     * @var array
     */
    private $_customPostTypes = [
        'person'
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
        add_action('init', [$this, 'registerTaxonomy'], 999);
    }

    /**
     * @return void
     */
    public function registerTaxonomy()
    {
        if (!taxonomy_exists($this->_name)) {
            register_taxonomy($this->_name, [
                'hierarchical' => false,
                'labels' => [
                    'name' => $this->_labels['plural'],
                    'singular_name' => $this->_labels['singular'],
                    'search_items' => 'Search ' . $this->_labels['plural'],
                    'all_items' => 'All ' . $this->_labels['plural'],
                    'parent_item' => 'Parent ' . $this->_labels['singular'],
                    'parent_item_colon' => 'Parent ' . $this->_labels['singular'] . ':',
                    'edit_item' => 'Edit ' . $this->_labels['singular'],
                    'update_item' => 'Update ' . $this->_labels['singular'],
                    'add_new_item' => 'Add New ' . $this->_labels['singular'],
                    'new_item_name' => 'New ' . $this->_labels['singular'] . 'Name',
                    'menu_name' => $this->_labels['singular']
                ],
                'public' => true,
                'rewrite' => [
                    'slug' => $this->_slug,
                    'with_front' => false
                ]
            ]);

            foreach ($this->_customPostTypes as $customPostType) {
                register_taxonomy_for_object_type($this->_name, $customPostType);
            }
        }
    }
}
