<!-- FILE: resources/views/components/application-logo.blade.php -->
<!-- Ganti seluruh isi file ini dengan kode berikut -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<style>
    .sehatku-logo-component {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: transform 0.3s ease;
    }

    .sehatku-logo-component:hover {
        transform: scale(1.05);
    }

    .sehatku-logo-component .icon-box {
        width: 36px;
        height: 36px;
        border: 2px solid #007bff;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #007bff;
        box-shadow: 0 3px 8px rgba(0, 123, 255, 0.3);
        transition: all 0.3s ease;
    }

    .sehatku-logo-component:hover .icon-box {
        box-shadow: 0 5px 12px rgba(0, 123, 255, 0.5);
        transform: rotate(5deg);
    }

    .sehatku-logo-component .icon-box i {
        font-size: 18px;
        color: white;
    }

    .sehatku-logo-component .text {
        font-size: 1.3em;
        font-weight: 700;
        color: #007bff;
        font-family: 'Montserrat', sans-serif;
        letter-spacing: -0.5px;
    }

    /* Dark Mode */
    .dark .sehatku-logo-component .icon-box {
        border-color: #3b82f6;
        background-color: #3b82f6;
    }

    .dark .sehatku-logo-component .text {
        color: #60a5fa;
    }
</style>

<div {{ $attributes->merge(['class' => 'sehatku-logo-component']) }}>
    <div class="icon-box">
        <i class="fas fa-chart-area"></i>
    </div>
    <span class="text">SehatKu</span>
</div>