@if( session()->has('success') )
<div class="alert alert-success alert-dismissible fade show alert-styled-left alert-arrow-left alert-icon">
    <i class="bi bi-check-square-fill"></i> {{ session('success') }}

    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
</div>
@endif

@if( session()->has('warning') )
<div class="alert alert-warning alert-dismissible fade show alert-styled-left alert-arrow-left alert-icon">
    <i class="bi bi-cone-striped"></i> {{ session('warning') }}

    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
</div>
@endif

@if( session()->has('error') )
<div class="alert alert-danger alert-dismissible fade show alert-styled-left alert-arrow-left alert-icon">
    <i class="bi bi-dash-circle-fill"></i> {{ session('error') }}

    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
</div>
@endif

@if( session()->has('info') )
<div class="alert alert-info alert-dismissible fade show alert-styled-left alert-arrow-left alert-icon">
    <i class="bi bi-info-circle-fill"></i> {{ session('info') }}

    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
</div>
@endif
