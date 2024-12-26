@extends('job_seeker.layouts.master')
@section('title', 'Profile Update')
@section("content")



{{-- Post method/// --}}
    <form action="{{ route('job_seeker.profile.update') }}" method="POST" enctype="multipart/form-data"
          class="needs-validation" novalidate="">
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>Profile Update</h1>

                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item"><a href="{{ route("job_seeker.dashboard") }}">Dashboard</a></div>
                        <div class="breadcrumb-item active">Profile Update</div>
                    </div>
                </div>

                {!! session('message') !!}
{{-- !! in Blade templates allows you to render raw, unescaped HTML
JObSEkkerProfile controller --}}
                <div class="section-body">
                    <div class="card">
                        <div class="card-body">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-3 col-form-label text-right">Name
                                            *</label>
                                        <div class="col-md-9">
                                            <input type="text" name="name" id="name" class="form-control"
                                                   value="{{ old('name', $account->name) }}" autofocus>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="username" class="col-sm-3 col-form-label text-right">Username
                                            *</label>
                                        <div class="col-md-9">
                                            <input type="text" name="username" id="username" class="form-control"
                                                   value="{{ old('username', $account->username) }}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="email" class="col-sm-3 col-form-label text-right">Email *</label>
                                        <div class="col-md-9">
                                            <input type="email" name="email" id="email" class="form-control" disabled
                                                   value="{{ old('email', $account->email) }}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="phone" class="col-sm-3 col-form-label text-right">Phone</label>
                                        <div class="col-md-9">
                                            <input type="text" name="phone" id="phone" class="form-control"
                                                   value="{{ old('phone', $account->phone) }}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="date_of_birth" class="col-sm-3 col-form-label text-right">Date of
                                            Birth</label>
                                        <div class="col-md-9">
                                            <input type="date" name="date_of_birth" id="date_of_birth"
                                                   class="form-control"
                                                   value="{{ old('date_of_birth', $account->date_of_birth) }}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password" class="col-sm-3 col-form-label text-right">Password</label>
                                        <div class="col-md-9">
                                            <input type="password" name="password" id="password"
                                                   class="form-control" value="{{ old('password') }}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="description" class="col-sm-3 col-form-label text-right">Description</label>
                                        <div class="col-sm-9">
                                    <textarea name="description" id="description"
                                              class="form-control summernote-simple">{{ $account->description }}</textarea>
                                        </div>
                                    </div>

                                    <hr>
                                    {{-- <div class="form-group row">
                                        <label for="country_id"
                                               class="col-sm-3 col-form-label text-right">Country</label>
                                        <div class="col-md-9">
                                            <select name="country_id" id="country_id" class="form-control">
                                                <option value="">Choose...</option>
                                            </select>
                                            <small id="country_wait" class="text-danger d-none">Please wait...</small>
                                        </div>
                                    </div> --}}

                                    {{-- <div class="form-group row">
                                        <label for="state_id" class="col-sm-3 col-form-label text-right">State</label>
                                        <div class="col-md-9">
                                            <select name="state_id" id="state_id" class="form-control">
                                                <option value="">Choose...</option>
                                            </select>
                                            <small id="state_wait" class="text-danger d-none">Please wait...</small>
                                        </div>
                                    </div> --}}

                                    {{-- <div class="form-group row">
                                        <label for="city_id" class="col-sm-3 col-form-label text-right">City</label>
                                        <div class="col-md-9">
                                            <select name="city_id" id="city_id" class="form-control">
                                                <option value="">Choose...</option>
                                            </select>
                                            <small id="city_wait" class="text-danger d-none">Please wait...</small>
                                        </div>
                                    </div> --}}

                                    <div class="form-group row">
                                        <label for="address" class="col-sm-3 col-form-label text-right">Address</label>
                                        <div class="col-md-9">
                                            <textarea name="address" id="address"
                                                      class="form-control">{{ $account->address->address }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary py-2 w-100">Update Profile
                                            </button>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label class="d-block m-0">
                                                <select name="account_type" id="account_type" class="form-control"
                                                        disabled
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
                                                {{-- <select name="status" id="status" class="form-control" disabled
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
                                                </select> --}}
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
{{--                                                    <option value="1" @selected(old('is_public_profile', $account->is_public_profile) === 1)>--}}
{{--                                                        YES--}}
{{--                                                    </option>--}}
{{--                                                    <option value="0" @selected(old('is_public_profile', $account->is_public_profile) === 0)>--}}
{{--                                                        NO--}}
{{--                                                    </option>--}}
{{--                                                </select>--}}
{{--                                            </label>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label class="d-block m-0">
                                                <select name="gender" id="gender" class="form-control"
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
                                        <label for="avatar_image" class="col-sm-4 col-form-label">Avatar Image</label>
                                        <div class="col-md-8">
                                            <input type="file" name="avatar_image" id="avatar_image">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-6 col-form-label">Exist Cover
                                            Image</label>
                                        <div class="col-md-6 text-right">
                                            @if (!empty($account->cover_image) && file_exists(public_path("storage/uploads/accounts/$account->cover_image")))
                                                <img src="{{ asset("storage/uploads/accounts/$account->cover_image") }}"
                                                     class="w-100"
                                                     alt="">
                                            @else
                                                <img src="{{ asset('assets/img/example-image.jpg') }}"
                                                     class="w-100"
                                                     alt="">
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="cover_image" class="col-sm-4 col-form-label">Cover Image</label>
                                        <div class="col-md-8">
                                            <input type="file" name="cover_image" id="cover_image">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="cv_filename" class="col-sm-4 col-form-label">CV Upload</label>
                                        <div class="col-md-8">
                                            <input type="file" name="cv_filename" id="cv_filename">

                                            <div class="mt-2">
                                                @if (!empty($account->cv_filename) && file_exists(public_path("storage/uploads/accounts/$account->cv_filename")))
                                                    <a href="{{ asset("storage/uploads/accounts/$account->cv_filename") }}" target="_blank">Show CV</a>
                                                    <button type="submit" name="cv_delete" value="1" class="text-danger ml-5 btn btn-sm bg-transparent"><i class="fa fa-trash"></i></button>
                                                @else
                                                    <p class="text-muted">CV Not Attached</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label class="d-block m-0">
                                                <button type="button" class="btn btn-light py-2 w-100"
                                                        data-toggle="modal" data-target="#experienceModal">
                                                        {{-- experience modal eta add experince modal er id 
                                                        button e click dile pop up hoi jQery system--}}
                                                    <i class="fa fa-plus"></i>
                                                    Add Experience
                                                </button>
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

        <!-- Experiences Modal pop up hobe -->
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
                            <!-- modal e hidle thke click dile show -->
                            {{-- $experience database value...i=0,1,2,3 --}}
                            {{-- axxount theke experience ansi..ene loop chalay edekhaisi --}}
                            @if (old('experiences', $account->experiences))
                                @foreach(old('experiences', $account->experiences) as $i => $experience)
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
                    {{-- pop up er vitore --}}
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

        <!-- Education Modal pop up hobe -->
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
                            @if (old('educations', $account->educations))<!-- Check if there are old input values or existing education records -->
                                @foreach(old('educations', $account->educations) as $i => $education)<!-- Loop Iterates over each education record. 
                                    $i is the index of the current education record. -->
                                    <tr id="educationRow{{ $i }}"><!-- Table row with a unique ID -->
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
                                                       <!-- Check the checkbox if 'status' is truthy -->
                                                <span class="custom-switch-indicator"></span>
                                            </label>
                                        </td>

                                        <td class="text-center">
                                            <button type="button" value="educationRow{{ $i }}"
                                                    id="educationRemoveButton{{ $i }}"
                                                    class="btn btn-danger btn-sm">
                                                <i class="fa fa-times"></i></button>
                                                <!-- Button to remove this education row -->
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
{{-- JVASRIPT html er niche thakbe --}}
    <script>
        // For Experience
        'use strict';
// Elements selection
        const experienceTableBodyElement = jQuery('#experienceTableBody');
        const experienceAddButtonElement = jQuery('#experienceAddButton');

 // Function to generate HTML for experience rows
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
 // Function to handle removal of experience rows
        const makeRemoveExperienceEvent = (i) => {
            const experienceRemoveButtonElement = jQuery(`#experienceRemoveButton${i}`);
            experienceRemoveButtonElement.on('click', function () {
                const row = jQuery(this).val();
                jQuery(`#${row}`).remove();
            });
        }
// 1st execution Document ready function
        jQuery(document).ready(function () {
            let experienceCount = experienceTableBodyElement.find('tr').length;
    // Add button click event        
            experienceAddButtonElement.on('click', function ()//popup er modde button
             {
                experienceTableBodyElement.append(getExperienceHtml(experienceCount));//gtexphtml er vitore form lekha boro
                //xperienceTableBodyElement upr die ashtese.append(333ja new experince)//apend=jog
                makeRemoveExperienceEvent(experienceCount);
                experienceCount++;//ja dsilam tar por die 0,1,2,3 increment
            });
// Attach remove events to existing rows
            for (let i = 0; i < experienceCount; i++) {
                makeRemoveExperienceEvent(i);
            }
        });
    </script>

    <script>
        // For Education
        'use strict';
   // Elements selection
        const educationTableBodyElement = jQuery('#educationTableBody');
        const educationAddButtonElement = jQuery('#educationAddButton');

 // Function to generate HTML for education rows
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
 // Function to handle removal of education rows
        const makeRemoveEducationEvent = (i) => {
            const educationRemoveButtonElement = jQuery(`#educationRemoveButton${i}`);

            educationRemoveButtonElement.on('click', function () {
                const row = jQuery(this).val();
                jQuery(`#${row}`).remove();
            });
        }
// Document ready function
        jQuery(document).ready(function () {
            let educationCount = educationTableBodyElement.find('tr').length;
// Add button click event
            educationAddButtonElement.on('click', function () {
                educationTableBodyElement.append(getEducationHtml(educationCount));
                makeRemoveEducationEvent(educationCount);
                educationCount++;
            });
// Attach remove events to existing rows
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