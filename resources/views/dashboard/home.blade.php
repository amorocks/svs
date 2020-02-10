@extends('layouts.app')

@section('content')

<h2 class="mt-5 mb-4">Student Volg Systeem</h2>

<div class="card-deck v-scroll" style="margin-bottom: 120px;"> <!-- for scrolling with fixed footer -->
	<div class="card" data-controller="filter">
		<h3 class="card-title mx-4 my-3">Mijn studenten</h3>
		<input class="form-control mx-4" style="width: initial;" placeholder="Filter lijst" type="text" data-target="filter.query" data-action="input->filter#filter">
		<ul class="list-group list-group-flush">
			@foreach($students as $student)
				<li class="list-group-item" data-target="filter.list"><a href="{{ route('student.u', $student) }}">{{ $student->name }}</a></li>
			@endforeach
		</ul>
	</div>
	<div class="card text-muted">
		<h3 class="card-title mx-4 my-3">Mijn taken</h3>
		<ul class="list-group list-group-flush list-group-icons">
			<!-- foreach -->
		</ul>
	</div>
	<div class="card">
		<h3 class="card-title mx-4 my-3">
			Incomplete vakken<br />
			<small style="font-size: 50%;">Doel, toetsing of tijden ontbreken nog</small>
		</h3>
		<ul class="list-group list-group-flush list-group-icons">
			
		</ul>
	</div>
</div>

<div class="bg-light fixed-bottom p-3">
	<h5 class="mb-0">Feedback</h5>
	<p class="mb-0">Maak <a href="https://github.com/amorocks/currapp/issues/new/choose" target="_blank">direct een issue aan</a> voor idee&euml;n, suggesties of problemen, of stuur een e-mail naar <a href="mailto:br10@rocwb.nl?subject=CurrApp+2.0">br10@rocwb.nl</a>.</p>
</div>

@endsection
