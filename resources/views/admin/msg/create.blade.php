@extends('admin/public/layout')
@section('title')
    新增推送消息
@endsection
@section('content')
    <section class="content-header">
        <h1>
            推送消息管理
            <small>新增推送消息</small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-default">
                    <form role="form" name="addForm" method="POST" enctype="multipart/form-data" action="{{ route('admin.msg.store') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="box-body">

                            <div class="form-group @if($errors->has('title')) has-error @endif">
                                <label>消息标题</label>
                                <input type="text" name="title" class="form-control " placeholder="标题" value="">
                                @if($errors->has('title')) <p class="help-block">{{ $errors->first('title') }}</p> @endif
                            </div>
							<div class="form-group">
                                <label>消息类型</label>
                                <span class="text-muted">(推送消息类型，1：文章 2：文本)</span>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="type" value="1" /> 文章
                                    </label>&nbsp;&nbsp;
                                    <label>
                                        <input type="radio" name="type" value="2" /> 内容
                                    </label>
                                </div>
                            </div>

                            <div class="form-group @if($errors->has('content')) has-error @endif">
                                <label>消息内容</label>
                                <input type="text" name="content" class="form-control " placeholder="推送内容" value="">
                                @if($errors->has('content')) <p class="help-block">{{ $errors->first('content') }}</p> @endif
                            </div>


                            <div class="form-group @if($errors->has('to_user')) has-error @endif">
                                <label>推送对象</label>
                                <input type="text" name="to_user" class="form-control " placeholder="推送给所有人填0" value="">
                                @if($errors->has('to_user')) <p class="help-block">{{ $errors->first('to_user') }}</p> @endif
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">保存</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script type="text/javascript">
        set_active_menu('operations',"{{ route('admin.notice.index') }}");
    </script>
@endsection
