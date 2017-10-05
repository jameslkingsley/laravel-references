<?php

namespace Kingsley\References\Models;

use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    /**
     * Guarded attributes.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Constructor method.
     *
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        $this->table = config('references.table_name');

        parent::__construct($attributes);
    }

    /**
     * Gets the referenced model.
     *
     * @return Illuminate\Database\Eloquent\Model
     */
    public function referenced()
    {
        return $this->model_type::findOrFail($this->model_id);
    }
}
