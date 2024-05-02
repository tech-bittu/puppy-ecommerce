@extends('admin.layouts.app')
@section('page-title') {{ 'Add Product' }} @endsection
@section('styles')
<style>
    #image-gallary {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        gap: 8px;
    }

    .preview-temp {
        width: 60px !important;
        height: 60px;
    }

    #image-gallary img:hover {
        ::after {
            content: 'Remove';
            background-color: #0f0f0f;
            z-index: 2;
        }
    }
</style>
@endsection
@section('content-wrapper')
<div class="page-header">
    <h3 class="page-title"> Product item</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"> product</a></li>
            <li class="breadcrumb-item active" aria-current="page"> add product</li>
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
                <form action="{{ $editBoolean ? '': url('admin/products') }}" class="form-sample" id="product" method="POST" autocomplete="off" aria-autocomplete="none">
                    <!-- <p class="card-description">Basic information </p> -->
                    @csrf
                    @if($editBoolean)
                    @method('put')
                    @endif
                    <p class="card-description"> {{$editBoolean ? 'Edit '.$data['product']->title : 'Add'}} product</p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Title *</label>
                                <div class="col-sm-9">
                                    <div class="d-flex justify-content-center-align-items-center">
                                        <input type="text" value="{{ $editBoolean ? $data['product']->title : old('title') }}" name="title" class="form-control @error('title') is-invalid  @enderror" placeholder="Product title ..." />
                                        @error('title')
                                        <a class="nav-link count-indicator dropdown-toggle text-danger" id="titlemessageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-email-outline"></i>
                                            <span class="count-symbol bg-warning"></span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="titlemessageDropdown">
                                            <div class="text-danger"> {{ $message }}</div>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Slug *</label>
                                <div class="col-sm-9">
                                    <div class="d-flex justify-content-center-align-items-center">
                                        <input readonly type="text" max="5" min="1" value="{{ $editBoolean ? $data['product']->slug : old('slug') }}" class="form-control @error('slug') is-invalid  @enderror" name="slug" placeholder="View slug here" />
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
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Compare price</label>
                                <div class="col-sm-9">
                                    <div class="d-flex justify-content-center-align-items-center">
                                        <input type="number" value="{{ $editBoolean ? $data['product']->compare_price : old('compare_price') }}" class="form-control @error('compare_price') is-invalid  @enderror" name="compare_price" placeholder="" />
                                        @error('compare_price')
                                        <a class="nav-link count-indicator dropdown-toggle text-danger" id="compare_pricegmessageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-email-outline"></i>
                                            <span class="count-symbol bg-warning"></span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="compare_pricegmessageDropdown">
                                            <div class="text-danger"> {{ $message }}</div>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Price *</label>
                                <div class="col-sm-9">
                                    <div class="d-flex justify-content-center-align-items-center">
                                        <input type="number" value="{{ $editBoolean ? $data['product']->price : old('price') }}" class="form-control @error('price') is-invalid  @enderror" name="price" placeholder="" />
                                        @error('price')
                                        <a class="nav-link count-indicator dropdown-toggle text-danger" id="pricemessageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-email-outline"></i>
                                            <span class="count-symbol bg-warning"></span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="pricemessageDropdown">
                                            <div class="text-danger"> {{ $message }}</div>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">qty</label>
                                <div class="col-sm-9">
                                    <div class="d-flex justify-content-center-align-items-center">
                                        <input type="number" max="5" min="1" value="{{ $editBoolean ? $data['product']->qty : old('qty') }}" class="form-control @error('qty') is-invalid  @enderror" name="qty" placeholder="qty" />
                                        @error('qty')
                                        <a class="nav-link count-indicator dropdown-toggle text-danger" id="qtymessageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-email-outline"></i>
                                            <span class="count-symbol bg-warning"></span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="qtymessageDropdown">
                                            <div class="text-danger"> {{ $message }}</div>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">SKU ( Stock Keeping Unit ) *</label>
                                <div class="col-sm-9">
                                    <div class="d-flex justify-content-center-align-items-center">
                                        <input type="number" max="5" min="1" value="{{ $editBoolean ? $data['product']->sku : old('sku') }}" class="form-control @error('sku') is-invalid  @enderror" name="sku" placeholder="sku" />
                                        @error('sku')
                                        <a class="nav-link count-indicator dropdown-toggle text-danger" id="skumessageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-email-outline"></i>
                                            <span class="count-symbol bg-warning"></span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="skumessageDropdown">
                                            <div class="text-danger"> {{ $message }}</div>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">barkode</label>
                                <div class="col-sm-9">
                                    <div class="d-flex justify-content-center-align-items-center">
                                        <input type="number" max="5" min="1" value="{{ $editBoolean ? $data['product']->barkode : old('barkode') }}" class="form-control @error('barkode') is-invalid  @enderror" name="barkode" placeholder="barkode" />
                                        @error('barkode')
                                        <a class="nav-link count-indicator dropdown-toggle text-danger" id="barkodemessageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-email-outline"></i>
                                            <span class="count-symbol bg-warning"></span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="barkodemessageDropdown">
                                            <div class="text-danger"> {{ $message }}</div>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Category *</label>
                                <div class="col-sm-9  mb-2">
                                    <div class="h-100 d-flex flex-row align-items-center justify-content-center">
                                        <select class="form-control @error('category_id') is-invalid  @enderror h-100" {{ $editBoolean ? 'aria-readonly="true"':''}} id="category_id" name="category_id">
                                            <option value="">---Select category ---</option>
                                            @foreach($data['category'] as $category)
                                            <option value="{{ $category->id }}" @php if($editBoolean){echo $category->id == $data['product']->category_id ? 'selected' : ''; } @endphp {{ old('category_id') == $category->id ? 'selected' : '' }} > {{ $category->name }} </option>
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
                                <label class="col-sm-3 col-form-label">Subcategory *</label>
                                <div class="col-sm-9  mb-2">
                                    <div class="h-100 d-flex flex-row align-items-center justify-content-center">
                                        <select class="form-control @error('subcategory_id') is-invalid  @enderror h-100" {{ $editBoolean ? 'aria-readonly="true"':''}} id="subcategory_id" name="subcategory_id">
                                            <option value="">---Select subcategory ---</option>
                                            @foreach($data['subcategory'] as $subcategory)
                                            <option value="{{ $subcategory->id }}" @php if($editBoolean){echo $subcategory->id == $data['product']->subcategory_id ? 'selected' : ''; } @endphp {{ old('subcategory_id') == $subcategory->id ? 'selected' : '' }} > {{ $subcategory->name }} </option>
                                            @endforeach
                                        </select>
                                        @error('subcategory_id')
                                        <a class="nav-link count-indicator dropdown-toggle text-danger" id="subcategory_idmessageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-email-outline"></i>
                                            <span class="count-symbol bg-warning"></span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="subcategory_idmessageDropdown">
                                            <div class="text-danger"> {{ $message }}</div>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Brand *</label>
                                <div class="col-sm-9  mb-2">
                                    <div class="h-100 d-flex flex-row align-items-center justify-content-center">
                                        <select class="form-control @error('brand_id') is-invalid  @enderror h-100" {{ $editBoolean ? 'aria-readonly="true"':''}} id="brand_id" name="brand_id">
                                            <option value="">---Select brand ---</option>
                                            @foreach($data['brand'] as $brand)
                                            <option value="{{ $brand->id }}" @php if($editBoolean){echo $brand->id == $data['product']->brand_id ? 'selected' : ''; } @endphp {{ old('brand_id') == $brand->id ? 'selected' : '' }} > {{ $brand->name }} </option>
                                            @endforeach
                                        </select>
                                        @error('brand_id')
                                        <a class="nav-link count-indicator dropdown-toggle text-danger" id="brand_idmessageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-email-outline"></i>
                                            <span class="count-symbol bg-warning"></span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="brand_idmessageDropdown">
                                            <div class="text-danger"> {{ $message }}</div>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Track quantity</label>
                                <div class="col-sm-4">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="track_qty" id="track_qty1" value="Yes"> YES <i class="input-helper"></i></label>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="track_qty" id="track_qty2" value="No" checked> No <i class="input-helper"></i></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Is feature</label>
                                <div class="col-sm-4">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="is_feature" id="is_feature1" value="Yes" checked=""> YES <i class="input-helper"></i></label>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="is_feature" id="is_feature2" value="No"> No <i class="input-helper"></i></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p class="card-description">Product Gallery</p>
                            <div id="image" class="dropzone dz-clickable">
                                <div class="dz-message needsclick">
                                    <br>Drop files here or click to upload.<br><br>
                                </div>
                            </div>
                            <div id="image-gallary" class="row row-cols-1 row-cols-md-6 g-4 mb-4"></div>
                        </div>
                        <input type="hidden" name="image_gallery" value="{{ old('image_gallery') }}">
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Description</label>
                                <div class="col-sm-12">
                                    <div class="d-flex justify-content-center-align-items-center">
                                        <textarea id="description" name="description" id="" cols="30" rows="10" class="tinymce">{{ $editBoolean ? $data['product']->description : old('description') }}</textarea>
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
        $('input[name="title"]').on('keyup', function() {
            $('input[name="slug"]').val(`${$(this).val().trim().replaceAll(' ','-')}`)
        })

        // Dropzone.autoDiscover = false;
        const dropzone = $("#image").dropzone({
            // init: function() {
            //     this.on('addedfile', function(file) {
            //         if (this.files.length > 1) {
            //             this.removeFile(this.files[0]);
            //         }
            //     });
            // },
            url: "{{ route('temp-images.create') }}",
            maxFiles: 10,
            paramName: 'images',
            addRemoveLinks: true,
            acceptedFiles: "image/jpeg,image/png,image/gif",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(file, response) {
                $previouseImage = $("input[name='image_gallery']").val();
                $previouseImage = response + ',' + $previouseImage;
                $dd = $("input[name='image_gallery']").val($previouseImage);
                $('#image-gallary').append('<div class="col" > <div style="height:164px;" class="card"><img src="{{ asset("temp")}}/' + response + '" class="preview-temp h-100"/> <button onclick="remove(\'' + response + '\')" type="button" class="card-footer bg-transparent border-success">Remove</button></div></div>')
            },
            complete:function(file)
            {
                this.removeFile(file);
            }
        });
        // ## image name in input image-gallary 
        function addValue() {
            $("input[name='image_gallery']").val('');
            $("#image-gallary img").each(function(e) {
                console.log($(e))
                let value = $("input[name='image_gallery']").val();
                let previouseImage = $(e).attr('src');
                valueIn = value + ',' + previouseImage
                $("input[name='image_gallery']").val(valueIn);
            });
        }

        $("#image-gallary").on('change', addValue())

        function remove(id) {
            $(`img[src="{{ asset("temp")}}/${id}"]`).parent().parent().remove();
            // addValue()
            var images = '';
            $("#image-gallary img").each(function() {
                if (this.src) {
                    images =  this.src  +','+ images;
                }
            });
            $("input[name='image_gallery']").val(images)
        }
    </script>
    <script src="{{asset('admin-theme/assets/vendors/tinymce/tinymce.min.js') }}"></script>
    <script src="{{asset('admin-theme/assets/vendors/tinymce/init-tinymce.js') }}"></script>
    @endsection