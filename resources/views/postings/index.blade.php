    @extends('index')

    @section('content')
        <div class="container">
            <h1>Daftar Postingan</h1>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <a href="{{ route('postings.create') }}" class="btn btn-primary mb-3">Buat Postingan Baru</a>

            <!-- Ubah dari ID_USER menjadi username -->
            @foreach ($posts as $post)
                <div class="card mb-4">
                    <div class="card-body">
                        <!-- Menampilkan username dari user yang membuat posting -->
                        <h5 class="card-title">{{ $post->user->username }}</h5>
                        <p class="card-text">{{ $post->message_text }}</p>

                        @if (!empty($post->message_gambar))
                        @php
                            $gambarPathArray = json_decode($post->message_gambar, true);
                        @endphp
                        @foreach ($gambarPathArray as $gambarPath)
                            <img src="{{ asset('storage/' . $gambarPath) }}" alt="Gambar Postingan" class="img-fluid" style="max-width: 20%; height: auto;">
                        @endforeach
                    @endif
                    

                        <p><small class="text-muted">Dibuat pada: {{ $post->create_date }}</small></p>
                        <a href="{{ route('postings.edit', $post->posting_id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('postings.destroy', $post->posting_id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger"
                                onclick="return confirm('Apakah anda yakin ingin menghapus posting ini?')">Hapus</button>
                        </form>
                    </div>

                    <!-- Bagian untuk menampilkan komentar -->
                    <div class="card-footer">
                        <h6>Komentar:</h6>
                        @if ($post->komentar->count() > 0)
                            <ul>
                                @foreach ($post->komentar as $komentar)
                                    <li>
                                        <!-- Tampilkan username dari user yang membuat komentar -->
                                        <h6>{{ $komentar->user->username }}: {{ $komentar->komentar_text }} </h6>
                                        <small class="text-muted">Dibuat pada: {{ $komentar->create_date }}</small>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p>Belum ada komentar.</p>
                        @endif

                        <!-- Form Tambah Komentar -->
                        <form action="{{ route('comments.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="posting_id" value="{{ $post->posting_id }}">
                            <input type="hidden" name="id_user" value="{{ Auth::user()->ID_USER }}">

                            <div class="form-group">
                                <label for="komentar_text">Komentar:</label>
                                <textarea name="komentar_text" class="form-control" rows="3" required></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary mt-2">Kirim Komentar</button>
                        </form>
                    </div>
                </div>
            @endforeach



        </div>
    @endsection
