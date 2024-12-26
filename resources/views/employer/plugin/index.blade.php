@php use App\Helpers\ConstantHelper; @endphp
@extends('employer.layouts.master')

@section('title', 'Plugins')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Plugins</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    @foreach(ConstantHelper::PLUGINS as $plugin)
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <span>Plugin</span>
                                    @if(in_array($plugin, $activePlugins))
                                        <span class="text-success">Active</span>
                                    @else
                                        <span class="text-danger">Inactive</span>
                                    @endif
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $plugin }}</h5>
                                    <form action="{{ route('employer.plugins.update') }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        @if(in_array($plugin, $activePlugins))
                                            <input type="hidden" name="plugin" value="{{ $plugin }}">
                                            <input type="hidden" name="status" value="Inactive">
                                            <button type="submit" class="btn btn-danger">Deactivate</button>
                                        @else
                                            <input type="hidden" name="plugin" value="{{ $plugin }}">
                                            <input type="hidden" name="status" value="Active">
                                            <button type="submit" class="btn btn-success">Activate</button>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@endsection