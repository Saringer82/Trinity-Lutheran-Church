<?php
namespace Application\Theme\Apt206;

use Concrete\Core\Area\Layout\Preset\Provider\ThemeProviderInterface;
use Concrete\Core\Page\Theme\Theme;

class PageTheme extends Theme implements ThemeProviderInterface
{
    public function registerAssets()
    {
        //$this->providesAsset('javascript', 'bootstrap/*');
        $this->providesAsset('css', 'bootstrap/*');
        $this->providesAsset('css', 'blocks/form');
        $this->providesAsset('css', 'blocks/social_links');
        $this->providesAsset('css', 'blocks/share_this_page');
        $this->providesAsset('css', 'blocks/feature');
        $this->providesAsset('css', 'blocks/testimonial');
        $this->providesAsset('css', 'blocks/date_navigation');
        $this->providesAsset('css', 'blocks/topic_list');
        $this->providesAsset('css', 'blocks/faq');
        $this->providesAsset('css', 'blocks/tags');
        $this->providesAsset('css', 'core/frontend/*');
        $this->providesAsset('css', 'blocks/feature/templates/hover_description');

        $this->providesAsset('css', 'blocks/event_list');

        $this->requireAsset('css', 'font-awesome');
        $this->requireAsset('javascript', 'jquery');
        $this->requireAsset('javascript', 'picturefill');
        $this->requireAsset('javascript-conditional', 'html5-shiv');
        $this->requireAsset('javascript-conditional', 'respond');
    }

    protected $pThemeGridFrameworkHandle = 'bootstrap3';

    public function getThemeName()
    {
        return t('Apt206');
    }

    public function getThemeDescription()
    {
        return t('Theme by Peter Anderson.');
    }

    /**
     * @return array
     */
    public function getThemeBlockClasses()
    {
        return [
            'feature' => ['feature-home-page'],
            'page_list' => [
                'recent-blog-entry',
                'blog-entry-list',
                'page-list-with-buttons',
                'block-sidebar-wrapped',
            ],
            'next_previous' => ['block-sidebar-wrapped'],
            'share_this_page' => ['block-sidebar-wrapped'],
            'content' => [
                'block-sidebar-wrapped',
                'block-sidebar-padded',
            ],
            'date_navigation' => ['block-sidebar-padded'],
            'topic_list' => ['block-sidebar-wrapped'],
            'testimonial' => ['testimonial-bio'],
            'image' => [
                'image-right-tilt',
                'image-circle',
            ],
        ];
    }

    /**
     * @return array
     */
    public function getThemeAreaClasses()
    {
        return [
            'Page Footer' => ['area-content-accent'],
        ];
    }

    /**
     * @return array
     */
    public function getThemeDefaultBlockTemplates()
    {
        return [
            'calendar' => 'bootstrap_calendar.php',
        ];
    }

    /**
     * @return array
     */
    public function getThemeResponsiveImageMap()
    {
        return [
            'large' => '900px',
            'medium' => '768px',
            'small' => '0',
        ];
    }

    /**
     * @return array
     */
    public function getThemeEditorClasses()
    {
        return [
            [
                'title' => t('Small text'),
                'element' => ['span'],
                'attributes' => ['class' => 'small']
            ],
            //// PARAGRAPHS
            [
                'title' => t('Lead paragraph'),
                'element' => ['p'],
                'attributes' => ['class' => 'lead']
            ],
            [
                'title' => t('Logo'),
                'element' => ['p'],
                'attributes' => ['class' => 'header-logo']
            ],
            [
                'title' => t('Intro paragraph'),
                'element' => ['p'],
                'attributes' => ['class' => 'intro']
            ],
            //// LINKS
            [
                'title' => t('Default Button'),
                'element' => ['a'],
                'attributes' => ['class' => 'btn btn-default']
            ],
            [
                'title' => t('Primary Button'),
                'element' => ['a'],
                'attributes' => ['class' => 'btn btn-primary']
            ],
        ];
    }

    /**
     * @return array
     */
    public function getThemeAreaLayoutPresets()
    {
        $presets = [
            //// SECTIONS
            [
                'handle' => 'section_container',
                'name' => 'Section Container',
                'container' => '<section class="section"></section>',
                'columns' => [
                    '<div class="container"></div>'
                ]
            ],
            //// LAYOUTS
            [
                'handle' => 'column_single',
                'name' => 'Single Column',
                'container' => '<div class="row"></div>',
                'columns' => [
                    '<div class="col-xs-12"></div>'
                ]
            ],
            [
                'handle' => 'column_narrow',
                'name' => 'Narrow Column',
                'container' => '<div class="row"></div>',
                'columns' => [
                    '<div class="col-xs-12 col-md-10 col-md-offset-1"></div>'
                ]
            ],
            [
                'handle' => 'column_two',
                'name' => 'Two Column',
                'container' => '<div class="row"></div>',
                'columns' => [
                    '<div class="col-xs-12 col-sm-6"></div>',
                    '<div class="col-xs-12 col-sm-6"></div>'
                ]
            ],
            [
                'handle' => 'column_three',
                'name' => 'Three Column',
                'container' => '<div class="row"></div>',
                'columns' => [
                    '<div class="col-xs-12 col-sm-4"></div>',
                    '<div class="col-xs-12 col-sm-4"></div>',
                    '<div class="col-xs-12 col-sm-4"></div>'
                ]
            ],
            [
                'handle' => 'column_four',
                'name' => 'Four Column',
                'container' => '<div class="row"></div>',
                'columns' => [
                    '<div class="col-xs-12 col-sm-6 col-md-3"></div>',
                    '<div class="col-xs-12 col-sm-6 col-md-3"></div>',
                    '<div class="col-xs-12 col-sm-6 col-md-3"></div>',
                    '<div class="col-xs-12 col-sm-6 col-md-3"></div>'
                ]
            ],
//            [
//                'handle' => 'left_sidebar',
//                'name' => 'Left Sidebar',
//                'container' => '<div class="row"></div>',
//                'columns' => [
//                    '<div class="col-sm-4"></div>',
//                    '<div class="col-sm-8"></div>',
//                ],
//            ],
//            [
//                'handle' => 'right_sidebar',
//                'name' => 'Right Sidebar',
//                'container' => '<div class="row"></div>',
//                'columns' => [
//                    '<div class="col-sm-8"></div>',
//                    '<div class="col-sm-4"></div>',
//                ],
//            ],
        ];

        return $presets;
    }
}
