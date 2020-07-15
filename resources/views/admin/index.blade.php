@extends('layouts.layout')

@section('title')
Admin
@endsection

@section('body_class')
class="hold-transition sidebar-mini layout-fixed"
@endsection

@section('contents')
<div class="wrapper">
@include('layouts.admin.nav')
</div>
@endsection
@section('scripts')
<script src="/manifest.js"></script>
<script src="/js/vendor.js"></script>
<script src="/js/app.js"></script>
<script>
$(document).ready(function(){
	alert('jquery test');
});
</script>
@endsection