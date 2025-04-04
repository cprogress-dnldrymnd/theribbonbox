# lighttheme

A (custom?) theme for [The Ribbon Box](https://theribbonbox.com/) by ??

# Dev notes

For large listing pages like [/fertility](https://theribbonbox.com/fertility), the body of the page is build using the [blog_filter] shortcode. For example:

/fertility: `[blog_filter format='post-page' add_ad='Yes' categoryid='1164']`

## JavaScript

The theme's main JS is in `/js/javascript2.js`, which appears to be the `/js/TO-DELETE/javascript1.js` file, after being run through some sort of minification process.

### "Load more" / "Infinite scroll"

This is done by the following:
- Home page: `$('#loadHome')` code in `/js/home-js.php`, which calls `/functions.php->home_page_load_function()`
- All other pages: `/js/index-load-more.js`, which calls `/functions.php->blog_filter_load_function()`