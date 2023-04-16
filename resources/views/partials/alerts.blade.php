@if(session('success'))
    <div class="alert alert-success">
        {{__('alert.Successfuly Done. ')}}
    </div>
@endif

@if (session('failed'))
    <div class="alert alert-danger">
        {{__('alert.Somthing gets wrong, try again. ')}}
    </div>
@endif