<?php

namespace Kingsley\References;

use Spatie\Macroable\Macroable;
use Illuminate\Database\Eloquent\Model;
use Kingsley\References\Models\Reference;

trait Referenceable
{
    use Macroable;

    /**
     * Constructor method.
     *
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $appendedName = config('references.appended_name');
        $methodName = 'get'.studly_case($appendedName).'Attribute';

        $this->appends[] = $appendedName;

        static::macro($methodName, function () {
            return optional($this->reference())->hash;
        });
    }

    /**
     * Boot the referenceable trait.
     *
     * @return void
     */
    protected static function bootReferenceable()
    {
        static::created(function (Model $model) {
            $model->references()->save(
                new Reference([
                    'hash' => $model->makeReferenceHash()
                ])
            );
        });
    }

    /**
     * Gets the references for the model.
     *
     * @return Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function references()
    {
        return $this->morphMany(Reference::class, 'model');
    }

    /**
     * Gets the reference factory instance.
     *
     * @return Kingsley\References\Models\Reference
     */
    public function reference()
    {
        return $this->references()->first();
    }

    /**
     * Makes a new reference hash.
     *
     * @return string
     */
    public function makeReferenceHash()
    {
        if (config('references.prefix')) {
            $class = strtolower(class_basename(get_class($this)));

            return $class.'_'.str_random(12);
        } else {
            return str_random(12);
        }
    }
}
