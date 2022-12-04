@extends('admin.layout.master')

@section('title','Category List Page')

@section('content')

                <!-- MAIN CONTENT-->
                <div class="main-content">
                    <div class="section__content section__content--p30">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-3 offset-8">
                                    <a href="{{ route('category#list') }}"><button class="btn bg-dark text-white my-3">Return to List</button></a>
                                </div>
                            </div>
                            <div class="col-lg-6 offset-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-title">
                                            <h3 class="text-center title-2">Edit your category</h3>
                                        </div>
                                        <hr>
                                        <form action="{{ route('category#update') }}" method="post" novalidate="novalidate">
                                            @csrf
                                            <div class="form-group">
                                                <input type="hidden" name="categoryId" value="{{ $getcategoryData->id }}">
                                                <label for="categoryName" class="control-label mb-1">Category Name</label>
                                                <input id="categoryname" name="categoryName" type="text" class="form-control @error('categoryName') is-invalid @enderror" value="{{ old('categoryName',$getcategoryData->name) }}" aria-required="true" aria-invalid="false">
                                                @error('categoryName')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div>
                                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                    <span id="payment-button-amount">Update</span>
                                                    <span id="payment-button-sending" style="display:none;">Sending…</span>
                                                    <i class="fa-solid fa-circle-right"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END MAIN CONTENT-->

@endsection