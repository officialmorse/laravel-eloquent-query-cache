<?php

namespace Rennokki\QueryCache\Contracts;

interface QueryCacheModuleInterface
{
    /**
     * Generate the plain unique cache key for the query.
     *
     * @param  string  $method
     * @param  string|null  $id
     * @param  string|null  $appends
     * @return string
     */
    public function generatePlainCacheKey(string $method = 'get', string $id = null, string $appends = null): string;

    /**
     * Make a call to the required method avoiding the cache.
     *
     * @param  string  $method
     * @param  array|string  $columns
     * @param  string|null  $id
     * @return \Closure
     */
    public function callMethodAvoidingCache(string $method = 'get', $columns = ['*'], string $id = null);
}
