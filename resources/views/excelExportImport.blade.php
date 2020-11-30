<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel Excel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
        integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
        crossorigin="anonymous" />

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Nunito';
        }
    </style>
</head>

<body class="antialiased">



    {{-- SCRIPT --}}
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"
        integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous">
    </script>
</body>

</html>


<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body>
    <div class="container">
        <div class="row mt-3 justify-content-center">
            <h1>Import File</h1>
            {{-- ALERTS --}}
            @include('partials._alerts')
            {{-- START FORM --}}
            <div class="col-sm-12 col-md-12 col-lg-12">
                <form action="{{ route('file.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="nama_file">Put File</label>
                        <input type="file" name="nama_file"
                            class="form-control @error('nama_file') is-invalid @enderror" id="nama_file">
                        @error('nama_file')
                        <div class="invalid-feedback">
                            <p class="pl-3">
                                {{ $message }}
                            </p>
                        </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-file-import"></i> Import</button>
                    {{-- <a href="{{ route('file.export') }}" class="btn btn-info">Export</a> --}}
                </form>
                {{-- <a href="{{ route('file.export.pdf') }}" target="_blank" class="btn btn-info">PDF</a> --}}
                <div class="row mt-3">
                    <div class="col-lg-6 col-md-6 text-left">
                        <a href="{{ route('view.qrcode') }}" target="_blank" class="btn btn-default"><i
                                class="fas fa-qrcode"></i> View
                            QRCode</a>
                    </div>
                    <div class="col-lg-6 col-md-6 text-right">
                        <a href="#" class="btn btn-danger text-right" id="deleteAllSelectedRecord"><i
                                class="fas fa-trash-alt"></i> Delete All</a>
                    </div>
                </div>
            </div>
            <div class=" col-sm-12 col-md-12 col-lg-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-borderless table-striped mt-5">
                        <thead>
                            <tr>
                                <th scope="col"><input type="checkbox" name="checkAll" id="checkAll">
                                </th>
                                <th>#</th>
                                <th scope="col">Date</th>
                                <th scope="col">Description</th>
                                <th scope="col">Nominal</th>
                                <th scope="col">Balance</th>

                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $no=1;
                            @endphp
                            @forelse ($excel as $row)
                            <tr id="sid{{ $row->id }}">
                                <td><input type="checkbox" name="ids" class="checkBoxClass" value="{{ $row['id'] }}"
                                        id="ids">
                                </td>
                                <td>{{ $no++ }}</td>
                                <td>{{ $row->date }}</td>
                                <td>{{ $row->description }}</td>
                                <td>{{ $row->nominal }}</td>
                                <td>{{ $row->balance }}</td>
                            </tr>
                            @empty
                        <tbody>
                            <td colspan="8" class="p-3 mb-2 bg-primary text-white text-center">Data tidak di
                                temukan!
                            </td>
                        </tbody>
                        @endforelse


                        </tbody>
                    </table>
                </div>
            </div>
            {{-- END FORM --}}
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
        integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
        crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"
        integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous">
    </script>

    <script>
        $(function(e){
            $("#checkAll").click(function(){
                $(".checkBoxClass").prop("checked", $(this).prop("checked"));
            });
            $("#deleteAllSelectedRecord").click(function(e){
                e.preventDefault();
                let allIds = [];
                // checkbox
                $("input:checkbox[name=ids]:checked").each(function(){
                    allIds.push($(this).val());
                });
                $.ajax({
                    url:"",
                    type:"DELETE",
                    data:{
                        _token:$("input[name=_token]").val(),
                        ids:allIds
                    },
                    success:function(response){
                        $.each(allIds, function(key, val){
                            $("#sid"+val).remove();
                            window.location.reload();
                        });
                    }
                });
            });

        });
    </script>
</body>

</html>
