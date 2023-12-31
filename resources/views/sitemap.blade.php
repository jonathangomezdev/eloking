<?php echo '<?xml version="1.0" encoding="UTF-8"?>' ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">
    @foreach($routes as $route)
        <url>
            <loc>{{ $route['loc'] }}</loc>
            <lastmod>{{ $route['lastmod'] }}</lastmod>
            <changefreq>{{ $route['changefreq'] }}</changefreq>
            <priority>{{ $route['priority'] }}</priority>
        </url>
    @endforeach
</urlset>
