<?php
/**
 * This file is part of Blog Example.
 * @copyright Sven Erens <sven@signature-framework.com>
 */

namespace Blog\Model;

use Signature\Persistence\ResultCollectionInterface;

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
     * @var ResultCollectionInterface
     */
    protected $comments = null;

    /**
     * Returns the comments of this article.
     * @return ResultCollectionInterface
     */
    public function getComments(): ResultCollectionInterface
    {
        if (null === $this->comments) {
            /** @var \Blog\Model\Comment $comment */
            $comment  = $this->objectProviderService->create(\Blog\Model\Comment::class);
            $comments = $comment->findByField('article_id', $this->getID());

            if ($comments && $comments->count()) {
                $this->comments = $comments;
            }
        }

        return $this->comments;
    }
}
