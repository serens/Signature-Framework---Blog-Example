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
class Article extends \Signature\Persistence\ActiveRecord\AbstractRecord
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
            $this->comments = \Blog\Model\Comment::findByField('article_id', $this->getID());
        }

        return $this->comments;
    }
}
