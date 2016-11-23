<?php

namespace ProjectName;

class AboutPageMetaBoxes
{

    /**
     * This should be used to prefix all of
     * the fields created
     *
     * @var string
     */
    private $_prefix = 'about_page_';

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
        add_action('cmb2_init', [$this, 'registerMetaBoxes']);
    }

    /**
     * @return void
     */
    public function registerMetaBoxes()
    {
        $galleryMetaBox = new_cmb2_box([
            'id' => 'galleryMetaBox',
            'title' => 'Gallery',
            'object_types' => ['page'],
            'show_on' => [
                'key' => 'page-template',
                'value' => 'template-about.php'
            ],
            'context' => 'normal',
            'priority' => 'high',
            'show_names' => false
        ]);

        $galleryMetaBox->add_field([
            'name' => 'Gallery',
            'id'   => $this->_prefix . 'gallery',
            'type' => 'file_list'
        ]);
    }
}
