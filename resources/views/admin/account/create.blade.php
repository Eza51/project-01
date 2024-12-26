@php use App\Helpers\ConstantHelper; @endphp
@extends('admin.layouts.master')
@section('title', 'Account Create')
@section("content")
    <form action="{{ route('admin.accounts.store') }}" method="POST" enctype="multipart/form-data"
          class="needs-validation" novalidate="">
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>Account Create</h1>
                    <div class="section-header-button">
                        <a href="{{ route('admin.accounts.index') }}" class="btn btn-primary">Account</a>
                    </div>

                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item"><a href="{{ route("admin.dashboard") }}">Dashboard</a></div>
                        <div class="breadcrumb-item"><a href="{{ route("admin.accounts.index") }}">Accounts</a></div>
                        <div class="breadcrumb-item active">Account Create</div>
                    </div>
                </div>

                {!! session('message') !!}

                <div class="section-body">
                    <div class="card">
                        <div class="card-body">

                            @csrf
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-3 col-form-label text-right">Name
                                            *</label>
                                        <div class="col-md-9">
                                            <input type="text" name="name" id="name" class="form-control"
                                                   value="{{ old('name') }}" autofocus>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="username" class="col-sm-3 col-form-label text-right">Username
                                            *</label>
                                        <div class="col-md-9">
                                            <input type="text" name="username" id="username" class="form-control"
                                                   value="{{ old('username') }}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="email" class="col-sm-3 col-form-label text-right">Email *</label>
                                        <div class="col-md-9">
                                            <input type="email" name="email" id="email" class="form-control"
                                                   value="{{ old('email') }}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="phone" class="col-sm-3 col-form-label text-right">Phone</label>
                                        <div class="col-md-9">
                                            <input type="text" name="phone" id="phone" class="form-control"
                                                   value="{{ old('phone') }}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="date_of_birth" class="col-sm-3 col-form-label text-right">Date of
                                            Birth</label>
                                        <div class="col-md-9">
                                            <input type="date" name="date_of_birth" id="date_of_birth"
                                                   class="form-control"
                                                   value="{{ old('date_of_birth') }}">
                                            <small class="text-muted mt-2">Only for Job Seeker</small>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password" class="col-sm-3 col-form-label text-right">Password
                                            *</label>
                                        <div class="col-md-9">
                                            <input type="password" name="password" id="password"
                                                   class="form-control" value="{{ old('password') }}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="description"
                                               class="col-sm-3 col-form-label text-right">Description</label>
                                        <div class="col-sm-9">
                                    <textarea name="description" id="description"
                                              class="form-control summernote-simple">{{ old('description') }}</textarea>
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="form-group row">
                                        <label for="country_id"
                                               class="col-sm-3 col-form-label text-right">Country</label>
                                        <div class="col-md-9">
                                            <select name="country_id" id="country_id" class="form-control">
                                                <option value="">Choose...</option>
                                            </select>
                                            <small id="country_wait" class="text-danger d-none">Please wait...</small>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="state_id" class="col-sm-3 col-form-label text-right">State</label>
                                        <div class="col-md-9">
                                            <select name="state_id" id="state_id" class="form-control">
                                                <option value="">Choose...</option>
                                            </select>
                                            <small id="state_wait" class="text-danger d-none">Please wait...</small>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="city_id" class="col-sm-3 col-form-label text-right">City</label>
                                        <div class="col-md-9">
                                            <select name="city_id" id="city_id" class="form-control">
                                                <option value="">Choose...</option>
                                            </select>
                                            <small id="city_wait" class="text-danger d-none">Please wait...</small>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="address" class="col-sm-3 col-form-label text-right">Address</label>
                                        <div class="col-md-9">
                                            <textarea name="address" id="address" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="plugins" class="col-sm-3 col-form-label text-right">Plugins</label>
                                        <div class="col-md-9">
                                            @foreach(ConstantHelper::PLUGINS as $i => $plugin)
                                                <div class="form-check">
                                                    <input class="form-check-input" name="plugins[]"
                                                           value="{{ $plugin }}"
                                                           type="checkbox"
                                                           {{ in_array($plugin, old('plugins', [])) ? 'checked' : '' }}
                                                           id="plugin_{{ $i }}">
                                                    <label class="form-check-label" for="plugin_{{ $i }}">
                                                        {{ $plugin }}
                                                    </label>
                                                </div>
                                            @endforeach
                                            <small class="text-muted mt-2">Only for Employer</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary py-2 w-100">Account Create
                                            </button>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label class="d-block m-0">
                                                <select name="account_type" id="account_type" class="form-control"
                                                >
                                                    <option value="">Account Type</option>
                                                    <option value="Job Seeker" @selected(old('account_type') == 'Job Seeker')>
                                                        Job Seeker
                                                    </option>
                                                    <option value="Employer" @selected(old('account_type') == 'Employer')>
                                                        Employer
                                                    </option>

                                                </select>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label class="d-block m-0">
                                                <select name="status" id="status" class="form-control"
                                                >
                                                    <option value="">Status</option>
                                                    <option value="Pending" @selected(old('status') == 'Pending')>
                                                        Pending
                                                    </option>
                                                    <option value="Approved" @selected(old('status') == 'Approved')>
                                                        Approved
                                                    </option>
                                                    <option value="Suspended" @selected(old('status') == 'Suspended')>
                                                        Suspended
                                                    </option>
                                                </select>
                                            </label>
                                        </div>
                                    </div>

