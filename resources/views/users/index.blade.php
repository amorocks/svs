@extends('layouts.app')
@section('content')
    
    <h2>
        Gebruikers
        @if(isset($unit))
            in {{ $unit }}
        @endif
    </h2>
    <table class="table table-striped table-hover" data-controller="filter" data-filter-display="table-row">
        <tr>
            <th>Code</th>
            <th>Naam</th>
            <th>Level</th>
            <th>Afdeling</th>
            <th>&nbsp;</th>
        </tr>
        <tr>
            <td colspan="5"><input class="form-control" placeholder="Filter lijst" type="text" data-target="filter.query" data-action="input->filter#filter"></td>
        </tr>

        @foreach($users as $user)
            <tr data-target="filter.list">
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>
                    @switch($user->level)
                        @case(0) 0 - Student @break
                        @case(1) 1 - Docent @break
                        @case(2) 2 - Onderwijsco @break
                        @case(3) 3 - Admin @break
                    @endswitch
                </td>
                <td>
                    @if($user->unit)
                        <a href="{{ route('users.filter', $user->unit) }}">{{ $user->unit }}</a>
                    @endif
                </td>
                <td>
                    <a href="{{ route('users.edit', $user->id) }}"><i class="fas fa-edit"></i></a>
                </td>
            </tr>
        @endforeach

    </table>

@endsection