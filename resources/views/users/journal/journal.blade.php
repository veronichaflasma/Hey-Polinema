@extends('users.main')

@section('content')
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <!-- <h2>Section title</h2> -->
                <div class="row">
                    <div class="col-md-8">
                        @include('users.journal.journal-posting')
                        @include('users.journal.journal-posting')
                    </div> <!-- / .col- -->
                    <div class="col-md-4">
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <button type="button" class="btn mb-2 btn-primary btn-lg btn-block" 
                                    data-toggle="modal"
                                    data-target="#journalModal">
                                    + Journal
                                </button>
                            </div> <!-- /. card-body -->
                        </div>
                        <div class="card shadow mb-4">
                            @include('users.journal.journal-rekomen')
                        </div>

                    </div>

                </div> <!-- end section -->
            </div>
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->


    <!-- modal -->
    @include('users.journal.journal-modal')
    @include('users.journal.journal-modal-edit')
    @include('modals.modal-notification')
    @include('modals.modal-shortcart')
    @include('modals.modal-write-article')
    @include('modals.modal-photo-video')
</main> <!-- main -->
@endsection