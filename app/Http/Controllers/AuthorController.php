<?php

namespace App\Http\Controllers;
use App\Author;
use App\Http\Resources\AuthorResource;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\Searchable\Search;

class AuthorController extends Controller
{
    //
    public function all(){
        $authors = Author::latest()->paginate(10);
        return view('landing',['authors'=>$authors]);
    }

    public function single(Author $author){
        return view('single', ['author'=>$author]);
    }

    public function index(Request $request){

        if(empty($request->column)) $sort_column = "created_at";  else $sort_column = $request->column;
        if(empty($request->order)) $sort_order = "asc";  else $sort_order = $request->order;

        $query = Author::orderBy($sort_column, $sort_order)->paginate(10);  //  $query = Author::orderBy('first_name')->paginate(10);
        return AuthorResource::collection($query);  // return AuthorResource::collection(Author::orderBy($sort_field)->paginate(10));
    }
    public function test(){
        return view('search');
    }

    public function search(Request $request)
    {
        $searchResults = (new Search())
            ->registerModel(Author::class, ['first_name','last_name'])
            ->search($request->input('query'));
        //return view('search', compact('searchResults'));
        return response()->json($searchResults);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'body' => 'required',
            'user_id' => 'required',
            'author_image' => 'required|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $author = new Author;

        if ($request->hasFile('author_image')) {
            $image = $request->file('author_image');
            $name = Str::slug($request->first_name).'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/authors');
            $imagePath = $destinationPath . "/" . $name;
            $image->move($destinationPath, $name);
            $author->author_image = $name;
        }

        $author->user_id = $request->user_id;
        $author->first_name = $request->first_name;
        $author->last_name = $request->last_name;
        $author->body = $request->body;
        $author->ISNI = $request->ISNI;
        $author->date_of_birth = $request->date_of_birth;
        $author->date_of_flourish = $request->date_of_flourish;
        $author->email = $request->email;
        $author->contact_number = $request->contact_number;
        $author->wikilink = $request->wikilink;
        $author->status = $request->status;
        $author->save();

        return new AuthorResource($author);
    }

    public function show(Author $author)
    {
        return new AuthorResource($author);
    }

    public function update(Request $request, Author $author)
    {
       $this->validate($request,[
           'first_name' => 'required',
           'last_name' => 'required',
           'body' => 'required',
       ]);

        if ($request->hasFile('author_image')) {
            $image = $request->file('author_image');
            $name = Str::slug($request->first_name).'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/authors');
            $imagePath = $destinationPath . "/" . $name;
            $image->move($destinationPath, $name);
            $author->author_image = $name;
        }

        $author->first_name = $request->first_name;
        $author->last_name = $request->last_name;
        $author->body = $request->body;
        $author->ISNI = $request->ISNI;
        $author->date_of_birth = $request->date_of_birth;
        $author->date_of_flourish = $request->date_of_flourish;
        $author->email = $request->email;
        $author->contact_number = $request->contact_number;
        $author->author_image = $request->author_image;
        $author->wikilink = $request->wikilink;
        $author->status = $request->status;
        $author->update();

       return new AuthorResource($author);
    }

    public function destroy(Author $author)
    {
        $author->delete();
        return response()->json(null, 204);
    }
}
