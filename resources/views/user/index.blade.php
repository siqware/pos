@extends('layouts.dashboard')
@section('title')
    បញ្ជីអ្នកប្រើប្រាស់
@stop
@section('content')
    <div class="row">
        <div class="column">
            <div class="ui segments stacked">
                <div class="ui segment">
                    <h5 class="ui header">
                        បញ្ជីអ្នកប្រើប្រាស់
                    </h5>
                </div>
                <div class="ui segment">
                    <table id="user_list" class="ui compact selectable striped celled table tablet stackable datatable">
                        <thead>
                        <tr>
                            <th>ល.រ</th>
                            <th>រូបប្រូហ្វាល</th>
                            <th>ឈ្មោះ</th>
                            <th>អ៊ីម៉ែល</th>
                            <th>លេខទូរស័ព្ទ</th>
                            <th>កំណត់សិទ្ធ</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
@push('css')
    <link rel="stylesheet" href="#">
@endpush
@push('js')
    <script src="{{asset('sigware/plugins/datatable/jquery.dataTables.js')}}"></script>
    <script src="{{asset('sigware/js/customjs/custom-datatable.js')}}"></script>
@endpush
@section('js')
    <script>
        $(function () {
            function initCheckbox(){
                let checkboxClass = document.querySelectorAll('.checkbox');
                $.each(checkboxClass,function (key,value) {
                    $(value).checkbox(event).first().checkbox({
                        onChecked: function () {
                            let form_node = event.target.parentNode.parentNode;
                            $(form_node).submit();
                            console.log(form_node)
                        },
                        onUnchecked: function () {
                            let form_node = event.target.parentNode.parentNode;
                            $(form_node).submit();
                            console.log(form_node)
                        },
                    });
                });
            }
            let user = $('#user_list').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                deferRender: true,
                ajax: {
                    url: '{{route('user.json.view')}}',
                    method: 'GET',
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'profile', name: 'profile',orderable:false,searchcable:false },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'phone', name: 'phone' },
                    { data: 'role', name: 'role' ,orderable:false,searchcable:false},
                    { data: 'action', name: 'action',orderable:false,searchcable:false }
                ],
                drawCallback:function(settings){
                    initCheckbox();
                }
            });
        })
    </script>
@stop
