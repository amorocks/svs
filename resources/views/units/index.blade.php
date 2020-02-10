@extends('layouts.app')

@section('buttons')
    <a href="{{ route('units.create') }}" class="btn btn-outline-gray"><i class="fas fa-plus"></i> Nieuwe afdeling</a>
@endsection

@section('content')
    @if(count($units) < 1)
        @include('layouts.empty', ['type' => 'afdeling'])    
    @else

    <h2>Afdelingen</h2>
    <table class="table table-striped table-hover" data-controller="filter" data-filter-display="table-row">
        <tr>
            <th>Naam</th>
            <th>Leden</th>
            <th>&nbsp;</th>
        </tr>
        <tr>
            <td colspan="3"><input class="form-control" placeholder="Filter lijst" type="text" data-target="filter.query" data-action="input->filter#filter"></td>
        </tr>

        @foreach($units as $unit)
            <tr data-target="filter.list">
                <td>{{ $unit->title }}</td>
                <td>
                    <a href="{{ route('users.filter', $unit) }}">
                        {{ $unit->users->count() }} <i class="fas fa-users"></i>
                    </a>
                </td>
                <td>
                    <a href="{{ route('units.edit', $unit->id) }}"><i class="fas fa-edit"></i></a> |
                    <a href="{{ route('educations.filter', $unit->id) }}"><i class="fas fa-university"></i> opleidingen</a>
                </td>
            </tr>
        @endforeach

    </table>
    @endif
@endsection