<?php
/**
 * This file is part of Blog Example.
 * @copyright Sven Erens <sven@signature-framework.com>
 */

namespace Blog;

/**
 * Class Module
 * @package Blog
 */
class Module extends \Signature\Module\AbstractModule
{
    /**
     * @var string
     */
    protected $author = 'Sven Erens <sven@signature-framework.com>';

    /**
     * @var string
     */
    protected $copyright = 'Copyright &copy; 2014';

    /**
     * @var string
     */
    protected $version = '0.1';

    /**
     * @var string
     */
    protected $description = 'Simple blog based on Signature framework.';

    /**
     * @var string
     */
    protected $url = 'https://github.com/serens/Signature-Framework---Blog-Example';

    /**
     * Adds routing information to the Signature Configuration.
     * @return bool
     */
    public function init(): bool
    {
        $this->configurationService->setConfigByPath(
            'Signature',
            'Service.Persistence.ConnectionInfo',
            [
                'Host'     => '127.0.0.1',
                'Username' => 'root',
                'Password' => 'enter_your_password_here',
                'Database' => 'blog_example',
            ]
        );

        $this->configurationService->setConfigByPath(
            'Signature',
            'Mvc.Routing.Matcher.Signature\\Mvc\\Routing\\Matcher\\UriMatcher.Routes',
            [
                'allarticles' => [
                    'Uris'                => ['/articles'],
                    'ControllerClassname' => \Blog\Controller\ArticleController::class,
                    'ActionName'          => 'index',
                ],
                'article' => [
                    'Uris'                => ['/articles/$alias'],
                    'ControllerClassname' => \Blog\Controller\ArticleController::class,
                    'ActionName'          => 'show',
                ],
                'postcomment' => [
                    'Uris'                => ['/articles/$alias/post', '/articles/$alias/post/'],
                    'ControllerClassname' => \Blog\Controller\ArticleController::class,
                    'ActionName'          => 'post',
                ],
            ]
        );

        return parent::init();
    }
}
