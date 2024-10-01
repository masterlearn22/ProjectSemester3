@extends('index')

@section('content')
    <h1>Detail Pesan</h1>

    <p><strong>Dari:</strong> {{ $message->sender }}</p>
    <p><strong>Subjek:</strong> {{ $message->subject }}</p>
    <p><strong>Pesan:</strong> {{ $message->message_text }}</p>
    <p><strong>Status:</strong> {{ $message->message_status }}</p>
    <p><strong>Kategori:</strong> {{ $message->category->description }}</p>
    @foreach($message->documents as $document)
    <p>
        <img src="{{ Storage::url($document->file) }}" alt="{{ $document->description }}" style="max-width: 20%; height: auto;">
    </p>
@endforeach


    <form action="{{ route('messages.store') }}" method="POST">
        @csrf
        <!-- Field yang diperlukan untuk validasi -->
        <input type="hidden" name="sender" value="{{ Auth::user()->email}}">
        <input type="hidden" name="subject" value="Balasan: {{ $message->subject }}">
        <input type="hidden" name="message_status" value="Draft">
        <input type="hidden" name="no_mk" value="{{ $message->no_mk }}">
        <input type="hidden" name="create_by" value="{{ Auth::user()->ID_USER }}">
        <input type="hidden" name="recipient_email" value="{{ $message->sender }}"> <!-- Ini adalah pengirim awal yang sekarang menjadi penerima balasan -->
        <input type="hidden" name="message_reference" value="{{ $message->message_id }}">
        
        
        <!-- Balasan -->
        <div class="form-group">
            <label for="message_text">Balasan</label>
            <textarea name="message_text" class="form-control" rows="5" required></textarea>
        </div>
    
        <button type="submit" class="btn btn-primary">Balas</button>
    </form>
    
@endsection
