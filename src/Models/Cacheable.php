<?php
/**
 * Cacheable Trait
 *
 * @author Del
 */

namespace Delatbabel\Keylists\Models;

use Illuminate\Support\Facades\Cache;
use Delatbabel\Fluents\Fluents;

/**
 * Cacheable Trait
 *
 * This trait can be applied to any model class allowing the
 * caching of the entire database table.  Note that it stores
 * the entire table contents in a single cache object, which
 * is usually suitable for tables containing small amounts of
 * data such as key/value pairs, category lists, etc.
 *
 * Caching in this manner is usually only efficient if the data
 * in the table is small and rarely changes.
 */
trait Cacheable
{
    use Fluents;

    /** @var string contains the cache key for caching values */
    // protected static $cache_key = 'override.this.key';

    /**
     * Override this function to provide the cache key.
     *
     * Note that using a protected static variable inside a trait can't
     * be done, it throws an error whenever it is overriden.
     */
    abstract protected function cacheKey();

    /**
     * Return the cache key for a model.
     *
     * Override this in child classes.
     *
     * @return string
     */
    abstract protected function getIndexKey();

    /**
     * Return a simple list of entries in the table.
     *
     * May cache the results for up to 60 minutes.
     *
     * @return	array
     */
    public static function tableToArray()
    {
        $me = new static();
        $cache_key = $me->cacheKey();

        // Return the array from the cache if it is present.
        if (Cache::has($cache_key)) {
            return (array) Cache::get($cache_key);
        }

        // Otherwise put the results into the cache and return them.
        $results = array();

        $query = static::all();

        // If the current model uses softDeletes then fix the
        // query to exclude those objects.
        foreach (class_uses(__CLASS__) as $traitName) {
            if ($traitName == 'SoftDeletes') {
                $query = static::whereNull('deleted_at')->get();
                break;
            }
        }

        /** @var Cacheable $row */
        foreach ($query as $row) {
            $results[$row->getIndexKey()] = $row->toFluent();
        }
        Cache::put($cache_key, $results, 60);
        return $results;
    }

    /**
     * Discard the cache for any tableToArray call.
     *
     * @return void
     */
    public static function discardTableToArray()
    {
        $me = new static();
        $cache_key = $me->cacheKey();

        Cache::forget($cache_key);
    }
}
