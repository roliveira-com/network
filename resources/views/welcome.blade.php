@extends('layouts.master')

@section('title')
    Bem Vindo!
@endsection

@section('content')
    <section class="hero is-primary">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    Hero title
                </h1>
                <h2 class="subtitle">
                    Hero subtitle
                </h2>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="columns">
                <div class="column is-5">
                    <h2 class="title is-2">Sign up</h2>
                    <form action="{{ route('signup') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="field">
                            <label class="label">Email</label>
                            <div class="control">
                                <input class="input is-medium" type="text" placeholder="email" name="email" id="email">
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Name</label>
                            <div class="control">
                                <input class="input is-medium" type="text" placeholder="nome" name="name" id="name">
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Password</label>
                            <div class="control">
                                <input class="input is-medium" type="password" placeholder="nome" name="password" id="password">
                            </div>
                        </div>
                        <div class="field is-grouped is-grouped-right">
                            <p class="control">
                                <button type="submit" class="button is-primary"> Sign up </button>
                            </p>
                        </div>
                        {{-- <div class="field">
                            <label class="label">Name</label>
                            <div class="control">
                                <div class="select">
                                    <select>
                                        <option>Select dropdown</option>
                                        <option>With options</option>
                                    </select>
                                </div>
                            </div>
                        </div> --}}
                    </form>
                </div>
                <div class="column is-2"></div>
                <div class="column is-5">
                    <h2 class="title is-2">Sign in</h2>
                    <form action="{{ route('signin') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="field">
                            <label class="label">Email</label>
                            <div class="control">
                                <input class="input" type="text" placeholder="email" name="email">
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Password</label>
                            <div class="control">
                                <input class="input" type="password" placeholder="nome" name="password">
                            </div>
                        </div>
                        <div class="field is-grouped is-grouped-right">
                            <p class="control">
                                <button type="submit" class="button is-primary"> Sign in </button>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection