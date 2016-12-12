<?php
/**
 * This file is part of Blog Example.
 * @copyright Sven Erens <sven@signature-framework.com>
 */

namespace Blog\Controller;

/**
 * Class ArticleController. Renders the given blog article.
 * @package Blog\Controller
 */
class ArticleController extends \Signature\Mvc\Controller\ActionController
{
    /**
     * Index-Action. Will list up all articles.
     * @return void
     */
    public function indexAction()
    {
        /** @var \Blog\Model\Article $article */
        $article = $this->objectProviderService->create('Blog\Model\Article');

        $this->view->setViewData([
            'articles' => $article->findAll(),
        ]);
    }

    /**
     * Show-Action. Renders a article by a given alias.
     * @param string $alias
     * @return void
     */
    public function showAction($alias)
    {
        if ($article = $this->getArticleByAlias($alias)) {
            $commentForm = new \Signature\Html\Form\Form(
                $this->request,
                ['action' => '/articles/' . $article->getFieldValue('alias') . '/post']
            );

            $commentForm->addElements([
                new \Signature\Html\Form\Element\Input('name', '', ['id' => 'name']),
                new \Signature\Html\Form\Element\Input('email', '', ['id' => 'email']),
                new \Signature\Html\Form\Element\Textarea('comment', '', ['id' => 'comment']),
            ]);

            $this->view->setViewData([
                'article'     => $article,
                'comments'    => $article->getComments(),
                'commentform' => $commentForm,
                'errors'      => $this->request->getParameter('errors'),
            ]);
        } else {
            $this->handleArticleNotFoundError();
        }
    }

    /**
     * Creates a new comment for an article.
     * @param string $alias
     * @return void
     */
    public function postAction($alias)
    {
        if ($article = $this->getArticleByAlias($alias)) {
            $errors = [];

            if ('' === $this->request->getParameter('name'))
                $errors[] = 'Please enter your name.';

            if ('' === $this->request->getParameter('comment'))
                $errors[] = 'Please enter your comment.';

            if (count($errors)) {
                // Add the errors to the request-parameters
                $this->request->setParameter('errors', $errors);
                $this->forward('show');
            }

            /** @var \Blog\Model\Comment $comment */
            $comment = $this->objectProviderService->create('Blog\Model\Comment');
            $comment
                ->setFieldValues([
                    'article_id' => $article->getID(),
                    'name'       => $this->request->getParameter('name'),
                    'email'      => $this->request->getParameter('email'),
                    'comment'    => $this->request->getParameter('comment'),
                    'created'    => date('Y-m-d H:i:s'),
                    'published'  => 1
                ])
                ->create();

            $article
                ->setFieldValue('comment_count', (int) $article->getFieldValue('comment_count') + 1)
                ->save();

            $this->redirect('/articles/' . $article->getFieldValue('alias'));
        } else {
            $this->handleArticleNotFoundError();
        }
    }

    /**
     * Returns an article model by a given article-alias.
     * @param string $alias
     * @return \Blog\Model\Article
     */
    protected function getArticleByAlias($alias)
    {
        /** @var \Blog\Model\Article $article */
        $article = $this->objectProviderService->create('Blog\Model\Article');

        if (($articles = $article->findByField('alias', $alias)) && $articles->count()) {
            return $articles->getFirst();
        }

        return null;
    }

    /**
     * Assigns a layout to the view.
     * @return void
     */
    protected function initView()
    {
        parent::initView();

        $this->view->setLayout($this->getTemplateDir() . 'Layouts/Default.phtml');
    }

    /**
     * Handles a 404-error if a given article can not be found.
     * @return void
     */
    protected function handleArticleNotFoundError()
    {
        $this->forward('noRouteFound', 'Signature\Mvc\Controller\ErrorController');
    }
}
