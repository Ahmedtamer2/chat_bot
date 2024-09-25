<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
class Chat extends Model
{
    use HasFactory;
 protected $fillable=['message','answer'];

 public function users(): BelongsToMany
 {
     return $this->belongsToMany(User::class);
 }


}
