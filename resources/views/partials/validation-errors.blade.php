@error('record')
<ul>
    @foreach ($errors as $error )
    <div class="small mb-2">
        <li class="text-danger"> {{$error}} </li>
    </div>
    @endforeach
</ul>    
@enderror