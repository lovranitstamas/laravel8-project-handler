<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{route('index')}}">Kezdőlap</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{route('contact_person.index')}}">Kapcsolattartók</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('status.index')}}">Projekt státuszok</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('project.index')}}">Projektek</a>
            </li>
        </ul>
    </div>
</nav>


