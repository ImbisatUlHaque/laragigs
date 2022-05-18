<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = ['title','company','location','logo','email','tags','website','description'];
    

    public function scopeFilter($query, array $filters)
    {
        if ($filters ?? false) {
            $query->where('tags', 'like', '%' . request('tag') . '%');
        }


        if ($filters ?? false) {
            $query->where('title', 'like', '%' . request('search') . '%')
                ->orWhere('description', 'like', '%' . request('search') . '%')
                ->orWhere('tags', 'like', '%' . request('search') . '%');
                // dd($filters);

        }
    }
}
