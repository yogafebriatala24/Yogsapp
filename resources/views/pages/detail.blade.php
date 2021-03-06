@extends('layouts.app')
@section('title', 'Detail Travel')

@section('content')
    <main>
        <section class="section-details-header"></section>
        <section class="section-details-content">
            <div class="container">
                <div class="row">
                    <div class="col p-0">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">Paket Travel</li>
                                <li class="breadcrumb-item active">Details</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 pl-lg-0">
                        <div class="card card-details">
                            <h1>{{ $item->title }}</h1>
                            <p>{{ $item->location }}</p>
                            @if ($item->galleries->count())
                                <div class="gallery">
                                    <div class="xzoom-container">
                                        <img src="{{ Storage::url($item->galleries->first()->image) }}"
                                            class="xzoom" id="xzoom-default"
                                            xoriginal="{{ Storage::url($item->galleries->first()->image) }}" />
                                    </div>
                                    <div class="xzoom-thumbs">
                                        @foreach ($item->galleries as $gallery)
                                            <a href="{{ Storage::url($gallery->image) }}">
                                                <img src="{{ Storage::url($gallery->image) }}" class="xzoom-gallery"
                                                    width="128" xpreview="{{ Storage::url($gallery->image) }}" />
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <h2>Tentang Wisata</h2>
                            <p>
                                {!! $item->about !!}
                            </p>
                            <div class="features row">
                                <div class="col-md-4">
                                    <div class="description">
                                        <img src="{{ url('frontend/img/Budaya 1.png') }}" alt="" class="features-image" />
                                        <div class="description">
                                            <h3>{{ $item->cagar_budaya }}</h3>
                                            <p>Cagar Budaya</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 border-left">
                                    <div class="description">
                                        <img src="{{ url('frontend/img/Makanan.png') }}" alt="" class="features-image" />
                                        <div class="description">
                                            <h3>{{ $item->makanan_khas }}</h3>
                                            <p>Makanan Khas</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 border-left">
                                    <div class="description">
                                        <img src="{{ url('frontend/img/Tari.png') }}" alt="" class="features-image" />
                                        <div class="description">
                                            <h3>{{ $item->tarian_khas }}</h3>
                                            <p>Tarian Khas</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card card-details card-right">
                            <h2>Members are going</h2>
                            <div class="members my-2">
                                <img src="{{ url('frontend/img/members1.png') }}" alt="" class="member-image mr-1" />
                                <img src="{{ url('frontend/img/members2.png') }}" alt="" class="member-image mr-1" />
                                <img src="{{ url('frontend/img/members3.png') }}" alt="" class="member-image mr-1" />
                                <img src="{{ url('frontend/img/members4.png') }}" alt="" class="member-image mr-1" />
                                <img src="{{ url('frontend/img/members.png') }}" alt="" class="member-image mr-1" />
                            </div>
                            <hr />
                            <h2>Informasi</h2>
                            <table class="trip-informations">
                                <tr>
                                    <th width="50%">Tanggal Keberangkatan</th>
                                    <td width="50%" class="text-right">
                                        {{ \Carbon\Carbon::create($item->tanggal_keberangkatan)->format('F n, Y') }}</td>
                                </tr>
                                <tr>
                                    <th width="50%">Durasi Wisata</th>
                                    <td width="50%" class="text-right">{{ $item->durasi_wisata }}</td>
                                </tr>
                                <tr>
                                    <th width="50%">Tipe Trip</th>
                                    <td width="50%" class="text-right">{{ $item->tipe_trip }}</td>
                                </tr>
                                <tr>
                                    <th width="50%">Harga</th>
                                    <td width="50%" class="text-right">${{ $item->harga }},00 / Orang</td>
                                </tr>
                            </table>
                        </div>
                        <div class="join-container">
                            @auth
                                <form action="{{ route('checkout_process', $item->id) }}" method="post">
                                    @csrf
                                    <button class="btn btn-block btn-join-now mt-3 py-2" type="submit">
                                        Join Now
                                    </button>
                                </form>
                            @endauth

                            @guest
                                <a href="{{ route('login') }}" class="btn btn-block btn-join-now mt-3 py-2">
                                    Login or Register to Join
                                </a>
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('prepend-style')
    <link rel="stylesheet" href="{{ url('frontend/libraries/xzoom/xzoom.css') }}" />
@endpush

@push('addon-script')
    <script src="{{ url('frontend/libraries/xzoom/xzoom.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $(".xzoom, .xzoom-gallery").xzoom({
                zoomWidth: 100,
                title: false,
                tint: "#333",
                position: "lens",
                lensShape: "circle",
            });
        });
    </script>
@endpush
