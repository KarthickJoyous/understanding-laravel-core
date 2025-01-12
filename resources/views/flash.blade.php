@session('flash_success')
<div class="alert alert-success alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    {{session('flash_success')}}
</div>
@endsession

@session('flash_error')
<div class="alert alert-danger alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    {{session('flash_error')}}
</div>
@endsession

@if($errors->any())
    @foreach($errors->all() as $error)
    <div class="alert alert-danger alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{$error}}
    </div>
    @endforeach
@endif