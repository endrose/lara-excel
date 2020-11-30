<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title }}</title>

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

<body onload="window.print();">
    <div class="container">
        <div class="row mt-3 justify-content-center">
            <h1>Laporan QR Code</h1>
            {{-- ALERTS --}}
            @include('partials._alerts')

            <div class=" col-sm-12 col-md-12 col-lg-12">
                <div class="table-responsive">
                    <table class="table table-bordered  table-striped mt-5">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th scope="col">Date</th>
                                <th scope="col">Description</th>
                                <th scope="col">Nominal</th>
                                <th scope="col">Balance</th>
                                <th class="text-center" scope="col">QR Code</th>

                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $no=1;
                            @endphp
                            @forelse ($excel as $row)
                            <tr id="sid{{ $row->id }}">
                                <td>{{ $no++ }}</td>
                                <td>{{ $row->date }}</td>
                                <td>{{ $row->description }}</td>
                                <td>{{ $row->nominal }}</td>
                                <td>{{ $row->balance }}</td>
                                <td>
                                    <div class="visible-print text-center">
                                        {!! QrCode::size(100)->generate($row->nominal); !!}
                                        <p>Scan me to return to the original page.</p>
                                    </div>
                                </td>
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
