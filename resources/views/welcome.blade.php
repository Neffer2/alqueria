@extends('layouts.app')
    @section('content')
    <div class="desktop-container">
        <img id="welcome-image-desk"
            src="{{ asset('assets/desk/desk.png') }}"
            alt="Promo Back To School Alquería: Gana entradas de cine con tus compras"
            title="Bienvenido a la promo Regreso a Clases de Alquería y Cine Colombia">
    </div>

    <div class="mobile-container">
        <img id="welcome-image-mobile"
            src="{{ asset('assets/mobile/mobile_.png') }}"
            alt="Promo Alquería Regreso a Clases: Tu oportunidad de ir al cine gratis"
            title="Participa en la promo Back To School de Alquería y Cine Colombia">
    </div>

    <a href="https://www.alqueria.com.co/terminos-y-condiciones" target="_blank" class="tc-btn tooltip" aria-label="Contáctanos por WhatsApp para la promo Back To School Alquería">
        <i class="bi-file-earmark-text"></i>
        <span class="tooltiptext tooltip-left">Términos y Condiciones!</span>
    </a>


    <a href="https://alqueria.com.co/sites/default/files/2025-07/TyC_Alqueria_Back_To_School.pdf" target="_blank" class="whatsapp-btn tooltip-wp" aria-label="Contáctanos por WhatsApp para la promo Back To School Alquería">
        <i class="bi bi-whatsapp"></i>
        <span class="tooltiptext-wp tooltip-left-wp">¡Participa aquí!</span>
    </a>
    @endsection
