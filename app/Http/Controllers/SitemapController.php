<?php

namespace App\Http\Controllers;

use App\BlogPost;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

class SitemapController extends Controller
{
    protected $exclude = [
        'sitemap.xml',
    ];

    public function index()
    {
        $pages  = Route::getRoutes();
        $routes = collect();

        foreach ($pages as $page) {
            if (!(
                    preg_match('/^\_.*/', $page->uri) || // remove all underscore urls
                    preg_match('/panel|api|broadcasting|logout|password/', $page->uri) || // remove panel and api specific urls
                    preg_match('/\{/', $page->uri) || // remove dynamic url like /blog/{slug}
                    in_array($page->uri, $this->exclude) // remove some static urls like sitemap.xml
                ) && in_array('GET', $page->methods)) { // allow only get methods not Post, Put or Patch
                $routes->push([
                    'loc'           => URL::to($page->uri),
                    'lastmod'       => now()->subWeek()->toIso8601String(),
                    'changefreq'    => 'weekly',
                    'priority'      => 1,
                ]);
            }
        }

        $blogs = BlogPost::select('slug', 'updated_at')->where('status', BlogPost::STATUS_PUBLISHED)->get();
        foreach ($blogs as $blog) {
            $routes->push([
                'loc'           => URL::to('/blog/' . $blog->slug),
                'lastmod'       => Carbon::parse($blog->updated_at)->toIso8601String(),
                'changefreq'    => 'weekly',
                'priority'      => 0.8,
            ]);
        }
        return response()->view('sitemap', compact('routes'))->header('Content-Type', 'text/xml;charset=utf-8');
    }
}
