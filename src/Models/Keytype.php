<?php
/**
 * Keytype Model
 *
 * @author Del
 */

namespace Delatbabel\Keylists\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * Keytype Model
 *
 * Contains the list of key lists used throughout the application.
 *
 * @see database/migrations/2012_01_01_000001_create_keylists_tables.php
 */
class Keytype extends Model
{
    use SoftDeletes, Cacheable;

    /** @var array */
    protected $fillable = ['name', 'description', 'extended_data',
        'created_by', 'updated_by'];

    protected $casts = [
        'extended_data'     => 'array',
    ];

    /**
     * Return the cache key for a model.
     *
     * @return string
     */
    protected function cacheKey()
    {
        return 'table.to.array.keytypes';
    }

    /**
     * Return the cache index key for a model.
     *
     * @return string
     */
    protected function getIndexKey()
    {
        return $this->name;
    }

    /**
     * Many:1 relationship with Keytype
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function keyvalues()
    {
        return $this->hasMany('Delatbabel\Keylists\Models\Keyvalue');
    }

    /**
     * return an array of name/description pairs from the cache
     *
     * @return array
     */
    public static function getKeytypes()
    {
        $tableCache = static::tableToArray();

        // Reformat the table cache to name => description.
        $result = array();
        foreach ($tableCache as $key => $value) {
            $result[$value->name] = $value->description;
        }

        return $result;
    }
}
