<?php

/*
 * This file is part of the ONGR package.
 *
 * (c) NFQ Technologies UAB <info@nfq.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ONGR\ElasticsearchDSL\Query\Joining;

use ONGR\ElasticsearchDSL\BuilderInterface;
use ONGR\ElasticsearchDSL\ParametersTrait;

/**
 * Represents Elasticsearch "nested" query.
 *
 * @link https://www.elastic.co/guide/en/elasticsearch/reference/current/query-dsl-nested-query.html
 */
class NestedQuery implements BuilderInterface
{
    use ParametersTrait;

    /**
     * @param string           $path
     */
    public function __construct(private $path, private readonly BuilderInterface $query, array $parameters = [])
    {
        $this->parameters = $parameters;
    }

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return 'nested';
    }

    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
        return [
            $this->getType() => $this->processArray(
                [
                    'path' => $this->path,
                    'query' => $this->query->toArray(),
                ]
            )
        ];
    }

    /**
     * Returns nested query object.
     *
     * @return BuilderInterface
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * Returns path this query is set for.
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }
}
