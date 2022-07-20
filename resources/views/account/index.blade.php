<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- bootayrap scripts and css links --}}

    <link rel="stylesheet" href=" {{ asset('css/style.css') }} ">
    <script src=" {{ asset('js/navbar.js') }} "></script>
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">


    {{-- datatable css --}}
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    {{-- datatable bootstrap css --}}


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
        integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js"
        integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous">
    </script>
    {{-- jquerry script --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    {{-- datatable jquerry --}}
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>



</head>

<body>
    <div id="mySidenav" class="sidenav mt-5" onmouseover="openNav()" onmouseout="closeNav()">
        {{-- <a href="javascript:void(0)" class="closebtn d-none" onclick="closeNav()">&times;</a> --}}


        <div class="btn-group dropdown">
            <a href="{{ route('accounts.index') }}"> <img width="50" height="50" avatar="A ccounts"
                    class="round" title="Account"> <span class="navclick d-none"> Accounts </span></a>
            {{-- <a href=" {{ route('payments.index') }} " class="" ><img width="50" height="50" avatar="Pay ments" class="round"  title="Payment"> <span class="navclick d-none">  Payments </span></a> --}}
            <button type="button" class="navclick d-none  btn dropdown-toggle dropdown-toggle-split"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            </button>
            <div class="dropdown-menu">
                <a href=" {{ route('accounts.create') }}   " class="btn btn-sm">Create</a>
            </div>
        </div>

        <div class="btn-group dropdown">
            <a href=" {{ route('payments.index') }} " class=""><img width="50" height="50"
                    avatar="Pay ments" class="round" title="Payment"> <span class="navclick d-none"> Payments
                </span></a>
            <button type="button" class="navclick d-none  btn dropdown-toggle dropdown-toggle-split"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            </button>
            <div class="dropdown-menu">
                <button href="#" class="btn btn-sm">Create</button>
            </div>
        </div>
        <div class="btn-group dropdown">
            <a href="/campaign" class=""><img width="50" height="50" avatar="Cam paign" class="round"
                    title="Campaign"> <span class="navclick d-none"> Campaign </span></a>
   
        </div>
        <a href="  {{ route('payments.chart') }}  "><img width="50" height="50" avatar="Re port" class="round"
                title="Report"> <span class="navclick d-none"> Report </span></a>
    </div>
    {{-- navbar --}}
    <div id="app">
        <nav class="navbar navbar-expand-md  shadow-sm fixed-top" style="z-index: 101;  background-color: #3a5199;">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    {{-- navbar --}}


    {{-- MODAL --}}
    <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    {{-- datatable table code --}}

    <div id="main">
        <div class="container mt-5 " id="tp">

            {{-- <span style="font-size:30px;cursor:pointer" onclick="openNav()" class="opennav">&#9776;</span> --}}

            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Account Details</li>
                </ol>
            </nav>
            {{-- <div class="container-fluid"> --}}

            <div class="row d-flex flex-row flex-nowrap overflow-auto noscroll">
                {{-- @  dd($unpaid) --}}
                @foreach ($unpaid as $single)
                    <div class="card  card-block m-2 cardcss"
                        style="width: 15rem; border-left : 5px solid blue ; border-radius: 10px ; ">
                        <span
                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary text-light totalaccountcount"
                            style="z-index : 100;">
                            {{ $single->count }}
                        </span>
                        <div class="card-body">
                            <h5 class="card-title">{{ $single->status }} </h5>
                            {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
                            <p class="card-text"></p>

                        </div>
                    </div>
                @endforeach
            </div>
            {{-- </div> --}}

            <a href=" {{ route('accounts.create') }} " class="btn btn-success my-2">Create New Account</a>
            <table class="display data-table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Releted Payments</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Payment pending</th>
                        <th>Status</th>
                        <th>Payment Recived</th>
                        <th width="200px">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    </div>

</body>
<script>
    $(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: false,
            ajax: "{{ route('accounts.index') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'phone',
                    name: 'phone'
                },
                {
                    data: 'releted_payments',
                    name: 'releted_payments'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'address',
                    name: 'address'
                },
                {
                    data: 'payment_pending',
                    name: 'payment pending'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'payment_recived',
                    name: 'payment recived'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },

            ],
            success: function(data) {
                console.log(data);
            }
        });

        // delete button ajax 
        $(document).on('click', '.datadelete', function() {
            // alert('he;llo')
            var studentDeleteid = $(this).val();
            // alert(studentDeleteid);
            var selector = ".".studentDeleteid;
            console.log(selector);
            var deleteurl = 'accounts/'.concat(studentDeleteid);
            console.log(deleteurl);
            $.ajax({
                url: deleteurl,
                context: this,
                type: 'DELETE',
                success: function(data) {
                    console.log(data);
                    table.draw();
                    $(this).parent().parent().html('');
                    $('#tp').prepend(
                        '<div class="alert alert-danger  alert-dismissible fade show" role="alert"><strong>data deleted succesfully </strong>!!!!!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span> </button></div>'
                    );

                }
            });
        });


        $(document).on('click', '.showpayment', function() {
            var paymentid = $(this).val();
            var url = 'accounts/'.concat(paymentid);
            console.log(paymentid, url);
            $.ajax({
                url: url,
                type: 'GET',
                success: function(data) {
                    $('.modal-body').html('Subject : ' + data.subject +
                        '<br>id : ' + data.id +
                        '<br>Account ID : ' + data.account_id +
                        '<br>payment_date : ' + data.payment_date +
                        '<br>payment_pending : ' + data.payment_pending +
                        '<br>payment_recived : ' + data.payment_recived +
                        '<br>pending_amount : ' + data.pending_amount +
                        '<br>');
                    console.log(data);
                }
            });
        });


        $(document).on('mouseover', '#mySidenav', function() {
            $('.navclick').removeClass('d-none');
            $('.closebtn').removeClass('d-none');
        });
        $(document).on('mouseout', '#mySidenav', function() {
            $('.navclick').addClass('d-none');
            $('.closebtn').addClass('d-none');

        });



    });

    /*
     * LetterAvatar
     * 
     * Artur Heinze
     * Create Letter avatar based on Initials
     * based on https://gist.github.com/leecrossley/6027780
     */
    (function(w, d) {


        function LetterAvatar(name, size) {

            name = name || '';
            size = size || 60;

            var colours = [
                    "#1abc9c", "#2ecc71", "#3498db", "#9b59b6", "#34495e", "#16a085", "#27ae60", "#2980b9",
                    "#8e44ad", "#2c3e50",
                    "#f1c40f", "#e67e22", "#e74c3c", "#ecf0f1", "#95a5a6", "#f39c12", "#d35400", "#c0392b",
                    "#bdc3c7", "#7f8c8d"
                ],

                nameSplit = String(name).toUpperCase().split(' '),
                initials, charIndex, colourIndex, canvas, context, dataURI;


            if (nameSplit.length == 1) {
                initials = nameSplit[0] ? nameSplit[0].charAt(0) : '?';
            } else {
                initials = nameSplit[0].charAt(0) + nameSplit[1].charAt(0);
            }

            if (w.devicePixelRatio) {
                size = (size * w.devicePixelRatio);
            }

            charIndex = (initials == '?' ? 72 : initials.charCodeAt(0)) - 64;
            colourIndex = charIndex % 20;
            canvas = d.createElement('canvas');
            canvas.width = size;
            canvas.height = size;
            context = canvas.getContext("2d");

            context.fillStyle = colours[colourIndex - 1];
            context.fillRect(0, 0, canvas.width, canvas.height);
            context.font = Math.round(canvas.width / 2) + "px Arial";
            context.textAlign = "center";
            context.fillStyle = "#FFF";
            context.fillText(initials, size / 2, size / 1.5);

            dataURI = canvas.toDataURL();
            canvas = null;

            return dataURI;
        }

        LetterAvatar.transform = function() {

            Array.prototype.forEach.call(d.querySelectorAll('img[avatar]'), function(img, name) {
                name = img.getAttribute('avatar');
                img.src = LetterAvatar(name, img.getAttribute('width'));
                img.removeAttribute('avatar');
                img.setAttribute('alt', name);
            });
        };


        // AMD support
        if (typeof define === 'function' && define.amd) {

            define(function() {
                return LetterAvatar;
            });

            // CommonJS and Node.js module support.
        } else if (typeof exports !== 'undefined') {

            // Support Node.js specific `module.exports` (which can be a function)
            if (typeof module != 'undefined' && module.exports) {
                exports = module.exports = LetterAvatar;
            }

            // But always support CommonJS module 1.1.1 spec (`exports` cannot be a function)
            exports.LetterAvatar = LetterAvatar;

        } else {

            window.LetterAvatar = LetterAvatar;

            d.addEventListener('DOMContentLoaded', function(event) {
                LetterAvatar.transform();
            });
        }

    })(window, document);
</script>

</html>
