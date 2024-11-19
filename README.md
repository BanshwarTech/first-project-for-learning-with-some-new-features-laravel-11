
# Laravel Useful Commands and Routes Guide

## Starting with Useful Commands
1. Start Laravel Server
   php artisan serve

2. General Artisan Command
   php artisan


## Routes Guide

### Common Artisan Commands for Routes
1. Get Help for Route Commands
   php artisan route -h
   - Use -h to get detailed information about a specific command.

2. List Custom Routes Only (Excluding Vendor Routes)
   php artisan route:list --except-vendor
   - Shows only your application's routes.

3. Filter Routes by Specific Path
   php artisan route:list --path=post
   - Displays only routes related to post.


### Optional Parameters in Routes
- Example:
  If you use a route like "/post/{id?}", it allows accessing the route even without providing the id.


## Validating Route Parameters
### You can validate route parameters with specific rules:
1. Constraints Examples:
   http://localhost/post/10         // whereNumber('id')
   http://localhost/post/yahoobaba  // whereAlpha('name')
   http://localhost/post/news10     // whereAlphaNumeric('name')
   http://localhost/post/song       // whereIn('category', ['movie', 'song'])
   http://localhost/post/@10        // where('id', '[@0-9]+') (Regular Expressions)

2. Code Example with Validation:
   Route::get('/post/{id}', function (string $id) {
       return 'User ' . $id;
   })->whereNumber('id');


## Named Routes and Route Groups

### Named Routes
- What It Does:
  If a route's URL is used in multiple places, naming it ensures easier management. Updating the URL in one place will reflect everywhere.

- Example:
  Route::get('/post/{id}', function (string $id) {
      return 'User ' . $id;
  })->whereNumber('id')->name('post');

- Redirect Using Named Routes:
  Route::redirect('/about', '/test', 301);
  - This creates a permanent redirect. Even if someone bookmarks the old URL, they'll be redirected to the new one.

- Tip: Look up "Redirect codes wiki" for more information.


### Route Groups
- Why Use Route Groups?
  To define a common prefix for multiple related routes.

- Example:
  Route::prefix('page')->group(function () {
      Route::get('/post/1', function () {
          // Code for /page/post/1
      });

      Route::get('/about', function () {
          // Code for /page/about
      });

      Route::get('/gallery', function () {
          // Code for /page/gallery
      });
  });
  - This adds the page prefix to all routes in the group, e.g., /page/post/1, /page/about, and /page/gallery.


### Fallback Route
- Purpose:
  Use a fallback route to handle requests to undefined pages.

- Example:
  Route::fallback(function () {
      return "<h6>Page Not Found</h6>";
  });
  - This is helpful for displaying a "404 Page Not Found" message when the requested route does not exist.

