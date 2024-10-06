<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('author', 'tags', 'category')->latest()->paginate(10);

        return view('articles.index', compact('articles'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('articles.create', compact('categories', 'tags'));
    }

    public function store(ArticleRequest $request)
    {
        $article = Article::create([
            'title' => $request->title,
            'body' => $request->body,
            'slug' => Str::slug($request->title),
            'user_id' => Auth::id(),
            'category_id' => $request->category,
        ]);

        if($request->file('image')){
            $image = $request->file('image');
            $path = $image->store("images/articles/$article->id", 'public');
            $article->update(['image' => $path]);
        }

        $article->tags()->attach($request->tags);

        return redirect()->route('articles.index')->withFlashMessage("Article je uspješno dodan");
    }

    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        Gate::authorize('update', $article);
        
        $categories = Category::all();
        $tags = Tag::all();

        return view('articles.edit', compact('article', 'categories', 'tags'));
    }

    public function update(ArticleRequest $request, Article $article)
    {
        $article->update([
            'title' => $request->title,
            'body' => $request->body,
            'slug' => Str::slug($request->title),
            'category_id' => $request->category,
        ]);

        if($request->file('image')){
            Storage::disk('public')->delete($article->image);

            $image = $request->file('image');
            $path = $image->store("images/articles/$article->id", 'public');
            $article->update(['image' => $path]);
        }

        if ($request->tags) {
            $article->tags()->sync($request->tags);
        }else{
            $article->tags()->detach($article->tags->pluck('id'));
        }

        return redirect()->route('articles.index')->withFlashMessage("Article je uspješno apdejtan");
    }

    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->route('articles.index')->withFlashMessage("Article je obrisan");
    }

    public function byAuthor(User $author)
    {
        // $articles = Article::whereUserId($id)->latest()->paginate(10);// magicna metoda where(user_id, $id)
        $articles = $author->articles()->with('category', 'tags')->paginate(10);
        $header = $author->fullName() ."'s articles";

        return view('articles.index', compact('articles', 'header'));
    }

    public function byTags(Tag $tag)
    {
        $articles = $tag->articles()->with('category', 'author')->paginate(10);
        $header = "Articles with keyword \"$tag->name\"";

        return view('articles.index', compact('articles', 'header'));
    }

    public function byCategory(Category $category)
    {
        $articles = $category->articles()->with('tags', 'author')->paginate(10);
        $header = "Articles in category \"$category->name\"";

        return view('articles.index', compact('articles', 'header'));
    }
}
