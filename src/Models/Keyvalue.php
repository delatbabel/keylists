<?php
/**
 * Keyvalues Model
 *
 * @author Del
 */

namespace Delatbabel\Keylists\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Keyvalues Model
 *
 * Contains the list of key/value pairs used throughout the application.
 *
 * ### Example
 *
 * <code>
 * // returns a key => value list of all enums with type "status"
 * $keyvalue = Keyvalues::getKeyvaluesByType('status');
 * </code>
 *
 * @see database/migrations/2012_01_01_000001_create_keylists_tables.php
 */
class Keyvalue extends Model
{
    use SoftDeletes, Cacheable;

    /** @var array */
    protected $fillable = ['keytype_id', 'keyvalue', 'keyname',
        'description', 'extended_data', 'created_by', 'updated_by'];

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
        return 'table.to.array.keyvalues';
    }

    /**
     * Return the cache index key for a model.
     *
     * @return string
     */
    protected function getIndexKey()
    {
        return $this->keytype()->name . '__' . $this->keyvalue;
    }

    /**
     * Many:1 relationship with Keytype
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function keytype()
    {
        return $this->belongsTo('Delatbabel\Keylists\Models\Keytype');
    }

    /**
     * return the Keyvalues objects for a given keytype
     *
     * @param string $keyType
     * @return array
     */
    public static function getKeyvaluesByKeyType($keyType)
    {
        if (empty($keyType)) {
            // return empty array
            return [];
        }

        $tableCache = static::tableToArray();

        // Read through the entire table cache looking for keys that match
        // the keyType
        $result = [];
        foreach ($tableCache as $key => $value) {
            list($storedType, $storedValue) = explode('__', $key, 2);
            if ($storedType == $keyType) {
                $result[$value->id] = $value;
            }
        }

        return $result;
    }

    /**
     * return the keyvalue -> keyname pairs for all elements that match a keytype
     *
     * @param string $keyType
     * @return array
     */
    public static function getKeyValuesByType($keyType)
    {
        $keyvalues = self::getKeyvaluesByKeyType($keyType);

        // Sort through the enums of the found type and reformat those
        // as a keyvalue => keyname list.
        $list = [];

        /** @var Keyvalue $keyvalue */
        foreach ($keyvalues as $keyvalue) {
            $list[$keyvalue->keyvalue] = $keyvalue->keyname;
        }

        return $list;
    }
}
