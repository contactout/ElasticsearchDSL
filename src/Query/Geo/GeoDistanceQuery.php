<?php

/*
 * This file is part of the ONGR package.
 *
 * (c) NFQ Technologies UAB <info@nfq.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ONGR\ElasticsearchDSL\Query\Geo;

use ONGR\ElasticsearchDSL\BuilderInterface;
use ONGR\ElasticsearchDSL\ParametersTrait;

/**
 * Represents Elasticsearch "geo_distance" query.
 *
 * @link https://www.elastic.co/guide/en/elasticsearch/reference/current/query-dsl-geo-distance-query.html
 */
class GeoDistanceQuery implements BuilderInterface
{
    use ParametersTrait;

    /**
     * @param string $field
     * @param string $distance
     */
    public function __construct(private $field, private $distance, private readonly mixed $location, array $parameters = [])
    {
        $this->setParameters($parameters);
    }

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return 'geo_distance';
    }

    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
        $query = [
            'distance' => $this->distance,
            $this->field => $this->location,
        ];
        $output = $this->processArray($query);

        return [$this->getType() => $output];
    }
}
