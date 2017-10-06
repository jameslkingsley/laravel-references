<?php

namespace Kingsley\References;

use Illuminate\Database\Eloquent\Model;
use Kingsley\References\Models\Reference;

trait Referenceable
{
    /**
     * Constructor method.
     *
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->appends[] = 'ref';
    }

    /**
     * Boot the referenceable trait.
     *
     * @return void
     */
    protected static function bootReferenceable()
    {
        static::created(function (Model $model) {
            $model->reference()->save(
                new Reference([
                    'hash' => $model->makeReferenceHash()
                ])
            );
        });
    }

    /**
     * Gets the reference for the model.
     *
     * @return Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function reference()
    {
        return $this->morphOne(Reference::class, 'model');
    }

    /**
     * Makes a new reference hash.
     *
     * @return string
     */
    public function makeReferenceHash()
    {
        if (property_exists($this, 'referencePrefix')) {
            if (is_null($this->referencePrefix)) {
                return str_random(12);
            } else {
                return $this->referencePrefix.'_'.str_random(12);
            }
        }

        if (config('references.prefix')) {
            $prefix = substr(strtolower(class_basename(get_class($this))), 0, 3);

            return $prefix.'_'.str_random(12);
        }

        return str_random(12);
    }

    /**
     * Gets the ref attribute.
     *
     * @return string
     */
    public function getRefAttribute()
    {
        return optional($this->reference)->hash;
    }
}
