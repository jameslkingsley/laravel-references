<?php

namespace Kingsley\References\Models;

use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = config('references.table_name');

    /**
     * Guarded attributes.
     *
     * @var array
     */
    protected $guarded = [];

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
