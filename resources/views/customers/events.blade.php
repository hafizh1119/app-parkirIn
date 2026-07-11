@extends('layouts.app')

@push('styles')
<link rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=block" />
<style>
    :root {
        --pk-primary: #2a14b4;
        --pk-primary-dark: #190b7a;
        --pk-primary-light: #6d5ce8;
        --pk-amber: #ffb800;
        --pk-amber-dark: #d99400;
        --pk-red: #ff3b4e;
        --pk-red-dark: #d81f34;
        --pk-green: #12b76a;
        --pk-bg: #f5f7fc;
        --pk-surface: #ffffff;
        --pk-border: #e3e6f5;
        --pk-text: #14162b;
        --pk-text-muted: #5b5f7a;
    }

    .material-symbols-outlined {
        font-family: 'Material Symbols Outlined';
        font-weight: normal;
        font-style: normal;
        font-size: 24px;
        line-height: 1;
        letter-spacing: normal;
        text-transform: none;
        display: inline-block;
        white-space: nowrap;
        word-wrap: normal;
        direction: ltr;
        font-feature-settings: 'liga';
        -webkit-font-smoothing: antialiased;
        font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
    }

    .pk-hero {
        background:
            radial-gradient(ellipse 80% 60% at 50% -10%, rgba(42,20,180,0.10), transparent),
            linear-gradient(180deg, #f5f7fc 0%, #eef0fb 100%);
    }

    .pk-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--pk-primary);
    }

    .pk-eyebrow::before {
        content: '';
        width: 18px;
        height: 3px;
        background: var(--pk-amber);
        border-radius: 2px;
        display: inline-block;
    }

    .pk-title {
        color: var(--pk-text);
        font-weight: 900 !important;
        letter-spacing: -0.5px;
        text-shadow: 0 2px 0 rgba(42,20,180,0.08);
    }

    .pk-title .highlight {
        background: linear-gradient(90deg, var(--pk-primary) 0%, var(--pk-primary-light) 100%);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        text-shadow: none;
    }

    .pk-cta {
        background: linear-gradient(135deg, var(--pk-primary) 0%, var(--pk-primary-dark) 100%);
        box-shadow: 0 8px 20px -6px rgba(42,20,180,0.45);
        transition: all 0.25s ease;
    }

    .pk-cta:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 24px -6px rgba(42,20,180,0.55);
    }

    .pk-promo-banner {
        background: linear-gradient(135deg, #dc2626 0%, #f97316 50%, #dc2626 100%);
        color: #ffffff;
        font-weight: 800;
        font-size: 13px;
        letter-spacing: 0.5px;
        padding: 10px 24px;
        border-radius: 999px;
        box-shadow: 0 0 40px rgba(239,68,68,0.5);
        border: 2px solid rgba(255,255,255,0.3);
        animation: pk-banner-pulse 2s ease-in-out infinite;
        background-size: 200% 200%;
    }

    @keyframes pk-banner-pulse {
        0%, 100% { 
            transform: scale(1);
            box-shadow: 0 0 30px rgba(239, 68, 68, 0.4);
            background-position: 0% 50%;
        }
        50% { 
            transform: scale(1.03);
            box-shadow: 0 0 60px rgba(239, 68, 68, 0.7);
            background-position: 100% 50%;
        }
    }

    .pk-subtitle {
        color: var(--pk-text-muted);
        font-size: 17px;
        line-height: 1.6;
    }

    .pk-subtitle strong {
        color: var(--pk-primary);
        font-weight: 800;
    }

    .pk-barrier {
        height: 10px;
        background: repeating-linear-gradient(
            -45deg,
            var(--pk-amber),
            var(--pk-amber) 16px,
            #1a1a1a 16px,
            #1a1a1a 32px
        );
    }

    .pk-section {
        background: var(--pk-bg);
    }

    /* ===================== CARD POSTER / PAMFLET ===================== */

    .promo-card {
        background: var(--pk-surface);
        border: 1px solid var(--pk-border);
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .promo-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 40px -12px rgba(42,20,180,0.25);
        border-color: var(--pk-primary-light);
    }

    /* Wrapper poster: rasio vertikal 2:3 ala poster film / pamflet */
    .pk-poster {
        position: relative;
        width: 100%;
        aspect-ratio: 2 / 3;
        overflow: hidden;
        border-radius: 14px;
        background: #f2f4f6;
    }

    .pk-poster img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .promo-card:hover .pk-poster img {
        transform: scale(1.06);
    }

    /* Gradient overlay di bagian bawah poster, tempat judul & tanggal menempel */
    .pk-poster-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(
            to top,
            rgba(20,22,43,0.92) 0%,
            rgba(20,22,43,0.55) 32%,
            rgba(20,22,43,0.0) 60%
        );
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        padding: 16px;
    }

    .pk-poster-title {
        color: #fff;
        font-weight: 800;
        font-size: 1.05rem;
        line-height: 1.25;
        text-shadow: 0 2px 8px rgba(0,0,0,0.35);
    }

    .pk-poster-date {
        color: rgba(255,255,255,0.85);
        font-size: 0.72rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 4px;
        margin-top: 4px;
    }

    .pk-badge-discount {
        background: linear-gradient(135deg, var(--pk-red) 0%, var(--pk-red-dark) 100%);
        transform: rotate(-6deg);
        box-shadow: 0 4px 10px -2px rgba(216,31,52,0.5);
        border: 2px dashed rgba(255,255,255,0.5);
    }

    .pk-badge-live {
        background: var(--pk-green);
        position: relative;
    }

    .pk-badge-live .pk-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #fff;
        display: inline-block;
        animation: pk-pulse 1.6s ease-in-out infinite;
    }

    @keyframes pk-pulse {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.4; transform: scale(1.4); }
    }

    .pk-date-chip {
        color: var(--pk-primary);
        background: #eeecfc;
        border-radius: 8px;
        padding: 6px 10px;
    }

    .pk-detail-btn {
        background: var(--pk-primary);
        transition: all 0.2s ease;
    }

    .pk-detail-btn:hover {
        background: var(--pk-primary-dark);
    }

    .pk-empty-icon {
        color: #c7c9e0;
    }

    /* ===================== MODAL DETAIL — MODERN ===================== */

    .pk-modal-content {
        border: none;
        overflow: hidden;
        border-radius: 22px;
        box-shadow: 0 30px 70px -20px rgba(20,22,43,0.35);
    }

    /* Hero image full-bleed di atas modal */
    .pk-modal-hero {
        position: relative;
        width: 100%;
        height: 260px;
        overflow: hidden;
        background: #eef0fb;
    }

    .pk-modal-hero img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .pk-modal-hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(
            to top,
            rgba(20,22,43,0.95) 0%,
            rgba(20,22,43,0.45) 45%,
            rgba(20,22,43,0.05) 75%
        );
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        padding: 24px;
    }

    .pk-modal-badges {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 10px;
    }

    .pk-modal-title {
        color: #fff;
        font-weight: 800;
        font-size: 1.5rem;
        line-height: 1.2;
        text-shadow: 0 2px 10px rgba(0,0,0,0.4);
    }

    /* Tombol close melayang di atas hero image */
    .pk-modal-close-float {
        position: absolute;
        top: 16px;
        right: 16px;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: rgba(20,22,43,0.55);
        backdrop-filter: blur(6px);
        border: none;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
        z-index: 5;
    }

    .pk-modal-close-float:hover {
        background: rgba(20,22,43,0.85);
        transform: rotate(90deg);
    }

    .pk-modal-body {
        padding: 24px 28px 28px;
    }

    .pk-modal-desc {
        color: var(--pk-text-muted);
        font-size: 0.92rem;
        line-height: 1.6;
    }

    /* Grid info modern, pengganti list bergaris tiket */
    .pk-info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
        margin-top: 20px;
    }

    .pk-info-card {
        background: var(--pk-bg);
        border: 1px solid var(--pk-border);
        border-radius: 14px;
        padding: 14px;
        display: flex;
        align-items: flex-start;
        gap: 10px;
    }

    .pk-info-card.pk-info-card-wide {
        grid-column: 1 / -1;
    }

    .pk-info-icon {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: #eeecfc;
        color: var(--pk-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .pk-info-label {
        font-size: 0.65rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 700;
        color: var(--pk-text-muted);
        margin-bottom: 2px;
    }

    .pk-info-value {
        font-size: 0.85rem;
        font-weight: 700;
        color: var(--pk-text);
        line-height: 1.35;
    }

    .pk-capacity-bar {
        width: 100%;
        height: 6px;
        border-radius: 999px;
        background: #e3e6f5;
        overflow: hidden;
        margin-top: 8px;
    }

    .pk-capacity-fill {
        height: 100%;
        background: linear-gradient(90deg, var(--pk-primary) 0%, var(--pk-primary-light) 100%);
        border-radius: 999px;
    }

    .pk-modal-footer {
        border: none;
        padding: 0 28px 28px;
    }

    .pk-close-btn {
        background: var(--pk-bg);
        color: var(--pk-text);
        border: 1px solid var(--pk-border);
        transition: all 0.2s ease;
        width: 100%;
        font-size: 0.9rem;
    }

    .pk-close-btn:hover {
        background: #e9ebfa;
        color: var(--pk-text);
    }

    .animate-bounce {
        animation: pk-bounce 1.5s ease-in-out infinite;
    }

    @keyframes pk-bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-6px); }
    }
