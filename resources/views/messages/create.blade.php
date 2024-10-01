@extends('index')

@section('content')
    <h1>Kirim Pesan Baru</h1>

    <form action="{{ route('messages.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="sender">Pengirim</label>
            <input type="text" name="sender" class="form-control" value="{{ Auth::user()->email }}" readonly>
        </div>

        <div class="form-group">
            <label for="subject">Subjek</label>
            <input type="text" name="subject" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="message_text">Pesan</label>
            <textarea name="message_text" class="form-control" rows="5" required></textarea>
        </div>

        <div class="form-group">
            <label for="message_status">Status Pesan</label>
            <select name="message_status" class="form-control">
                <option value="Draft">Draft</option>
                <option value="Sent">Terkirim</option>
            </select>
        </div>

        <div class="form-group">
            <label for="no_mk">Kategori Pesan</label>
            <select name="no_mk" class="form-control" required>
                @foreach($categories as $category)
                    <option value="{{ $category->no_mk }}">{{ $category->description }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="recipient_email">Kepada</label>
            <select name="recipient_email" class="form-control" required>
                <option value="">Pilih Penerima</option>
                @foreach($users as $user)
                    <option value="{{ $user->email }}">{{ $user->email }}</option> <!-- Gunakan email di sini -->
                @endforeach
            </select>            
        </div>

        <div class="form-group">
            <label for="cc">Cc</label>
            <input type="text" name="cc" class="form-control">
        </div>
        
        <input type="hidden" name="create_by" value="{{ Auth::user()->name }}">


        <div class="form-group">
            <label for="file">Lampiran</label>
            <input type="file" name="file[]" class="form-control" multiple>
        </div>

        <button type="submit" class="btn btn-primary">Kirim</button>
    </form>
@endsection
