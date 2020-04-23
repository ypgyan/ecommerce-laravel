@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <div class="row align-items-center">
        <div class="col-auto">
            <span class="icon icon-shape bg-white text-danger rounded-circle shadow h1 mb-0">
                <i class="fas fa-times"></i>
            </span>
        </div>
        <div class="col">
            @foreach ($errors->all() as $error)
                <div class="h3 mb-0 text-white">{{ $error }}</div>
            @endforeach
        </div>
    </div>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

@elseif (!empty($messages))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <div class="row align-items-center">
        <div class="col-auto">
            <span class="icon icon-shape bg-white text-warning rounded-circle shadow h1 mb-0">
                <i class="fas fa-exclamation"></i>
            </span>
        </div>
        <div class="col">
        @foreach ($messages as $message)
            <div class="h3 mb-0 text-white">{{ $message }}</div>
        @endforeach
        </div>
    </div>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

@elseif (Session::has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <div class="row align-items-center">
        <div class="col-auto">
            <span class="icon icon-shape bg-white text-success rounded-circle shadow h1 mb-0"  data-toggle="tooltip" data-original-title="Editar">
                <i class="fas fa-check"></i>
            </span>
        </div>
        <div class="col">
            <div class="h3 mb-0 text-white">{!! Session::get('success') !!}</div>
        </div>
    </div>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

@elseif (Session::has('info'))
<div class="alert alert-info alert-dismissible fade show" role="alert">
    <div class="row align-items-center">
        <div class="col-auto">
            <span class="icon icon-shape bg-white text-info rounded-circle shadow h1 mb-0">
                <i class="fas fa-bullhorn"></i>
            </span>
        </div>
        <div class="col">
            <div class="h3 mb-0 text-white">{!! Session::get('info') !!}</div>
        </div>
    </div>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

@elseif (Session::has('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <div class="row align-items-center">
        <div class="col-auto">
            <span class="icon icon-shape bg-white text-danger rounded-circle shadow h1 mb-0">
                <i class="fas fa-times"></i>
            </span>
        </div>
        <div class="col">
            <div class="h3 mb-0 text-white">{!! Session::get('error') !!}</div>
        </div>
    </div>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif