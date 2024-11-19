
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

### if we add @ before too any php code then it will be print exactly same.

### BLADE Template

- What is Blade Template?
- Blade Template
- → Template Engine Based on PHP

- Blade provides a clean and convenient way to create views in Laravel.

##### Benefits:
1. Create Dynamic and Reusable Templates
2. Supports HTML & PHP

<h1>Blade vs Core PHP Comparison</h1>
    <table>
        <thead>
            <tr>
                <th>Feature</th>
                <th>Core PHP Syntax</th>
                <th>Blade Syntax</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Echo Simple Text</td>
                <td>&lt;?php echo "Hello"; ?&gt;</td>
                <td>{{ "Hello" }}</td>
            </tr>
            <tr>
                <td>Echo Variable</td>
                <td>&lt;?php echo $name; ?&gt;</td>
                <td>{{ $name }}</td>
            </tr>
            <tr>
                <td>Echo Raw HTML</td>
                <td>&lt;?php echo "&lt;h1&gt;Hello&lt;/h1&gt;"; ?&gt;</td>
                <td>{!! "&lt;h1&gt;Hello&lt;/h1&gt;" !!}</td>
            </tr>
            <tr>
                <td>Execute PHP Code</td>
                <td>&lt;?php // PHP code ?&gt;</td>
                <td>@php // PHP code @endphp</td>
            </tr>
            <tr>
                <td>PHP Comments</td>
                <td>&lt;?php // This is a comment ?&gt;</td>
                <td>{-- This is a comment --}</td>
            </tr>
            <tr>
                <td>If Statement</td>
                <td>
                    &lt;?php<br>
                    if ($condition) {<br>
                    &nbsp;&nbsp;// Code<br>
                    } elseif ($condition) {<br>
                    &nbsp;&nbsp;// Code<br>
                    } else {<br>
                    &nbsp;&nbsp;// Code<br>
                    }<br>
                </td>
                <td>
                    @if ($condition)<br>
                    &nbsp;&nbsp;// Code<br>
                    @elseif ($condition)<br>
                    &nbsp;&nbsp;// Code<br>
                    @else<br>
                    &nbsp;&nbsp;// Code<br>
                    @endif
                </td>
            </tr>
            <tr>
                <td>For Loop</td>
                <td>
                    &lt;?php<br>
                    for ($i = 0; $i &lt; 10; $i++) {<br>
                    &nbsp;&nbsp;echo "Value: $i";<br>
                    }<br>
                </td>
                <td>
                    @for ($i = 0; $i &lt; 10; $i++)<br>
                    &nbsp;&nbsp;Value: {{ $i }}<br>
                    @endfor
                </td>
            </tr>
            <tr>
                <td>Foreach Loop</td>
                <td>
                    &lt;?php<br>
                    foreach ($users as $user) {<br>
                    &nbsp;&nbsp;echo $user;<br>
                    }<br>
                </td>
                <td>
                    @foreach ($users as $user)<br>
                    &nbsp;&nbsp;{{ $user }}<br>
                    @endforeach
                </td>
            </tr>
            <tr>
                <td>Forelse with Empty</td>
                <td>N/A</td>
                <td>
                    @forelse ($users as $user)<br>
                    &nbsp;&nbsp;{{ $user->name }}<br>
                    @empty<br>
                    &nbsp;&nbsp;No users<br>
                    @endforelse
                </td>
            </tr>
            <tr>
                <td>While Loop</td>
                <td>
                    &lt;?php<br>
                    while ($condition) {<br>
                    &nbsp;&nbsp;echo "Running";<br>
                    }<br>
                </td>
                <td>
                    @while ($condition)<br>
                    &nbsp;&nbsp;Running<br>
                    @endwhile
                </td>
            </tr>
            <tr>
                <td>Loop Variables</td>
                <td>
                    $index = 0;<br>
                    foreach ($users as $user) {<br>
                    &nbsp;&nbsp;echo $index++;<br>
                    }
                </td>
                <td>
                    @foreach ($users as $user)<br>
                    &nbsp;&nbsp;{{ $loop->index }}<br>
                    @endforeach
                </td>
            </tr>
            <tr>
                <td>Break Statement</td>
                <td>
                    foreach (...) {<br>
                    &nbsp;&nbsp;if (...) break;<br>
                    }
                </td>
                <td>
                    @foreach (...)<br>
                    &nbsp;&nbsp;if (...) @break<br>
                    @endforeach
                </td>
            </tr>
            <tr>
                <td>Continue Statement</td>
                <td>
                    foreach (...) {<br>
                    &nbsp;&nbsp;if (...) continue;<br>
                    }
                </td>
                <td>
                    @foreach (...)<br>
                    &nbsp;&nbsp;if (...) @continue<br>
                    @endforeach
                </td>
            </tr>
        </tbody>
    </table>


