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

    .promo-card {
        background: var(--pk-surface);
        border: 1px solid var(--pk-border);
        transition: all 0.3s ease;
    }

    .promo-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 16px 32px -10px rgba(42,20,180,0.20);
        border-color: var(--pk-primary-light);
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

    .pk-modal-content {
        border: none;
        overflow: hidden;
    }

    .pk-modal-topbar {
        height: 6px;
        background: linear-gradient(90deg, var(--pk-primary) 0%, var(--pk-primary-light) 50%, var(--pk-amber) 100%);
    }

    .pk-ticket-divider {
        border-left: 2px dashed var(--pk-border);
        position: relative;
    }

    .pk-ticket-divider::before,
    .pk-ticket-divider::after {
        content: '';
        position: absolute;
        left: -8px;
        width: 14px;
        height: 14px;
        background: var(--pk-bg);
        border: 1px solid var(--pk-border);
        border-radius: 50%;
    }

    .pk-ticket-divider::before { top: -8px; }
    .pk-ticket-divider::after { bottom: -8px; }

    .pk-info-row {
        border-bottom: 1px solid #f0f1f8;
    }

    .pk-info-icon {
        width: 34px;
        height: 34px;
        border-radius: 9px;
        background: #eeecfc;
        color: var(--pk-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .pk-close-btn {
        background: var(--pk-text);
        color: #fff;
        transition: all 0.2s ease;
    }

    .pk-close-btn:hover {
        background: #000;
    }

    .pk-empty-icon {
        color: #c7c9e0;
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
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($events as $event)
                        @php
                            $eventImage = $event->image ? asset($event->image) : asset('assets/img/default-event.jpg');
                        @endphp

                        {{-- CARD --}}
                        <div class="promo-card rounded-2xl p-4 flex flex-col cursor-pointer"
                             data-bs-toggle="modal" data-bs-target="#eventModal{{ $event->id }}">

                            <div class="relative w-full aspect-video rounded-xl overflow-hidden mb-4" style="background:#f2f4f6;">
                                <img src="{{ $eventImage }}" alt="{{ $event->name }}" class="w-full h-full object-cover">

                                @if($event->discount_percentage > 0)
                                    <div class="pk-badge-discount absolute top-3 right-3 text-white px-3 py-1 rounded-full text-xs font-extrabold">
                                        {{ $event->discount_percentage }}%
                                    </div>
                                @endif

                                @if($event->status == 'active')
                                    <div class="pk-badge-live absolute top-3 left-3 text-white pl-2 pr-3 py-1 rounded-full text-[10px] font-bold flex items-center gap-1.5">
                                        <span class="pk-dot"></span> Sedang Berlangsung
                                    </div>
                                @endif
                            </div>

                            <div class="flex-1">
                                <h3 class="text-xl font-bold mb-1" style="color: var(--pk-text);">{{ $event->name }}</h3>
                                <p class="text-sm mb-4 line-clamp-2" style="color: var(--pk-text-muted);">{{ $event->description }}</p>

                                <div class="pk-date-chip inline-flex items-center gap-2 mb-4">
                                    <span class="material-symbols-outlined text-lg">calendar_today</span>
                                    <span class="text-sm font-semibold">
                                        {{ $event->start_date->format('d M Y') }} - {{ $event->end_date->format('d M Y') }}
                                    </span>
                                </div>
                            </div>

                            <button class="pk-detail-btn w-full py-2.5 text-white rounded-xl font-semibold"
                                    onclick="event.stopPropagation();">
                                Lihat Detail
                            </button>
                        </div>

                        {{-- MODAL DETAIL --}}
                        <div class="modal fade" id="eventModal{{ $event->id }}" tabindex="-1"
                             aria-labelledby="eventModalLabel{{ $event->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="pk-modal-content modal-content rounded-2xl">
                                    <div class="pk-modal-topbar"></div>

                                    <div class="modal-header border-0 px-5 pt-5 pb-2">
                                        <h5 class="modal-title font-extrabold text-xl" style="color: var(--pk-text);" id="eventModalLabel{{ $event->id }}">
                                            {{ $event->name }}
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body p-5 pt-2">
                                        <div class="row g-4">
                                            <div class="col-md-6">
                                                <img src="{{ $eventImage }}" alt="{{ $event->name }}"
                                                     class="w-full max-h-[200px] object-cover rounded-xl">
                                            </div>

                                            <div class="col-md-6 pk-ticket-divider ps-4">
                                                <div class="flex flex-wrap gap-2 mb-3">
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

                                                <p class="text-sm mb-4" style="color: var(--pk-text-muted);">{{ $event->description }}</p>

                                                <div>
                                                    <div class="pk-info-row flex items-center gap-3 py-3">
                                                        <div class="pk-info-icon">
                                                            <span class="material-symbols-outlined text-lg">calendar_today</span>
                                                        </div>
                                                        <div>
                                                            <div class="text-[10px] uppercase tracking-wide font-semibold" style="color: var(--pk-text-muted);">Tanggal</div>
                                                            <div class="font-bold text-sm" style="color: var(--pk-text);">
                                                                {{ $event->start_date->format('d M Y') }} — {{ $event->end_date->format('d M Y') }}
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="pk-info-row flex items-center gap-3 py-3">
                                                        <div class="pk-info-icon">
                                                            <span class="material-symbols-outlined text-lg">schedule</span>
                                                        </div>
                                                        <div>
                                                            <div class="text-[10px] uppercase tracking-wide font-semibold" style="color: var(--pk-text-muted);">Waktu</div>
                                                            <div class="font-bold text-sm" style="color: var(--pk-text);">
                                                                {{ $event->start_date->format('H:i') }} — {{ $event->end_date->format('H:i') }}
                                                            </div>
                                                        </div>
                                                    </div>

                                                    @if($event->max_capacity)
                                                        <div class="pk-info-row flex items-center gap-3 py-3">
                                                            <div class="pk-info-icon">
                                                                <span class="material-symbols-outlined text-lg">groups</span>
                                                            </div>
                                                            <div>
                                                                <div class="text-[10px] uppercase tracking-wide font-semibold" style="color: var(--pk-text-muted);">Kapasitas</div>
                                                                <div class="font-bold text-sm" style="color: var(--pk-text);">
                                                                    {{ $event->current_participants ?? 0 }} / {{ $event->max_capacity }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif

                                                    @if($event->lokasiParkirs->count() > 0)
                                                        <div class="flex items-center gap-3 py-3">
                                                            <div class="pk-info-icon">
                                                                <span class="material-symbols-outlined text-lg">location_on</span>
                                                            </div>
                                                            <div>
                                                                <div class="text-[10px] uppercase tracking-wide font-semibold mb-1" style="color: var(--pk-text-muted);">Lokasi Parkir</div>
                                                                <div class="flex flex-wrap gap-1.5">
                                                                    @foreach($event->lokasiParkirs as $lokasi)
                                                                        <span class="text-xs font-semibold px-2.5 py-1 rounded-full" style="background:#eeecfc; color: var(--pk-primary);">
                                                                            {{ $lokasi->nama }}
                                                                        </span>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer border-0 px-5 pb-5 pt-0">
                                        <button type="button" class="pk-close-btn btn btn-sm rounded-xl px-4 py-2 fw-semibold" data-bs-dismiss="modal">
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