@extends('users.main')

@section('content')
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="h3 mb-4 page-title">Profile</h2>
                <div class="card mb-4 shadow">
                    <div class="card-body my-n3">
                        <div class="row mt-5 align-items-center">
                            <div class="col-md-3 text-center mb-5">
                                <div class="avatar avatar-xl">
                                    <img src="./assets/avatars/face-4.jpg" alt="..." class="avatar-img rounded-circle">
                                </div>
                            </div>
                            <div class="col">
                                <div class="row align-items-center">
                                    <div class="col-md-7">
                                        <h4 class="mb-1">Veronicha, Flasma 2018</h4>
                                        <p class="small mb-3"><span class="badge badge-dark">Malang, IDN</span></p>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <p class="text-muted"> Halo, perkenalkan namaku Veronicha lorem ipsum
                                            Ipsum has been the industry's standard dummy text ever since the 1500s, when
                                            an
                                            unknown printer took a
                                            galley of type and scrambled it to make a type specimen book. It has
                                            survived
                                            not only five centuries,
                                            but also the leap into electronic typesetting, remaining essentially
                                            unchanged.
                                            It was popularised in
                                            the 1960s with the release of Letraset sheets containing Lorem Ipsum
                                            passages,
                                            and more recently with
                                            desktop publishing software like Aldus PageMaker including versions of Lorem
                                            Ipsum. </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @include('users.profile.profile-folder')

                <p class="text-muted">Recent Updates</p>

                <div class="row">
                    <div class="col-md-8">
                        <div class="card shadow mb-4">
                            @include('users.journal.journal-posting')
                        </div> <!-- /.card -->
                    </div> <!-- / .col- -->

                    <!-- profile -->
                    <div class="col-md-4">
                        <div class="card shadow mb-4">
                            <div class="card-header">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col">
                                        <strong class="mb-1">Education</strong>
                                    </div>

                                </div>
                            </div> <!-- /.card-footer -->
                            <div class="card-body">
                                <div class="list-group list-group-flush my-n3">
                                    <div class="list-group-item">
                                        <div class="row align-items-center">


                                            <p class="small mb-0 ">

                                                <strong>Informatics Engineering</strong>
                                                <br>
                                                <small><span class="text-muted"> 2018</span></small>
                                            </p>


                                        </div>
                                    </div>
                                    <div class="list-group-item">
                                        <div class="row align-items-center">

                                            <p class="small mb-0 ">

                                                <strong>Software Engineering</strong>
                                                <br>
                                                <small><span class="text-muted">Vocational High School</span></small>
                                            </p>


                                        </div>
                                    </div>
                                </div> <!-- / .list-group -->
                            </div> <!-- / .card-body -->
                            <div class="card-header">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col">
                                        <strong class="mb-1">Experiences</strong>
                                    </div>

                                </div>
                            </div> <!-- /.card-footer -->
                            <div class="card-body">
                                <div class="list-group list-group-flush my-n3">
                                    <div class="list-group-item">
                                        <div class="row align-items-center">


                                            <p class="small mb-0 ">

                                                <strong>UI/UX Designer</strong>
                                                <br>
                                                <small><span class="text-muted">2021 - Current</span></small>
                                            </p>


                                        </div>
                                    </div>
                                    <div class="list-group-item">
                                        <div class="row align-items-center">

                                            <p class="small mb-0 ">

                                                <strong>Project Manager</strong>
                                                <br>
                                                <small><span class="text-muted">2019</span></small>
                                            </p>


                                        </div>
                                    </div>
                                </div> <!-- / .list-group -->
                            </div> <!-- / .card-body -->
                        </div> <!-- / .card -->
                    </div> <!-- / .col- -->

                </div> <!-- end section -->
            </div> <!-- /.col-12 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->

    @include('modals.modal-notification')
    @include('modals.modal-shortcart')
</main> <!-- main -->
@endsection