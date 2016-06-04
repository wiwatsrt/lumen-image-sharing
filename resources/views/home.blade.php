@extends('layouts.default')

@section('contents')

    <div id="headerwrap">
        <div class="container">
            <div class="row">
                <!-- main body of our application -->
                <div class="col-md-8">
                    <div id="result">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default text-center">
                                <div class="panel-heading">
                                    <div id="choose-img">
                                        <input id="fileUpload" type="file" name="files[]" data-url="{{ url('upload') }}"
                                               multiple style="display: none">
                                        <button class="btn btn-block btn-primary" id="btnSelectImg">เลือกรูป</button>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="0"
                                             aria-valuemin="0" aria-valuemax="100" id="all_progress">
                                            0%
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <label for="bbAllFull">BBCode [Full Images]</label>
                                    <input type="text" class="form-control" id="bbAllFull" readonly="readonly"
                                           title="Ctrl+C เพื่อคัดลอก"
                                           onmouseover="javascript:this.focus();this.select();">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!--/ .container -->
    </div>

    <script type="text/html" id="panel-template">
        <div class="panel panel-primary" data-id="panel_id">
            <div class="panel-heading">
                <h3 class="panel-title" data-content="head_status"></h3>
            </div>
        </div>
    </script>
    <script type="text/html" id="img-template">
        <div class="panel-heading">
            <h3 class="panel-title" data-content="file_name"></h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="text-center">
                        <a data-href="directUrl" target="_blank">
                            <img alt="" data-src="thumbImg" class="img-responsive">
                        </a>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="directUrl">Direct</label>
                        <input type="text" class="form-control" id="directUrl" readonly="readonly"
                               data-value="directUrl" title="Ctrl+C เพื่อคัดลอก"
                               onmouseover="javascript:this.focus();this.select();">
                    </div>
                    <div class="form-group">
                        <label for="bbFullUrl">BBCode [Full image]</label>
                        <input type="text" class="form-control" id="bbFullUrl" readonly="readonly" data-value="bbFullUrl"
                               title="Ctrl+C เพื่อคัดลอก" onmouseover="javascript:this.focus();this.select();">
                    </div>
                </div>
            </div>
        </div>
    </script>
@endsection