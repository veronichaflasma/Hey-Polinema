@extends('users.main')

@section('content')
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-8">
                <h2 class="h3 mb-4 page-title">Settings</h2>
                <div class="my-4">
                    <!-- tab -->
                    <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                aria-controls="home" aria-selected="true">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#security" role="tab"
                                aria-controls="profile" aria-selected="false">Security</a>
                        </li>
                    </ul>

                    <!-- tab content -->
                    <div class="tab-content" id="myTabContent">
                        <!-- profile -->
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <form>
                                <div class="row mt-5 align-items-center">
                                    <div class="col-md-3 text-center mb-5">
                                        <div class="avatar avatar-xl">
                                            <img src="./assets/avatars/face-4.jpg" alt="..."
                                                class="avatar-img rounded-circle">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row align-items-center">
                                            <div class="col-md-7">
                                                <h4 class="mb-1">Veronicha Flasma</h4>
                                                <p class="small mb-3"><span class="badge badge-dark">Malang, IDN</span></p>
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-md-7">
                                                <p class="text-muted"> Lorem ipsum dolor sit amet, consectetur
                                                    adipiscing elit.
                                                    Mauris blandit nisl ullamcorper, rutrum metus in, congue lectus. In
                                                    hac
                                                    habitasse platea dictumst. Cras urna quam, malesuada vitae risus at,
                                                    pretium
                                                    blandit sapien. </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-4">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="firstname">Firstname</label>
                                        <input type="text" id="firstname" class="form-control" placeholder="Hailey">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="lastname">Lastname</label>
                                        <input type="text" id="lastname" class="form-control" placeholder="Bieber">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail4">Email</label>
                                    <input type="email" class="form-control" id="inputEmail4"
                                        placeholder="user@user">
                                </div>
                                <div class="form-group">
                                    <label for="inputAddress5">Address</label>
                                    <input type="text" class="form-control" id="inputAddress5"
                                        placeholder="Malang">
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputCompany5">Company</label>
                                        <input type="text" class="form-control" id="inputCompany5"
                                            placeholder="Telekomunikasi Indonesia">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputState5">State</label>
                                        <select id="inputState5" class="form-control">
                                            <option selected="">Choose...</option>
                                            <option>...</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputZip5">Zip</label>
                                        <input type="text" class="form-control" id="inputZip5" placeholder="98232">
                                    </div>
                                </div>
                                <hr class="my-4">
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputPassword4">Old Password</label>
                                            <input type="password" class="form-control" id="inputPassword5">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPassword5">New Password</label>
                                            <input type="password" class="form-control" id="inputPassword5">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPassword6">Confirm Password</label>
                                            <input type="password" class="form-control" id="inputPassword6">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="mb-2">Password requirements</p>
                                        <p class="small text-muted mb-2"> To create a new password, you have to meet all
                                            of the
                                            following requirements: </p>
                                        <ul class="small text-muted pl-4 mb-0">
                                            <li> Minimum 8 character </li>
                                            <li>At least one special character</li>
                                            <li>At least one number</li>
                                            <li>Can’t be the same as a previous password </li>
                                        </ul>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Save Change</button>
                            </form>
                        </div> 
                        <!-- end profile -->
                        <!-- security -->
                        <div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="profile-tab">
                            @include('users.setting.security')
                        </div>
                        <!-- end security -->
                    </div>
                </div> <!-- /.card-body -->
            </div> <!-- /.col-12 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->

    @include('modals.modal-notification')
    @include('modals.modal-shortcart')
</main> <!-- main -->
@endsection