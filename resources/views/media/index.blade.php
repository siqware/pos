@extends('layouts.dashboard')
@section('title')
    មេឌៀ
@stop
@section('content')
    <div class="row">
        <div class="column">
            <div class="ui segments stacked">
                <div class="ui segment">
                    <h5 class="ui header">
                        មេឌៀ
                    </h5>
                </div>
                <div class="ui segment">
                    <iframe src="laravel-filemanager" style="width: 100%; height: 500px; overflow: hidden; border: none;"></iframe>
                </div>
            </div>
        </div>
    </div>
@stop
@push('css')
    <link rel="stylesheet" href="">
@endpush
@push('js')
    <script src=""></script>
@endpush
@section('js')
    <script>
    </script>
@stop
