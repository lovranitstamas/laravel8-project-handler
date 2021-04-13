<p>Tisztelt {{$contactPerson}}!</p>

@if(isset($project['name']) && $project['name'])
    <p>Projekt neve: {{$project['name']}}</p>
@endif
@if(isset($project['description']) && $project['description'])
    <p>Leírás: {{$project['description']}}</p>
@endif
@if(isset($project['status']) && $project['status'])
    <p>Státusz: {{$project['status']}}</p>
@endif
