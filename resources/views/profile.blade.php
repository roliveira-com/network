@extends('layouts.master')

@section('title')
Perfil
@endsection

@section('content')
<section class="hero is-primary">
    <div class="hero-body">
        <div class="container">
            <div class="columns is-vcentered">
                {{-- <div class="column is-1">
                    <img src="/image/icons/profile.png" alt="">
                </div> --}}
                <div class="column">
                    <h1 class="title">Bem vindo, {{ Auth::user()->name }}</h1>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="columns">
            <div class="column is-offset-2 is-2">
                @if (Storage::disk('local')->has($user->name . '-' . $user->id . '.jpg'))
                <figure class="image is-128x128">
                    <img class="is-rounded" src="{{ route('profile.image', ['filename' => $user->name . '-' . $user->id . '.jpg']) }}">
                </figure>
                @else
                <figure class="image is-128x128">
                    <img class="is-rounded" src="/image/icons/profile_primary.png">
                </figure>
                @endif
            </div>
            <div class="column is-6">
                <form action="{{ route('profile.save') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="field">
                        <label class="label">Nome</label>
                        <div class="control">
                            <input type="text" name="name" class="input is-medium" value="{{ $user->name }}" id="name">
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Email</label>
                        <div class="control">
                            <input type="text" name="email" class="input is-medium" value="{{ $user->email }}" id="email">
                        </div>
                    </div>
                    <p>&nbsp;</p>
                    <div class="field">
                        <div class="file has-name is-fullwidth is-medium">
                            <label class="file-label">
                                <input class="file-input" type="file" name="image" id="image">
                                <span class="file-cta">
                                <span class="file-icon">
                                    <i class="icon-cloud-upload"></i>
                                </span>
                                <span class="file-label">
                                    Selecione um foto...
                                </span>
                                </span>
                                <span class="file-name"></span>
                            </label>
                        </div>
                    </div>

                    <div class="field is-grouped">
                        <div class="control">
                            <button class="button is-link">Submit</button>
                        </div>
                        <div class="control">
                            <button class="button is-text">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection