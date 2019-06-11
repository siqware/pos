@extends('layouts.dashboard')
@section('title')
    កែប្រែអ្នកប្រើប្រាស់
@stop
@section('content')
    <div class="row">
        <div class="column">
            <div class="ui segments stacked">
                <div class="ui segment">
                    <h5 class="ui header">
                        កែប្រែអ្នកប្រើប្រាស់
                    </h5>
                </div>
                <div class="ui segment">
                    {{Form::open(['url'=>route('user.update',$user->id),'method'=>'put','class'=>'ui form segment'])}}
                    {{csrf_field()}}
                    <table class="ui compact celled definition table tablet stackable">
                        <thead>
                        <tr>
                            <th colspan="2">
                                ពត៌មានទំនិញទូទៅ
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="three wide column right aligned">រូបភាពប្រូហ្វាល</td>
                            <td class="thirteen wide column">
                                <div class="ui input popupHover m-0" id="lfm" data-input="profile" data-preview="profile_holder" data-content="ដាក់រូបភាព" data-variation="larg">
                                    <div class="ui button m-0">
                                        <img id="profile_holder" src="{{$user->profile=='មិនបានដាក់ជូន'?asset('files/1/placholder.png'):asset($user->profile)}}" style="margin-top:15px;max-height:100px;">
                                    </div>
                                    <input id="profile" type="hidden" value="{{$user->profile}}" name="profile">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="right aligned">
                                ឈ្មោះ
                            </td>
                            <td>
                                <div class="three fields m-0">
                                    <div class="field">
                                        <input type="text" name="user_name" value="{{$user->name}}" placeholder="ឈ្មោះ">
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="right aligned">
                                ទំនាក់ទំនង
                            </td>
                            <td>
                                <div class="three fields m-0">
                                    <div class="field">
                                        <label>អ៊ីម៉ែល</label>
                                        <input type="text" name="email" value="{{$user->email}}" placeholder="អ៊ីម៉ែល">
                                    </div>
                                    <div class="field">
                                        <label>លេខទូរស័ព្ទ</label>
                                        <input type="text" name="phone" value="{{$user->phone}}" placeholder="លេខទូរស័ព្ទ">
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="right aligned">
                                ពាក្យសម្ងាត់
                            </td>
                            <td>
                                <div class="three fields m-0">
                                    <div class="field">
                                        <input type="password" name="password" placeholder="ពាក្យសម្ងាត់">
                                    </div>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                        <tfoot class="full-width">
                        <tr>
                            <th colspan="4">
                                <button class="ui small primary labeled icon button hiddenui">
                                    <i class="edit icon"></i> កែប្រែ
                                </button>
                            </th>
                        </tr>
                        </tfoot>
                    </table>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
@stop
@push('css')
    <link rel="stylesheet" href="">
@endpush
@push('js')
    <script src="{{asset('vendor/laravel-filemanager/js/lfm.js')}}"></script>
@endpush
@section('js')
    <script>
    </script>
@stop
