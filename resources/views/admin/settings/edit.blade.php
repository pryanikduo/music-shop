@extends('layouts.admin')
@section('title', 'Настройки сайта')
@section('content')
<div class="card">
    <div class="card-header"><h3>Общие настройки</h3></div>
    <div class="card-body">
        <form action="{{ route('admin.settings.update') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3"><label>Телефон</label><input type="text" name="contact_phone" class="form-control" value="{{ $settings['contact_phone'] ?? '' }}"></div>
            <div class="mb-3"><label>Email</label><input type="email" name="contact_email" class="form-control" value="{{ $settings['contact_email'] ?? '' }}"></div>
            <div class="mb-3"><label>Адрес</label><input type="text" name="contact_address" class="form-control" value="{{ $settings['contact_address'] ?? '' }}"></div>
            <div class="mb-3"><label>Карта (iframe-код)</label><textarea name="google_maps_embed" class="form-control" rows="4">{{ $settings['google_maps_embed'] ?? '' }}</textarea></div>
            <div class="mb-3"><label>VK</label><input type="url" name="social_vk" class="form-control" value="{{ $settings['social_vk'] ?? '' }}"></div>
            <div class="mb-3"><label>Telegram</label><input type="url" name="social_telegram" class="form-control" value="{{ $settings['social_telegram'] ?? '' }}"></div>
            <div class="mb-3"><label>YouTube (опционально)</label><input type="url" name="social_youtube" class="form-control" value="{{ $settings['social_youtube'] ?? '' }}"></div>
            <button type="submit" class="btn btn-primary">Сохранить настройки</button>
        </form>
    </div>
</div>
@endsection