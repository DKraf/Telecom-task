<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class News extends Model
{
    use HasFactory , SoftDeletes, Notifiable;

    protected $table = 'news';

    protected $fillable = [
        'title',
        'description',
        'text',
        'image',
        'is_publicated',
        'publication_date'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];


    /**
     * @var mixed
     */
    private $id;
}
