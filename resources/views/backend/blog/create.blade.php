@extends('layouts.backend.main')

@section('title', 'MyBlog | Add new post')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Blog
        <small>Add new post</small>
      </h1>
      <ol class="breadcrumb">
        <li>
        	<a href="{{ url('/home') }}"><i class="fa fa-dashboard">Dashboard</i></a>
        </li>
        <li>
        	<a href="{{ route('backend.blog.index') }}">
        		Blog
        	</a>	
        </li>
        <li class="active">
        	All new
        </li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <!-- /.box-header -->
              <div class="box-body ">
				{!! Form::model($post, [
					'method' => 'POST',
					'route'  => 'backend.blog.store'
				]) !!}

				{!! Form::close() !!}
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
        </div>
      <!-- ./row -->
    </section>
    <!-- /.content -->
  </div>
@endsection

@section('script')
	<script type="text/javascript">
		$('ul.pagination').addClass('no-margin pagination-sm');
	</script>
@endsection
