## form start some useful commands
    1. php artisan serve
    2. php artisan 

    3. ROUTES
        php artisan route -h "if we add -h of any command then it will be give taht related details.".
        php artisan route:list --except-vendor "it is only shown the routes from created of own."
        php artisan route:list --path=post "shown only post routes"

        if we "/post/{id?}" use this then we can open a without id value

        if we validate parameter value in url then use it 
            http://localhost/post/10 → whereNumber('id')
            http://localhost/post/yahoobaba → whereAlpha('name')
            http://localhost/post/news10 → whereAlphaNumeric('name')
            http://localhost/post/song → whereIn('category', ['movie', 'song'])
            http://localhost/post/@10 → where('id', '[@0-9]+') (Regular Expressions)

            Route::get('/post/{id}',function(string $id){
                return 'User'.$id;
            })->whereNumber('id');  
    
        NAMED ROUTES AND ROUTE GROUPS

        NAMED ROUTES : if we create some routes then define the rrl then we updated in route file but this url is used in more than one place then we can use it ::

        Route::get('/post/{id}',function(string $id){
                return 'User'.$id;
        })->whereNumber('id')->name('post');  

        Route::redirect('/about','/test',301);permanent change it we change url but any will be save in bookmark with previous url 

        // read it "redirect codes wiki"

        ROUTE GROUPS : 

        Route::prefix('page')->group(function () {
            Route::get('/post/1', function () {
                // Code for /post/1
            });

            Route::get('/about/', function () {
                // Code for /about/
            });

            Route::get('/gallery/', function () {
                // Code for /gallery/
            });
        });
        define one time with more than one page url with prefix

        // fallback()
        Route::fallback(function(){
            return "<h1>Page Not Found.</h1>"
        });

        it is used for , we can not create the page then we use it
