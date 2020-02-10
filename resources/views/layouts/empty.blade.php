@section('container', 'container-fluid')
<div class="d-flex justify-content-center align-items-center m-5 p-5 position-relative">
	
	<h2>
		<span class="text-muted">Er is nog geen {{ $type }} gemaakt...</span><br />
		<small>Klik op de knop rechtsboven om te beginnen!</small>
	</h2>
	<img style="width: 20vw; position: absolute; right: 75px; top: 0;" src="{{ asset("img/arrow.png") }}" alt="">

</div>