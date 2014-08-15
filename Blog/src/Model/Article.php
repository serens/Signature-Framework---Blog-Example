<?php
/**
 * This file is part of Blog Example.
 * @copyright Sven Erens <sven@signature-framework.com>
 */

namespace Blog\Model;

/**
 * Class Article.
 * @package Blog\Model
 */
class Article extends \Signature\Persistence\ActiveRecord\AbstractModel
{
    use \Signature\Object\ObjectProviderServiceTrait;

    /**
     * @var string
     */
    protected $primaryKeyName = 'id';

    /**
     * @var \Signature\Persistence\ResultCollectionInterface
     */
    protected $comments = null;

    /**
     * Returns the comments of this article.
     * @return \Signature\Persistence\ResultCollectionInterface
     */
    public function getComments()
    {
        if (null === $this->comments) {
            /** @var \Blog\Model\Comment $comment */
            $comment  = $this->objectProviderService->create('Blog\Model\Comment');
            $comments = $comment->findByField('article_id', $this->getID());

            if ($comments && $comments->count()) {
                $this->comments = $comments;
            }
        }

        return $this->comments;
    }
}
