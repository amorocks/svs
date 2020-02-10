@extends('layouts.app')

@section('buttons')
    <a href="{{ route('educations.create') }}" class="btn btn-outline-gray"><i class="fas fa-plus"></i> Nieuwe opleiding</a>
@endsection

@section('content')
    @if(count($educations) < 1)
        @include('layouts.empty', ['type' => 'opleiding'])    
    @else

    <h2>
        Opleidingen
        @if(isset($unit))
            in {{ $unit }}
        @endif
    </h2>
    <table class="table table-striped table-hover" data-controller="filter" data-filter-display="table-row">
        <tr>
            <th>Titel</th>
            <th>Crebo</th>
            <th>Afdeling</th>
            <th>Punten</th>
            <th>&nbsp;</th>
        </tr>
        <tr>
            <td colspan="5"><input class="form-control" placeholder="Filter lijst" type="text" data-target="filter.query" data-action="input->filter#filter"></td>
        </tr>

        @foreach($educations as $education)
            <tr data-target="filter.list">
                <td>{{ $education->title }}</td>
                <td>#{{ $education->crebo }}</td>
                <td>{{ $education->unit }}</td>
                <td>{{ $education->points }}</td>
                <td>
                    <a href="{{ route('educations.edit', $education->id) }}"><i class="fas fa-edit"></i></a> |
                    <a href="{{ route('tracks.filter', $education->id) }}"><i class="fas fa-sitemap"></i> programma's</a>
                </td>
            </tr>
        @endforeach

    </table>
    @endif
@endsection