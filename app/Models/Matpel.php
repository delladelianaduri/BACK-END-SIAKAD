<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matpel extends Model
{
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'kd_matpel';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The key type of the primary key.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['kd_matpel', 'nama_matpel'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'matpels';

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'kd_matpel' => 'integer',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    // Relationships jika ada
    // public function relationship()
    // {
    //     return $this->belongsTo(RelatedModel::class);
    // }
}