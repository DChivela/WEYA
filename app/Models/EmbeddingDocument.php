<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmbeddingDocument extends Model
{
    protected $table = 'embeddings_documents';
    protected $guarded = [];
    protected $casts = [
        'metadata' => 'array',
    ];
}
