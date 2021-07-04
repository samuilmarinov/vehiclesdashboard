<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="/">Webinteractive</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
        <a class="nav-link" href="{{url('/')}}">Dashboard <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item {{ Request::segment(1) === 'vehicles' ? 'active' : null }}">
        <a class="nav-link" href="{{url('vehicles')}}">Vehicles</a>
      </li>
      <li class="nav-item {{ Request::segment(1) === 'brands' ? 'active' : null }}">
        <a class="nav-link" href="{{url('brands')}}">Brands</a>
      </li>
      <li class="nav-item {{ Request::segment(1) === 'vehiclemodels' ? 'active' : null }}">
        <a class="nav-link" href="{{url('vehiclemodels')}}">Vehicle Models</a>
      </li>
      <li class="nav-item {{ Request::segment(1) === 'bodyworks' ? 'active' : null }}">
        <a class="nav-link" href="{{url('bodyworks')}}">Bodyworks</a>
      </li>
      <li class="nav-item {{ Request::segment(1) === 'engines' ? 'active' : null }}">
        <a class="nav-link" href="{{url('engines')}}">Engines</a>
      </li>
      <li class="nav-item {{ Request::segment(1) === 'colors' ? 'active' : null }}">
        <a class="nav-link" href="{{url('colors')}}">Colors</a>
      </li>
    </ul>
    @if(Route::currentRouteName()== 'vehicles.index')
    {{-- <form style="color:white;" action="{{ route('vehicles.index') }}" method="GET" class="form-inline my-2 my-lg-0">
      <div class="searchsection">
              <div class="input-daterange input-group" id="datepicker">
                  <input type="text" id="from_date" class="input-sm form-control" name="from_date"
                      value="{{ Request::get('from_date') }}" />
                  <span class="input-group-addon">to</span>
                  <input type="text" id="to_date" class="input-sm form-control" name="to_date"
                      value="{{ Request::get('to_date') }}" />
              </div>
              <button type="submit" id="dateSearch" class="btn btn-sm btn-primary my-2 my-sm-0">Search</button>
        </div>
        <div class="actionsection">
          <a class="btn btn-warning reset my-2 my-sm-0" href="{{ route('vehicles.index') }}"> Reset Filters </a>
           <a class="btn btn-success reset my-2 my-sm-0" href="{{ route('vehicles.create') }}"> Create New Vehicle </a> 
        </div>
    </form> --}}
    <form action="{{ route('vehicles.index') }}" method="GET" role="search" class="form-inline my-2 my-lg-0">
    {{-- {{ csrf_field() }} --}}
    <div class="input-group">
            <input class="form-control mr-sm-2" id="search" name="search" type="search" placeholder="Search" value="{{ Request::get('search') }}" aria-label="Search">
            <button type="submit" class="btn btn-outline-success my-2 my-sm-0">
                Search Vehicles
            </button>
        </span>
    </div>
    </form>
    @else
    <form action="{{ route('vehicles.index') }}" method="GET" role="search" class="form-inline my-2 my-lg-0">
    {{-- {{ csrf_field() }} --}}
    <div class="input-group">
            <input class="form-control mr-sm-2" id="search" name="search" type="search" placeholder="Search" value="{{ Request::get('search') }}" aria-label="Search">
            <button type="submit" class="btn btn-outline-success my-2 my-sm-0">
                Search Vehicles
            </button>
        </span>
    </div>
    </form>
    @endif
  </div>
</nav>