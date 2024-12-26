@extends('admin.layouts.master')
@section('title', 'Job Show')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Job Edit</h1>
                <div class="section-header-button">
                    <a href="{{ route('admin.jobs.index') }}" class="btn btn-primary"><i
                                class="fa fa-eye"></i>
                        View All</a>
                </div>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('admin.jobs.index') }}">Jobs</a>
                    </div>
                    <div class="breadcrumb-item active">Job Show</div>
                </div>
            </div>

            {!! session('message') !!}

            <div class="section-body">
                <form action="" method="POST"
                      enctype="multipart/form-data"
                      class="needs-validation" novalidate="">
                    <div class="card">
                        <div class="card-header">
                            <h4>Job Detail</h4>
                        </div>
                        <div class="card-body">

                            <div class="form-group row">
                                <label for="title" class="col-sm-3 col-form-label text-right">Title *</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="title"
                                           value="{{ old('title', $jobPost->title) }}" name="title" disabled>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="account_id" class="col-sm-3 col-form-label text-right">Employer *</label>
                                <div class="col-sm-6">
                                    <select name="account_id" id="account_id" class="form-control" disabled>
                                        <option value="">Choose...</option>
                                        @foreach($employerAccounts as $employerAccount)
                                            <option value="{{ $employerAccount->id }}" @selected(old('account_id', $jobPost->account_id) == $employerAccount->id)>{{ $employerAccount->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="job_category_id" class="col-sm-3 col-form-label text-right">Category
                                    *</label>
                                <div class="col-sm-6">
                                    <select name="job_category_id" id="job_category_id" class="form-control" disabled>
                                        <option value="">Choose...</option>
                                        @foreach($jobCategories as $jobCategory)
                                            <option value="{{ $jobCategory->id }}" @selected(old('job_category_id', $jobPost->job_category_id) == $jobCategory->id)>{{ $jobCategory->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="vacancy" class="col-sm-3 col-form-label text-right">Vacancy *</label>
                                <div class="col-sm-6">
                                    <input type="number" class="form-control" id="vacancy"
                                           value="{{ old('vacancy', $jobPost->vacancy) }}" name="vacancy" disabled>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="deadline" class="col-sm-3 col-form-label text-right">Deadline *</label>
                                <div class="col-sm-6">
                                    <input type="date" class="form-control" id="deadline"
                                           value="{{ old('deadline', $jobPost->deadline) }}" name="deadline" disabled>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-sm-3 col-form-label text-right">Description
                                    *</label>
                                <div class="col-sm-6">
                                    <textarea name="description" id="description" disabled
                                              class="form-control">{{ old('description', $jobPost->description) }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h4>Location</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="country_id"
                                       class="col-sm-3 col-form-label text-right">Country</label>
                                <div class="col-md-6">
                                    <select name="country_id" id="country_id" class="form-control" disabled>
                                        <option value="">Choose...</option>
                                    </select>
                                    <small id="country_wait" class="text-danger d-none">Please wait...</small>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="state_id" class="col-sm-3 col-form-label text-right">State</label>
                                <div class="col-md-6">
                                    <select name="state_id" id="state_id" class="form-control" disabled>
                                        <option value="">Choose...</option>
                                    </select>
                                    <small id="state_wait" class="text-danger d-none">Please wait...</small>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="city_id" class="col-sm-3 col-form-label text-right">City</label>
                                <div class="col-md-6">
                                    <select name="city_id" id="city_id" class="form-control" disabled>
                                        <option value="">Choose...</option>
                                    </select>
                                    <small id="city_wait" class="text-danger d-none">Please wait...</small>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="address" class="col-sm-3 col-form-label text-right">Address</label>
                                <div class="col-md-6">
                                    <textarea name="address" id="address" disabled
                                              class="form-control">{{ old('address', $jobPost->location->address) }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h4>Salary</h4>
                        </div>

                        <div class="card-body">
                            <div class="form-group row">
                                <label for="min_salary" class="col-sm-3 col-form-label text-right">Minimum Salary or
                                    Fixed Salary *</label>
                                <div class="col-sm-6">
                                    <input type="number" class="form-control" id="min_salary" disabled
                                           value="{{ old('min_salary', $jobPost->salary->min_salary) }}"
                                           name="min_salary">
                                    <small class="text-muted">If the maximum salary field is empty, it acts as a fixed
                                        salary.</small>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="max_salary" class="col-sm-3 col-form-label text-right">Maximum
                                    Salary</label>
                                <div class="col-sm-6">
                                    <input type="number" class="form-control" id="max_salary" disabled
                                           value="{{ old('max_salary', $jobPost->salary->max_salary) }}"
                                           name="max_salary">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="salary_type" class="col-sm-3 col-form-label text-right">Salary Type
                                    *</label>
                                <div class="col-sm-6">
                                    <select name="job_attributes[Salary Type]" id="salary_type" class="form-control" disabled>
                                        <option value="">Choose...</option>
                                        @foreach($jobAttributes as $jobAttribute)
                                            @if ($jobAttribute->type !== 'Salary Type')
                                                @continue
                                            @endif
                                            <option value="{{ $jobAttribute->id }}" {{ old('job_attributes.Salary Type',
                                                $jobPost->attributes->first(function($attribute) use ($jobAttribute) {
                                                        return $attribute->attribute->type == 'Salary Type' &&
                                                               $attribute->attribute->name == $jobAttribute->name;
                                            }) ? 'selected' : '') }}
                                            >{{ $jobAttribute->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h4>Attributes</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="experience" class="col-sm-3 col-form-label text-right">Experience *</label>
                                <div class="col-sm-6">
                                    <select name="job_attributes[Experience]" id="experience" class="form-control" disabled>
                                        <option value="">Choose...</option>
                                        @foreach($jobAttributes as $jobAttribute)
                                            @if ($jobAttribute->type !== 'Experience')
                                                @continue
                                            @endif
                                            <option value="{{ $jobAttribute->id }}" {{ old('job_attributes.Experience',
                                                $jobPost->attributes->first(function($attribute) use ($jobAttribute) {
                                                        return $attribute->attribute->type == 'Experience' &&
                                                               $attribute->attribute->name == $jobAttribute->name;
                                            }) ? 'selected' : '') }}
                                            >{{ $jobAttribute->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="job_role" class="col-sm-3 col-form-label text-right">Job Role *</label>
                                <div class="col-sm-6">
                                    <select name="job_attributes[Job Role]" id="job_role" class="form-control" disabled>
                                        <option value="">Choose...</option>
                                        @foreach($jobAttributes as $jobAttribute)
                                            @if ($jobAttribute->type !== 'Job Role')
                                                @continue
                                            @endif
                                            <option value="{{ $jobAttribute->id }}" {{ old('job_attributes.Job Role',
                                                $jobPost->attributes->first(function($attribute) use ($jobAttribute) {
                                                        return $attribute->attribute->type == 'Job Role' &&
                                                               $attribute->attribute->name == $jobAttribute->name;
                                            }) ? 'selected' : '') }}
                                            >{{ $jobAttribute->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="education" class="col-sm-3 col-form-label text-right">Education *</label>
                                <div class="col-sm-6">
                                    <select name="job_attributes[Education]" id="education" class="form-control" disabled>
                                        <option value="">Choose...</option>
                                        @foreach($jobAttributes as $jobAttribute)
                                            @if ($jobAttribute->type !== 'Education')
                                                @continue
                                            @endif
                                            <option value="{{ $jobAttribute->id }}" {{ old('job_attributes.Education',
                                                $jobPost->attributes->first(function($attribute) use ($jobAttribute) {
                                                        return $attribute->attribute->type == 'Education' &&
                                                               $attribute->attribute->name == $jobAttribute->name;
                                            }) ? 'selected' : '') }}
                                            >{{ $jobAttribute->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="job_type" class="col-sm-3 col-form-label text-right">Job Type *</label>
                                <div class="col-sm-6">
                                    <select name="job_attributes[Job Type]" id="job_type" class="form-control" disabled>
                                        <option value="">Choose...</option>
                                        @foreach($jobAttributes as $jobAttribute)
                                            @if ($jobAttribute->type !== 'Job Type')
                                                @continue
                                            @endif
                                            <option value="{{ $jobAttribute->id }}" {{ old('job_attributes.Job Type',
                                                $jobPost->attributes->first(function($attribute) use ($jobAttribute) {
                                                        return $attribute->attribute->type == 'Job Type' &&
                                                               $attribute->attribute->name == $jobAttribute->name;
                                            }) ? 'selected' : '') }}
                                            >{{ $jobAttribute->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="tags" class="col-sm-3 col-form-label text-right">Tags *</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="tags" disabled
                                           value="{{ old('tags', $jobPost->attributeOther->tags) }}" name="tags">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="benefits" class="col-sm-3 col-form-label text-right">Benefits *</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="benefits" disabled
                                           value="{{ old('benefits', $jobPost->attributeOther->benefits) }}" name="benefits">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="skills" class="col-sm-3 col-form-label text-right">Skills *</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="skills" disabled
                                           value="{{ old('skills', $jobPost->attributeOther->skills) }}" name="skills">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="status" class="col-sm-3 col-form-label text-right">Status *</label>
                                <div class="col-sm-6">
                                    <select name="status" id="status" class="form-control" disabled>
                                        <option value="Pending" @selected(old('status', $jobPost->status) == 'Pending')>Pending</option>
                                        <option value="Publish" @selected(old('status', $jobPost->status) == 'Publish')>Publish</option>
                                        <option value="Expired" @selected(old('status', $jobPost->status) == 'Expired')>Expired</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script>
        // For Country, State and City
        'use strict';
        const API_URL = '{{ url('api') }}';
        const countryIdElement = $('#country_id');
        const stateIdElement = $('#state_id');
        const cityIdElement = $('#city_id');

        const countryWaitElement = $('#country_wait');
        const stateWaitElement = $('#state_wait');
        const cityWaitElement = $('#city_wait');

        const findCountry = (selectedId = null) => {
            $.ajax({
                url: API_URL + '/countries',
                method: 'get',
                beforeSend: function () {
                    countryWaitElement.removeClass('d-none');
                },
                success: function (json) {
                    countryWaitElement.addClass('d-none');
                    if (json.success) {
                        let html = `<option value="">Choose...</option>`;

                        html += json.data.map((item) => {
                            const selected = item.id === selectedId ? 'selected' : '';
                            return `<option value="${item.id}" ${selected}>${item.name}</option>`;
                        }).join('');

                        countryIdElement.html(html);

                        if (selectedId !== null && !isNaN(selectedId)) {
                            findState(selectedCountryId, selectedStateId);
                        }
                    } else {
                        alert(json.message);
                        console.log(json);
                    }
                }
            });
        }

        const findState = (countryId = null, selectedStateId = null) => {
            $.ajax({
                url: API_URL + '/states' + (countryId ? '/' + countryId : ''),
                method: 'get',
                beforeSend: function () {
                    stateWaitElement.removeClass('d-none');
                },
                success: function (json) {
                    stateWaitElement.addClass('d-none');
                    if (json.success) {
                        let html = `<option value="">Choose...</option>`;

                        html += json.data.map((item) => {
                            const selected = item.id === selectedStateId ? 'selected' : '';
                            return `<option value="${item.id}" ${selected}>${item.name}</option>`;
                        }).join('');

                        stateIdElement.html(html);

                        if (selectedStateId !== null && !isNaN(selectedStateId)) {
                            findCity(selectedStateId, selectedCityId);
                        }
                    } else {
                        alert(json.message);
                        console.log(json);
                    }
                }
            });
        }

        const findCity = (stateId = null, selectedCityId = null) => {
            $.ajax({
                url: API_URL + '/cities' + (stateId ? '/' + stateId : ''),
                method: 'get',
                beforeSend: function () {
                    cityWaitElement.removeClass('d-none');
                },
                success: function (json) {
                    cityWaitElement.addClass('d-none');
                    if (json.success) {
                        let html = `<option value="">Choose...</option>`;

                        html += json.data.map((item) => {
                            const selected = item.id === selectedCityId ? 'selected' : '';
                            return `<option value="${item.id}" ${selected}>${item.name}</option>`;
                        }).join('');

                        cityIdElement.html(html);
                    } else {
                        alert(json.message);
                        console.log(json);
                    }
                }
            });
        }

        const selectedCountryId = parseInt('{{ old('country_id', $jobPost->location->country_id) }}');
        const selectedStateId = parseInt('{{ old('state_id', $jobPost->location->state_id) }}');
        const selectedCityId = parseInt('{{ old('city_id', $jobPost->location->city_id) }}');

        countryIdElement.on('change', function () {
            const countryId = jQuery(this).val();
            findState(countryId);
        });

        stateIdElement.on('change', function () {
            const cityId = jQuery(this).val();
            findCity(cityId);
        });

        findCountry(selectedCountryId);
    </script>
@endpush