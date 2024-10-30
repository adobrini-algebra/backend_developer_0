<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Mail\ArticleCreated;
use App\Mail\ArticleDeleted;
use App\Mail\ArticleUpdated;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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
        // Gate::authorize('create', Article::class);

        $categories = Category::all();
        $tags = Tag::all();

        return view('articles.create', compact('categories', 'tags'));
    }

    public function store(ArticleRequest $request)
    {
        $user = Auth::user();

        $article = Article::create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => $user->id,
            'category_id' => $request->category,
        ]);

        $article->tags()->attach($request->tags);

        if ($image = $request->file('image')) {
             $path = $image->store("images/articles/$article->id", "public");
             $article->update(['image' => $path]);
        }

        Mail::to($user->email)->send(new ArticleCreated($article, $user));

        return redirect()->route('articles.index')->withFlashMessage("Uspjesno kreiran Article");
    }

    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        // Gate::authorize('update', $article);

        $categories = Category::all();
        $tags = Tag::all();

        return view('articles.edit', compact('article', 'categories', 'tags'));
    }

    public function update(ArticleRequest $request, Article $article)
    {
        $article->update([
            'title' => $request->title,
            'body' => $request->body,
            'category_id' => $request->category,
        ]);

        if ($image = $request->file('image')) {
            Storage::disk('public')->delete($article->image);

            $path = $image->store("images/articles/$article->id", "public");
            $article->update(['image' => $path]);
        }

        if ($request->tags) {
            $article->tags()->sync($request->tags);
        } else {
            $article->tags()->detach();
        }

        $user = $request->user();

        Mail::to("aleksandar.dobrinic@predavaci.algebra.hr")->send(new ArticleUpdated($article, $user));

        return redirect()->back()->withFlashMessage("Article je apdejtan");
    }

    public function destroy(Article $article)
    {
        $author = $article->load('author')->author;
        $user = Auth::user();

        $article->delete();

        if ($author->id !== $user->id) {
            Mail::to($author->email)->send(new ArticleDeleted($article, $user, $author));
        }

        return redirect()->route('articles.index')->withFlashMessage("Article je obrisan");
    }

    public function byAuthor(int $id)
    {
        $user = User::where('id', $id)->firstOrFail();
        $articles = $user->articles()->with('author', 'tags')->latest()->paginate(10);
        $header = $user->fullName() . "'s articles";

        return view('articles.index', compact('articles', 'header'));
    }

    public function byTag(Tag $tag)
    {
        $articles = $tag->articles()->with('author', 'tags', 'category')->latest()->paginate(10);
        $header = "Articles with $tag->name";

        return view('articles.index', compact('articles', 'header'));
    }

    public function byCategory(Category $category)
    {
        // $articles = Article::where('category_id', $id)->with('author', 'tags')->latest()->paginate(10);
        // $articles = Article::whereCategoryId($id)->with('author', 'tags')->latest()->paginate(10);
        $articles = $category->articles()->with('author', 'tags')->latest()->paginate(10);
        $header = "Articles in category $category->name";

        return view('articles.index', compact('articles', 'header'));
    }

    // public function searchArticles(Request $request)
    // {
    //     $header = 'Search results';

    //     $keyword = $request->search;
    //     Validator::make(['search' => $keyword], ['search' => 'required|regex:/^[\pL0-9\s_-]+$/i'], ['regex' => 'The :attribute field has to be alphanumeric.'])
    //         ->validateWithBag('search');

    //     $articles = Article::with('tags')->whereAny(['title', 'body'], 'like', "%$keyword%")->paginate(12);

    //     return view('articles.index', compact('header', 'articles'));
    // }
}