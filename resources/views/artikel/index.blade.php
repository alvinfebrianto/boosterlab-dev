<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Artikel | Boosterlab</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>.custom-card{border-radius: 1em;}.toast-success{background-color: #28a745 !important;}.text-truncate-container{width:150px;}.text-truncate-container div{overflow:hidden;-webkit-line-clamp:8;-webkit-box-orient:vertical;display:-webkit-box;}.description-container{display:flex;align-items:center;height:100%;}.description-content{overflow:hidden;text-overflow:ellipsis;white-space:normal;-webkit-line-clamp:7;-webkit-box-orient:vertical;display:-webkit-box;}</style>
</head>
<body>
    <div id="app">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/admin') }}">
                    <img src="{{ asset('img/boosterlab_logo.svg') }}" alt="Boosterlab Logo" width="170" class="d-inline-block align-text-top">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto"></ul>
                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <strong>{{ __('Logout') }}</strong>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
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
    <div class="container mt-3 mb-3">
        <div class="row justify-content-center">
            <div class="col-md-2 mb-3">
                <!-- Sidebar -->
                <ul class="list-group custom-card">
                    <li class="list-group-item"><a href="{{ route('admin.home') }}" style="color: black; text-decoration: none;">Home</a></li>
                    <li class="list-group-item"><a href="{{ route('admin.jadwal') }}" style="color: black; text-decoration: none;">Jadwal</a></li>
                    <li class="list-group-item active" aria-current="true">Artikel</li>
                    <li class="list-group-item"><a href="{{ route('admin.faq') }}" style="color: black; text-decoration: none;">FAQ</a></li>
                </ul>
            </div>
            <div class="col-md-10">
                <div class="card border-0 shadow custom-card">
                    <div class="card-body">
                        <!-- Tombol Buat Artikel -->
                        <a href="{{ route('artikel.create') }}" class="btn btn-md btn-success mb-3">Buat Artikel</a>
                        <div class="table-responsive">
                            <!-- Tabel Artikel -->
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">GAMBAR</th>
                                        <th scope="col">JUDUL</th>
                                        <th scope="col">DESKRIPSI</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($artikels as $artikel)
                                        <tr>
                                            <td class="text-center">
                                                <img src="{{ Storage::url('public/artikels/').$artikel->image }}" class="rounded" style="width: 20rem">
                                            </td>
                                            <td>
                                                <div class="text-truncate-container">
                                                    <!-- Judul Artikel -->
                                                    <div class="text-truncate-container">{{ $artikel->title }}</div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="description-container">
                                                    <!-- Deskripsi Artikel -->
                                                    <div class="description-content">{{ strip_tags($artikel->content) }}</div>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <!-- Form untuk Hapus Artikel -->
                                                <form onsubmit="return confirm('Apakah Anda Yakin?');" action="{{ route('artikel.destroy', $artikel->id) }}" method="POST">
                                                    <!-- Tombol Lihat Artikel -->
                                                    <a href="{{ route('artikel.show', $artikel->id) }}" class="btn btn-sm btn-dark mb-1">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    <!-- Tombol Edit Artikel -->
                                                    <a href="{{ route('artikel.edit', $artikel->id) }}" class="btn btn-sm btn-primary mb-1">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <!-- Tombol Hapus Artikel -->
                                                    <button type="submit" class="btn btn-sm btn-danger mb-1">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4">
                                                <div class="alert alert-danger">
                                                    Artikel belum tersedia.
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                          {{ $artikels->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        @if(session()->has('success'))
            // Menampilkan pesan toastr untuk notifikasi sukses
            toastr.success('{{ session('success') }}', 'BERHASIL!'); 
        @elseif(session()->has('error'))
            // Menampilkan pesan toastr untuk notifikasi kesalahan
            toastr.error('{{ session('error') }}', 'GAGAL!'); 
        @endif
    </script>
</body>
</html>