<?php

/*
 * This file is part of the ONGR package.
 *
 * (c) NFQ Technologies UAB <info@nfq.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ONGR\ElasticsearchDSL\Query\TermLevel;

use ONGR\ElasticsearchDSL\BuilderInterface;
use ONGR\ElasticsearchDSL\ParametersTrait;

/**
 * Represents Elasticsearch "range" query.
 *
 * @link https://www.elastic.co/guide/en/elasticsearch/reference/current/query-dsl-range-query.html
 */
class RangeQuery implements BuilderInterface
{
    use ParametersTrait;

    /**
     * Range control names.
     */
    final public const LT = 'lt';
    final public const GT = 'gt';
    final public const LTE = 'lte';
    final public const GTE = 'gte';

    /**
     * @param string $field
     */
    public function __construct(private $field, array $parameters = [])
    {
        $this->setParameters($parameters);

        if ($this->hasParameter(self::GTE) && $this->hasParameter(self::GT)) {
            unset($this->parameters[self::GT]);
        }

        if ($this->hasParameter(self::LTE) && $this->hasParameter(self::LT)) {
            unset($this->parameters[self::LT]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return 'range';
    }

    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
        $output = [
            $this->field => $this->getParameters(),
        ];

        return [$this->getType() => $output];
    }
}
