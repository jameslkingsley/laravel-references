<?php

use Kingsley\References\Models\Reference;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Resolves the given reference hash to its model.
 *
 * @return Illuminate\Database\Eloquent\Model
 */
function reference(string $hash)
{
    if (! $ref = Reference::where('hash', $hash)->first()) {
        throw new ModelNotFoundException("Reference '{$hash}' does not exist.");
    }

    return $ref->referenced();
}
