<?php

/*
 * This file is part of the ONGR package.
 *
 * (c) NFQ Technologies UAB <info@nfq.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ONGR\ElasticsearchDSL\Query\Span;

use ONGR\ElasticsearchDSL\ParametersTrait;

/**
 * Elasticsearch Span not query.
 *
 * @link https://www.elastic.co/guide/en/elasticsearch/reference/current/query-dsl-span-not-query.html
 */
class SpanNotQuery implements SpanQueryInterface
{
    use ParametersTrait;

    public function __construct(private readonly SpanQueryInterface $include, private readonly SpanQueryInterface $exclude, array $parameters = [])
    {
        $this->setParameters($parameters);
    }

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return 'span_not';
    }

    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
        $query = [
            'include' => $this->include->toArray(),
            'exclude' => $this->exclude->toArray(),
        ];

        return [$this->getType() => $this->processArray($query)];
    }
}
