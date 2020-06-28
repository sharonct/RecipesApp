
{{-- check for any error in the laravel app--}}
@if(count($errors) > 0)
    <div class="error">
    @foreach($errors->all() as $error)
      
          <p>{{$error}}</p>
      
    @endforeach
    </div>
@endif

{{-- check for successful session --}}
@if(session('success'))
  <div class="success">
            {{session('success')}}
  </div>
@endif

{{-- check for errors in sessions --}}
@if(session('error'))
  <div class="error">
            {{session('error')}}
  </div>
@endif