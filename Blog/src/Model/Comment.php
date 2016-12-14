<?php
/**
 * This file is part of Blog Example.
 * @copyright Sven Erens <sven@signature-framework.com>
 */

namespace Blog\Model;

/**
 * Class Comment.
 * @package Blog\Model
 */
class Comment extends \Signature\Persistence\ActiveRecord\AbstractRecord
{
    /**
     * @var string
     */
    protected $primaryKeyName = 'id';
}
