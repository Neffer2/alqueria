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

    <a href="https://wa.me/573142636890?text=Hola%2C%20quiero%20participar!" target="_blank" class="whatsapp-btn" aria-label="Contáctanos por WhatsApp para la promo Back To School Alquería">
        <i class="bi bi-whatsapp"></i>
    </a>
    @endsection