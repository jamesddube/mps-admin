@extends('layout.master')
    @section('title','New User')
    @section('header')
    @parent
        <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
        <link href="{{ url('assets/plugins/bootstrap-wizard/css/bwizard.min.css') }}" rel="stylesheet" />
        <link href="{{ url('assets/plugins/parsley/src/parsley.css') }}" rel="stylesheet" />
        <!-- ================== END PAGE LEVEL STYLE ================== -->
    @endsection
@section('content')
    <div class="row">
        <!-- begin col-12 -->
        <div class="col-md-12">
            <!-- begin panel -->
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">Form Wizards</h4>
                </div>
                <div class="panel-body">
                    <form action="{{ url('users') }}" method="POST" data-parsley-validate="true" name="form-wizard" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div id="wizard">
                            <ol>
                                <li>
                                   Personal Information
                                    <small>Personal data about the user</small>
                                </li>
                                <li>
                                    Contact Information
                                    <small>How the system can reach the user</small>
                                </li>
                                <li>
                                    User Settings
                                    <small>Miscellaneous</small>
                                </li>
                                <li>
                                    Completed
                                    <small>That's it!</small>
                                </li>
                            </ol>

                           <!-- begin wizard step-1 -->
                            <div class="wizard-step-1">
                                <fieldset>
                                    <legend class="pull-left width-full">Personal Details</legend>
                                    <!-- begin row -->
                                    <div class="row">
                                        <!-- begin col-4 -->
                                        <div class="col-md-4">
                                            <div class="form-group block1">
                                                <label>First Name</label>
                                                <input type="text" value="{{ old('name') }}" name="name" placeholder="John" class="form-control" data-parsley-group="wizard-step-1" required />
                                            </div>
                                        </div>
                                        <!-- end col-4 -->
                                        <!-- begin col-4 -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input type="text" value="{{ old('surname') }}" name="surname" placeholder="Smith" class="form-control" data-parsley-group="wizard-step-1" required />
                                            </div>
                                        </div>
                                        <!-- end col-4 -->
                                        <!-- begin col-4 -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Gender</label>
                                                <select class="form-control" name="gender">
                                                    <option>Male</option>
                                                    <option>Female</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- end col-4 -->
                                    </div>
                                    <!-- end row -->
                                </fieldset>
                            </div>
                            <!-- end wizard step-1 -->
                            <!-- begin wizard step-2 -->
                            <div class="wizard-step-2">
                                <fieldset>
                                    <legend class="pull-left width-full">Contact Information</legend>
                                    <!-- begin row -->
                                    <div class="row">
                                        <!-- begin col-6 -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Job Title</label>
                                                <input type="text" value="{{ old('job_title') }}" name="job_title" placeholder="1234567890" class="form-control" data-parsley-group="wizard-step-2" required />
                                            </div>
                                        </div>
                                        <!-- end col-6 -->
                                        <!-- begin col-6 -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Email Address</label>
                                                <input type="email" value="{{ old('email') }}" name="email" placeholder="someone@example.com" class="form-control" data-parsley-group="wizard-step-2" data-parsley-type="email" required />
                                            </div>
                                        </div>
                                        <!-- end col-6 -->
                                    </div>
                                    <!-- end row -->
                                </fieldset>
                            </div>
                            <!-- end wizard step-2 -->
                            <!-- begin wizard step-3 -->
                            <div class="wizard-step-3">
                                <fieldset>
                                    <legend class="pull-left width-full">User Roles</legend>
                                    <!-- begin row -->
                                    <div class="row">
                                        <!-- begin col-4 -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>User Group</label>
                                                <div class="controls">
                                                    <select name="user_type_id" class="form-control" data-parsley-group="wizard-step-3" required >
                                                      @if(isset($user_types))
                                                          @foreach($user_types as $user_type)
                                                              <option value="{{ $user_type->id }}">{{ $user_type->name }}</option>
                                                          @endforeach
                                                      @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end col-4 -->
                                        <!-- begin col-4 -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Avatar</label>
                                                <div class="controls">
                                                    <input type="file" value="{{ old('avatar') }}" name="avatar" placeholder="Your Picture" class="form-control" data-parsley-group="wizard-step-3" required />
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end col-4 -->
                                        <!-- end col-6 -->
                                    </div>
                                    <!-- end row -->
                                </fieldset>
                            </div>
                            <!-- end wizard step-3 -->
                            <!-- begin wizard step-4 -->
                            <div>
                                <div class="jumbotron m-b-0 text-center">
                                    <h1>Account Created</h1>
                                    <p>The user account has been created, a activation link has been sent to the user to finish up the process</p>
                                    <p><input type="submit" class="btn btn-success btn-lg" role="button" value="Proceed"></p>
                                </div>
                            </div>
                            <!-- end wizard step-4 -->
                        </div>
                    </form>
                </div>
            </div>
            <!-- end panel -->
        </div>
        <!-- end col-12 -->
    </div>

@endsection

@section('footer')
        @parent

        <!-- ================== BEGIN PAGE LEVEL JS ================== -->
        <script src="{{ url('assets/plugins/parsley/dist/parsley.js') }}"></script>
        <script src="{{ url('assets/plugins/bootstrap-wizard/js/bwizard.js') }}"></script>
        <script src="{{ url('assets/js/form-wizards-validation.demo.min.js') }}"></script>
        <script src="{{ url('assets/js/apps.min.js') }}"></script>
        <!-- ================== END PAGE LEVEL JS ================== -->

        <script>
            $(document).ready(function() {
                FormWizardValidation.init();

            });
        </script>
@endsection
