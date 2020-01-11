<div><img src="storage/images/recipes/{{ $recipe->picture}}"></div>
<h1>{{ $recipe->name }}</h1>
<p>{{ $recipe->description }}</p>
<p>Created by: {{ $recipe->user->name }}</p>

<hr>
<p>Cooking time (min): {{ $recipe->cook_time }}</p>
<p>Preparation time (min): {{ $recipe->prep_time }}</p>

<p>Ingredients:</p>
<ul>
    @foreach ($recipe->ingredients as $ingredient)
    <li>
        {{ $ingredient->pivot->amount }}
        {{ $ingredient->pivot->unit }} of
        <a href="https://en.wikipedia.org/wiki/{{ $ingredient->wikipedia_id }}" target="_blank"> {{ $ingredient->name }}</a>
    </li>
    @endforeach
</ul>


<div class="footer">
    <img src="storage/images/recipes/Recipe_Watermark.png">
</div>

<style>
    .footer {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        text-align: center;
    }
</style>