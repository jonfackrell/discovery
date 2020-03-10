<?php

namespace App\Modules\Search\Indexes;

interface IndexInterface
{
    /**
     * Is this index available?
     *
     * @return bool
     */
    public function isAvailable();

    /**
     * Search the index.
     *
     * @param string $query
     * @param array $options
     * @return mixed|false
     */
    public function search($query, array $options = []);
}
