<?php

/*
 * This file is part of the ONGR package.
 *
 * (c) NFQ Technologies UAB <info@nfq.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ONGR\ElasticsearchDSL\Query\Compound;

use ONGR\ElasticsearchDSL\BuilderInterface;

/**
 * Represents Elasticsearch "boosting" query.
 *
 * @link https://www.elastic.co/guide/en/elasticsearch/reference/current/query-dsl-boosting-query.html
 */
class BoostingQuery implements BuilderInterface
{
    /**
     * @param int|float        $negativeBoost
     */
    public function __construct(private readonly BuilderInterface $positive, private readonly BuilderInterface $negative, private $negativeBoost)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return 'boosting';
    }

    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
        $query = [
            'positive' => $this->positive->toArray(),
            'negative' => $this->negative->toArray(),
            'negative_boost' => $this->negativeBoost,
        ];

        return [$this->getType() => $query];
    }
}
