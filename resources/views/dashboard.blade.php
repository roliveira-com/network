@extends('layouts.master')

@section('title')
Dashboard
@endsection

@section('content')
<section class="hero is-primary">
    <div class="hero-body">
        <div class="container">
            <div class="columns is-vcentered">
                <div class="column is-1">
                    <img src="/image/icons/home.png" alt="">
                </div>
                <div class="column">
                    <h1 class="title"> Dashboard</h1>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="columns">
            <div class="column is-offset-3 is-6">
                @include('partials.notification')
                <article class="media">
                    <figure class="media-left">
                        <p class="image is-64x64">
                            <img src="/image/logo/logo.png">
                        </p>
                    </figure>
                    <div class="media-content">
                        <form action="{{ route('post.create') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="field">
                                <p class="control">
                                    <textarea class="textarea {{ $errors->has('body') ? 'is-danger' : '' }}" name="body"
                                        placeholder="Add a comment..."></textarea>
                                </p>
                            </div>
                            <nav class="level">
                                <div class="level-left">
                                    <div class="level-item">
                                        {{-- <a class="button is-info">Submit</a> --}}
                                    </div>
                                </div>
                                <div class="level-right">
                                    <div class="level-item">
                                        <label class="checkbox">
                                            <button type="submit" class="button is-primary">Submit</button>
                                        </label>
                                    </div>
                                </div>
                            </nav>
                        </form>
                    </div>
                </article>
            </div>
        </div>
        <div class="columns">
            <div class="column is-offset-3 is-6">
                {{-- <div class="card">
                    <div class="card-image">
                        <figure class="image">
                            <img src="https://picsum.photos/600/400" alt="Placeholder image">
                        </figure>
                    </div>
                    <div class="card-content">
                        <div class="media">
                            <div class="media-left">
                                <figure class="image is-24x24">
                                    <img src="/image/logo/logo.png" alt="Placeholder image">
                                </figure>
                            </div>
                            <div class="media-content">
                                <p class="title is-4">John Smith</p>
                                <p class="subtitle is-6">@johnsmith</p>
                            </div>
                        </div>

                        <div class="content">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Phasellus nec iaculis mauris. <a>@bulmaio</a>.
                            <a href="#">#css</a> <a href="#">#responsive</a>
                            <br>
                            <time datetime="2016-1-1">11:09 PM - 1 Jan 2016</time>
                        </div>

                    </div>
                    <footer class="card-footer level">
                        <div class="level-left">
                            <div class="level-item">
                                <a class="button is-info">Submit</a>
                            </div>
                        </div>
                        <div class="level-right">
                            <div class="level-item">
                                <label class="checkbox">
                                    <a class="button is-white">delete</a>
                                    <a class="button is-white">edit</a>
                                    <a class="button is-white">like</a>
                                    <a class="button is-white">dislike</a>
                                </label>
                            </div>
                        </div>
                    </footer>
                </div> --}}
                @foreach ($posts as $post)
                <div class="card">
                    {{-- <div class="card-image">
                        <figure class="image">
                            <img src="https://picsum.photos/600/400" alt="Placeholder image">
                        </figure>
                    </div> --}}
                    <div class="card-content">
                        <div class="media">
                            <div class="media-left">
                                <figure class="image is-24x24">
                                    <img src="/image/logo/logo.png" alt="Placeholder image">
                                </figure>
                            </div>
                            <div class="media-content">
                                <p class="title is-4">{{ $post->user->name }}</p>
                                {{-- <p class="subtitle is-6">@johnsmith</p> --}}
                            </div>
                        </div>

                        <div class="content" data-post-id="{{ $post->id }}">
                            <p>{{ $post->body }}</p>
                            <time datetime="2016-1-1">{{ $post->created_at }}</time>
                        </div>

                    </div>
                    <footer class="card-footer level">
                        <div class="level-left">
                            <div class="level-item">
                                {{-- <a class="button is-info">Submit</a> --}}
                            </div>
                        </div>
                        <div class="level-right">
                            <div class="level-item">
                                <a class="button is-white">like</a>
                                <a class="button is-white">dislike</a>
                                @if (Auth::user() == $post->user)
                                <a data-element="modal" data-target="edit-modal" class="button is-white">edit</a>
                                <a href="{{ route('post.delete',['post_id' => $post->id]) }}" class="button is-white">delete</a>
                                @endif
                            </div>
                        </div>
                    </footer>
                </div>
                <p>&nbsp;</p>
                @endforeach
            </div>
        </div>
    </div>
</section>

<div id="edit-modal" class="modal">
    <div class="modal-background"></div>
    <div class="modal-card">
        <header class="modal-card-head">
            <p class="modal-card-title">Editar Post</p>
            <button class="button" aria-label="close" data-element="modal-close" data-target="edit-modal">X</button>
        </header>
        <section class="modal-card-body">
            <form>
                <div class="field">
                    <p class="control">
                        <textarea id="modal-post-body" class="textarea" name="post-body" placeholder="Add a comment..."></textarea>
                    </p>
                </div>
            </form>
            <p>&nbsp;</p>
            <div class="level">
                <div class="level-left">
                    <div class="level-item">
                        {{-- <a class="button is-info">Submit</a> --}}
                        <button class="button" data-element="modal-close" data-target="edit-modal">Cancel</button>
                    </div>
                </div>
                <div class="level-right">
                    <div class="level-item">
                        <button id="edit-post" class="button is-primary">Save changes</button>
                    </div>
                </div>         
            </div>
        </section>
    </div>
</div>

<script>
    var $modal = document.querySelectorAll('[data-element="modal"]');
    var $modalClose = document.querySelectorAll('[data-element="modal-close"]');
    var $editPostButton = document.getElementById('edit-post');
    var $editPostValue = document.getElementById('modal-post-body');
    var token = document.head.querySelector('meta[name="csrf-token"]')

    $modal.forEach(function(el){
        el.addEventListener('click',openModal)
    })

    $modalClose.forEach(function(el){
        el.addEventListener('click',closeModal)
    })

    $editPostButton.addEventListener('click', editPost)

    function openModal(evt){
        $modalTarget = document.getElementById(evt.target.getAttribute('data-target'))
        $modalTarget.classList.add('is-active');
        modalContent(evt);
    }

    function closeModal(evt){
        $modalTarget = document.getElementById(evt.target.getAttribute('data-target'))
        $modalTarget.classList.remove('is-active');
    }

    var Modal = {
        close: function(){
            $modals = document.querySelectorAll('.modal');
            $modals.forEach(function(el){
                el.classList.remove('is-active')
            })
        },
        open: function(element){
            if(element.classList.contains('modal')){
                element.classList.add('is-active')
            }else{
                console.warn('The specified element is not a Modal')
            }
        }
    }

    function modalContent(evt){
        $modalContent = document.getElementById('modal-post-body');
        $modalContent.value = evt.target.parentNode.parentNode.parentNode.parentNode.childNodes[1].getElementsByTagName('p')[1].innerHTML;
    }

    function editPost(){
        fetch('/edit', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': token.content,
            },
            body: JSON.stringify({
                body: $editPostValue.value,
                postId: "",
            })
        })
        .then(resp => {
            Modal.close();
            console.log(JSON.parse(resp));
        })
        .catch(error => {
            console.log(error);
        })
    }

</script>
@endsection