</style>
@endpush

@section('content')

    {{-- ===================== HERO ===================== --}}
    <section class="pk-hero relative overflow-hidden pt-24 pb-16 px-4 md:px-8">
        <div class="max-w-4xl mx-auto text-center relative z-10">

            <div class="flex justify-center mb-4">
                <span class="pk-promo-banner inline-flex items-center gap-3">
                    <span class="material-symbols-outlined text-lg animate-bounce">local_fire_department</span>
                    Event & Promo Parkir Bulan Ini
                    <span class="material-symbols-outlined text-lg animate-bounce">local_fire_department</span>
                </span>
            </div>

            <p class="pk-subtitle mb-8 max-w-2xl mx-auto">
                <strong>Parkir makin hemat, aktivitas makin semangat!</strong> Jangan lewatkan diskon dan promo eksklusif dari berbagai event parkir pilihan yang sedang berlangsung.
            </p>

        </div>
    </section>

    {{-- signature: barrier stripe --}}
    <div class="pk-barrier"></div>

    {{-- ===================== GRID EVENT ===================== --}}
    <section class="pk-section py-10 px-4 md:px-8">
        <div class="max-w-7xl mx-auto">

            @if($events->count() > 0)
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
                    @foreach($events as $event)
                        @php
                            $eventImage = $event->image ? asset($event->image) : asset('assets/img/default-event.jpg');
                        @endphp

                        {{-- CARD POSTER --}}
                        <div class="promo-card rounded-2xl p-3 flex flex-col cursor-pointer"
                             data-bs-toggle="modal" data-bs-target="#eventModal{{ $event->id }}">

                            <div class="pk-poster">
                                <img src="{{ $eventImage }}" alt="{{ $event->name }}">

                                @if($event->discount_percentage > 0)
                                    <div class="pk-badge-discount absolute top-3 right-3 text-white px-3 py-1 rounded-full text-xs font-extrabold z-10">
                                        {{ $event->discount_percentage }}%
                                    </div>
                                @endif

                                @if($event->status == 'active')
                                    <div class="pk-badge-live absolute top-3 left-3 text-white pl-2 pr-3 py-1 rounded-full text-[10px] font-bold flex items-center gap-1.5 z-10">
                                        <span class="pk-dot"></span> Sedang Berlangsung
                                    </div>
                                @endif

                                {{-- Overlay judul + tanggal, gaya caption pamflet --}}
                                <div class="pk-poster-overlay">
                                    <h3 class="pk-poster-title line-clamp-2">{{ $event->name }}</h3>
                                    <div class="pk-poster-date">
                                        <span class="material-symbols-outlined" style="font-size:14px;">calendar_today</span>
                                        {{ $event->start_date->format('d M') }} - {{ $event->end_date->format('d M Y') }}
                                    </div>
                                </div>
                            </div>

                            <div class="pt-3">
                                <p class="text-sm mb-3 line-clamp-2" style="color: var(--pk-text-muted);">{{ $event->description }}</p>

                                <button class="pk-detail-btn w-full py-2.5 text-white rounded-xl font-semibold"
                                        onclick="event.stopPropagation();">
                                    Lihat Detail
                                </button>
                            </div>
                        </div>

                        {{-- MODAL DETAIL — MODERN --}}
                        <div class="modal fade" id="eventModal{{ $event->id }}" tabindex="-1"
                             aria-labelledby="eventModalLabel{{ $event->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 480px;">
                                <div class="pk-modal-content modal-content">

                                    {{-- Hero image full-bleed dengan judul overlay --}}
                                    <div class="pk-modal-hero">
                                        <img src="{{ $eventImage }}" alt="{{ $event->name }}">

                                        <button type="button" class="pk-modal-close-float" data-bs-dismiss="modal" aria-label="Close">
                                            <span class="material-symbols-outlined" style="font-size:18px;">close</span>
                                        </button>

                                        <div class="pk-modal-hero-overlay">
                                            <div class="pk-modal-badges">
                                                @if($event->status == 'active')
                                                    <span class="pk-badge-live inline-flex items-center gap-1.5 text-white px-3 py-1 rounded-full text-[11px] font-bold">
                                                        <span class="pk-dot"></span> Sedang Berlangsung
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center text-white px-3 py-1 rounded-full text-[11px] font-bold" style="background: var(--pk-amber-dark);">
                                                        Akan Datang
                                                    </span>
                                                @endif

                                                @if($event->discount_percentage > 0)
                                                    <span class="pk-badge-discount inline-flex items-center gap-1 text-white px-3 py-1 rounded-full text-[11px] font-extrabold">
                                                        <span class="material-symbols-outlined text-sm">local_offer</span>
                                                        {{ $event->discount_percentage }}%
                                                    </span>
                                                @endif
                                            </div>

                                            <h5 class="pk-modal-title" id="eventModalLabel{{ $event->id }}">
                                                {{ $event->name }}
                                            </h5>
                                        </div>
                                    </div>

                                    <div class="pk-modal-body">
                                        <p class="pk-modal-desc">{{ $event->description }}</p>

                                        <div class="pk-info-grid">

                                            <div class="pk-info-card pk-info-card-wide">
                                                <div class="pk-info-icon">
                                                    <span class="material-symbols-outlined text-lg">calendar_today</span>
                                                </div>
                                                <div>
                                                    <div class="pk-info-label">Tanggal</div>
                                                    <div class="pk-info-value">
                                                        {{ $event->start_date->format('d M Y') }} — {{ $event->end_date->format('d M Y') }}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="pk-info-card">
                                                <div class="pk-info-icon">
                                                    <span class="material-symbols-outlined text-lg">schedule</span>
                                                </div>
                                                <div>
                                                    <div class="pk-info-label">Waktu</div>
                                                    <div class="pk-info-value">
                                                        {{ $event->start_date->format('H:i') }} — {{ $event->end_date->format('H:i') }}
                                                    </div>
                                                </div>
                                            </div>

                                            @if($event->max_capacity)
                                                <div class="pk-info-card">
                                                    <div class="pk-info-icon">
                                                        <span class="material-symbols-outlined text-lg">groups</span>
                                                    </div>
                                                    <div style="width: 100%;">
                                                        <div class="pk-info-label">Kapasitas</div>
                                                        <div class="pk-info-value">
                                                            {{ $event->current_participants ?? 0 }} / {{ $event->max_capacity }}
                                                        </div>
                                                        <div class="pk-capacity-bar">
                                                            <div class="pk-capacity-fill"
                                                                 style="width: {{ min(100, round((($event->current_participants ?? 0) / $event->max_capacity) * 100)) }}%;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                            @if($event->lokasiParkirs->count() > 0)
                                                <div class="pk-info-card pk-info-card-wide">
                                                    <div class="pk-info-icon">
                                                        <span class="material-symbols-outlined text-lg">location_on</span>
                                                    </div>
                                                    <div>
                                                        <div class="pk-info-label mb-1">Lokasi Parkir</div>
                                                        <div class="flex flex-wrap gap-1.5">
                                                            @foreach($event->lokasiParkirs as $lokasi)
                                                                <span class="text-xs font-semibold px-2.5 py-1 rounded-full" style="background:#fff; color: var(--pk-primary); border: 1px solid var(--pk-border);">
                                                                    {{ $lokasi->nama }}
                                                                </span>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                        </div>
                                    </div>

                                    <div class="pk-modal-footer">
                                        <button type="button" class="pk-close-btn btn rounded-xl px-4 py-2.5 fw-semibold" data-bs-dismiss="modal">
                                            Tutup
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $events->links() }}
                </div>
            @else
                <div class="text-center py-16">
                    <span class="pk-empty-icon material-symbols-outlined text-6xl block">event_busy</span>
                    <h4 class="mt-3 text-lg font-bold" style="color: var(--pk-text);">Belum Ada Event</h4>
                    <p style="color: var(--pk-text-muted);">Belum ada event parkir yang tersedia saat ini.</p>
                </div>
            @endif

        </div>
    </section>

@endsection