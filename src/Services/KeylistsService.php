<?php
/**
 * Class KeylistsService
 *
 * @author del
 */

namespace Delatbabel\Keylists\Services;

use Delatbabel\Keylists\Models\Keyvalue;
use Illuminate\Support\Fluent;


/**
 * Class KeylistsService
 *
 * This class provides some utility functions for fetching keylist entries.
 *
 * ### Example
 *
 * <code>
 * $keyservice = new KeylistsService;
 * // @var Fluent $key
 * $key = $keyservice->getKeyValue('currencies', 'USD');
 * </code>
 */
class KeylistsService
{

    /**
     * Fetches a single keyvalue by key type and key value
     *
     * @param string $keyType
     * @param string $keyValue
     * @return Fluent
     */
    public function getKeyValue($keyType, $keyValue)
    {
        $list = Keyvalue::getKeyValuesByType($keyType);
        return $list[$keyValue];
    }
}
