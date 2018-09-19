@if(count($errors) > 0)
    <div class="notification is-danger">
        <strong>Ops! Algo deu errado:</strong>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if(Session::has('message'))
    <div class="notification is-info">
        {{ Session::get('message') }}
    </div>
@endif
@if(Session::has('error'))
    <div class="notification is-danger">
        {{ Session::get('error') }}
    </div>
@endif