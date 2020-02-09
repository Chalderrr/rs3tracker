@extends('layouts.main')



@section('content')
    <section class="section">
        <div class="container">
            <h1 class="title">Runescape 3 Adventurer's Log</h1>
            <h2 class="subtitle">Use the search below to return results for the given name</h2>
        </div>
    </section>

    <section class="section">
        <div class="container">

            <search-component></search-component>

        </div>
    </section>
@endsection