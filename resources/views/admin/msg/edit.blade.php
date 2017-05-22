@extends('admin/public/layout')
@section('title')编辑消息@endsection
@section('content')
    <section class="content-header">
        <h1>
            编辑消息
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <form role="form" name="editForm" method="POST" enctype="multipart/form-data" action="{{ route('admin.msg.update',['id'=>$msgs->id]) }}">
                        <input name="_method" type="hidden" value="PUT">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="box-body">

                            <div class="form-group @if($errors->has('title')) has-error @endif">
                                <label>消息标题</label>
                                <input type="text" name="title" class="form-control " placeholder="标题" value="{{ old('title',$msgs->title) }}">
                                @if($errors->has('title')) <p class="help-block">{{ $errors->first('title') }}</p> @endif
                            </div>
							<div class="form-group">
                                <label>消息类型</label>
                                <span class="text-muted">(推送消息类型，1：文章 2：文本)</span>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="type" value="1" @if($msgs->type === 1 ) checked @endif /> 文章
                                    </label>&nbsp;&nbsp;
                                    <label>
                                        <input type="radio" name="type" value="2" @if($msgs->type === 2 ) checked @endif /> 内容
                                    </label>
                                </div>
                            </div>

                            <div class="form-group @if($errors->has('content')) has-error @endif">
                                <label>消息内容</label>
                                <input type="text" name="content" class="form-control " placeholder="推送内容" value="{{ old('content',$msgs->content) }}">
                                @if($errors->has('content')) <p class="help-block">{{ $errors->first('content') }}</p> @endif
                            </div>


                            <div class="form-group @if($errors->has('to_user')) has-error @endif">
                                <label>推送对象</label>
                                <input type="text" name="to_user" class="form-control " placeholder="推送给所有人填0" value="{{ old('to_user',$msgs->to_user) }}">
                                @if($errors->has('to_user')) <p class="help-block">{{ $errors->first('to_user') }}</p> @endif
                            </div>


                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">保存</button>
                            <button type="reset" class="btn btn-success">重置</button>
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