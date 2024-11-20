
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

- Blade Template : Template Engine Based on PHP. It provides a clean and convenient way to create views in Laravel.

##### Benefits:
1. Create Dynamic and Reusable Templates
2. Supports HTML & PHP

### Blade vs Core PHP Comparison
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
![Screenshot (60)](https://github.com/user-attachments/assets/58736a67-e63f-4f0f-93a0-083b28d8bc98)


### Blade Template Main Directives

- @include
- @section
- @extend
- @yield
<<<<<<< HEAD
## Blade Loop Variables for @foreach

    <table>
        <thead>
            <tr>
                <th>Property</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><code>$loop->index</code></td>
                <td>The index of the current loop iteration (starts at 0).</td>
            </tr>
            <tr>
                <td><code>$loop->iteration</code></td>
                <td>The current loop iteration (starts at 1).</td>
            </tr>
            <tr>
                <td><code>$loop->remaining</code></td>
                <td>The iterations remaining in the loop.</td>
            </tr>
            <tr>
                <td><code>$loop->count</code></td>
                <td>The total number of items in the array being iterated.</td>
            </tr>
            <tr>
                <td><code>$loop->first</code></td>
                <td>Whether this is the first iteration through the loop.</td>
            </tr>
            <tr>
                <td><code>$loop->last</code></td>
                <td>Whether this is the last iteration through the loop.</td>
            </tr>
            <tr>
                <td><code>$loop->even</code></td>
                <td>Whether this is an even iteration through the loop.</td>
            </tr>
            <tr>
                <td><code>$loop->odd</code></td>
                <td>Whether this is an odd iteration through the loop.</td>
            </tr>
            <tr>
                <td><code>$loop->depth</code></td>
                <td>The nesting level of the current loop.</td>
            </tr>
            <tr>
                <td><code>$loop->parent</code></td>
                <td>When in a nested loop, the parent's loop variable.</td>
            </tr>
        </tbody>
    </table>

###
php artisan route:list --except-vendor
php artisan route:list --path=user // with name

### laravel 11 new features

- minimum requirement  PHP 8.2
- improve folder structure
- Default Database - SQLite
- Laravel Reverb - WebSocket Server
- new once method
- model casts changes
- per-second rate limiting 
- eager load limit 
- some new artisan commands 
- named arguments removed

Laravel Migration Commands
==========================

Below are the commonly used Laravel Artisan commands for handling database migrations:

1. Create a Migration
   Command: php artisan make:migration create_students_table

2. Run Migrations
   Command: php artisan migrate

3. Check Migration Status
   Command: php artisan migrate:status

4. Rollback the Last Migration Batch
   Command: php artisan migrate:rollback

5. Rollback a Specific Number of Batches
   Command: php artisan migrate:rollback --step=2

6. Rollback a Specific Batch
   Command: php artisan migrate:rollback --batch=2

7. Reset All Migrations
   *Removes all tables from the database.*
   Command: php artisan migrate:reset

8. Refresh Migrations
   *Drops all tables and runs migrations again.*
   Command: php artisan migrate:refresh

9. Fresh Migrations
   *Rolls back all migrations and then runs them again.*
   Command: php artisan migrate:fresh

Notes:
- Ensure you have a backup of your database before performing destructive operations like `reset`, `refresh`, or `fresh`.
- Use the `--force` flag to bypass confirmation prompts in production environments (use with caution).

1. BIT(size)          1 to 64
2. TINYINT(size)     -128 to 127
3. INT(size)         -2147483648 to 2147483647
4. INTEGER(size)     -2147483648 to 2147483647
5. SMALLINT(size)    -32768 to 32767
6. MEDIUMINT(size)   -8388608 to 8388607
7. BIGINT(size)      -9223372036854775808 to 9223372036854775807
8. BOOL              0 / 1
9. BOOLEAN           0 / 1
10. FLOAT(p)
11. DOUBLE(size, d)  255.568
12. DECIMAL(size, d) Size = 60, d = 30
13. DEC(size, d)

Schema::create('table_name', function (Blueprint $table) {
    $table->bit('column_name', 64); // BIT(size) 1 to 64
    $table->tinyInteger('column_name'); // TINYINT(size) -128 to 127
    $table->integer('column_name'); // INT(size) -2147483648 to 2147483647
    $table->smallInteger('column_name'); // SMALLINT(size) -32768 to 32767
    $table->mediumInteger('column_name'); // MEDIUMINT(size) -8388608 to 8388607
    $table->bigInteger('column_name'); // BIGINT(size) -9223372036854775808 to 9223372036854775807
    $table->boolean('column_name'); // BOOL / BOOLEAN 0 or 1
    $table->float('column_name', 8, 2); // FLOAT(p) with precision
    $table->double('column_name', 15, 8); // DOUBLE(size, d)
    $table->decimal('column_name', 60, 30); // DECIMAL(size, d) Size=60, d=30
    $table->decimal('column_name', 60, 30); // DEC(size, d) (same as DECIMAL)
});



=======
![Screenshot (63)](https://github.com/user-attachments/assets/a8f2f278-bf89-4212-bde0-96c6f345484e)
>>>>>>> 061b208e93fa3276b4c8eadc13b747e42ecd493c

