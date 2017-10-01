<form {!! $attributes !!}>
    <div class="box-body fields-group">

        @foreach($fields as $field)
            {!! $field->render() !!}
        @endforeach

    </div>

    <!-- /.box-body -->
    @if($isNeedFoot)
    <div class="box-footer">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="col-sm-2">
        </div>

        <div class="col-sm-2">
            <div class="btn-group pull-left">
                <a href="javascript:" onClick="javascript:history.back(-1);" class="btn btn-warning pull-right">返回</a>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="btn-group pull-right">
                <button type="submit" class="btn btn-info pull-right">{{ trans('admin::lang.submit') }}</button>
            </div>
        </div>

    </div>
    @endif
</form>
