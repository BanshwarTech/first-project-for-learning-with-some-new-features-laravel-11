
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
- php artisan route:list --except-vendor
- php artisan route:list --path=user // with name

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

#### Laravel Migration Commands
==========================

#### Below are the commonly used Laravel Artisan commands for handling database migrations:

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
### numeric datatypes in mysql
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
-  $table->bit('column_name', 64); // BIT(size) 1 to 64
   - $table->tinyInteger('column_name'); // TINYINT(size) -128 to 127
  -  $table->integer('column_name'); // INT(size) -2147483648 to 2147483647
   - $table->smallInteger('column_name'); // SMALLINT(size) -32768 to 32767
  -  $table->mediumInteger('column_name'); // MEDIUMINT(size) -8388608 to 8388607
  -  $table->bigInteger('column_name'); // BIGINT(size) -9223372036854775808 to 9223372036854775807
   -   $table->boolean('column_name'); // BOOL / BOOLEAN 0 or 1
   -   $table->float('column_name', 8, 2); // FLOAT(p) with precision
   -   $table->double('column_name', 15, 8); // DOUBLE(size, d)
   -   $table->decimal('column_name', 60, 30); // DECIMAL(size, d) Size=60, d=30
   -   $table->decimal('column_name', 60, 30); // DEC(size, d) (same as DECIMAL)
});

## Modification with Migration
- Column Modification
    - Add New Column
    - Rename Column
    - Delete Column
    - Change Column Order 
    - Change Datatypes or Size of Column

- Table Modification
   - Rename Table
   - Delete Table

### Add to Column with Migration
- php artisan make:migration update_students_table --table=students  // it is used to update column table 
- php artisan migrate 

   - $table->renameColumn('from','to'); 
   - $table->dropColumn('city');
   - table->dropColumn(['city','avtar','location']);
   - $table->string('name',50)->change();
   - $table->integer('votes')->unsigned()->default(1)->comment('my comment')->change();
   - change column order 
            $table->after('password',function(Blueprint $table){
                $table->string('address');
                $table->string('city');
            })
