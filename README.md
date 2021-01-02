# RESTFull API LARAVEL + VUE

## Description

This repository is a Software of Development with Laravel,MySQL,VUE,Axios,Boostrap,etc

## Installation

Using Laravel 8.5 and Vue.js 2.5 preferably.

## DataBase

Using MySQL preferably.
Create a MySQL database and configure the .env file.

## Apps

Using Postman,Talend API Tester,Insomnia,etc

## Usage

```html
$ git clone https://github.com/DanielArturoAlejoAlvarez/RESTFull-Laravel-8.5-Eloquent-API-Resources[NAME APP]

$ composer install

$ copy .env.example .env

$ php artisan key:generate

$ php artisan migrate:refresh --seed

$ php artisan serve

$ npm install (Frontend)

$ npm run dev

```

Follow the following steps and you're good to go! Important:

![alt text](https://graphql-engine-cdn.hasura.io/learn-hasura/assets/graphql-react/graphql-api.gif)

## Coding

### Component

```js
...
import axios from 'axios';

    export default {
       data() {
           return {
               posts: null
           }
       },
       mounted() {
           this.getPosts()
       },
       methods: {
           getPosts: function() {
            axios.get('api/posts')
                .then(res=>{
                    this.posts = res.data
                })
            }
       }
       
    }
...
```

### Controllers

```php
...
class PostController extends Controller
{

    protected $post;

    /**HTTP Status
     * 1XX Info
     * 2XX Respose Successfully
     * 3XX Redirection
     * 4XX Error Client
     * 5XX Error Server
     */

    public function __construct(Post $post)
    {
        $this->post = $post;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(
            new PostCollection(
                $this->post->orderBy('id', 'DESC')->get()
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {

        $post = $this->post->create($request->all());
        return response()->json(new PostResource($post), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {

        return response()->json(new PostResource($post), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $post->update($request->all());
        return response()->json(new PostResource($post));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        /**
         * VerifyCsrfToken apply except api/*
         */
        return response()->json(null, 204);
    }
}
...
```

### Models

```php
...
class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title','body'];

}
...
```

### Resources

```php
...
class Post extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'id'            =>  $this->id,
            'post_name'     =>  strtoupper($this->title),
            'post_body'     =>  strtoupper(substr($this->body,0,100)) . '...',
            'published_at'  =>  $this->created_at->diffForHumans(),
            'created_at'    =>  $this->created_at->format('d-m-Y'),
            'updated_at'    =>  $this->updated_at->format('d-m-Y'),
        ];
    }
}
...
```

### Middlewares

```php
...
class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'api/*'
    ];
}
...
```

### Routes
```php
...

#API
Route::apiResource('posts', App\Http\Controllers\Api\PostController::class)->names([
  'index'   =>  'api.posts.index',
  //'store'   =>  'api.posts.store',
  //'show'    =>  'api.posts.show',
  //'update'  =>  'api.posts.update',
  //'destroy' =>  'api.posts.destroy',
])->only('index');

#WEB
Route::get('/', [App\Http\Controllers\PageController::class, 'index'])->name('welcome');

Route::group(['prefix' => 'api'], function () {
    //Route::apiResource('posts', PostController::class);
});

Route::middleware('auth')->resource('posts', App\Http\Controllers\Backend\PostController::class)->only('index');

Route::get('/home', [App\Http\Controllers\Backend\HomeController::class, 'index'])->name('home');

Auth::routes();

...
```

### Factory
```php
...
public function definition()
    {
        return [
            'title' =>  $this->faker->sentence,
            'body'  =>  $this->faker->text,
        ];
    }
...
```

### Seeders
```php
...
public function run()
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\User::create([
            'name'      =>  [YOUR NAME],
            'email'     =>  [YOUR EMAIL],
            'password'  =>  bcrypt([YOUR PASSWORD])
        ]);

        \App\Models\Post::factory(18)->create();
    }
...
```

### HTTP Resources

```html
$ http://127.0.0.1:8000/posts (frontend/backend[auth])

$ http://127.0.0.1:8000/api/posts (API)

```


## Contributing

Bug reports and pull requests are welcome on GitHub at https://github.com/DanielArturoAlejoAlvarez/RESTFull-Laravel-8.5-Eloquent-API-Resources. This project is intended to be a safe, welcoming space for collaboration, and contributors are expected to adhere to the [Contributor Covenant](http://contributor-covenant.org) code of conduct.

## License

The gem is available as open source under the terms of the [MIT License](http://opensource.org/licenses/MIT).

```

```