@if(session('success'))<div class="alert alert-success">{{session('success')}}</div>@endif
@if(session('error'))<div class="alert alert-error">{{session('error')}}</div>@endif
@if($errors->any())<div class="alert alert-error"><ul>@foreach($errors->all() as $e)<li>{{$e}}</li>@endforeach</ul></div>@endif
