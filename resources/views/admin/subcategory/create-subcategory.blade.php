@extends('admin.layouts.app')
@section('page-title') {{ 'Add SUbcategory' }} @endsection
@section('styles')
<style>

</style>
@endsection
@section('content-wrapper')
<div class="page-header">
    <h3 class="page-title"> Product Subcategory</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"> Subcategory</a></li>
            <li class="breadcrumb-item active" aria-current="page"> add Subcategory</li>
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
                <form action="{{ $editBoolean ? '': url('admin/subcategory') }}" class="form-sample" id="category" method="post" autocomplete="off" aria-autocomplete="none">
                    <!-- <p class="card-description">Basic information </p> -->
                    @csrf
                    @if($editBoolean)
                    @method('put')
                    @else
                    @method('post')
                    @endif
                    <p class="card-description"> {{$editBoolean ? 'Edit '.$data['subcategory']->name : 'Add'}} Subcategory</p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Name</label>
                                <div class="col-sm-9">
                                    <div class="d-flex justify-content-center-align-items-center">
                                        <input type="text" value="{{ $editBoolean ? $data['subcategory']->name : old('name') }}" name="name" class="form-control @error('name') is-invalid  @enderror" placeholder="Average Life" />
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
                                <label class="col-sm-3 col-form-label">Category</label>
                                <div class="col-sm-9  mb-2">
                                    <div class="h-100 d-flex flex-row align-items-center justify-content-center">
                                        <select class="form-control @error('category_id') is-invalid  @enderror h-100" {{ $editBoolean ? 'aria-readonly="true"':''}} id="category_id" name="category_id">
                                            <option value="">---Select Category ---</option>
                                            @foreach($data['category'] as $cate)
                                            <option value="{{ $cate->id }}" @php if($editBoolean){echo $cate->id == $data['subcategory']->category_id ? 'selected' : ''; } @endphp {{ old('category_id ') == $cate->id ? 'selected' : '' }} > {{ $cate->name }} </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                        <a class="nav-link count-indicator dropdown-toggle text-danger" id="category_idmessageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-email-outline"></i>
                                            <span class="count-symbol bg-warning"></span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="category_idmessageDropdown">
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
                                        <input readonly type="text" max="5" min="1" value="{{ $editBoolean ? $data['subcategory']->slug : old('slug') }}" class="form-control @error('slug') is-invalid  @enderror" name="slug" placeholder="AFFECTIONATE WITH FAMILY" />
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