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

        @foreach ($posts as $post)
            <div class="card mb-4" style="border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3"> <!-- Tambahkan margin-bottom di sini -->
                        @if ($post->user->profile_photo)
                            <img src="{{ asset('storage/' . $post->user->profile_photo) }}" alt="Profile Photo"
                                class="rounded-circle mr-3" style="width: 40px; height: 40px; object-fit: cover;">
                        @else
                            <img src="{{ asset('assets/images/default-profile.jpg') }}" alt="Default Profile Photo"
                                class="rounded-circle mr-3" style="width: 40px; height: 40px; object-fit: cover;">
                        @endif
                        <h5 class="card-title mb-0 username">{{ $post->user->name }}</h5>
                    </div>
                    <div class="post-content">
                        <h4 class="card-text mb-0 post-text">{{ $post->message_text }}</h4>
                        <!-- Tambahkan margin-bottom di sini -->

                        <!-- Menampilkan gambar jika ada -->
                        @if (is_array($post->message_gambar))
                            <div class="d-flex flex-wrap mb-2"> <!-- Tambahkan margin-bottom di sini -->
                                @foreach ($post->message_gambar as $gambarPath)
                                    <img src="{{ asset('storage/' . $gambarPath) }}" alt="Gambar Postingan"
                                        class="img-fluid zoomable-image m-1"
                                        style="max-width: 23%; height: auto; object-fit: cover;">
                                @endforeach
                            </div>
                        @elseif(is_string($post->message_gambar))
                            @php
                                $gambarPathArray = json_decode($post->message_gambar, true);
                            @endphp
                            @if (is_array($gambarPathArray))
                                <div class="d-flex flex-wrap mb-2"> <!-- Tambahkan margin-bottom di sini -->
                                    @foreach ($gambarPathArray as $gambarPath)
                                        <img src="{{ asset('storage/' . $gambarPath) }}" alt="Gambar Postingan"
                                            class="img-fluid zoomable-image m-1"
                                            style="max-width: 23%; height: auto; object-fit: cover;">
                                    @endforeach
                                </div>
                            @endif
                        @endif

                        <p class="text-muted mb-0 timestamp"><small>Dibuat pada: {{ $post->create_date }}</small></p>
                    </div>

                    <!-- Bagian tombol Edit dan Hapus, di pojok kanan atas -->
                    <div class="position-absolute" style="top: 10px; right: 10px;">
                        <a href="{{ route('postings.edit', $post->posting_id) }}" class="btn btn-light btn-sm">Edit</a>
                        <form action="{{ route('postings.destroy', $post->posting_id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-dark btn-sm"
                                onclick="return confirm('Apakah anda yakin ingin menghapus posting ini?')">Hapus</button>
                        </form>
                    </div>
                    <!-- Comment section -->
                    <div class="card-footer">
                        <h6>Komentar:</h6>
                        @if ($post->komentar->count() > 0)
                            <ul class="comment-list">
                                <!-- Menampilkan maksimal 3 komentar -->
                                @foreach ($post->komentar->take(3) as $komentar)
                                    <li>
                                        
                                        <h6 style="display:inline">{{ $komentar->user->name }}:</h6>
                                        {{ $komentar->komentar_text }}
                                        <small class="text-muted mt-0" style="display:block">Dibuat pada:
                                            {{ $komentar->create_date }}</small>
                                    </li>
                                @endforeach

                                <!-- Sembunyikan sisa komentar -->
                                <div class="extra-comments" style="display: none;">
                                    @foreach ($post->komentar->slice(3) as $komentar)
                                        <li>
                                            <h6>{{ $komentar->user->username }}: {{ $komentar->komentar_text }}</h6>
                                            <small class="text-muted" style="margin-top: 0;">Dibuat pada:
                                                {{ $komentar->create_date }}</small>
                                        </li>
                                    @endforeach
                                </div>
                            </ul>

                            <!-- Tombol See More dan See Less Comments -->
                            @if ($post->komentar->count() > 3)
                                <button class="btn btn-secondary btn-sm see-more-comments">See More Comments</button>
                                <button class="btn btn-secondary btn-sm see-less-comments" style="display: none;">See Less
                                    Comments</button>
                            @endif
                        @else
                            <p>Belum ada komentar.</p>
                        @endif

                        <!-- Form Tambah Komentar -->
                        <form action="{{ route('comments.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="posting_id" value="{{ $post->posting_id }}">
                            <input type="hidden" name="id_user" value="{{ Auth::user()->ID_USER }}">

                            <!-- Bagian Input dan Button dalam satu baris -->
                            <div class="form-group d-flex">
                                <textarea name="komentar_text" class="form-control" rows="1" required placeholder="Tambahkan komentar..."></textarea>
                                <button type="submit" class="btn btn-info ml-2">Kirim Komentar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <style>
        .zoomable-image {
            cursor: pointer;
            transition: transform 0.2s;
        }

        .modal-container {
            display: none;
            position: fixed;
            z-index: 1000;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            justify-content: center;
            align-items: center;
        }

        .modal-container img {
            max-width: 90%;
            max-height: 90%;
        }

        .username {
            font-family: 'Roboto', sans-serif;
            font-size: 18px;
            padding-left: 12px;
        }

        .post-text {
            font-family: 'Open Sans', sans-serif;
            font-size: 16px;
        }

        .timestamp {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            color: #666;
        }
    </style>

    <div class="container">
        <!-- Your existing HTML code here -->
    </div>
    <!-- Modal untuk menampilkan gambar -->
    <div class="modal-container" id="image-modal">
        <img id="modal-image" src="" alt="Gambar">
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('image-modal');
            const modalImage = document.getElementById('modal-image');
            const zoomableImages = document.querySelectorAll('.zoomable-image');

            zoomableImages.forEach(image => {
                image.addEventListener('click', function() {
                    modal.style.display = 'flex';
                    modalImage.src = this.src;
                });
            });

            modal.addEventListener('click', function() {
                modal.style.display = 'none';
            });

            const seeMoreButtons = document.querySelectorAll('.see-more-comments');
            const seeLessButtons = document.querySelectorAll('.see-less-comments');

            seeMoreButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const extraComments = this.parentElement.querySelector('.extra-comments');
                    extraComments.style.display = 'block';
                    this.style.display = 'none';
                    const seeLessButton = this.parentElement.querySelector('.see-less-comments');
                    seeLessButton.style.display = 'inline-block';
                });
            });

            seeLessButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const extraComments = this.parentElement.querySelector('.extra-comments');
                    extraComments.style.display = 'none';
                    this.style.display = 'none';
                    const seeMoreButton = this.parentElement.querySelector('.see-more-comments');
                    seeMoreButton.style.display = 'inline-block';
                });
            });
        });
    </script>
@endsection