{{--                                    <div class="form-group row">--}}
{{--                                        <div class="col-md-12">--}}
{{--                                            <label class="d-block m-0">--}}
{{--                                                <select name="is_public_profile" id="is_public_profile"--}}
{{--                                                        class="form-control"--}}
{{--                                                >--}}
{{--                                                    <option value="">Public Profile</option>--}}
{{--                                                    <option value="1" @selected(old('is_public_profile') === 1)>YES--}}
{{--                                                    </option>--}}
{{--                                                    <option value="0" @selected(old('is_public_profile') === 0)>NO--}}
{{--                                                    </option>--}}
{{--                                                </select>--}}
{{--                                                <small class="text-muted mt-2">Only for Employer</small>--}}
{{--                                            </label>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label class="d-block m-0">
                                                <select name="gender" id="gender" class="form-control"
                                                >
                                                    <option value="">Gender</option>
                                                    <option value="Male" @selected(old('is_public_profile') == 'Male')>
                                                        Male
                                                    </option>
                                                    <option value="Female" @selected(old('is_public_profile') == 'Female')>
                                                        Female
                                                    </option>
                                                    <option value="Other" @selected(old('is_public_profile') == 'Other')>
                                                        Other
                                                    </option>
                                                </select>
                                                <small class="text-muted mt-2">Only for Job Seeker</small>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="avatar_image" class="col-sm-4 col-form-label">Avatar Image</label>
                                        <div class="col-md-8">
                                            <input type="file" name="avatar_image" id="avatar_image">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="cover_image" class="col-sm-4 col-form-label">Cover Image</label>
                                        <div class="col-md-8">
                                            <input type="file" name="cover_image" id="cover_image">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label class="d-block m-0">
                                                <button type="button" class="btn btn-light py-2 w-100"
                                                        data-toggle="modal" data-target="#experienceModal">
                                                    <i class="fa fa-plus"></i>
                                                    Add Experience
                                                </button>
                                                <small class="text-muted mt-2">Experience only for Job Seeker</small>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label class="d-block m-0">
                                                <button type="button" class="btn btn-light py-2 w-100"
                                                        data-toggle="modal" data-target="#educationModal">
                                                    <i class="fa fa-plus"></i>
                                                    Add Education
                                                </button>
                                                <small class="text-muted mt-2">Education only for Job Seeker</small>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- Experiences Modal -->
        <div class="modal fade" id="experienceModal" tabindex="-1" role="dialog" aria-labelledby="experienceModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="experienceModalLabel">Experiences</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered table-sm">
                            <thead>
                            <tr>
                                <th>Company*</th>
                                <th>Position*</th>
                                <th>From*</th>
                                <th>To</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody id="experienceTableBody">
                            <!-- For JS Response -->
                            @if (old('experiences'))
                                @foreach(old('experiences') as $i => $experience)
                                    <tr id="experienceRow{{ $i }}">
                                        <td><label class="d-block"><input type="text"
                                                                          name="experiences[{{ $i }}][company]"
                                                                          value="{{ $experience['company'] }}"
                                                                          class="form-control form-control-sm"></label>
                                        </td>

                                        <td><label class="d-block"><input type="text"
                                                                          name="experiences[{{ $i }}][position]"
                                                                          value="{{ $experience['position'] }}"
                                                                          class="form-control form-control-sm"></label>
                                        </td>

                                        <td><label class="d-block"><input type="date" name="experiences[{{ $i }}][from]"
                                                                          value="{{ $experience['from'] }}"
                                                                          class="form-control form-control-sm"></label>
                                        </td>

                                        <td><label class="d-block"><input type="date" name="experiences[{{ $i }}][to]"
                                                                          value="{{ $experience['to'] }}"
                                                                          class="form-control form-control-sm"></label>
                                        </td>

                                        <td><label class="d-block"><input type="text"
                                                                          name="experiences[{{ $i }}][description]"
                                                                          value="{{ $experience['description'] }}"
                                                                          class="form-control form-control-sm"></label>
                                        </td>
                                        <td>
                                            <label class="custom-switch mt-2 float-right">
                                                <input type="checkbox" name="experiences[{{ $i }}][status]"
                                                       value="{{ $experience['status'] ?? 0 }}"
                                                       class="custom-switch-input" checked="">
                                                <span class="custom-switch-indicator"></span>
                                            </label>
                                        </td>

                                        <td class="text-center">
                                            <button type="button" value="experienceRow{{ $i }}"
                                                    id="experienceRemoveButton{{ $i }}"
                                                    class="btn btn-danger btn-sm">
                                                <i class="fa fa-times"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>

                            <tfoot>
                            <tr>
                                <td colspan="7">
                                    <button type="button" id="experienceAddButton" class="btn btn-primary btn-sm">
                                        <i class="fa fa-plus"></i>
                                        Add New Experience
                                    </button>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close Dialog</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Education Modal -->
        <div class="modal fade" id="educationModal" tabindex="-1" role="dialog" aria-labelledby="educationModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="educationModalLabel">Education</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered table-sm">
                            <thead>
                            <tr>
                                <th>School*</th>
                                <th>Degree*</th>
                                <th>From*</th>
                                <th>To</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody id="educationTableBody">
                            <!-- For JS Response -->
                            @if (old('educations'))
                                @foreach(old('educations') as $i => $education)
                                    <tr id="educationRow{{ $i }}">
                                        <td><label class="d-block"><input type="text"
                                                                          name="educations[{{ $i }}][school]"
                                                                          value="{{ $education['school'] }}"
                                                                          class="form-control form-control-sm"></label>
                                        </td>

                                        <td><label class="d-block"><input type="text"
                                                                          name="educations[{{ $i }}][degree]"
                                                                          value="{{ $education['degree'] }}"
                                                                          class="form-control form-control-sm"></label>
                                        </td>

                                        <td><label class="d-block"><input type="date" name="educations[{{ $i }}][from]"
                                                                          value="{{ $education['from'] }}"
                                                                          class="form-control form-control-sm"></label>
                                        </td>

                                        <td><label class="d-block"><input type="date" name="educations[{{ $i }}][to]"
                                                                          value="{{ $education['to'] }}"
                                                                          class="form-control form-control-sm"></label>
                                        </td>

                                        <td><label class="d-block"><input type="text"
                                                                          name="educations[{{ $i }}][description]"
                                                                          value="{{ $education['description'] }}"
                                                                          class="form-control form-control-sm"></label>
                                        </td>
                                        <td>
                                            <label class="custom-switch mt-2 float-right">
                                                <input type="checkbox" name="educations[{{ $i }}][status]"
                                                       value="{{ $education['status'] ?? 0 }}"
                                                       class="custom-switch-input" checked="">
                                                <span class="custom-switch-indicator"></span>
                                            </label>
                                        </td>

                                        <td class="text-center">
                                            <button type="button" value="educationRow{{ $i }}"
                                                    id="educationRemoveButton{{ $i }}"
                                                    class="btn btn-danger btn-sm">
                                                <i class="fa fa-times"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>

                            <tfoot>
                            <tr>
                                <td colspan="7">
                                    <button type="button" id="educationAddButton" class="btn btn-primary btn-sm">
                                        <i class="fa fa-plus"></i>
                                        Add New Education
                                    </button>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close Dialog</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('styles')
    <style>
        .modal-dialog {
            max-width: 90% !important;
        }
    </style>
@endpush

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/modules/summernote/summernote-bs4.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('assets/modules/summernote/summernote-bs4.js') }}"></script>
@endpush

