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
        parent::__construct($attributes);

        $this->table = config('references.table_name');
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
