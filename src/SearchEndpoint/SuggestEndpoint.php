<?php

/*
 * This file is part of the ONGR package.
 *
 * (c) NFQ Technologies UAB <info@nfq.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ONGR\ElasticsearchDSL\SearchEndpoint;

use ONGR\ElasticsearchDSL\Suggest\TermSuggest;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Search suggest dsl endpoint.
 */
class SuggestEndpoint extends AbstractSearchEndpoint
{
    /**
     * Endpoint name
     */
    final public const NAME = 'suggest';

    /**
     * {@inheritdoc}
     */
    public function normalize(NormalizerInterface $normalizer, $format = null, array $context = []): float|array|\ArrayObject|bool|int|string|null
    {
        $output = [];
        if (count($this->getAll()) > 0) {
            /** @var TermSuggest $suggest */
            foreach ($this->getAll() as $suggest) {
                $output = array_merge($output, $suggest->toArray());
            }
        }

        return $output;
    }
}
