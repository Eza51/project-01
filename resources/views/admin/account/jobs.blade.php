@extends('admin.layouts.master')
@section('title', 'Accounts')
@section("content")
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Employer's Jobs</h1>

                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{ route("admin.dashboard") }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route("admin.accounts.index") }}">Accounts</a></div>
                    <div class="breadcrumb-item active">Employer's Jobs</div>
                </div>
            </div>

            {!! session('message') !!}

            <div class="section-body">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>Account Detail</h4>
                        <button class="btn btn-light" type="button" data-toggle="collapse" data-target="#accountDetail"
                                aria-expanded="false" aria-controls="accountDetail">Show / Hide
                        </button>
                    </div>
                    <div class="collapse multi-collapse" id="accountDetail">
                        <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group row">
                                    <label for="name" class="col-sm-3 col-form-label text-right">Name
                                        *</label>
                                    <div class="col-md-9">
                                        <input type="text" name="name" id="name" class="form-control"
                                               value="{{ old('name', $account->name) }}" disabled>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="username" class="col-sm-3 col-form-label text-right">Username
                                        *</label>
                                    <div class="col-md-9">
                                        <input type="text" name="username" id="username" class="form-control"
                                               value="{{ old('username', $account->username) }}" disabled>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-sm-3 col-form-label text-right">Email *</label>
                                    <div class="col-md-9">
                                        <input type="email" name="email" id="email" class="form-control"
                                               value="{{ old('email', $account->email) }}" disabled>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="phone" class="col-sm-3 col-form-label text-right">Phone</label>
                                    <div class="col-md-9">
                                        <input type="text" name="phone" id="phone" class="form-control"
                                               value="{{ old('phone', $account->phone) }}" disabled>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="date_of_birth" class="col-sm-3 col-form-label text-right">Date of
                                        Birth</label>
                                    <div class="col-md-9">
                                        <input type="date" name="date_of_birth" id="date_of_birth"
                                               class="form-control"
                                               value="{{ old('date_of_birth', $account->date_of_birth) }}" disabled>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-sm-3 col-form-label text-right">Password
                                        *</label>
                                    <div class="col-md-9">
                                        <input type="password" name="password" id="password"
                                               class="form-control" value="{{ old('password') }}" disabled>
                                    </div>
                                </div>

                                <hr>
                                <div class="form-group row">
                                    <label for="country_id"
                                           class="col-sm-3 col-form-label text-right">Country</label>
                                    <div class="col-md-9">
                                        <select name="country_id" id="country_id" class="form-control" disabled>
                                            <option value="">Choose...</option>
                                        </select>
                                        <small id="country_wait" class="text-danger d-none">Please wait...</small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="state_id" class="col-sm-3 col-form-label text-right">State</label>
                                    <div class="col-md-9">
                                        <select name="state_id" id="state_id" class="form-control" disabled>
                                            <option value="">Choose...</option>
                                        </select>
                                        <small id="state_wait" class="text-danger d-none">Please wait...</small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="city_id" class="col-sm-3 col-form-label text-right">City</label>
                                    <div class="col-md-9">
                                        <select name="city_id" id="city_id" class="form-control" disabled>
                                            <option value="">Choose...</option>
                                        </select>
                                        <small id="city_wait" class="text-danger d-none">Please wait...</small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="address" class="col-sm-3 col-form-label text-right">Address</label>
                                    <div class="col-md-9">
                                        <textarea name="address" id="address" class="form-control" disabled>{{ $account->address->address }}</textarea>
                                    </div>
                                </div>

                                @if ($account->account_type === 'Job Seeker')
                                    <hr>

                                    <div class="form-group row">
                                        <label class="label">Experiences</label>
                                        <div class="col-12">
                                            <table class="table table-bordered table-sm">
                                                <thead>
                                                <tr>
                                                    <th>Company*</th>
                                                    <th>Position*</th>
                                                    <th>From*</th>
                                                    <th>To</th>
                                                    <th>Description</th>
                                                    <th>Status</th>
                                                </tr>
                                                </thead>

                                                <tbody id="experienceTableBody">
                                                @foreach(old('experiences', $account->experiences) as $i => $experience)
                                                    <tr id="experienceRow{{ $i }}">
                                                        <td><label class="d-block"><input type="text"
                                                                                          name="experiences[{{ $i }}][company]"
                                                                                          value="{{ $experience['company'] }}"
                                                                                          disabled
                                                                                          class="form-control form-control-sm"></label>
                                                        </td>

                                                        <td><label class="d-block"><input type="text"
                                                                                          name="experiences[{{ $i }}][position]"
                                                                                          value="{{ $experience['position'] }}"
                                                                                          disabled
                                                                                          class="form-control form-control-sm"></label>
                                                        </td>

                                                        <td><label class="d-block"><input type="date" name="experiences[{{ $i }}][from]"
                                                                                          value="{{ $experience['from'] }}"
                                                                                          disabled
                                                                                          class="form-control form-control-sm"></label>
                                                        </td>

                                                        <td><label class="d-block"><input type="date" name="experiences[{{ $i }}][to]"
                                                                                          value="{{ $experience['to'] }}"
                                                                                          disabled
                                                                                          class="form-control form-control-sm"></label>
                                                        </td>

                                                        <td><label class="d-block"><input type="text"
                                                                                          name="experiences[{{ $i }}][description]"
                                                                                          value="{{ $experience['description'] }}"
                                                                                          disabled
                                                                                          class="form-control form-control-sm"></label>
                                                        </td>
                                                        <td>
                                                            <label class="custom-switch mt-2 float-right">
                                                                <input type="checkbox" name="experiences[{{ $i }}][status]"
                                                                       disabled
                                                                       value="{{ $experience['status'] ?? 0 }}"
                                                                       class="custom-switch-input" @checked($experience['status'])>
                                                                <span class="custom-switch-indicator"></span>
                                                            </label>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="label">Educations</label>
                                        <div class="col-12">
                                            <table class="table table-bordered table-sm">
                                                <thead>
                                                <tr>
                                                    <th>School*</th>
                                                    <th>Degree*</th>
                                                    <th>From*</th>
                                                    <th>To</th>
                                                    <th>Description</th>
                                                    <th>Status</th>
                                                </tr>
                                                </thead>

                                                <tbody id="educationTableBody">
                                                @foreach(old('educations', $account->educations) as $i => $education)
                                                    <tr id="educationRow{{ $i }}">
                                                        <td><label class="d-block"><input type="text"
                                                                                          name="educations[{{ $i }}][school]"
                                                                                          value="{{ $education['school'] }}"
                                                                                          disabled
                                                                                          class="form-control form-control-sm"></label>
                                                        </td>

                                                        <td><label class="d-block"><input type="text"
                                                                                          name="educations[{{ $i }}][degree]"
                                                                                          value="{{ $education['degree'] }}"
                                                                                          disabled
                                                                                          class="form-control form-control-sm"></label>
                                                        </td>

                                                        <td><label class="d-block"><input type="date" name="educations[{{ $i }}][from]"
                                                                                          value="{{ $education['from'] }}"
                                                                                          disabled
                                                                                          class="form-control form-control-sm"></label>
                                                        </td>

                                                        <td><label class="d-block"><input type="date" name="educations[{{ $i }}][to]"
                                                                                          value="{{ $education['to'] }}"
                                                                                          disabled
                                                                                          class="form-control form-control-sm"></label>
                                                        </td>

                                                        <td><label class="d-block"><input type="text"
                                                                                          name="educations[{{ $i }}][description]"
                                                                                          value="{{ $education['description'] }}"
                                                                                          disabled
                                                                                          class="form-control form-control-sm"></label>
                                                        </td>
                                                        <td>
                                                            <label class="custom-switch mt-2 float-right">
                                                                <input type="checkbox" name="educations[{{ $i }}][status]"
                                                                       value="{{ $education['status'] ?? 0 }}"
                                                                       disabled
                                                                       class="custom-switch-input" @checked($education['status'])>
                                                                <span class="custom-switch-indicator"></span>
                                                            </label>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="col-md-4">
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label class="d-block m-0">
                                            <select name="account_type" id="account_type" class="form-control" disabled
                                            >
                                                <option value="">Account Type</option>
                                                <option value="Employer" @selected(old('account_type', $account->account_type) == 'Employer')>
                                                    Employer
                                                </option>
                                                <option value="Job Seeker" @selected(old('account_type', $account->account_type) == 'Job Seeker')>
                                                    Job Seeker
                                                </option>
                                            </select>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label class="d-block m-0">
                                            <select name="status" id="status" class="form-control" disabled
                                            >
                                                <option value="">Status</option>
                                                <option value="Pending" @selected(old('status', $account->status) == 'Pending')>
                                                    Pending
                                                </option>
                                                <option value="Approved" @selected(old('status', $account->status) == 'Approved')>
                                                    Approved
                                                </option>
                                                <option value="Suspended" @selected(old('status', $account->status) == 'Suspended')>
                                                    Suspended
                                                </option>
                                            </select>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label class="d-block m-0">
                                            <select name="is_public_profile" id="is_public_profile" disabled
                                                    class="form-control"
                                            >
                                                <option value="">Public Profile</option>
                                                <option value="1" @selected(old('is_public_profile', $account->is_public_profile) === 1)>
                                                    YES
                                                </option>
                                                <option value="0" @selected(old('is_public_profile', $account->is_public_profile) === 0)>
                                                    NO
                                                </option>
                                            </select>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label class="d-block m-0">
                                            <select name="gender" id="gender" class="form-control" disabled
                                            >
                                                <option value="">Gender</option>
                                                <option value="Male" @selected(old('is_public_profile', $account->gender) == 'Male')>
                                                    Male
                                                </option>
                                                <option value="Female" @selected(old('is_public_profile', $account->gender) == 'Female')>
                                                    Female
                                                </option>
                                                <option value="Other" @selected(old('is_public_profile', $account->gender) == 'Other')>
                                                    Other
                                                </option>
                                            </select>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-6 col-form-label">Exist Avatar
                                        Image</label>
                                    <div class="col-md-6 text-right">
                                        @if (!empty($account->avatar_image) && file_exists(public_path("storage/uploads/accounts/$account->avatar_image")))
                                            <img src="{{ asset("storage/uploads/accounts/$account->avatar_image") }}"
                                                 width="100"
                                                 alt="">
                                        @else
                                            <img src="{{ asset('assets/img/avatar/avatar-1.png') }}"
                                                 width="100"
                                                 alt="">
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-6 col-form-label">Exist Cover
                                        Image</label>
                                    <div class="col-md-6 text-right">
                                        @if (!empty($account->cover_image) && file_exists(public_path("storage/uploads/accounts/$account->cover_image")))
                                            <img src="{{ asset("storage/uploads/accounts/$account->cover_image") }}"
                                                 width="100"
                                                 alt="">
                                        @else
                                            <img src="{{ asset('assets/img/example-image.jpg') }}"
                                                 width="200"
                                                 alt="">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>

            <div class="section-body">
                <div class="card">
                    <div class="card-header">
                        <h4>Jobs</h4>
                    </div>

                    <div class="card-body">
                        {{ $dataTable->table() }}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush

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

                        if (selectedId !== null) {
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

                        if (selectedStateId !== null) {
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

        const selectedCountryId = parseInt('{{ $account->address->country_id }}');
        const selectedStateId = parseInt('{{ $account->address->state_id }}');
        const selectedCityId = parseInt('{{ $account->address->city_id }}');

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