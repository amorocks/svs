@extends('layouts.app')

@section('buttons')
    <a href="{{ route('terms.create') }}" class="btn btn-outline-gray"><i class="fas fa-plus"></i> Nieuw blok</a>
@endsection

@section('content')
    @if(count($terms) < 1)
        @include('layouts.empty', ['type' => 'blok'])    
    @else

    <h2>Blokken @if(\Auth::user()->level < 3) in {{ \Auth::user()->unit }} @endif</h2>
    <table class="table table-striped table-hover" data-controller="filter" data-filter-display="table-row">
        <tr>
            <th>Titel</th>
            <th>Start</th>
            <th>Einde</th>
            <th>Punten</th>
            <th>Afdeling</th>
            <th>&nbsp;</th>
        </tr>
        <tr>
            <td colspan="6"><input class="form-control" placeholder="Filter lijst" type="text" data-target="filter.query" data-action="input->filter#filter"></td>
        </tr>

        @foreach($terms as $term)
            <tr data-target="filter.list">
                <td>{{ $term->title }}</td>
                <td>{{ $term->valid_from->format('d-m-Y') }}</td>
                <td>{{ optional($term->valid_to)->format('d-m-Y') }}</td>
                <td>{{ $term->points }}</td>
                <td>{{ $term->unit }}</td>
                <td>
                    <a href="{{ route('terms.edit', $term->id) }}"><i class="fas fa-edit"></i></a>
                </td>
            </tr>
        @endforeach

    </table>
    @endif
@endsection