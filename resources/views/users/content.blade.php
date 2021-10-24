@extends('users.main')
@section('content')
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <!-- <h2>Section title</h2> -->
                <div class="row">
                    <div class="col-md-8">
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-2 text-center" style="margin-top: -20px">
                                        <a href="profile-posts.html" class="avatar avatar-md">
                                            <img src="./assets/avatars/face-4.jpg" alt="..."
                                                class="avatar-img rounded-circle">
                                        </a>
                                    </div>
                                    <div class="col">
                                        <strong class="mb-1">Whats on your mind </strong>
                                        <span>Veronicha
                                        </span>
                                        <strong class="mb-1">?</strong>
                                        <input type="text" class="form-control" data-toggle="modal"
                                            data-target="#varyModal">

                                        <div class="col-auto" style="margin-top: 10px; margin-left: -14px">
                                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                                data-target="#photoModal">Photo/Video</button>&nbsp;
                                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                                data-target="#varyModal">Article</button>&nbsp;
                                            <button type="button" class="btn btn-sm btn-info" data-toggle="modal"
                                                data-target="#journalModal">Journal</button>&nbsp;
                                            <button type="button" class="btn btn-sm btn-warning" data-toggle="modal"
                                                data-target="#varyModal">Event</button></div>
                                    </div>
                                </div>
                            </div> <!-- / .card-body -->
                        </div> <!-- / .card -->
                        @include('users.feed.posting')
                        @include('users.journal.journal-posting')
                    </div> <!-- / .col- -->

                    <div class="col-md-4">
                        <div class="card shadow mb-4">
                        @include('users.friend.friend-suggestion')
                        </div> <!-- / .card -->

                        <div class="card shadow mb-4">
                        @include('users.journal.journal-rekomen')
                        </div> <!-- / .card -->
                    </div> <!-- / .col- -->
                </div> <!-- end section -->

            </div>
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->


    <!-- modal -->
    @include('users.journal.journal-modal')
    @include('modals.modal-notification')
    @include('modals.modal-shortcart')
    @include('modals.modal-write-article')
    @include('modals.modal-photo-video')
</main> <!-- main -->
@endsection