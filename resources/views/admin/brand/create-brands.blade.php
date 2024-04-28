@extends('admin.layouts.app')
@section('page-title') {{ 'Add brand' }} @endsection
@section('styles')
<style>

</style>
@endsection
@section('content-wrapper')
<div class="page-header">
    <h3 class="page-title"> Product brand</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"> brand</a></li>
            <li class="breadcrumb-item active" aria-current="page"> add brand</li>
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
                <form action="{{ $editBoolean ? '': url('admin/brand') }}" class="form-sample" id="category" method="post" autocomplete="off" aria-autocomplete="none">
                    <!-- <p class="card-description">Basic information </p> -->
                    @csrf
                    @if($editBoolean)
                    @method('put')
                    @else
                    @method('post')
                    @endif
                    <p class="card-description"> {{$editBoolean ? 'Edit '.$data['brand']->name : 'Add'}} brand</p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Name</label>
                                <div class="col-sm-9">
                                    <div class="d-flex justify-content-center-align-items-center">
                                        <input type="text" value="{{ $editBoolean ? $data['brand']->name : old('name') }}" name="name" class="form-control @error('name') is-invalid  @enderror" placeholder="Average Life" />
                                        @error('name')
                                        <a class="nav-link count-indicator dropdown-toggle text-danger" id="namemessageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-email-outline"></i>
                                            <span class="count-symbol bg-warning"></span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="namemessageDropdown">
                                            <div class="text-danger"> {{ $message }}</div>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Slug</label>
                                <div class="col-sm-9">
                                    <div class="d-flex justify-content-center-align-items-center">
                                        <input readonly type="text" max="5" min="1" value="{{ $editBoolean ? $data['brand']->slug : old('slug') }}" class="form-control @error('slug') is-invalid  @enderror" name="slug" placeholder="AFFECTIONATE WITH FAMILY" />
                                        @error('slug')
                                        <a class="nav-link count-indicator dropdown-toggle text-danger" id="slugmessageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-email-outline"></i>
                                            <span class="count-symbol bg-warning"></span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="slugmessageDropdown">
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
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="submit" name="status" value="0" class="btn btn-gradient-secondary">Save as Draft</button>
                                <button type="submit" name="status" value="1" class="btn btn-gradient-primary">Live</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection

    @section('scripts')
    <script>
        $('input[name="name"]').on('keyup', function() {
            $('input[name="slug"]').val(`${$(this).val().trim().replaceAll(' ','-')}`)
        })
    </script>
    @endsection