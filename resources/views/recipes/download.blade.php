
<div><img src="/storage/images/recipes/{{ $recipe->picture }}"></div>
<h1>{{ $recipe->name }}</h1>
<p>{{ $recipe->description }}</p>
<p>Created by: {{ $recipe->user->name }}</p>

<hr>
<p>Cooking time (min): {{ $recipe->cook_time }}</p>
<p>Preparation time (min): {{ $recipe->prep_time }}</p>

<p>Ingredients:</p>
<div>
    <ul>
        @foreach ($recipe->ingredients as $ingredient)
        <li>
            {{ $ingredient->pivot->amount }}
            {{ $ingredient->pivot->unit }} of
            {{ $ingredient->name }}
        </li>
        @endforeach
    </ul>
</div>