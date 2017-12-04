@extends('layouts.template')

@section('content')
<div id="content">
  <div class="outer">
    <div class="inner bg-light lter" style="min-height: 534px">
      
<div class="text-center">

    <a class="quick-btn" href="#">
  <i class="fa fa-bolt fa-2x"></i>
  <span>default</span>
  <span class="label label-default">2</span>
    </a>
    <a class="quick-btn" href="#">
  <i class="fa fa-check fa-2x"></i>
  <span>danger</span>
  <span class="label label-danger">2</span>
    </a>
    <a class="quick-btn" href="#">
  <i class="fa fa-building-o fa-2x"></i>
  <span>No Label</span>
    </a>
    <a class="quick-btn" href="#">
  <i class="fa fa-envelope fa-2x"></i>
  <span>success</span>
  <span class="label label-success">-456</span>
    </a>
    <a class="quick-btn" href="#">
  <i class="fa fa-signal fa-2x"></i>
  <span>warning</span>
  <span class="label label-warning">+25</span>
    </a>
    <a class="quick-btn" href="#">
  <i class="fa fa-external-link fa-2x"></i>
  <span>π</span>
  <span class="label btn-metis-2">3.14159265</span>
    </a>
    <a class="quick-btn" href="#">
  <i class="fa fa-lemon-o fa-2x"></i>
  <span>é</span>
  <span class="label btn-metis-4">2.71828</span>
    </a>
    <a class="quick-btn" href="#">
  <i class="fa fa-glass fa-2x"></i>
  <span>φ</span>
  <span class="label btn-metis-3">1.618</span>
    </a>

</div>
<hr>

    </div>
    <!-- /.inner -->
  </div>
  <!-- /.outer -->
</div>
<!-- /#content -->
@endsection

@push('script')
    <script src="{{ asset('js/app.js') }}"></script>
@endpush