@extends('index')

@section('content')
    <h1>Edit Pesan</h1>

    <form action="{{ route('messages.update', $message->message_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="subject">Subjek</label>
            <input type="text" name="subject" class="form-control" value="{{ $message->subject }}" required>
        </div>

        <div class="form-group">
            <label for="message_text">Pesan</label>
            <textarea name="message_text" class="form-control" rows="5" required>{{ $message->message_text }}</textarea>
        </div>

        <div class="form-group">
            <label for="message_status">Status Pesan</label>
            <select name="message_status" class="form-control">
                <option value="Draft" {{ $message->message_status == 'Draft' ? 'selected' : '' }}>Draft</option>
                <option value="Sent" {{ $message->message_status == 'Sent' ? 'selected' : '' }}>Terkirim</option>
            </select>
        </div>

        <div class="form-group">
            <label for="no_mk">Kategori Pesan</label>
            <select name="no_mk" class="form-control">
                @foreach($categories as $category)
                    <option value="{{ $category->no_mk }}" {{ $message->no_mk == $category->no_mk ? 'selected' : '' }}>
                        {{ $category->description }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="file">Lampiran</label>
            <input type="file" name="file[]" class="form-control" multiple>
        </div>

        <button type="submit" class="btn btn-primary">Perbarui</button>
    </form>
@endsection
