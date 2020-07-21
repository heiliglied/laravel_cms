@extends('layouts.layout')

@section('title')
Admin
@endsection

@section('heads')
<link rel="stylesheet" type="text/css" href="/css/app.css" />
<link rel="stylesheet" type="text/css" href="/plugin/adminlte/dist/css/adminlte.min.css" />

@endsection

@section('body_class')
class="hold-transition sidebar-mini layout-fixed"
@endsection

@section('contents')
<div class="wrapper">
@include('layouts.admin.nav')
@include('layouts.admin.aside')

	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0 text-dark">관리자 등급 설정</h1>
					</div><!-- /.col -->
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="/admin/settings/rank">환경설정</a></li>
							<li class="breadcrumb-item active">관리자 등급 설정</li>
						</ol>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.container-fluid -->
		</div>
		<!-- /.content-header -->
		
		<section class="content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<form name="rank_form" method="post" action="/admin/settings/rank/create">
						{{ csrf_field() }}
						<div class="card card-primary">
							<div class="card-header">
								<h3 class="card-title">등급 신규 등록</h3>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label>관리자 등급</label>
											<input type="text" class="form-control" onkeyup="integerCheck(this);" name="rank" placeholder="등급을 입력해 주세요.">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label>관리자 등급명</label>
											<input type="text" class="form-control" name="name" maxlength="12" placeholder="회원 등급의 이름입니다.">
										</div>
									</div>
									@if(count($errors) > 0)
									<div class="col-sm-12">
										@foreach($errors->all() as $error)
										{{ $error }}<br/>
										@endforeach
									</div>
									@endif
								</div>
							</div>
							<div class="card-footer text-right">
								<button type="submit" class="btn btn-primary">등록</button>
							</div>
						</div>
					</div>
				</div>
			</div><!-- /.container-fluid -->
		</section>
		
	</div>

</div>
@include('layouts.admin.footer')
@include('layouts.admin.righttoggle')
@endsection

@section('scripts')
<script src="/js/manifest.js"></script>
<script src="/js/vendor.js"></script>
<script src="/js/app.js"></script>
<script src="/js/bootstrap.bundle.min.js"></script>
<script src="/plugin/adminlte/dist/js/adminlte.min.js"></script>
<script>

</script>
@endsection