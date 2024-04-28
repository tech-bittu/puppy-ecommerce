@extends('admin.layouts.app')
@section('page-title') {{ 'Add puppy' }} @endsection
@section('styles')
<style>
    .select2-dropdown {
        top: 22px !important;
        left: 8px !important;
    }
</style>
@endsection
@section('content-wrapper')
<div class="page-header">
    <h3 class="page-title"> Puppy </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Puppies</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Puppies</li>
        </ol>
    </nav>
</div>
@php
$editBoolean = false;
if(is_numeric(Request::segment(3)) && Request::segment(4)=='')
{
$editBoolean = true;
};
@endphp
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{$editBoolean ? $data['breed'][$data['puppyinfo']->breed_type -1]->name : ''}} Puppy Details @session('overviewActive') {{ $value }} @endsession</h4>
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link text-info  @if(!session('overviewActive')) active @endif" id="simple-tab-0" data-bs-toggle="tab" href="#simple-tabpanel-0" role="tab" aria-controls="simple-tabpanel-0" aria-selected="true" aria-disabled="">Basic Info</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link text-info @session('overviewActive') {{ $value }} @endsession" id="simple-tab-1" data-bs-toggle="tab" href="#simple-tabpanel-1" role="tab" aria-controls="simple-tabpanel-1" aria-selected="false">Overview Info </a>
                        @session('puppy_info_unique_id')
                        <div class="p-4 bg-green-100 d-none">
                            {{ $value }}
                        </div>
                        @endsession
                    </li>
                </ul>

                <div class="tab-content pt-5" id="tab-content">
                    <!-- ***************************************************************************************************************** -->
                    <!-- ************************************************Basic information********************************************************* -->
                    <!-- ***************************************************************************************************************** -->
                    <div class="tab-pane @if(!session('overviewActive')) active @endif " id="simple-tabpanel-0" role="tabpanel" aria-labelledby="simple-tab-0">
                        <form action="{{ $editBoolean ? '': url('admin/puppies') }}" class="form-sample" id="collapseBasicInfo" method="post" autocomplete="off" aria-autocomplete="none">
                            <!-- <p class="card-description">Basic information </p> -->
                            @csrf
                            @if($editBoolean)
                            @method('put')
                            @else
                            @method('post')
                            @endif
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Breed</label>
                                        <div class="col-sm-9  mb-2">
                                            <div class="h-100 d-flex flex-row align-items-center justify-content-center">
                                                <select class="form-control @error('breed_type') is-invalid  @enderror h-100" {{ $editBoolean ? 'aria-readonly="true"':''}} id="breed_type" name="breed_type">
                                                    <option value="">---Select breed ---</option>
                                                    @foreach($data['breed'] as $breed)
                                                    <option value="{{ $breed->id }}" @php if($editBoolean){echo $breed->id == $data['puppyinfo']->breed_type ? 'selected' : ''; } @endphp {{ old('breed_type') == $breed->id ? 'selected' : '' }} > {{ $breed->name }} </option>
                                                    @endforeach
                                                </select>
                                                @error('breed_type')
                                                <a class="nav-link count-indicator dropdown-toggle text-danger" id="breed_typemessageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-email-outline"></i>
                                                    <span class="count-symbol bg-warning"></span>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="breed_typemessageDropdown">
                                                    <div class="text-danger"> {{ $message }}</div>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">GROUP</label>
                                        <div class="col-sm-9  mb-2">
                                            <div class="d-flex justify-content-center-align-items-center h-100">
                                                <select class="form-control @error('group_type') is-invalid  @enderror h-100" name="group_type">
                                                    <option value="">--Select Group -- </option>
                                                    @foreach($data['breed_group'] as $type)
                                                    <option value="{{ $type->id }}" @php if($editBoolean){echo $data['puppyinfo']->group_type== $type->id ? 'selected' : ''; }@endphp {{ old('group_type') == $type->id ? 'selected' : '' }}> {{ $type->type }} </option>
                                                    @endforeach
                                                </select>
                                                @error('group_type')
                                                <a class="nav-link count-indicator dropdown-toggle text-danger" id="group_typemessageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-email-outline"></i>
                                                    <span class="count-symbol bg-warning"></span>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="group_typemessageDropdown">
                                                    <div class="text-danger"> {{ $message }}</div>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">BARKING LEVEL</label>
                                        <div class="col-sm-9 mb-2">
                                            <div class="d-flex justify-content-center-align-items-center  h-100">
                                                <select class="form-control @error('barking_level') is-invalid  @enderror h-100" name="barking_level">
                                                    <option value="">--Select Barking Level -- </option>
                                                    @foreach($data['barking_type'] as $type)
                                                    <option value="{{ $type->id }}" @php if($editBoolean){echo $data['puppyinfo']->barking_level== $type->id ? 'selected' : ''; }@endphp {{ old('barking_level') == $type->id ? 'selected' : '' }}> {{ $type->type }} </option>
                                                    @endforeach
                                                </select>
                                                @error('barking_level')
                                                <a class="nav-link count-indicator dropdown-toggle text-danger" id="barking_levelmessageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-email-outline"></i>
                                                    <span class="count-symbol bg-warning"></span>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="barking_levelmessageDropdown">
                                                    <div class="text-danger"> {{ $message }}</div>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">ACTIVITY LEVEL</label>
                                        <div class="col-sm-9 mb-2">
                                            <div class="d-flex justify-content-center-align-items-center  h-100">
                                                <select class="form-control @error('activity_level') is-invalid  @enderror h-100" name="activity_level">
                                                    <option value="">--Select Activity Level -- </option>
                                                    @foreach($data['activity_type'] as $type)
                                                    <option value="{{ $type->id }}" @php if($editBoolean){echo $data['puppyinfo']->activity_level== $type->id ? 'selected' : ''; }@endphp {{ old('activity_level') == $type->id ? 'selected' : '' }}> {{ $type->type }} </option>
                                                    @endforeach
                                                </select>
                                                @error('activity_level')
                                                <a class="nav-link count-indicator dropdown-toggle text-danger" id="activity_levelmessageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-email-outline"></i>
                                                    <span class="count-symbol bg-warning"></span>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="activity_levelmessageDropdown">
                                                    <div class="text-danger"> {{ $message }}</div>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">COAT TYPE</label>
                                        <div class="col-sm-9 mb-2">
                                            <div class="d-flex justify-content-center-align-items-center  h-100">
                                                <select class="form-control @error('coat_type') is-invalid  @enderror h-100" name="coat_type">
                                                    <option value=""> --select coat type--</option>
                                                    @foreach($data['coat_type'] as $type)
                                                    <option value="{{ $type->id }}" @php if($editBoolean){echo $data['puppyinfo']->coat_type== $type->id ? 'selected' : ''; }@endphp {{ old('coat_type') == $type->id ? 'selected' : '' }}> {{ $type->type }} </option>
                                                    @endforeach
                                                </select>
                                                @error('coat_type')
                                                <a class="nav-link count-indicator dropdown-toggle text-danger" id="coat_typemessageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-email-outline"></i>
                                                    <span class="count-symbol bg-warning"></span>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="coat_typemessageDropdown">
                                                    <div class="text-danger"> {{ $message }}</div>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">CHARACTERISTICS</label>
                                        <div class="col-sm-9 mb-2">
                                            <div class="d-flex justify-content-center-align-items-center  h-100">
                                                <select class="form-control @error('characteristics') is-invalid  @enderror h-100" name="characteristics">
                                                    <option value="">--Select CHARACTERISTICS -- </option>
                                                    @foreach($data['characteristic'] as $type)
                                                    <option value="{{ $type->id }}" @php if($editBoolean){echo $data['puppyinfo']->characteristics== $type->id ? 'selected' : ''; }@endphp {{ old('characteristics') == $type->id ? 'selected' : '' }}> {{ $type->type }} </option>
                                                    @endforeach
                                                </select>
                                                @error('characteristics')
                                                <a class="nav-link count-indicator dropdown-toggle text-danger" id="characteristicsmessageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-email-outline"></i>
                                                    <span class="count-symbol bg-warning"></span>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="characteristicsmessageDropdown">
                                                    <div class="text-danger"> {{ $message }}</div>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">SHEDDING</label>
                                        <div class="col-sm-9 mb-2">
                                            <div class="d-flex justify-content-center-align-items-center  h-100">
                                                <select class="form-control @error('shedding') is-invalid  @enderror h-100" name="shedding">
                                                    <option value="">--select SHEDDING --</option>
                                                    @foreach($data['sheeding'] as $type)
                                                    <option value="{{ $type->id }}" @php if($editBoolean){echo $data['puppyinfo']->shedding== $type->id ? 'selected' : ''; }@endphp {{ old('shedding') == $type->id ? 'selected' : '' }}> {{ $type->type }} </option>
                                                    @endforeach
                                                </select>
                                                @error('shedding')
                                                <a class="nav-link count-indicator dropdown-toggle text-danger" id="sheddingmessageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-email-outline"></i>
                                                    <span class="count-symbol bg-warning"></span>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="sheddingmessageDropdown">
                                                    <div class="text-danger"> {{ $message }}</div>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Size</label>
                                        <div class="col-sm-9 mb-2">
                                            <div class="d-flex justify-content-center-align-items-center  h-100">
                                                <select class="form-control @error('size') is-invalid  @enderror h-100" name="size">
                                                    <option value="">--select size --</option>
                                                    @foreach($data['breed_size'] as $type)
                                                    <option value="{{ $type->id }}" @php if($editBoolean){echo $data['puppyinfo']->size== $type->id ? 'selected' : ''; }@endphp {{ old('size') == $type->id ? 'selected' : '' }}> {{ $type->type }} </option>
                                                    @endforeach
                                                </select>
                                                @error('size')
                                                <a class="nav-link count-indicator dropdown-toggle text-danger" id="sizemessageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-email-outline"></i>
                                                    <span class="count-symbol bg-warning"></span>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="sizemessageDropdown">
                                                    <div class="text-danger"> {{ $message }}</div>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">TRAINABILITY</label>
                                        <div class="col-sm-9 mb-2">
                                            <select class="form-control @error('trainability') is-invalid  @enderror h-100" name="trainability">
                                                <option value="">--select size --</option>
                                                @foreach($data['trainablity'] as $type)
                                                <option value="{{ $type->id }}" @php if($editBoolean){echo $data['puppyinfo']->trainability== $type->id ? 'selected' : ''; } @endphp {{ old('trainability') == $type->id ? 'selected' : '' }}> {{ $type->type }} </option>
                                                @endforeach
                                            </select>
                                            @error('trainability')
                                            <a class="nav-link count-indicator dropdown-toggle text-danger" id="trainabilitymessageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="mdi mdi-email-outline"></i>
                                                <span class="count-symbol bg-warning"></span>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="trainabilitymessageDropdown">
                                                <div class="text-danger"> {{ $message }}</div>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">DROOLING LEVEL</label>
                                        <div class="col-sm-9">
                                            <div class="d-flex justify-content-center-align-items-center">
                                                <input type="number" max="5" min="1" value="{{ $editBoolean ? $data['puppyinfo']->drooling_level : old('drooling_level') }}" type="number" max="5" maxlength="2" name="drooling_level" class="form-control @error('drooling_level') is-invalid  @enderror" placeholder="Drooling Level" />
                                                @error('drooling_level')
                                                <a class="nav-link count-indicator dropdown-toggle text-danger" id="drooling_levelmessageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-email-outline"></i>
                                                    <span class="count-symbol bg-warning"></span>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="drooling_levelmessageDropdown">
                                                    <div class="text-danger"> {{ $message }}</div>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="card-description">FAMILY LIFE</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Life expetancy</label>
                                        <div class="col-sm-9">
                                            <div class="d-flex justify-content-center-align-items-center">
                                                <input type="number" max="50" min="1" value="{{ $editBoolean ? $data['puppyinfo']->life_expetancy : old('life_expetancy') }}" type="number" max="50" maxlength="2" name="life_expetancy" class="form-control @error('life_expetancy') is-invalid  @enderror" placeholder="Average Life" />
                                                @error('life_expetancy')
                                                <a class="nav-link count-indicator dropdown-toggle text-danger" id="life_expetancymessageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-email-outline"></i>
                                                    <span class="count-symbol bg-warning"></span>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="life_expetancymessageDropdown">
                                                    <div class="text-danger"> {{ $message }}</div>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">AFFECTIONATE WITH FAMILY</label>
                                        <div class="col-sm-9">
                                            <div class="d-flex justify-content-center-align-items-center">
                                                <input type="number" max="5" min="1" value="{{ $editBoolean ? $data['puppyinfo']->affectionate_with_family : old('affectionate_with_family') }}" class="form-control @error('affectionate_with_family') is-invalid  @enderror" name="affectionate_with_family" placeholder="AFFECTIONATE WITH FAMILY" />
                                                @error('affectionate_with_family')
                                                <a class="nav-link count-indicator dropdown-toggle text-danger" id="affectionate_with_familymessageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-email-outline"></i>
                                                    <span class="count-symbol bg-warning"></span>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="affectionate_with_familymessageDropdown">
                                                    <div class="text-danger"> {{ $message }}</div>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">GOOD WITH YOUNG CHILDREN</label>
                                        <div class="col-sm-9">
                                            <div class="d-flex justify-content-center-align-items-center">
                                                <input type="number" max="5" min="1" value="{{ $editBoolean ? $data['puppyinfo']->good_with_child : old('good_with_child') }}" class="form-control @error('good_with_child') is-invalid  @enderror" name="good_with_child" placeholder="GOOD WITH YOUNG CHILDREN" />
                                                @error('good_with_child')
                                                <a class="nav-link count-indicator dropdown-toggle text-danger" id="good_with_childbreed_typemessageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-email-outline"></i>
                                                    <span class="count-symbol bg-warning"></span>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="good_with_childbreed_typemessageDropdown">
                                                    <div class="text-danger"> {{ $message }}</div>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">GOOD WITH OTHER DOGS</label>
                                        <div class="col-sm-9">
                                            <div class="d-flex justify-content-center-align-items-center">
                                                <input type="number" max="5" min="1" value="{{ $editBoolean ? $data['puppyinfo']->good_with_other_dogs : old('good_with_other_dogs') }}" class="form-control @error('good_with_other_dogs') is-invalid  @enderror" name="good_with_other_dogs" placeholder="GOOD WITH OTHER DOGS" />
                                                @error('good_with_other_dogs')
                                                <a class="nav-link count-indicator dropdown-toggle text-danger" id="good_with_other_dogsmessageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-email-outline"></i>
                                                    <span class="count-symbol bg-warning"></span>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="good_with_other_dogsmessageDropdown">
                                                    <div class="text-danger"> {{ $message }}</div>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <p class="card-description">Social</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">OPENNESS TO STRANGERS</label>
                                        <div class="col-sm-9">
                                            <div class="d-flex justify-content-center-align-items-center">
                                                <input type="number" max="5" min="1" value="{{ $editBoolean ? $data['puppyinfo']->openness_to_strangers : old('openness_to_strangers') }}" class="form-control @error('openness_to_strangers') is-invalid  @enderror" name="openness_to_strangers" placeholder="GOOD WITH OTHER DOGS" />
                                                @error('openness_to_strangers')
                                                <a class="nav-link count-indicator dropdown-toggle text-danger" id="openness_to_strangersmessageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-email-outline"></i>
                                                    <span class="count-symbol bg-warning"></span>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="openness_to_strangersmessageDropdown">
                                                    <div class="text-danger"> {{ $message }}</div>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">WATCHDOG/PROTECTIVE NATURE</label>
                                        <div class="col-sm-9">
                                            <div class="d-flex justify-content-center-align-items-center">
                                                <input type="number" max="5" min="1" value="{{ $editBoolean ? $data['puppyinfo']->watchdog_protective_nature : old('watchdog_protective_nature') }}" class="form-control @error('watchdog_protective_nature') is-invalid  @enderror" name="watchdog_protective_nature" placeholder="GOOD WITH OTHER DOGS" />
                                                @error('watchdog_protective_nature')
                                                <a class="nav-link count-indicator dropdown-toggle text-danger" id="watchdog_protective_naturemessageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-email-outline"></i>
                                                    <span class="count-symbol bg-warning"></span>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="watchdog_protective_naturemessageDropdown">
                                                    <div class="text-danger"> {{ $message }}</div>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">ADAPTABILITY LEVEL</label>
                                        <div class="col-sm-9">
                                            <div class="d-flex justify-content-center-align-items-center">
                                                <input type="number" max="5" min="1" value="{{ $editBoolean ? $data['puppyinfo']->adaptability_level : old('adaptability_level') }}" class="form-control @error('adaptability_level') is-invalid  @enderror" name="adaptability_level" placeholder="GOOD WITH OTHER DOGS" />
                                                @error('adaptability_level')
                                                <a class="nav-link count-indicator dropdown-toggle text-danger" id="adaptability_levelmessageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-email-outline"></i>
                                                    <span class="count-symbol bg-warning"></span>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="adaptability_levelmessageDropdown">
                                                    <div class="text-danger"> {{ $message }}</div>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">PLAYFULNESS LEVEL</label>
                                        <div class="col-sm-9">
                                            <div class="d-flex justify-content-center-align-items-center">
                                                <input type="number" max="5" min="1" value="{{ $editBoolean ? $data['puppyinfo']->playfulness_level : old('playfulness_level') }}" class="form-control @error('playfulness_level') is-invalid  @enderror" name="playfulness_level" placeholder="GOOD WITH OTHER DOGS" />
                                                @error('playfulness_level')
                                                <a class="nav-link count-indicator dropdown-toggle text-danger" id="playfulness_levelmessageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-email-outline"></i>
                                                    <span class="count-symbol bg-warning"></span>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="playfulness_levelmessageDropdown">
                                                    <div class="text-danger"> {{ $message }}</div>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-gradient-primary">Go to overview</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- ***************************************************************************************************************** -->
                    <!-- ************************************************Overview********************************************************* -->
                    <!-- ***************************************************************************************************************** -->
                    <div class="tab-pane @session('overviewActive') {{ $value }} @endsession" id="simple-tabpanel-1" role="tabpanel" aria-labelledby="simple-tab-1">
                        <form action="{{$editBoolean ? route('puppydes.update'):route('puppies.overview') }} " enctype="multipart/form-data" method="post">
                            @csrf
                            @if($editBoolean)
                            @method('put')
                            <input type="hidden" name="puppyinfo_id" value="{{ $data['puppyDes'][0]->puppyinfo_id }} ">
                            @endif
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <label for="formFile" class="form-label">Cover Image</label>
                                                <input class="form-control" type="file" name="cover_image" id="formFile">
                                            </div>
                                            @if($editBoolean)
                                            <img src="{{ asset('puppy-images/cover/'.$data['puppyDes'][0]->cover_image)}}" width="48px" height="" alt="" srcset="">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-form-label">Short description</label>
                                        <div class="col-sm-12">
                                            <div class="d-flex justify-content-center-align-items-center">
                                                <input type="text" value="{{ $editBoolean ? $data['puppyDes'][0]->short_desc : old('short_desc') }}" name="short_desc" class="form-control @error('short_desc') is-invalid  @enderror" placeholder="Short description about this breed.." />
                                                @error('short_desc')
                                                <a class="nav-link count-indicator dropdown-toggle text-danger" id="short_descmessageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-email-outline"></i>
                                                    <span class="count-symbol bg-warning"></span>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="short_descmessageDropdown">
                                                    <div class="text-danger"> {{ $message }}</div>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Description</label>
                                        <div class="col-sm-12">
                                            <div class="d-flex justify-content-center-align-items-center">
                                                <textarea id="long_des" name="long_desc" id="" cols="30" rows="10" class="tinymce">{{ $editBoolean ? $data['puppyDes'][0]->long_desc : old('long_desc') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="card-description">SEO</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Page title</label>
                                        <div class="col-sm-9">
                                            <div class="d-flex justify-content-center-align-items-center">
                                                <input type="text" value="{{ $editBoolean ? $data['puppyDes'][0]->page_title : old('page_title') }}" name="page_title" class="form-control @error('page_title') is-invalid  @enderror" placeholder="page title..." />
                                                @error('page_title')
                                                <a class="nav-link count-indicator dropdown-toggle text-danger" id="page_titlemessageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-email-outline"></i>
                                                    <span class="count-symbol bg-warning"></span>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="page_titlemessageDropdown">
                                                    <div class="text-danger"> {{ $message }}</div>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Meta title</label>
                                        <div class="col-sm-9">
                                            <div class="d-flex justify-content-center-align-items-center">
                                                <input type="text" value="{{ $editBoolean ? $data['puppyDes'][0]->meta_title : old('meta_title') }}" name="meta_title" class="form-control @error('meta_title') is-invalid  @enderror" placeholder="meta title..." />
                                                @error('meta_title')
                                                <a class="nav-link count-indicator dropdown-toggle text-danger" id="meta_titlemessageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-email-outline"></i>
                                                    <span class="count-symbol bg-warning"></span>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="meta_titlemessageDropdown">
                                                    <div class="text-danger"> {{ $message }}</div>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Meta Image</label>
                                        <div class="col-sm-9">
                                            <div class="d-flex justify-content-center-align-items-center">
                                                @if($editBoolean)
                                                <img src="{{ asset('puppy-images/meta-images/'.$data['puppyDes'][0]->meta_image )}}" height="44px" alt="" srcset="">
                                                @endif
                                                <input type="file" value="{{ old('meta_image') }}" name="meta_image" class="form-control @error('meta_image') is-invalid  @enderror" placeholder="meta image" />
                                                @error('meta_image')
                                                <a class="nav-link count-indicator dropdown-toggle text-danger" id="meta_imagemessageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-email-outline"></i>
                                                    <span class="count-symbol bg-warning"></span>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="meta_imagemessageDropdown">
                                                    <div class="text-danger"> {{ $message }}</div>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Meta Keyword</label>
                                        <div class="col-sm-9">
                                            <div class="d-flex justify-content-center-align-items-center">
                                                <input type="text" value="{{$editBoolean ? $data['puppyDes'][0]->meta_keyword : old('meta_keyword') }}" name="meta_keyword" class="form-control @error('meta_keyword') is-invalid  @enderror" placeholder="Meta keyoword..." />
                                                @error('meta_keyword')
                                                <a class="nav-link count-indicator dropdown-toggle text-danger" id="meta_keywordmessageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-email-outline"></i>
                                                    <span class="count-symbol bg-warning"></span>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="meta_keywordmessageDropdown">
                                                    <div class="text-danger"> {{ $message }}</div>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Meta Description</label>
                                        <div class="col-sm-12">
                                            <div class="d-flex justify-content-center-align-items-center">
                                                <input type="text" value="{{ $editBoolean ? $data['puppyDes'][0]->meta_description : old('meta_description') }}" name="meta_description" class="form-control @error('meta_description') is-invalid  @enderror" placeholder="Meta description..." />
                                                @error('meta_description')
                                                <a class="nav-link count-indicator dropdown-toggle text-danger" id="meta_descriptionmessageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-email-outline"></i>
                                                    <span class="count-symbol bg-warning"></span>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="meta_descriptionmessageDropdown">
                                                    <div class="text-danger"> {{ $message }}</div>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Og title</label>
                                        <div class="col-sm-9">
                                            <div class="d-flex justify-content-center-align-items-center">
                                                <input type="text" value="{{$editBoolean ? $data['puppyDes'][0]->og_title : old('og_title') }}" name="og_title" class="form-control @error('og_title') is-invalid  @enderror" placeholder="Og title..." />
                                                @error('og_title')
                                                <a class="nav-link count-indicator dropdown-toggle text-danger" id="og_titlemessageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-email-outline"></i>
                                                    <span class="count-symbol bg-warning"></span>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="og_titlemessageDropdown">
                                                    <div class="text-danger"> {{ $message }}</div>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Og description</label>
                                        <div class="col-sm-9">
                                            <div class="d-flex justify-content-center-align-items-center">
                                                <input type="text" value="{{$editBoolean ? $data['puppyDes'][0]->og_description : old('og_description') }}" name="og_description" class="form-control @error('og_description') is-invalid  @enderror" placeholder="Og description..." />
                                                @error('og_description')
                                                <a class="nav-link count-indicator dropdown-toggle text-danger" id="og_descriptionmessageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-email-outline"></i>
                                                    <span class="count-symbol bg-warning"></span>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="og_descriptionmessageDropdown">
                                                    <div class="text-danger"> {{ $message }}</div>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Og Image</label>
                                        <div class="col-sm-9">
                                            <div class="d-flex justify-content-center-align-items-center">
                                                @if($editBoolean)
                                                <img src="{{ asset('puppy-images/og-images/'.$data['puppyDes'][0]->og_image)}}" height="44px" alt="" srcset="">
                                                @endif
                                                <input type="file" value="{{ old('og_image') }}" name="og_image" class="form-control @error('og_image') is-invalid  @enderror" placeholder="Og image..." />
                                                @error('og_image')
                                                <a class="nav-link count-indicator dropdown-toggle text-danger" id="og_imagemessageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-email-outline"></i>
                                                    <span class="count-symbol bg-warning"></span>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="og_imagemessageDropdown">
                                                    <div class="text-danger"> {{ $message }}</div>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Og url</label>
                                        <div class="col-sm-9">
                                            <div class="d-flex justify-content-center-align-items-center">
                                                <input type="link" value="{{$editBoolean ? $data['puppyDes'][0]->og_url : old('og_url') }}" name="og_url" class="form-control @error('og_url') is-invalid  @enderror" placeholder="Og description..." />
                                                @error('og_url')
                                                <a class="nav-link count-indicator dropdown-toggle text-danger" id="og_urlmessageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-email-outline"></i>
                                                    <span class="count-symbol bg-warning"></span>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="og_urlmessageDropdown">
                                                    <div class="text-danger"> {{ $message }}</div>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Robots</label>
                                        <div class="col-sm-4">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" @checked(old('robots', 1)) name="robots" id="robots1" value="1"> Follow <i class="input-helper"></i></label>
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" value="0" class="form-check-input" @checked(old('robots', 0)) name="robots" id="robots2"> No Follow <i class="input-helper"></i></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Googlebots</label>
                                        <div class="col-sm-4">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="googlebot" id="googlebots1" value="1" checked=""> Follow <i class="input-helper"></i></label>
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="googlebot" id="googlebots2" value="0"> NO Follow <i class="input-helper"></i></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex justify-content-end" style="gap: 20px;">
                                        <button type="submit" name="status" value="0" class="btn btn-gradient-light btn-fw">Save as Draft</button>
                                        <button type="submit" name="status" value="1" class="btn btn-gradient-success btn-fw">Save as Live</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

    @section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- include summernote css/js -->

    <script src="{{asset('admin-theme/assets/vendors/tinymce/tinymce.min.js') }}"></script>
    <script src="{{asset('admin-theme/assets/vendors/tinymce/init-tinymce.js') }}"></script>
    <script async>
        // $("#breed_type").select2({
        //     placeholder: "Select breed",
        //     allowClear: false
        // });
        // $('.select2').addClass('form-control')
        // $(document).ready(function() {
        //     tinymce.init({
        //         selector: 'textarea', // change this value according to your HTML
        //         plugins: 'a_tinymce_plugin',
        //         a_plugin_option: true,
        //         a_configuration_option: 400
        //     });
        // });
    </script>
    @endsection