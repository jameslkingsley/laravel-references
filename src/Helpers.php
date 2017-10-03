<?php

use Kingsley\References\Models\Reference;

/**
 * Resolves the given reference hash to its model.
 *
 * @return Illuminate\Database\Eloquent\Model
 */
function reference(string $hash)
{
    if (! $ref = Reference::where('hash', $hash)->first()) {
        throw new InvalidArgumentException("Reference '{$hash}' does not exist.");
    }

    return $ref->referenced();
}
