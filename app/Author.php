<?php

namespace App;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Author extends Model implements Searchable
{
    //
    protected $guarded = []; // all the field names are mass assignable

//defines relationship
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getAuthorImageAttribute($value){
        if(Str::contains($value, "http"))
            return $value;
        else
            return asset("uploads/authors/".$value);

    }

    public function getSearchResult(): SearchResult
    {
        $url =  $this->id;  //didn't need the url as using vue so passing id instead
        $full_name = $this->first_name . " ". $this->last_name;
        return new SearchResult($this, $full_name, $url);
    }
}


