@extends('users.main')

@section('content')
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row">
                    <!-- Striped rows -->
                    <div class="col-md-12 my-4">
                        <h2 class="h4 mb-1">Journal List</h2>
                        <p class="mb-4">Beberapa jurnal yang diterbitkan</p>
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="toolbar row mb-3">
                                    <div class="col">
                                        <form class="form-inline">
                                            <div class="form-row">
                                                <div class="form-group col-auto">
                                                    <label for="search" class="sr-only">Search</label>
                                                    <input type="text" class="form-control" id="search" value=""
                                                        placeholder="Search">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- table -->
                                <table class="table table-bordered">
                                    <thead class="text-center">
                                        <tr role="row" >
                                            <th>Title</th>
                                            <th>Author</th>
                                            <th>Year</th>
                                            <th colspan="3">Action</th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        <tr class="text-center">
                                            <td>
                                                CURETO: Skin Diseases Detection Using Image
                                                Processing And CNN
                                            </td>
                                            <td >K Karunanayake, R. K.M.S.</td>
                                            <td>2020</td>
                                            <td >
                                                <button type="button" class="btn mb-2 btn-success"><span class="fe fe-download fe-16"><span></span></span></button>
                                            </td>
                                            <td>
                                                <button type="button" class="btn mb-2 btn-primary"><span class="fe fe-edit fe-16"><span></span></span></button>
                                            </td>
                                            <td>
                                                <button type="button" class="btn mb-2 btn-danger"><span class="fe fe-trash fe-16"><span></span></span></button>
                                            </td>
                                            
                                        </tr>


                                    </tbody>
                                </table>
                                <nav aria-label="Table Paging" class="mb-0 text-muted">
                                    <ul class="pagination justify-content-end mb-0">
                                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div> <!-- simple table -->
                </div> <!-- end section -->

</main> <!-- main -->
@endsection