@if($errors->any())
    <div class="alert alert-danger alert-dismissible">
        <div class="list-group">

            @foreach($errors->all() as $error)
                <div class="list-group-item">
                    {{$error}}
                </div>
            @endforeach

        </div>
    </div>

@endif

@if(session()->has('success'))
    <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert" >
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
        <div>
            {{  session()->get('success')  }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>


    </div>

@elseif(session()->has('error'))
    <div class="alert alert-danger">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{session()->get('error')}}
    </div>
@endif