### Table Modification
- $table->rename('from','to');
- $table->drop('users');   
- Schema::dropIfExists('users');
- if(Schema::hasTable('users')){  // the 'users' table exists...'} 
- if(Schema::hasColumn('users','email')){  // the 'users' table exists and has an 'email' column...'}     

### Laravel: Constraints with Migration
This guide explains how to use constraints in Laravel migrations to enforce database rules such as NOT NULL, UNIQUE, DEFAULT, PRIMARY KEY, FOREIGN KEY, and CHECK.
1. NOT NULL
    - $table->string('email')->nullable();
    - Adding nullable() allows the column to accept NULL values.
    - If omitted, the column will be NOT NULL by default.
2. UNIQUE

    - At the column level:
        -- $table->string('email')->unique();

    - Or separately:
        -- $table->unique('email');

3. DEFAULT VALUE

    - $table->string('city')->default('Agra');
    - Sets a default value for the column. If no value is provided, 'Agra' will be stored.

4. PRIMARY KEY

    - $table->primary('user_id');
    - Declares user_id as the primary key.

5. FOREIGN KEY

    - $table->foreign('user_id')->references('id')->on('users');
    - Creates a foreign key relationship linking the user_id column to the id column in the users table.

6. CHECK CONSTRAINT

    - DB::statement('ALTER TABLE users ADD CONSTRAINT age CHECK (age > 18);');
    - Adds a CHECK constraint using raw SQL. Laravel migrations do not currently support CHECK constraints natively, so raw SQL is necessary.

### LARAVEL: Column Modifiers 
<table>
  <thead>
    <tr>
      <th>Modifier</th>
      <th>Description</th>
      <th>Example</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><code>->after('column')</code></td>
      <td>Places the column <strong>after</strong> another column in the table (MySQL).</td>
      <td><code>$table->string('new_column')->after('existing_column');</code></td>
    </tr>
    <tr>
      <td><code>->autoIncrement()</code></td>
      <td>Sets an INTEGER column as auto-incrementing (used for primary keys).</td>
      <td><code>$table->id()->autoIncrement();</code></td>
    </tr>
    <tr>
      <td><code>->comment('my comment')</code></td>
      <td>Adds a comment to the column (MySQL/PostgreSQL).</td>
      <td><code>$table->string('username')->comment('Stores the username of the user');</code></td>
    </tr>
    <tr>
      <td><code>->first()</code></td>
      <td>Places the column as the <strong>first</strong> column in the table (MySQL).</td>
      <td><code>$table->string('new_column')->first();</code></td>
    </tr>
    <tr>
      <td><code>->from($integer)</code></td>
      <td>Sets the starting value of an auto-incrementing field (MySQL/PostgreSQL).</td>
      <td><code>$table->increments('id')->from(1000);</code></td>
    </tr>
    <tr>
      <td><code>->invisible()</code></td>
      <td>Makes the column <strong>invisible</strong> to SELECT * queries (MySQL).</td>
      <td><code>$table->string('secret_key')->invisible();</code></td>
    </tr>
    <tr>
      <td><code>->unsigned()</code></td>
      <td>Marks an INTEGER column as <strong>unsigned</strong> (MySQL).</td>
      <td><code>$table->unsignedInteger('user_id');</code></td>
    </tr>
    <tr>
      <td><code>->useCurrent()</code></td>
      <td>Sets a TIMESTAMP column to use the current timestamp as the default value.</td>
      <td><code>$table->timestamp('created_at')->useCurrent();</code></td>
    </tr>
    <tr>
      <td><code>->useCurrentOnUpdate()</code></td>
      <td>Updates the TIMESTAMP column to the current timestamp when a record is updated (MySQL).</td>
      <td><code>$table->timestamp('updated_at')->useCurrentOnUpdate();</code></td>
    </tr>
  </tbody>
</table>

### 3 way to make foreign key
1. Using foreign Method
    - $table->foreign('stu_id')->references('id')->on('students');
   -  Define the foreign key explicitly.
    - Use references() to specify the column in the referenced table.
   - Use on() to specify the parent table.

2. Using foreignId with constrained
    - $table->foreignId('stu_id')->constrained('students');
    - Use foreignId() to define the foreign key column and its type (unsignedBigInteger).
    - constrained('students') automatically links stu_id to the id column of the students table.

3. Using unsignedBigInteger and Adding foreignId with constrained
    - $table->unsignedBigInteger('student_id');
    - $table->foreignId('student_id')->constrained();

    First, define the column as unsignedBigInteger.
    Then, add a foreign key constraint using foreignId()->constrained().
    The constrained() method automatically links to the table inferred from the column name (student_id → students).

    Differences:
    Explicit vs Implicit: The foreign method is more explicit, while foreignId()->constrained() is more concise.
    Ease of Use: foreignId()->constrained() automates naming conventions, reducing manual work.

### Laravel Seeders
- seeders are used to populate database tables with test or dummy data. Seeders help you quickly fill your database during development or testing without manually inserting data into tables.

- steps 
    -- first create model 
    -- create seeder
        php artisan make:seeder StudentSeeder
    -- create data in StudentSeeder
        stuudent::create([
            'name'=>'',
            'email'=>''
        ]);
    -- call the seeder in the seeders/databaseseeder.php;
        $this->call([
            StudentSeeder::class
        ]);
    -- run command : php artisan db:seed

    collect method is used 
     $students = collect(
            [
                [
                    'name' => 'John Doe',
                    'email' => 'johndoe@example.com',
                ],
                [
                    'name' => 'Jane Smith',
                    'email' => 'janesmith@example.com',
                ],
                [
                    'name' => 'Michael Johnson',
                    'email' => 'michaeljohnson@example.com',
                ],
                [
                    'name' => 'Emily Davis',
                    'email' => 'emilydavis@example.com',
                ],
                [
                    'name' => 'Chris Brown',
                    'email' => 'chrisbrown@example.com',
                ],
                [
                    'name' => 'Sarah Wilson',
                    'email' => 'sarahwilson@example.com',
                ],
                [
                    'name' => 'David Miller',
                    'email' => 'davidmiller@example.com',
                ],
                [
                    'name' => 'Sophia Garcia',
                    'email' => 'sophiagarcia@example.com',
                ],
                [
                    'name' => 'James Martinez',
                    'email' => 'jamesmartinez@example.com',
                ],
                [
                    'name' => 'Olivia Hernandez',
                    'email' => 'oliviahernandez@example.com',
                ],
            ]
        );


php artisan migrate:fresh --seed

if we insert more than 1000 data in database using seeder then first we create one json file with data

if we use toi insert fakke data in database for only tesing purpose in seeder then : 
        fake()->fieldwith();
