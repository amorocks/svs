@extends('layouts.app')

@section('buttons')
    <a href="{{ route('tracks.create') }}" class="btn btn-outline-gray"><i class="fas fa-plus"></i> Nieuw programma</a>
@endsection

@section('content')
    @if(count($tracks) < 1)
        @include('layouts.empty', ['type' => 'programma'])    
    @else

    <h2>
        Programma's
        @if(\Auth::user()->level < 3)
            in {{ \Auth::user()->unit }}
        @elseif(isset($education))
            in {{ $education->title }}
        @endif
    </h2>
    <table class="table table-striped table-hover" data-controller="filter" data-filter-display="table-row">
        <tr>
            <th>Titel</th>
            <th>Start</th>
            <th>Einde</th>
            <th>Opleiding</th>
            <th>&nbsp;</th>
        </tr>
        <tr>
            <td colspan="5"><input class="form-control" placeholder="Filter lijst" type="text" data-target="filter.query" data-action="input->filter#filter"></td>
        </tr>

        @foreach($tracks as $track)
            <tr data-target="filter.list">
                <td>{{ $track->title }}</td>
                <td>{{ $track->start->format('d-m-Y') }}</td>
                <td>{{ $track->end->format('d-m-Y') }}</td>
                <td>{{ $track->education }}</td>
                <td>
                    <a href="{{ route('tracks.edit', $track->id) }}"><i class="fas fa-edit"></i></a> |
                    <a href="{{ route('tracks.show', $track->id) }}"><i class="fas fa-cubes"></i> blokken</a>
                </td>
            </tr>
        @endforeach

    </table>
    @endif
@endsection