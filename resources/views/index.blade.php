@extends('layouts.template')

@section('title', (isset($title))? $title: config('app.name') )

@section('content')
<div id="content">
  <div class="outer">
    <div class="inner bg-light lter">
      
      <div class="row">
        <div class="col-lg-12">
          <div class="box" style="min-height: 494px">
			<div id="root"></div>
          </div>
        </div>
      </div>

    </div>
    <!-- /.inner -->
  </div>
  <!-- /.outer -->
</div>
<!-- /#content -->
@endsection

@push('script')
    <script src="{{ $script }}"></script>
@endpush