@push('scripts')
    <script>
        // For Experience
        'use strict';

        const experienceTableBodyElement = jQuery('#experienceTableBody');
        const experienceAddButtonElement = jQuery('#experienceAddButton');


        const getExperienceHtml = (i) => {
            return `<tr id="experienceRow${i}">
                <td><label class="d-block"><input type="text" name="experiences[${i}][company]"
                                                  class="form-control form-control-sm"></label></td>
                <td><label class="d-block"><input type="text" name="experiences[${i}][position]"
                                                  class="form-control form-control-sm"></label></td>
                <td><label class="d-block"><input type="date" name="experiences[${i}][from]"
                                                  class="form-control form-control-sm"></label></td>
                <td><label class="d-block"><input type="date" name="experiences[${i}][to]"
                                                  class="form-control form-control-sm"></label></td>
                <td><label class="d-block"><input type="text" name="experiences[${i}][description]"
                                                  class="form-control form-control-sm"></label></td>
                <td>
                    <label class="custom-switch mt-2 float-right">
                        <input type="checkbox" name="experiences[${i}][status]" value="1"
                               class="custom-switch-input" checked="">
                        <span class="custom-switch-indicator"></span>
                    </label>
                </td>

                <td class="text-center">
                    <button type="button" value="experienceRow${i}" id="experienceRemoveButton${i}" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></button>
                </td>
            </tr>`;
        };

        const makeRemoveExperienceEvent = (i) => {
            const experienceRemoveButtonElement = jQuery(`#experienceRemoveButton${i}`);
            experienceRemoveButtonElement.on('click', function () {
                const row = jQuery(this).val();
                jQuery(`#${row}`).remove();
            });
        }

        jQuery(document).ready(function () {
            let experienceCount = experienceTableBodyElement.find('tr').length;

            experienceAddButtonElement.on('click', function () {
                experienceTableBodyElement.append(getExperienceHtml(experienceCount));
                makeRemoveExperienceEvent(experienceCount);
                experienceCount++;
            });

            for (let i = 0; i < experienceCount; i++) {
                makeRemoveExperienceEvent(i);
            }
        });
    </script>

    <script>
        // For Education
        'use strict';

        const educationTableBodyElement = jQuery('#educationTableBody');
        const educationAddButtonElement = jQuery('#educationAddButton');


        const getEducationHtml = (i) => {
            return `<tr id="educationRow${i}">
                <td><label class="d-block"><input type="text" name="educations[${i}][school]"
                                                  class="form-control form-control-sm"></label></td>
                <td><label class="d-block"><input type="text" name="educations[${i}][degree]"
                                                  class="form-control form-control-sm"></label></td>
                <td><label class="d-block"><input type="date" name="educations[${i}][from]"
                                                  class="form-control form-control-sm"></label></td>
                <td><label class="d-block"><input type="date" name="educations[${i}][to]"
                                                  class="form-control form-control-sm"></label></td>
                <td><label class="d-block"><input type="text" name="educations[${i}][description]"
                                                  class="form-control form-control-sm"></label></td>
                <td>
                    <label class="custom-switch mt-2 float-right">
                        <input type="checkbox" name="educations[${i}][status]" value="1"
                               class="custom-switch-input" checked="">
                        <span class="custom-switch-indicator"></span>
                    </label>
                </td>

                <td class="text-center">
                    <button type="button" value="educationRow${i}" id="educationRemoveButton${i}" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></button>
                </td>
            </tr>`;
        };

        const makeRemoveEducationEvent = (i) => {
            const educationRemoveButtonElement = jQuery(`#educationRemoveButton${i}`);

            educationRemoveButtonElement.on('click', function () {
                const row = jQuery(this).val();
                jQuery(`#${row}`).remove();
            });
        }

        jQuery(document).ready(function () {
            let educationCount = educationTableBodyElement.find('tr').length;

            educationAddButtonElement.on('click', function () {
                educationTableBodyElement.append(getEducationHtml(educationCount));
                makeRemoveEducationEvent(educationCount);
                educationCount++;
            });

            for (let i = 0; i < educationCount; i++) {
                makeRemoveEducationEvent(i);
            }
        });
    </script>

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

        const findCountry = () => {
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
                            return `<option value="${item.id}">${item.name}</option>`;
                        }).join('');

                        countryIdElement.html(html);
                    } else {
                        alert(json.message);
                        console.log(json);
                    }
                }
            });
        }

        const findState = (countryId = null) => {
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
                            return `<option value="${item.id}">${item.name}</option>`;
                        }).join('');

                        stateIdElement.html(html);
                    } else {
                        alert(json.message);
                        console.log(json);
                    }
                }
            });
        }

        const findCity = (stateId = null) => {
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
                            return `<option value="${item.id}">${item.name}</option>`;
                        }).join('');

                        cityIdElement.html(html);
                    } else {
                        alert(json.message);
                        console.log(json);
                    }
                }
            });
        }

        countryIdElement.on('change', function () {
            const countryId = jQuery(this).val();
            findState(countryId);
        });

        stateIdElement.on('change', function () {
            const cityId = jQuery(this).val();
            findCity(cityId);
        });

        findCountry();
    </script>
@endpush