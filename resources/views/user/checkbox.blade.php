{{Form::open(['method'=>'put','url'=>route('user.updateRole',$user->id),'id'=>'is-admin'])}}
    <div class="ui toggle checkbox">
        <input type="checkbox" name="isAdmin" {{$user->role==1?'checked':''}}>
        <label>Is admin?</label>
    </div>
{{Form::close()}}
